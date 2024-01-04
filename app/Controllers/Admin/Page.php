<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ConfigModel;
use App\Models\PostModel;

class Page extends BaseController
{
    protected $postm;
    protected $contr;
    protected $confM;
    public function __construct()
    {
        $this->postm = new PostModel();
        helper('global_helper');
        $this->contr = 'page';
        $this->confM = new ConfigModel();
    }
    function index()
    {
        $datam = $this->postm->getData();
        $data = [
            'titlepg' => 'PAGE LIST',
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
        $type = $this->contr;
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
        return view('admin/' . $this->contr, $data);
    }
    function addpg()
    {
        $data = ['titlepg' => 'ADD PAGE', 'sub' => 'Add Page'];
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
                'thumbnail' => 'is_image[thumbnail]|max_size[thumbnail,4048]',
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
                    'title' => "$title",
                    'post' => $this->request->getVar('post'),
                    'type' => $this->request->getVar('type'),
                    'status' => $this->request->getVar('status'),
                    'thumbnail' => $thumbn,
                    'desc' => $this->request->getVar('desc'),
                ];
                $type = $this->contr;
                // $dConf=['conf_name'=>$conf_name];
                // $this->postm->setSeo($title);
                $act = $this->postm->savePost($data, $type);
                if ($act == true) {

                    $pageId = $act;
                    $frontpg = $this->request->getVar('frontpg');;
                    $contactpg = $this->request->getVar('contactpg');
                    $frontpgId = '';

                    /*set front page */
                    $conf_name = "frontpg";
                    $dataGet = getConf($conf_name);
                    if ($frontpg == '1') {
                        $frontpgId = $pageId;
                        $dConf['conf_value'] = $frontpgId;
                        $dConf['conf_name'] = $conf_name;
                        // $this->confM->updConf($dConf);
                    }
                    if (isset($dataGet)) {
                        if ($dataGet['conf_value'] == $pageId && $frontpg != '1') {
                            $frontpgId = '';
                        }
                    }
                    $dataSet = ['conf_value' => $frontpgId];
                    setConf($conf_name, $dataSet);

                    /*set Contact page */
                    $conf_name = "contactpg";
                    if ($contactpg == '1') {
                        $contactId = $pageId;
                        $dConf['conf_value'] = $contactId;
                        $dConf['conf_name'] = $conf_name;
                        // $this->confM->updConf($dConf);
                    }
                    $dataGet = getConf($conf_name);
                    if (isset($dataGet)) {
                        if ($dataGet['conf_value'] == $pageId && $contactpg != '1') {
                            $contactId = '';
                        }
                    }
                    $dataSet = ['conf_value' => $contactId];
                    setConf($conf_name, $dataSet);

                    if ($thumbf->getName()) {
                        $thumbf->move('img', $thumbn);
                    }
                    session()->setFlashdata('scs', 'SUCCESS TO ADD !!!');
                    return redirect()->to('admin/page/editpg/' . $pageId);
                }
                // $thumbf->move('img', $thumbn);
                // session()->setFlashdata('scs', 'SUCCESS TO ADD PAGE !!!');
                // return true;
            } else {
                $vals = \Config\Services::validation();
                $title = $this->request->getVar('title');
                $desc = $this->request->getVar('desc');
                $post = $this->request->getVar('post');
                session()->setFlashdata('errs', $vals->getErrors());
                session()->setFlashdata('desc', $desc);
                session()->setFlashdata('post', $post);
                session()->setFlashdata('title', $title);
                // return false;
            }
        }

        return view('admin/addpg', $data);
    }

    function editPg($pageId = null)
    {
        $data['titlepg'] = 'EDIT PAGE';
        $data['sub'] = 'Edit Page';
        $pId = $this->request->getVar('post_id');
        if ($pageId != null) {
            $pId = $pageId;
        }
        $datap = $this->postm->getData($pId);
        // $datap = $this->confM->getConf($pId);
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
                'thumbnail' => 'is_image[thumbnail]|max_size[thumbnail,4048]',
                'desc' => 'required|min_length[3]',
            ];
            $type = 'page';
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
                    $pageId = $pId;
                    $frontpg = $this->request->getVar('frontpg');;
                    $contactpg = $this->request->getVar('contactpg');
                    // $frontpgId = '';
                    // $dataG = getConf('frontpg');

                    /*set front page */
                    $conf_name = "frontpg";
                    $dataGet = getConf($conf_name);
                    $frontpgId = $dataGet['conf_value'];
                    if ($frontpgId == null) {
                        if ($frontpg == '1') {
                            $frontpgId = $pageId;
                            // $dConf['conf_value'] = $frontpgId;
                            // $dConf['conf_name'] = $conf_name;
                            // $this->confM->updConf($dConf);
                        }
                    }
                    if (isset($dataGet)) {
                        if ($dataGet['conf_value'] == $pageId && $frontpg != '1') {
                            $frontpgId = '';
                        }
                    }
                    $dataSet = ['conf_value' => $frontpgId];
                    setConf($conf_name, $dataSet);

                    /*set Contact page */
                    $conf_name = "contactpg";
                    $dataGet = getConf($conf_name);
                    $contactId = $dataGet['conf_value'];
                    if ($contactId == null) {
                        if ($contactpg == '1') {
                            $contactId = $pageId;
                            // $dConf['conf_value'] = $contactId;
                            // $dConf['conf_name'] = $conf_name;
                            // $this->confM->updConf($dConf);
                        }
                    }
                    $dataGet = getConf($conf_name);
                    if (isset($dataGet)) {
                        if ($dataGet['conf_value'] == $pageId && $contactpg != '1') {
                            $contactId = '';
                        }
                    }
                    $dataSet = ['conf_value' => $contactId];
                    setConf($conf_name, $dataSet);
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
                    return redirect()->to('admin/page');
                }
                // $thumbf->move('img', $thumbn);
                // session()->setFlashdata('scs', 'SUCCESS TO ADD PAGE !!!');
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
        $dataG = getConf('frontpg');
        if ($dataG['conf_value'] == $pId) {
            // $frontpg='1';
            $data['frontpg'] = '1';
        }
        $dataG = getConf('contactpg');
        if ($dataG['conf_value'] == $pId) {
            $data['contactpg'] = '1';
        }
        return view('admin/addpg', $data);
    }
    // function delete()
    // {
    //     $id = $this->request->getGet('post_id');

    // }
}
