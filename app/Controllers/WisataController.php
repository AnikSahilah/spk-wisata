<?php

namespace App\Controllers;

use App\Models\WisataModel;
use App\Models\SubKriteriaModel;

class WisataController extends BaseController
{
    protected $wisataModel;
    protected $subKriteriaModel;

    public function __construct()
    {
        $this->wisataModel = new WisataModel();
        $this->subKriteriaModel = new SubKriteriaModel();
    }

    public function index()
    {
        $data['wisata'] = $this->wisataModel
            ->select('wisata.*, sub_kriteria.nama as sub_kriteria_nama')
            ->join('sub_kriteria', 'wisata.sub_kriteria_id = sub_kriteria.id')
            ->paginate(10);

        $data['pager'] = $this->wisataModel->pager;

        return view('wisata/index', $data);
    }

    public function create()
    {
        $subKriteriaModel = new SubKriteriaModel();
        $data['subkriteria'] = $subKriteriaModel->where('kriteria_id', 1)->findAll();
        return view('wisata/create', $data);
    }

    public function store()
    {
        $validationRules = [
            'nama_wisata'      => 'required',
            'alamat'           => 'required',
            'sub_kriteria_id'  => 'required',
            'gambar' => [
                'uploaded[gambar]',
                'is_image[gambar]',
                'max_size[gambar,2048]' // 2048 KB = 2MB
            ]
        ];

        $validationMessages = [
            'nama_wisata' => [
                'required' => 'Nama wisata wajib diisi.'
            ],
            'alamat' => [
                'required' => 'Alamat wajib diisi.'
            ],
            'sub_kriteria_id' => [
                'required' => 'Sub kriteria wajib dipilih.'
            ],
            'gambar' => [
                'uploaded' => 'Gambar wajib diunggah.',
                'is_image' => 'File yang diunggah harus berupa gambar.',
                'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB.'
            ]
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('gambar');
        $namaGambar = $file->getRandomName();
        $file->move('assets/images', $namaGambar);

        $this->wisataModel->insert([
            'nama_wisata' => $this->request->getPost('nama_wisata'),
            'alamat' => $this->request->getPost('alamat'),
            'gambar' => $namaGambar,
            'sub_kriteria_id' => $this->request->getPost('sub_kriteria_id'),
        ]);

        return redirect()->to('/admin/wisata')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $subKriteriaModel = new SubKriteriaModel();

        $data['subkriteria'] = $subKriteriaModel->where('kriteria_id', 1)->findAll();
        $data['wisata'] = $this->wisataModel->find($id);

        return view('wisata/edit', $data);
    }

    public function update($id)
    {
        $wisata = $this->wisataModel->find($id);

        $validationRules = [
            'nama_wisata'      => 'required',
            'alamat'           => 'required',
            'sub_kriteria_id'  => 'required',
            'gambar' => [
                'uploaded[gambar]',
                'is_image[gambar]',
                'max_size[gambar,2048]' // 2048 KB = 2MB
            ]
        ];

        $validationMessages = [
            'nama_wisata' => [
                'required' => 'Nama wisata wajib diisi.'
            ],
            'alamat' => [
                'required' => 'Alamat wajib diisi.'
            ],
            'sub_kriteria_id' => [
                'required' => 'Sub kriteria wajib dipilih.'
            ],
            'gambar' => [
                'uploaded' => 'Gambar wajib diunggah.',
                'is_image' => 'File yang diunggah harus berupa gambar.',
                'max_size' => 'Ukuran gambar tidak boleh lebih dari 2MB.'
            ]
        ];

        if (!$this->validate($validationRules, $validationMessages)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('gambar');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaGambar = $file->getRandomName();
            $file->move('assets/images', $namaGambar);

            if ($wisata['gambar'] && file_exists('assets/images/' . $wisata['gambar'])) {
                unlink('assets/images/' . $wisata['gambar']);
            }
        } else {
            $namaGambar = $wisata['gambar'];
        }

        $this->wisataModel->update($id, [
            'nama_wisata' => $this->request->getPost('nama_wisata'),
            'alamat' => $this->request->getPost('alamat'),
            'gambar' => $namaGambar,
            'sub_kriteria_id' => $this->request->getPost('sub_kriteria_id'),
        ]);

        return redirect()->to('/admin/wisata')->with('success', 'Data berhasil diperbarui');
    }

    public function delete($id)
    {
        $this->wisataModel->delete($id);
        return redirect()->to('/admin/wisata');
    }
}
