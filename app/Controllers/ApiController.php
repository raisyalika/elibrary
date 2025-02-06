<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class ApiController extends ResourceController
{
    public function index()
    {
        return $this->respond([
            'status' => 'success',
            'message' => 'Welcome to the API!'
        ]);
    }

    public function hello($name = 'Guest')
    {
        return $this->respond([
            'status' => 'success',
            'message' => "Hello, {$name}!"
        ]);
    }
}
