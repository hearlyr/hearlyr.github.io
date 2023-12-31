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
            'titlepg' => 'ARTICLE LIST',
            // 'arts' => $datam
        ];
        if ($this->request->getGet('act') == 'del' && $this->request->getGet('post_id')) {
            $act = $this->request->getGet('act');
            $pId = $this->request->getGet('post_id');
            $datap = $this->postm->getData($pId);
            if ($act == 'del' && $datap['post_id'] != null) {
                $this->postm->delete($pId);
                if ($datap['thumbnail'] != 'no-img.png') {
                    @unlink('img' . '/' . $datap['thumbnail']);
                }
                session()->setFlashdata('scs', 'SUCCESS TO DELETE ARTICLE !!!');
            } else {
                session()->setFlashdata('fail', 'FAILED TO DELETE ARTICLE !!!');
            }
            return redirect()->back();
        }
        $type = 'article';
        $keyword = $this->request->getVar('keyword');;
        $perpage = '4';
        $gdataset = 'pg';
        // $date = $datam['created'];
        // $data['create'] = idForDate($date);
        $hasil = $this->postm->listPost($type, $keyword, $perpage, $gdataset);
        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $currentpg = $this->request->getGet('page_pg');
        $data['number'] = number($perpage, $currentpg);
        $data['keyword'] = $keyword;
        return view('admin/article', $data);
    }

    function addart()
    {
        $data = ['titlepg' => 'ADD ARTICLE', 'sub' => 'Add Article'];
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
                'thumbnail' => 'is_image[thumbnail]|max_size[thumbnail,1024]',
                'desc' => 'required|min_length[3]',
            ];
            $type = 'article';
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
                    'title' => "$title",
                    'post' => $this->request->getVar('post'),
                    'type' => $this->request->getVar('type'),
                    'status' => $this->request->getVar('status'),
                    'thumbnail' => $thumbn,
                    'desc' => $this->request->getVar('desc'),
                ];
                // $this->postm->setSeo($title);
                $act = $this->postm->savePost($data, $type);
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
                $title = $this->request->getVar('title');
                $post = $this->request->getVar('post');
                session()->setFlashdata('errs', $vals->getErrors());
                session()->setFlashdata('post', $post);
                session()->setFlashdata('title', $title);
                // return false;
            }
        }

        return view('admin/addart', $data);
    }

    function editArt()
    {
        $data['titlepg'] = 'EDIT ARTICLE';
        $data['sub'] = 'Edit Article';
        $pId = $this->request->getVar('post_id');
        $datap = $this->postm->getData($pId);
        $data = $datap;

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
            $type = 'article';
            if ($this->validate($rule)) {
                $thumbf = $this->request->getFile('thumbnail');
                $thumbn = 'no-img.png';
                if ($thumbf->getName()) {
                    $thumbn = $thumbf->getRandomName();
                    // $thumbn = 'default.png';
                }
                $title = $this->request->getVar('title');
                $data = [
                    'post_id' => $pId,
                    'username' => session()->get('username'),
                    'title' => "$title",
                    'post' => $this->request->getVar('post'),
                    'type' => $this->request->getVar('type'),
                    'status' => $this->request->getVar('status'),
                    'thumbnail' => $thumbn,
                    'desc' => $this->request->getVar('desc'),
                ];
                // $this->postm->setSeo($title);
                $act = $this->postm->savePost($data, $type);
                if ($act == true) {
                    if ($thumbf->getName()) {
                        if ($datap['thumbnail']) {
                            $thumbbef = $datap['thumbnail'];
                            if ($thumbbef != 'no-img.png') {
                                @unlink('img' . '/' . $thumbbef);
                            }
                        }
                        $thumbf->move('img', $thumbn);
                    }
                    session()->setFlashdata('scs', 'SUCCESS TO ADD !!!');
                    return redirect()->to('admin/article');
                }
                // $thumbf->move('img', $thumbn);
                // session()->setFlashdata('scs', 'SUCCESS TO ADD ARTICLE !!!');
                // return true;
            } else {
                $vals = \Config\Services::validation();
                $title = $this->request->getVar('title');
                $desc = $this->request->getVar('desc');
                $thumbnail = $this->request->getVar('thumbnail');
                $post = $this->request->getVar('post');
                session()->setFlashdata('errs', $vals->getErrors());
                session()->setFlashdata('thumbnail', $thumbnail);
                session()->setFlashdata('desc', $desc);
                session()->setFlashdata('post', $post);
                session()->setFlashdata('title', $title);
                // return false;
            }
        }

        return view('admin/addart', $data);
    }
    // function delete()
    // {
    //     $id = $this->request->getGet('post_id');

    // }
}
