<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id_buku';
    protected $allowedFields = [
        'judul',
        'isbn',
        'pengarang',
        'penerbit',
        'tahun',
        'kategori',
        'level',
        'tgl_pengadaan',
        'ebook',
        'buku_fisik',
        'file_ebook_url',
        'sampul_url',
        'sinopsis',
        'updated_by', 
    ];

    protected $validationRules = [
        'judul' => 'required|min_length[3]',
        'pengarang' => 'required',
        'penerbit' => 'required'
    ];
}
