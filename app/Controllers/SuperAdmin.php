<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class SuperAdmin extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();

        $session = session();
        if ($session->get('role') !== 'super_admin') {
            redirect()->to('/forbidden')->send();
            exit;
        }
    }

    // List semua admin (default halaman superadmin)
    public function adminIndex()
    {
        $data['users'] = $this->userModel->where('role', 'admin')->findAll();
        return view('superadmin/index', $data);
    }

    public function adminCreate()
    {
        return view('superadmin/create');
    }

    public function adminStore()
    {
        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'     => 'admin',
        ];

        $this->userModel->insert($data);

        return redirect()->to('superadmin')->with('success', 'Admin berhasil ditambahkan.');
    }

    public function adminEdit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user || $user['role'] !== 'admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Admin tidak ditemukan');
        }

        return view('superadmin/edit', ['user' => $user]);
    }

    public function adminUpdate($id)
    {
        $user = $this->userModel->find($id);
        if (!$user || $user['role'] !== 'admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Admin tidak ditemukan');
        }

        $validation = \Config\Services::validation();

        $rules = [
            'username' => 'required|min_length[3]|is_unique[users.username,id,' . $id . ']',
            'email'    => 'required|valid_email|is_unique[users.email,id,' . $id . ']',
            'password' => 'permit_empty|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $updateData = [
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
        ];

        $password = $this->request->getPost('password');
        if ($password) {
            $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $updateData);

        return redirect()->to('superadmin')->with('success', 'Admin berhasil diupdate.');
    }

    public function adminDelete($id)
    {
        $user = $this->userModel->find($id);
        if (!$user || $user['role'] !== 'admin') {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Admin tidak ditemukan');
        }

        $this->userModel->delete($id);

        return redirect()->to('superadmin')->with('success', 'Admin berhasil dihapus.');
    }
}
