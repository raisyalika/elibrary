<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\AdminModel;

class AdminController extends ResourceController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    public function index()
    {
        return $this->respond($this->adminModel->findAll());
    }

    public function show($id = null)
    {
        $admin = $this->adminModel->find($id);

        if (!$admin) {
            return $this->failNotFound('Admin not found');
        }

        return $this->respond($admin);
    }

    public function create()
    {
        $rules = [
            'nama_admin' => 'required|min_length[3]',
            'email_admin' => 'required|valid_email|is_unique[admin.email_admin]',
            'password' => 'required|min_length[6]'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = [
            'nama_admin' => $this->request->getVar('nama_admin'),
            'email_admin' => $this->request->getVar('email_admin'),
            'password' => $this->hash_password($this->request->getVar('password'))
        ];

        $id = $this->adminModel->insert($data);

        if (!$id) {
            return $this->fail($this->adminModel->errors());
        }

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Admin created successfully',
            'admin' => [
                'id_admin' => $id,
                'nama_admin' => $data['nama_admin'],
                'email_admin' => $data['email_admin']
            ]
        ]);
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();

        // Hash new password if provided
        if (!empty($data['password'])) {
            $data['password'] = $this->hash_password($data['password']);
        }

        if (!$this->adminModel->update($id, $data)) {
            return $this->fail($this->adminModel->errors());
        }

        return $this->respond(['message' => 'Admin updated successfully']);
    }

    public function delete($id = null)
    {
        if (!$this->adminModel->delete($id)) {
            return $this->fail('Failed to delete admin');
        }

        return $this->respondDeleted(['message' => 'Admin deleted successfully']);
    }

    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}