<?php

namespace App\Controllers;

use App\Models\NilaiAlternatifModel;
use App\Models\WisataModel;
use App\Models\SubKriteriaModel;

class NilaiAlternatifController extends BaseController
{
    protected $nilaiAlternatifModel;
    protected $wisataModel;
    protected $subKriteriaModel;

    public function __construct()
    {
        $this->nilaiAlternatifModel = new NilaiAlternatifModel();
        $this->wisataModel = new WisataModel();
        $this->subKriteriaModel = new SubKriteriaModel();
    }

    public function index()
    {
        // Join untuk mendapatkan detail nama wisata dan sub_kriteria (jika ingin)
        $builder = $this->nilaiAlternatifModel->builder();
        $builder->select('nilai_alternatif.*, wisata.nama_wisata, sub_kriteria.nama as nama_sub_kriteria');
        $builder->join('wisata', 'wisata.id = nilai_alternatif.wisata_id');
        $builder->join('sub_kriteria', 'sub_kriteria.id = nilai_alternatif.sub_kriteria_id');
        $data['nilaiAlternatif'] = $builder->get()->getResultArray();

        return view('nilai-alternatif/index', $data);
    }

    public function create()
    {
        $data['wisata'] = $this->wisataModel->findAll();
        $data['subkriteria'] = $this->subKriteriaModel->findAll();
        return view('nilai-alternatif/create', $data);
    }

    public function store()
    {
        $data = [
            'wisata_id' => $this->request->getPost('wisata_id'),
            'sub_kriteria_id' => $this->request->getPost('sub_kriteria_id'),
            'nilai' => $this->request->getPost('nilai'),
        ];

        $this->nilaiAlternatifModel->save($data);

        return redirect()->to('/admin/nilai-alternatif')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $nilai = $this->nilaiAlternatifModel->find($id);
        if (!$nilai) {
            return redirect()->to('/admin/nilai-alternatif')->with('error', 'Data tidak ditemukan.');
        }

        $data['nilai'] = $nilai;
        $data['wisata'] = $this->wisataModel->findAll();
        $data['subkriteria'] = $this->subKriteriaModel->findAll();

        return view('nilai-alternatif/edit', $data);
    }

    public function update($id)
    {
        $data = [
            'wisata_id' => $this->request->getPost('wisata_id'),
            'sub_kriteria_id' => $this->request->getPost('sub_kriteria_id'),
            'nilai' => $this->request->getPost('nilai'),
        ];

        $this->nilaiAlternatifModel->update($id, $data);

        return redirect()->to('/admin/nilai-alternatif')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->nilaiAlternatifModel->delete($id);

        return redirect()->to('/admin/nilai-alternatif')->with('success', 'Data berhasil dihapus.');
    }
}
