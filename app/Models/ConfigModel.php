<?php

namespace App\Models;

use CodeIgniter\Model;

class ConfigModel extends Model
{
    protected $table = 'config';
    protected $primaryKey = 'conf_name';
    protected $allowedFields = ['conf_name', 'conf_value'];

    public function getConf($param)
    {
        $tbl = $this->table($this->table);

        $tbl->Where('conf_name', $param);
        $get = $tbl->get();
        // $get = $tbl->get()->getRowArray();
        return $get->getRowArray();
    }

    public function updConf($data)
    {
        helper('global_helper');
        $tbl = $this->table($this->table);

        foreach ($data as $key => $value) {
            $data[$key] = purHtml($value);
        }
        // $tseo = $data['title_seo'];
        $confN = $data['conf_name'];
        $dConf = getConf($confN);
        // $act = '';
        // if ($dConf != null) {
        //     $act = $tbl->update($data);
        //     return $act;
        // } else {
        $act = $tbl->save($data);
        if ($dConf == null) {
            $act = $tbl->insert($data);
        }
        // return $act;
        // }
        return $act;
        // if ($act != null) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
}
