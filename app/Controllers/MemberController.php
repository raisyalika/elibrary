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

    public function uploadProfilePicture($id)
    {
        log_message('debug', 'Upload request received for user ID: ' . $id);
    
        // ✅ Ensure the user exists
        $member = $this->memberModel->find($id);
        if (!$member) {
            log_message('error', 'Member not found: ' . $id);
            return $this->failNotFound('Member not found.');
        }
    
        // ✅ Get the uploaded file
        $file = $this->request->getFile('profilePicture');
    
        // ✅ Validate if file is uploaded
        if (!$file || !$file->isValid()) {
            log_message('error', 'Invalid file upload for user ID: ' . $id);
            return $this->fail('No file uploaded or file is invalid.');
        }
    
        // ✅ Ensure we are using the correct public_html path (Same as upload_cover & pdf)
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/profile_pictures/';
    
        // ✅ Ensure the directory exists
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
            log_message('debug', 'Created directory: ' . $uploadPath);
        }
    
        // ✅ Generate a unique file name
        $newName = $file->getRandomName();
    
        // ✅ Move the uploaded file to the correct location
        if (!$file->move($uploadPath, $newName)) {
            log_message('error', 'Failed to move uploaded file for user ID: ' . $id);
            return $this->fail('Failed to move uploaded file.');
        }
    
        // ✅ Verify if the file was moved successfully
        if (!file_exists($uploadPath . $newName)) {
            log_message('error', 'File move failed: File does not exist at ' . $uploadPath . $newName);
            return $this->fail('File was not saved correctly.');
        }
    
        // ✅ Generate the correct public URL for the uploaded profile picture
        $fileUrl = base_url("uploads/profile_pictures/{$newName}");
    
        // ✅ Update the database with the correct path
        if (!$this->memberModel->update($id, ['foto_url' => $fileUrl])) {
            log_message('error', 'Failed to update database with profile picture for user ID: ' . $id);
            return $this->fail('Failed to update profile picture in database.');
        }
    
        log_message('debug', 'Profile picture uploaded successfully for user ID: ' . $id);
    
        // ✅ Return success response
        return $this->respond([
            'status' => 200,
            'message' => 'Profile picture uploaded successfully',
            'foto_url' => $fileUrl
        ]);
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
    public function create()
    {
        $rules = [
            'nama_anggota' => 'required|min_length[3]',
            'username' => 'required|is_unique[anggota.username]',
            'password' => 'required|min_length[6]',
            'jk_anggota' => 'required|in_list[L,P]',
            'level_anggota' => 'required|in_list[Kelas 1,Kelas 2,Kelas 3,Kelas 4,Kelas 5,Kelas 6,Guru,Lainnya]',
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
            'foto_url' => null // No image storage initially
        ];
    
        $id = $this->memberModel->insert($data);
        if (!$id) {
            return $this->fail($this->memberModel->errors());
        }
    
        // Retrieve the newly created record
        $newMember = $this->memberModel->find($id);
    
        return $this->respondCreated([
            'message' => 'Member created successfully',
            'data' => [
                'id_anggota' => $id,  // Include the generated ID
                'nama_anggota' => $newMember['nama_anggota'],
                'username' => $newMember['username'],
                'jk_anggota' => $newMember['jk_anggota'],
                'level_anggota' => $newMember['level_anggota'],
                'alamat_anggota' => $newMember['alamat_anggota'],
                'foto_url' => $newMember['foto_url']
            ]
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
        // ✅ Check if member exists
        $member = $this->memberModel->find($id);
        if (!$member) {
            return $this->failNotFound('Member not found');
        }
    
        // ✅ Get raw input data
        $json = $this->request->getBody();
        try {
            $data = json_decode($json, true);
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                log_message('error', 'JSON decode error: ' . json_last_error_msg());
                return $this->fail('Invalid JSON data');
            }
        } catch (\Exception $e) {
            log_message('error', 'JSON parsing error: ' . $e->getMessage());
            return $this->fail('Failed to parse input data');
        }
    
        // ✅ Allow the same username for updates
        $usernameRule = 'required';
        if (isset($data['username']) && $data['username'] !== $member['username']) {
            $usernameRule .= '|is_unique[anggota.username]';
        }
    
        // ✅ Validation Rules
        $rules = [
            'nama_anggota' => 'required|min_length[3]',
            'username' => $usernameRule,
            'jk_anggota' => 'required|in_list[L,P]',
            'level_anggota' => 'required|in_list[Kelas 1,Kelas 2,Kelas 3,Kelas 4,Kelas 5,Kelas 6,Guru]',
            'alamat_anggota' => 'required'
        ];
    
        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }
    
        // ✅ Only hash password if provided
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['password']);
        }
    
        // ✅ Update Member Data
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
