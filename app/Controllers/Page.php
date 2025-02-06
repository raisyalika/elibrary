<?php 

namespace App\Controllers;

class page extends BaseController
{
  public function about()
  {
    return view('about');
  }
  
  public function contact()
  {
    return view('contact');
  }
}

?>
