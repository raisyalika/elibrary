<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $allowedFields = [
        'judul', 'isbn', 'pengarang', 'penerbit', 'tahun',
        'kategori', 'level','tgl_pengadaan', 'ebook', 'buku_fisik',
        'file_ebook', 'sampul', 'sinopsis'
    ];
    
    protected $validationRules = [
        'judul' => 'required|min_length[3]',
        'isbn' => 'required|min_length[10]',
        'pengarang' => 'required',
        'penerbit' => 'required'
    ];
}