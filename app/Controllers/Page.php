<?php 

namespace App\Controllers;

class Page extends BaseController
{
  public function about()
  {
    return view('about');
  }
  
  public function contact()
  {
    return view('contact');
  }

  // HALAMAN Login 
  public function login()
  {
    return view('login');
  }

  public function login_user()
  {
    return view('login_user');
  }

  // Register
  public function register()
  {
    return view('register');
  }

  public function dashboard_user()
  {
    return view('dashboard_user');
  }

  public function ebook()
  {
    return view('ebook');
  }

  public function profile()
  {
    return view('profile');
  }

  public function beranda()
  {
    return view('beranda');
  }

  public function data_anggota()
  {
    return view('data_anggota');
  }

  public function data_buku()
  {
    return view('data_buku');
  }

  public function tambah_buku()
  {
    return view('tambah_buku');
  }

  public function edit_buku()
  {
    return view('edit_buku');
  }

  public function tambah_anggota()
  {
    return view('tambah_anggota');
  }

  public function edit_anggota()
  {
    return view('edit_anggota');
  }

}

?>
