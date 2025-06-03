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
            ->findAll();

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
        $file = $this->request->getFile('gambar');

        if ($file->isValid() && !$file->hasMoved()) {
            $namaGambar = $file->getRandomName();
            $file->move('assets/images', $namaGambar);
        } else {
            $namaGambar = null;
        }

        $this->wisataModel->insert([
            'nama_wisata' => $this->request->getPost('nama_wisata'),
            'alamat' => $this->request->getPost('alamat'),
            'gambar' => $namaGambar,
            'sub_kriteria_id' => $this->request->getPost('sub_kriteria_id'),
        ]);

        return redirect()->to('/admin/wisata');
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
        $file = $this->request->getFile('gambar');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaGambar = $file->getRandomName();
            $file->move('assets/images', $namaGambar);

            // Hapus gambar lama
            if ($wisata['gambar'] && file_exists('assets/images/' . $wisata['gambar'])) {
                unlink('assets/images/' . $wisata['gambar']);
            }
        } else {
            $namaGambar = $wisata['gambar']; // Tetap gunakan gambar lama
        }

        $this->wisataModel->update($id, [
            'nama_wisata' => $this->request->getPost('nama_wisata'),
            'alamat' => $this->request->getPost('alamat'),
            'gambar' => $namaGambar,
            'sub_kriteria_id' => $this->request->getPost('sub_kriteria_id'),
        ]);

        return redirect()->to('/admin/wisata');
    }

    public function delete($id)
    {
        $this->wisataModel->delete($id);
        return redirect()->to('/admin/wisata');
    }
}
