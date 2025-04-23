<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\BookModel;
use Dompdf\Dompdf;
use Dompdf\Options;

class BookController extends ResourceController
{
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new BookModel();
        helper('url'); // Load the URL helper to use base_url()
    }

    // 📚 Get All Books
    public function index()
    {
        $perPage  = $this->request->getGet('per_page') ?? 10;
        $page     = $this->request->getGet('page') ?? 1;
        $kategori = $this->request->getGet('kategori');
        $level    = $this->request->getGet('level');
        $search   = $this->request->getGet('search');

        $query = $this->bookModel;

        if ($kategori) {
            $query = $query->where('kategori', $kategori);
        }

        if ($level) {
            $query = $query->where('level', $level);
        }

        if ($search) {
            $query = $query->groupStart()
                ->like('judul', $search)
                ->orLike('isbn', $search)
                ->orLike('pengarang', $search)
                ->orLike('penerbit', $search)
                ->groupEnd();
        }

        $books  = $query->paginate($perPage, 'default', $page);
        $pager  = $this->bookModel->pager;

        return $this->respond([
            'status'     => 200,
            'message'    => 'Books retrieved successfully',
            'data'       => $books,
            'pagination' => [
                'current_page' => $pager->getCurrentPage(),
                'per_page'     => $pager->getPerPage(),
                'total_pages'  => $pager->getPageCount(),
                'total_books'  => $pager->getTotal(),
                'next_page'    => $pager->getNextPageURI(),
                'prev_page'    => $pager->getPreviousPageURI()
            ]
        ]);
    }

    // 📖 Get a Single Book by ID
    public function show($id = null)
    {
        $book = $this->bookModel->find($id);
        return $book ? $this->respond($book) : $this->failNotFound('Book not found');
    }

    // 🆕 Create a Book
    public function create()
    {
        // Decode incoming JSON request
        $data = json_decode(trim($this->request->getBody()), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->fail('Invalid JSON format: ' . json_last_error_msg());
        }

        // Validation Rules
        $rules = [
            'judul'     => 'required|min_length[3]',
            'pengarang' => 'required',
            'penerbit'  => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors());
        }

        // Insert data into the database
        $id = $this->bookModel->insert($data);
        if (!$id) {
            return $this->fail($this->bookModel->errors());
        }

        return $this->respondCreated([
            'message' => 'Book created successfully',
            'id'      => $id
        ]);
    }

    // Upload Book Cover
    public function uploadCover($id)
    {
        $file = $this->request->getFile('cover');

        if (!$file || !$file->isValid()) {
            return $this->fail('No file uploaded or file is invalid.');
        }

        if ($file->hasMoved()) {
            return $this->fail('File already moved.');
        }

        // Save the file
        $newName = $file->getRandomName();
        $file->move('uploads/book_covers/', $newName);

        // Build the URL using CodeIgniter's base_url() helper
        $coverUrl = base_url("uploads/book_covers/{$newName}");

        // Update database
        $this->bookModel->update($id, ['sampul_url' => $coverUrl]);

        return $this->respond([
            'status'     => 200,
            'message'    => 'Book cover uploaded successfully',
            'sampul_url' => $coverUrl
        ]);
    }

    // 📌 Upload PDF File
    public function uploadPDF($id)
    {
        $file = $this->request->getFile('pdf');

        if (!$file || !$file->isValid()) {
            return $this->fail('No file uploaded or file is invalid.');
        }

        if ($file->hasMoved()) {
            return $this->fail('File already moved.');
        }

        // Validate PDF type
        if ($file->getMimeType() !== 'application/pdf') {
            return $this->fail('Invalid file type. Only PDFs are allowed.');
        }

        // Save the file
        $newName = $file->getRandomName();
        $file->move('uploads/book_pdfs/', $newName);

        // Build the URL using CodeIgniter's base_url() helper
        $pdfUrl = base_url("uploads/book_pdfs/{$newName}");

        // Update database
        $this->bookModel->update($id, ['file_ebook_url' => $pdfUrl]);

        return $this->respond([
            'status'  => 200,
            'message' => 'PDF file uploaded successfully',
            'pdf_url' => $pdfUrl
        ]);
    }

    // ✏️ Update a Book
    public function update($id = null)
    {
        // Decode incoming JSON request
        $data = json_decode(trim($this->request->getBody()), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return $this->fail('Invalid JSON format: ' . json_last_error_msg());
        }

        if (empty($data)) {
            return $this->fail('No data provided for update.');
        }

        // Ensure the book exists
        if (!$this->bookModel->find($id)) {
            return $this->failNotFound('Book not found');
        }

        if (!$this->bookModel->update($id, $data)) {
            return $this->fail($this->bookModel->errors());
        }

        return $this->respond(['message' => 'Book updated successfully']);
    }

    // ❌ Delete a Book
    public function delete($id = null)
    {
        if (!$this->bookModel->find($id)) {
            return $this->failNotFound('Book not found');
        }

        $this->bookModel->delete($id);
        return $this->respondDeleted(['message' => 'Book deleted successfully']);
    }

    public function printPDF()
    {
        $bookModel = new \App\Models\BookModel();
        $books = $bookModel->findAll();

        // Load view to string
        $html = view('buku_pdf', ['books' => $books]);

        // Dompdf setup
        $options = new Options();
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("data_buku.pdf", ["Attachment" => false]);
    }
}
