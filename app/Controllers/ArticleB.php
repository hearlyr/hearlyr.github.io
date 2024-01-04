<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PostModel;

class ArticleB extends BaseController
{
    protected $postm;
    public function __construct()
    {
        $this->postm = new PostModel();
        helper('global_helper');
    }
    function index($tSeo)
    {
        $datam = $this->postm->getData();
        $data = [
            'titlepg' => 'ARTICLE',
            // 'arts' => $datam
        ];
        $pageDt = $this->postm->getPostSeo($tSeo);
        // $data['article'] = $pageDt['article'];
        // dd($pageDt);
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

        $data['type'] = $pageDt['type'];
        if ($data['type'] != 'article') {
            return redirect()->back();
        }
        $data['username'] = $pageDt['username'];
        $data['title'] = $pageDt['title'];
        $data['thumbnail'] = $pageDt['thumbnail'];
        $data['desc'] = $pageDt['desc'];
        $data['post'] = $pageDt['post'];
        $data['created'] = $pageDt['created'];

        $keyword = $this->request->getVar('keyword');;
        $perpage = '3';
        $gdataset = 'fr';
        // $date = $datam['created'];
        // $data['create'] = idForDate($date);
        $hasil = $this->postm->listPost($data['type'], $keyword, $perpage, $gdataset);
        $data['record'] = $hasil['record'];
        $data['pager'] = $hasil['pager'];
        $currentpg = $this->request->getGet('page_fr');
        $data['number'] = number($perpage, $currentpg);
        $data['keyword'] = $keyword;
        return view('front/article', $data);
    }
}
