<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\MemberModel;

class MemberController extends ResourceController
{
    protected $memberModel;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
    }

    // Fetch all members
    public function index()
    {
        $perPage = $this->request->getGet('per_page') ?? 10;
        $page = $this->request->getGet('page') ?? 1;
        $kategori = $this->request->getGet('kategori');
        $level = $this->request->getGet('level');
        $search = $this->request->getGet('search');

        $query = $this->memberModel;

        if ($kategori) {
            $query = $query->where('kategori', $kategori);
        }

        if ($level) {
            $query = $query->where('level_anggota', $level);
        }

        if ($search) {
            $query = $query->groupStart()
                ->like('nama_anggota', $search)
                ->orLike('username', $search)
                ->orLike('alamat_anggota', $search)
                ->groupEnd();
        }

        $members = $query->paginate($perPage, 'default', $page);
        $pager = $this->memberModel->pager;

        return $this->respond([
            'status' => 200,
            'message' => 'Members retrieved successfully',
            'data' => $members,
            'pagination' => [
                'current_page' => $pager->getCurrentPage(),
                'per_page' => $pager->getPerPage(),
                'total_pages' => $pager->getPageCount(),
                'total_members' => $pager->getTotal(),
                'next_page' => $pager->getNextPageURI(),
                'prev_page' => $pager->getPreviousPageURI()
            ]
        ]);
    }
    // Create a new member
    public function create()
    {
        $rules = [
            'nama_anggota' => 'required|min_length[3]',
            'username' => 'required|is_unique[anggota.username]',
            'password' => 'required|min_length[6]',
            'jk_anggota' => 'required|in_list[L,P]',
            'level_anggota' => 'required|in_list[Kelas 1,Kelas 2,Kelas 3,Kelas 4,Kelas 5,Kelas 6,Guru]',
            'alamat_anggota' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        $data = [
            'nama_anggota' => $this->request->getVar('nama_anggota'),
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'), 
            'jk_anggota' => $this->request->getVar('jk_anggota'),
            'level_anggota' => $this->request->getVar('level_anggota'),
            'alamat_anggota' => $this->request->getVar('alamat_anggota'),
            'foto_url' => null // No image storage, so it's set to null
        ];

        $id = $this->memberModel->insert($data);

        if (!$id) {
            return $this->fail($this->memberModel->errors());
        }

        return $this->respondCreated([
            'message' => 'Member created successfully',
            'data' => $data
        ]);
    }

    // Get member by ID
    public function show($id = null)
    {
        $member = $this->memberModel->find($id);
        return $member ? $this->respond($member) : $this->failNotFound('Member not found');
    }

    public function update($id = null)
{
    // Check if member exists
    $member = $this->memberModel->find($id);
    if (!$member) {
        return $this->failNotFound('Member not found');
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

    // Validate input data
    $rules = [
        'nama_anggota' => 'required|min_length[3]',
        'username' => "required|is_unique[anggota.username,id_anggota,$id]",
        'jk_anggota' => 'required|in_list[L,P]',
        'level_anggota' => 'required|in_list[Kelas 1,Kelas 2,Kelas 3,Kelas 4,Kelas 5,Kelas 6,Guru]',
        'alamat_anggota' => 'required'
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
        $updated = $this->memberModel->update($id, $data);
        if ($updated) {
            return $this->respond([
                'status' => 200,
                'message' => 'Member updated successfully',
                'data' => $this->memberModel->find($id)
            ]);
        }
        return $this->fail($this->memberModel->errors());
    } catch (\Exception $e) {
        log_message('error', 'Update error: ' . $e->getMessage());
        return $this->fail('Failed to update member: ' . $e->getMessage());
    }
}


    // Delete member
    public function delete($id = null)
    {
        $member = $this->memberModel->find($id);
        if (!$member) return $this->failNotFound('Member not found');

        $this->memberModel->delete($id);
        return $this->respondDeleted([
            'message' => 'Member deleted successfully'
        ]);
    }
}
