<?php

namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    protected $allowedFields = ['username', 'title', 'title_seo', 'post', 'type', 'status', 'thumbnail', 'desc'];

    function getData($param = false)
    {
        $tbl = $this->table($this->table);

        if ($param === false) {
            $data = $tbl->findAll();
            $get = $tbl->get();
            return $data;
        }
        $tbl->where('title_seo=', $param);
        $tbl->orWhere('post_id', $param);
        $get = $tbl->get()->getRowArray();
        return $get;
    }
    function setSeo($title)
    {
        $tbl = $this->table($this->table);
        $url = $title;
        $url = url_title($url, '-', true);
        $data = $tbl->where('title_seo', $title);

        // if (isset($data)) {
        //     // $jumlah = $data;
        // }
        $jumlah = $tbl->countAllResults();
        if ($jumlah > 0) {
            $jumlah = $jumlah + 1;
            return $url . '-' . $jumlah;
        }
        return $url;
    }
    function savePost($data, $type = 'article')
    {
        helper('global_helper');
        $tbl = $this->table($this->table);
        $data['type'] = $type;

        foreach ($data as $key => $value) {
            $data[$key] = purHtml($value);
        }
        // $tseo = $data['title_seo'];
        if (isset($data['post_id'])) {
            // $data=['title_seo'=>$tseo];
            $act = $tbl->save($data);
            $id = $data['post_id'];
            // return $id;
        } else {
            $data['title_seo'] = $this->setSeo($data['title']);
            $act = $tbl->save($data);
            $id = $tbl->getInsertID();
            // return $id;
        }
        if ($act) {
            return $id;
        } else {
            return false;
        }
        // return $act;
    }

    function listPost($type, $keyword = null, $perpage, $gdataset = null)
    {
        $tbl = $this->table($this->table);
        $arrkeyword = explode(' ', $keyword);
        $tbl->groupStart();
        for ($i = 0; $i < count($arrkeyword); $i++) {
            $tbl->orLike('post', $arrkeyword[$i]);
            $tbl->orLike('title', $arrkeyword[$i]);
            $tbl->orLike('desc', $arrkeyword[$i]);
        };
        $tbl->groupEnd();

        $tbl->where('type', $type);
        $tbl->orderBy('created', 'desc');
        // $hasil['record'] = $data['record'];
        // $hasil['pager'] = $data['pager'];
        $data['record'] = $tbl->paginate($perpage, $gdataset);
        $data['pager'] = $tbl->pager;
        return $data;
    }
}
