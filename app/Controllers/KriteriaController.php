<?php

namespace App\Controllers;

use App\Models\KriteriaModel;

class KriteriaController extends BaseController
{
    protected $kriteriaModel;

    /*************  ✨ Windsurf Command ⭐  *************/
    /**
     * Constructor.
     *
     * @return void
     */
    /*******  0f52aa28-3cda-48dc-b09c-3d840d03cb67  *******/
    public function __construct()
    {
        $this->kriteriaModel = new KriteriaModel();
    }

    // Tampilkan list kriteria
    public function index()
    {
        $data['kriteria'] = $this->kriteriaModel->findAll();
        return view('kriteria/index', $data);
    }

    // Tampilkan form tambah
    public function create()
    {
        return view('kriteria/create');
    }

    // Proses simpan data baru
    public function store()
    {
        $validation = \Config\Services::validation();

        $data = $this->request->getPost();

        // Validasi input
        $rules = [
            'nama_kriteria' => 'required|max_length[100]',
            'type' => 'required|in_list[cost,benefit]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->kriteriaModel->insert([
            'nama_kriteria' => $data['nama_kriteria'],
            'bobot' => $data['bobot'], // Default bobot
            'type' => $data['type'],
        ]);

        return redirect()->route('admin/kriteria')->with('success', 'Data kriteria berhasil disimpan.');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $kriteria = $this->kriteriaModel->find($id);

        if (!$kriteria) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data kriteria tidak ditemukan');
        }

        return view('kriteria/edit', ['kriteria' => $kriteria]);
    }

    // Proses update data
    public function update($id)
    {
        $validation = \Config\Services::validation();

        $data = $this->request->getPost();

        $rules = [
            'nama_kriteria' => 'required|max_length[100]',
            'type' => 'required|in_list[cost,benefit]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $this->kriteriaModel->update($id, [
            'nama_kriteria' => $data['nama_kriteria'],
            'type' => $data['type'],
        ]);

        return redirect()->route('admin/kriteria')->with('success', 'Data kriteria berhasil diupdate.');
    }

    // Hapus data
    public function destroy($id)
    {
        $this->kriteriaModel->delete($id);
        return redirect()->route('admin/kriteria')->with('success', 'Data kriteria berhasil dihapus.');
    }
}
