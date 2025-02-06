<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class BookController extends ResourceController
{
    protected $bookModel;
    
    public function __construct()
    {
        $this->bookModel = new \App\Models\BookModel();
    }
    
    public function index()
    {
        $books = $this->bookModel->findAll();
        return $this->respond($books);
    }
    
    public function show($id = null)
    {
        $book = $this->bookModel->find($id);
        if (!$book) return $this->failNotFound('Book not found');
        return $this->respond($book);
    }
    
    public function create()
    {
        $data = $this->request->getJSON(true); // Convert to array

        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required|min_length[3]',
            'isbn' => 'required|min_length[10]',
            'pengarang' => 'required',
            'penerbit' => 'required'
        ]);
        
        if (!$validation->run($data)) {
            return $this->fail($validation->getErrors());
        }
        
        
        return $this->respondCreated(['message' => 'Book created successfully']);
    }
    
    public function update($id = null)
    {
        $data = $this->request->getJSON();
        
        if (!$this->bookModel->update($id, $data)) {
            return $this->fail($this->bookModel->errors());
        }
        
        return $this->respond(['message' => 'Book updated successfully']);
    }
    
    public function delete($id = null)
    {
        if (!$this->bookModel->delete($id)) {
            return $this->fail('Failed to delete book');
        }
        
        return $this->respondDeleted(['message' => 'Book deleted successfully']);
    }
}