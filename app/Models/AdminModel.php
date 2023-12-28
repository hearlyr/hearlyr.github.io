<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'email';
    // protected $primaryKey = 'id';
    // protected $allowedFields = ['id', 'username', 'email', 'password', 'token', 'last_login'];
    protected $allowedFields = ['username', 'password', 'token'];

    function getData($useremail = false)
    {
        $tbl = $this->table($this->table);
        // $user=new AdminModel();
        if ($useremail === false) {
            $tbl->findAll();
            $query = $tbl->get()->getRowArray();

            // $query = $this->findAll();
            return $query;
        }
        $tbl->where('email=', $useremail);
        $tbl->orWhere('username=', $useremail);
        $query = $tbl->get()->getRowArray();


        // $this->where(['username'=>$useremail]);
        // $this->orWhere(['email'=>$useremail]);
        // $query = [
        // ];
        // $query = $this->where(['username' => $useremail])->first();
        // $this->orWhere(['email' => $useremail])->first();

        return $query;
    }
    function updData($data)
    {
        $tbl = $this->table($this->table);
        // $tbl->save($data);
        if ($tbl->save($data)) {
            return true;
        } else {
            return false;
        }
    }
}
