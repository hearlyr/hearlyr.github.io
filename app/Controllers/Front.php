<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PostModel;

class Front extends BaseController
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
            'titlepg' => 'FRONT',
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
                session()->setFlashdata('scs', 'SUCCESS TO DELETE FRONT !!!');
            } else {
                session()->setFlashdata('fail', 'FAILED TO DELETE FRONT !!!');
            }
            return redirect()->back();
        }
        $confN = "frontpg";
        $conf = getConf($confN);
        $pageId = $conf['conf_value'];
        $post = $this->postm->getData($pageId);
        // dd($post);
        $data['type'] = $post['type'];
        $data['username'] = $post['username'];
        $data['title'] = $post['title'];
        $data['thumbnail'] = $post['thumbnail'];
        $data['desc'] = $post['desc'];
        $data['post'] = $post['post'];
        $type = 'article';
        $keyword = $this->request->getVar('keyword');;
        $perpage = '2';
        $gdataset = 'fr';
        // $date = $datam['created'];
        // $data['create'] = idForDate($date);
        $hasil = $this->postm->listPost($type, $keyword, $perpage, $gdataset);
        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $currentpg = $this->request->getGet('page_fr');
        $data['number'] = number($perpage, $currentpg);
        $data['keyword'] = $keyword;
        return view('front/index', $data);
    }
}
