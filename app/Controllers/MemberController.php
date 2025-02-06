<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Helpers\CloudStorage;

class MemberController extends ResourceController
{
    protected $anggotaModel;
    protected $cloudStorage;
    
    public function __construct()
    {
        $this->anggotaModel = new \App\Models\AnggotaModel();
        $this->cloudStorage = new CloudStorage();
    }
    
    public function index()
    {
        $anggota = $this->anggotaModel->findAll();
        return $this->respond($anggota);
    }
    
    public function create()
    {
        $rules = [
            'nama_anggota' => 'required|min_length[3]',
            'username' => 'required|valid_username|is_unique[anggota.username]',
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
            'alamat_anggota' => $this->request->getVar('alamat_anggota')
        ];

        // Handle photo upload
        if ($foto = $this->request->getFile('foto')) {
            if ($foto->isValid() && !$foto->hasMoved()) {
                $path = 'members/photos/' . $foto->getRandomName();
                $url = $this->cloudStorage->uploadFile($foto->getTempName(), $path);
                $data['foto_url'] = $url;
            }
        }

        $id = $this->anggotaModel->insert($data);
        
        if (!$id) {
            return $this->fail($this->anggotaModel->errors());
        }

        return $this->respondCreated([
            'status' => 'success',
            'message' => 'Member created successfully',
            'data' => $data
        ]);
    }
    
    public function show($id = null)
    {
        $anggota = $this->anggotaModel->find($id);
        
        if (!$anggota) {
            return $this->failNotFound('Member not found');
        }
        
        return $this->respond($anggota);
    }
    
    public function update($id = null)
    {
        $rules = [
            'nama_anggota' => 'required|min_length[3]',
            'username' => "required|valid_username|is_unique[anggota.username,id_anggota,$id]",
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
            'jk_anggota' => $this->request->getVar('jk_anggota'),
            'level_anggota' => $this->request->getVar('level_anggota'),
            'alamat_anggota' => $this->request->getVar('alamat_anggota')
        ];

        // Only update password if provided
        if ($password = $this->request->getVar('password')) {
            $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        // Handle photo update
        if ($foto = $this->request->getFile('foto')) {
            if ($foto->isValid() && !$foto->hasMoved()) {
                $path = 'members/photos/' . $foto->getRandomName();
                $url = $this->cloudStorage->uploadFile($foto->getTempName(), $path);
                $data['foto_url'] = $url;
            }
        }

        if (!$this->anggotaModel->update($id, $data)) {
            return $this->fail($this->anggotaModel->errors());
        }

        return $this->respond([
            'status' => 'success',
            'message' => 'Member updated successfully',
            'data' => $data
        ]);
    }
    
    public function delete($id = null)
    {
        $anggota = $this->anggotaModel->find($id);
        
        if (!$anggota) {
            return $this->failNotFound('Member not found');
        }

        // Delete photo from cloud storage if exists
        if (!empty($anggota['foto_url'])) {
            $this->cloudStorage->deleteFile($anggota['foto_url']);
        }
        
        $this->anggotaModel->delete($id);
        
        return $this->respondDeleted([
            'status' => 'success',
            'message' => 'Member deleted successfully'
        ]);
    }
}