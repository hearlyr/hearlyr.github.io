<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PostModel;

class Article extends BaseController
{
    protected $postm;
    public function __construct()
    {
        $this->postm = new PostModel();
        helper('global_helper');
    }
    function index()
    {
        $datam = $this->postm->getData();
        $data = [
            'title' => 'ARTICLE LIST',
            // 'arts' => $datam
        ];
        $type = 'article';
        $keyword = '';
        $perpage = '2';
        $gdataset = 'pg';
        // $date = $datam['created'];
        // $data['create'] = idForDate($date);
        $hasil = $this->postm->listPost($type, $keyword, $perpage, $gdataset);
        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $currentpg = $this->request->getGet('page_pg');
        $data['number'] = number($perpage, $currentpg);
        return view('admin/article', $data);
    }

    function addart()
    {
        $data = ['title' => 'ADD ARTICLE'];
        if ($this->request->getMethod() == 'post') {
            $rule = [
                'title' => [
                    'rules' => 'required|min_length[2]',
                    'errors' => [
                        'required' => 'the {field} must be filled',
                    ],
                ],
                'post' => 'required|min_length[7]',
                // 'type' => 'required|min_length[3]',
                'status' => 'required|min_length[3]',
                'thumbnail' => 'is_image[thumbnail]|max_size[thumbnail,2048]',
                'desc' => 'required|min_length[3]',
            ];
            if ($this->validate($rule)) {
                $thumbf = $this->request->getFile('thumbnail');
                $thumbn = 'no-img.png';
                if ($thumbf->getName()) {
                    $thumbn = $thumbf->getRandomName();
                    // $thumbn = 'default.png';
                }
                $title = $this->request->getVar('title');
                $data = [
                    'username' => session()->get('username'),
                    'title' => $title,
                    'post' => $this->request->getVar('post'),
                    'type' => $this->request->getVar('type'),
                    'status' => $this->request->getVar('status'),
                    'thumbnail' => $thumbn,
                    'desc' => $this->request->getVar('desc'),
                ];
                // $this->postm->setSeo($title);
                $act = $this->postm->savePost($data);
                if ($act == true) {
                    if ($thumbf->getName()) {
                        $thumbf->move('img', $thumbn);
                    }
                    session()->setFlashdata('scs', 'SUCCESS TO ADD !!!');
                }
                // $thumbf->move('img', $thumbn);
                // session()->setFlashdata('scs', 'SUCCESS TO ADD ARTICLE !!!');
                // return true;
            } else {
                $vals = \Config\Services::validation();
                session()->setFlashdata('errs', $vals->getErrors());
                // return false;
            }
        }

        return view('admin/addart', $data);
    }
}
