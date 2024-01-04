<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class Account extends BaseController
{
    protected $contr;
    protected $title;
    protected $adminM;
    public function __construct()
    {
        helper('global_helper');
        $this->contr = 'account';
        $this->title = 'ACCOUNT';
        $this->adminM = new AdminModel();
        helper('cookie');
    }
    function index()
    {
        $data['titlepg'] = 'ACCOUNT PAGE';
        $datam = $this->adminM->getData();
        // echo get_cookie('cooskuser');

        echo session()->get('username');
        if ($this->request->getMethod() == 'post') {
            $usern = $this->request->getVar('username');
            $oldpw = $this->request->getVar('oldpw');
            $newpw = $this->request->getVar('newpw');
            $pwc = $this->request->getVar('passwordc');
            // dd($newpw);
            $rule = [
                'username' => [
                    'rules' => 'required|min_length[4]',
                    'errors' => [
                        'required' => 'THE {field} IS REQUIRED !!!'
                    ],
                ],
                'oldpw' => [
                    'rules' => 'required|pw_verif[oldpw]',
                    'errors' => [
                        'pw_verif' => 'THE {field} IS WRONG !!!'
                    ],
                ],
            ];
            if ($newpw != null) {
                $rule['newpw'] = 'min_length[4]';
                $rule['passwordc'] = 'matches[newpw]';
            }

            $uemail = session()->get('email');
            if (!$this->validate($rule)) {
                $val = \Config\Services::validation();
                session()->getFlashdata('err', $val);
            } else {
                $uData = $this->adminM->getData($uemail);
                $data['username'] = $usern;
                $data['email'] = $uemail;
                $data['password'] = $uData['password'];
                if ($newpw != null) {
                    $data['password'] = password_hash($newpw, PASSWORD_DEFAULT);
                }
                if (get_cookie('cookpw')) {
                    set_cookie('cookuser', $data['username']);
                    set_cookie('cookpw', $data['password']);
                }
                $ses = ['username' => $data['username'], 'password' => $data['password']];
                session()->set('username', $ses['username']);
                session()->set('password', $ses['password']);
                $this->adminM->updData($data);
                session()->setFlashdata('scs', 'SUCCESS TO CHANGED !!!');
                return redirect()->to('/account')->withCookies();
            }
        }

        // if ($this->request->getGet('act') == 'del' && $this->request->getGet('post_id')) {
        //     $act = $this->request->getGet('act');
        //     $pId = $this->request->getGet('post_id');
        //     $datap = $this->adminM->getData($pId);
        //     if ($act == 'del' && $datap['post_id'] != null) {
        //         $this->adminM->delete($pId);
        //         if ($datap['thumbnail'] != 'no-img.png') {
        //             @unlink('img' . '/' . $datap['thumbnail']);
        //         }
        //         session()->setFlashdata('scs', 'SUCCESS TO DELETE ACCOUNT !!!');

        //         // return redirect()->to('/page');
        //     } else {
        //         session()->setFlashdata('fail', 'FAILED TO DELETE ACCOUNT !!!');
        //     }
        //     return redirect()->back();
        // }
        return view('admin/account', $data);
    }
}
