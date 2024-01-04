<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\PostModel;

class PageB extends BaseController
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
            'titlepg' => 'PAGE',
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
                session()->setFlashdata('scs', 'SUCCESS TO DELETE PAGE !!!');
            } else {
                session()->setFlashdata('fail', 'FAILED TO DELETE PAGE !!!');
            }
            return redirect()->back();
        }
        if ($this->request->getMethod() == 'post') {
            $data = $this->request->getVar();
            $to = EMAIL;
            $attach = '';
            $title = 'From Contact Page';
            $msg = "Sender Name <br>";
            $msg .= '<b>' . $data['name'] . "</b><br>";
            $msg .= "Sender Email <br>";
            $msg .= '<b>' . $data['email'] . "</b><br>";
            $msg .= "Sender phone <br>";
            $msg .= '<b>' . $data['phone'] . "</b><br>";
            $msg .= "Sender Message <br>";
            $msg .= '<b>' . $data['message'] . "</b><br>";
            sendEmail($attach, $to, $title, $msg);
            session()->setFlashdata('scs', 'SUCCESS SEND MESSAGE !!!');
            // dd($data);
        }
        $confN = "contactpg";
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
        $type = 'page';
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
        return view('front/contact', $data);
    }
}
