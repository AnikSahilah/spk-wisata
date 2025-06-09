<?php

namespace App\Controllers;

use App\Models\SubKriteriaModel;
use App\Models\KriteriaModel;

class SubKriteriaController extends BaseController
{
    protected $subKriteriaModel;
    protected $kriteriaModel;

    public function __construct()
    {
        $this->subKriteriaModel = new SubKriteriaModel();
        $this->kriteriaModel = new KriteriaModel();
    }

    public function index()
    {
        $data['subkriteria'] = $this->subKriteriaModel
            ->select('sub_kriteria.*, kriteria.nama_kriteria')  // ambil semua field sub_kriteria + nama kriteria
            ->join('kriteria', 'kriteria.id = sub_kriteria.kriteria_id')  // JOIN ON
            ->orderBy('sub_kriteria.id', 'ASC')
            ->findAll();

        return view('sub-kriteria/index', $data);
    }

    public function create()
    {
        $data['kriteria'] = $this->kriteriaModel->findAll();
        return view('sub-kriteria/create', $data);
    }

    public function store()
    {
        $this->subKriteriaModel->save([
            'kriteria_id' => $this->request->getPost('kriteria_id'),
            'nama'        => $this->request->getPost('nama'),
        ]);

        return redirect()->to('admin/sub-kriteria')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['subkriteria'] = $this->subKriteriaModel->find($id);
        $data['kriteria'] = $this->kriteriaModel->findAll();
        return view('sub-kriteria/edit', $data);
    }

    public function update($id)
    {
        // dd($this->request->getPost());
        $this->subKriteriaModel->update($id, [
            'kriteria_id' => $this->request->getPost('kriteria_id'),
            'nama'        => $this->request->getPost('nama'),
        ]);

        return redirect()->to('admin/sub-kriteria')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->subKriteriaModel->delete($id);
        return redirect()->to('admin/sub-kriteria')->with('success', 'Data berhasil dihapus.');
    }
}
