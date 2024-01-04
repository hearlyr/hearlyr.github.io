<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PostModel;

class Sosmed extends BaseController
{
    protected $postm;
    protected $contr;
    protected $title;
    public function __construct()
    {
        $this->postm = new PostModel();
        helper('global_helper');
        $this->contr = 'sosmed';
        $this->title = 'SOSMED';
    }
    function index()
    {
        $data['titlepg'] = 'SOSMED PAGE';
        $datam = $this->postm->getData();

        if ($this->request->getMethod() == 'post') {
            $confName = 'x';
            $dataSm = [
                'conf_value' => $this->request->getVar('x')
            ];
            setConf($confName, $dataSm);
            $confName = 'instagram';
            $dataSm = [
                'conf_value' => $this->request->getVar('instagram')
            ];
            setConf($confName, $dataSm);
            $confName = 'github';
            $dataSm = [
                'conf_value' => $this->request->getVar('github')
            ];
            setConf($confName, $dataSm);
            session()->setFlashdata('scs', 'SUCCESS TO ADD SOSMED !!!');
        }
        $confName = 'x';
        $gConf = getConf($confName);
        $data['confg'] = $gConf;
        if ($gConf != null) {
            $data['x'] = getConf($confName)['conf_value'];
        }

        $confName = 'instagram';
        $gConf = getConf($confName);
        // $data['confg'] = $gConf;
        if ($gConf != null) {
            $data['instagram'] = getConf($confName)['conf_value'];
        }

        $confName = 'github';
        $gConf = getConf($confName);
        // $data['confg'] = $gConf;
        if ($gConf != null) {
            $data['github'] = getConf($confName)['conf_value'];
        }

        if ($this->request->getGet('act') == 'del' && $this->request->getGet('post_id')) {
            $act = $this->request->getGet('act');
            $pId = $this->request->getGet('post_id');
            $datap = $this->postm->getData($pId);
            if ($act == 'del' && $datap['post_id'] != null) {
                $this->postm->delete($pId);
                if ($datap['thumbnail'] != 'no-img.png') {
                    @unlink('img' . '/' . $datap['thumbnail']);
                }
                session()->setFlashdata('scs', 'SUCCESS TO DELETE SOSMED !!!');

                return redirect()->to('/page');
            } else {
                session()->setFlashdata('fail', 'FAILED TO DELETE SOSMED !!!');
            }
            return redirect()->back();
        }
        return view('admin/addsm', $data);
    }
}
