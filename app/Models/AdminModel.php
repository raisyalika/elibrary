<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';
    protected $allowedFields = ['nama_admin', 'email_admin', 'password'];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
{
    if (!isset($data['data']['password'])) return $data;

   
     if (!password_get_info($data['data']['password'])['algo']) { 
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }

    return $data;
}

}
