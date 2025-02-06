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
        $perPage = $this->request->getGet('per_page') ?? 10;
        $page = $this->request->getGet('page') ?? 1;
        $search = $this->request->getGet('search');

        $query = $this->adminModel;

        if ($search) {
            $query = $query->like('nama_admin', $search)
                           ->orLike('email_admin', $search);
        }

        $admins = $query->paginate($perPage, 'default', $page);
        $pager = $this->adminModel->pager;

        return $this->respond([
            'status' => 200,
            'message' => 'Admins retrieved successfully',
            'data' => $admins,
            'pagination' => [
                'current_page' => $pager->getCurrentPage(),
                'per_page' => $pager->getPerPage(),
                'total_pages' => $pager->getPageCount(),
                'total_admins' => $pager->getTotal(),
                'next_page' => $pager->getNextPageURI(),
                'prev_page' => $pager->getPreviousPageURI()
            ]
        ]);
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
        // Check if admin exists
        $admin = $this->adminModel->find($id);
        if (!$admin) {
            return $this->failNotFound('Admin not found');
        }
    
        // Get raw input data and ensure it's properly decoded
        $json = $this->request->getBody();
        try {
            $data = json_decode($json, true);
            
            // If json_decode failed or returned null
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'JSON decode error: ' . json_last_error_msg());
                return $this->fail('Invalid JSON data');
            }
            
            log_message('debug', 'Decoded update data: ' . print_r($data, true));
        } catch (\Exception $e) {
            log_message('error', 'JSON parsing error: ' . $e->getMessage());
            return $this->fail('Failed to parse input data');
        }
    
        
        $rules = [
            'nama_admin' => 'required|min_length[3]',
            'email_admin' => "required|valid_email|is_unique[admin.email_admin,id_admin,$id]"
        ];
    
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }
    
        // Only hash password if it's provided
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }
    
        try {
            $updated = $this->adminModel->update($id, $data);
            if ($updated) {
                return $this->respond([
                    'status' => 200,
                    'message' => 'Admin updated successfully',
                    'data' => $this->adminModel->find($id)
                ]);
            }
            return $this->fail($this->adminModel->errors());
        } catch (\Exception $e) {
            log_message('error', 'Update error: ' . $e->getMessage());
            return $this->fail('Failed to update admin: ' . $e->getMessage());
        }
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