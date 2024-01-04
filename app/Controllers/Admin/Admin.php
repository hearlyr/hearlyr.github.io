<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
// use CodeIgniter\Cookie\Cookie;


class Admin extends BaseController
{
    protected $admmodel;
    public function __construct()
    {
        $this->admmodel = new AdminModel();
        helper('cookie');
        helper('global_helper');
    }
    public function index()
    {
        // session()->destroy();
        // delete_cookie('cookuser');
        // delete_cookie('cookpw');
        // exit;
        // echo 'konttttt';
        $data = [
            'titlepg' => 'LOGIN PAGE'
        ];
        if (get_cookie('cookuser') && get_cookie('cookpw')) {
            $cookuser = get_cookie('cookuser');
            $cookpw = get_cookie('cookpw');
            $row = $this->admmodel->getData($cookuser);

            if ($cookpw != $row['password']) {
                delete_cookie('cookuser');
                delete_cookie('cookpw');
                session()->setFlashdata('msg', 'THIS ACCOUNT IS NOT EXIST !!!');
                return redirect()->to('admin/index');
            }
            $data = [
                'username' => $row['username'],
                'email' => $row['email'],
                // 'token' => $row['token'],
                // 'last_login' => $row['last_login'],
            ];
            session()->set($data);
            // session('msg', 'WELCOOOOOME BROOO');
            return redirect()->to('admin/article');
        }
        // $row = $this->admmodel->getData();
        // d($row[0]['username']);
        if ($this->request->getMethod() == 'post') {
            $useremail = $this->request->getVar('useremail');
            $password = $this->request->getVar('password');
            $remember = $this->request->getVar('remember');
            // dd($password);
            // $row = $this->admmodel->getData();

            $row = $this->admmodel->getData($useremail);
            // dd($row);
            if ($row != NULL) {
                // dd($row);
                if (password_verify($password, $row['password'])) {
                    if ($remember == '1') {
                        set_cookie('cookuser', $useremail, 3600);
                        set_cookie('cookpw', $row['password'], 3600);
                    }
                    $data = [
                        // 'log' => true,
                        'username' => $row['username'],
                        'email' => $row['email'],
                        // 'token' => $row['token'],
                        // 'last_login' => $row['last_login'],
                    ];
                    session()->set($data);
                    session()->setFlashdata('msg', 'WELCOME BRO');
                    return redirect()->to('admin/article')->withCookies();
                }
            }
            session()->setFlashdata('msg', 'USERNAME/PASSWORD IS WRONG !!!');
            // session()->setFlashdata('out', 'GO IT BITCH!!!');
            return redirect()->to('/admin');
        }
        echo 'cook ' . get_cookie('cookuser');
        // d(cookies());
        // d(session()->get('username'));
        return view('admin/index', $data);
    }

    public function mains()
    {
        $data = [
            'titlepg' => 'MAIN PAGE',
        ];
        // d(get_cookie('cooskuser'));
        echo 'cook ' . get_cookie('cookuser');
        return view('admin/mains', $data);
    }
    public function logout()
    {
        // $data = [
        //     'titlepg' => 'LOGIN PAGE'
        // ];

        delete_cookie('cookuser');
        delete_cookie('cookpw');
        session()->destroy();

        return redirect()->to('/admin')->withCookies()->with('out', 'SUCCESS FOR LOGOUT');
        // return redirect()->to('/admin');
    }
    function forgotpw()
    {
        if ($this->request->getMethod() == 'post') {
            $useremail = $this->request->getVar('useremail');

            $row = $this->admmodel->getData($useremail);
            if ($row != null) {
                // dd($row);
                $token = md5(date('YmdHis'));
                $email = $row['email'];
                // if ($token) {}
                $attach = '';
                $to = $email;
                $title = "RESET PASSWORD";
                $msg = "CLICK LINK ON BELOW FOR RESET PASSWORD: <br>";
                $link = site_url("/admin/resetpw/?email=$email&token=$token");
                $msg .= $link;
                sendEmail($attach, $to, $title, $msg);
                // return $send;
                # code...
                // dd(sendEmail(($attach, $to, $title, $msg)));
                $udata = [
                    // 'id',
                    // 'username',
                    'email' => $email,
                    // 'password',
                    'token' => $token,
                    // 'last_login',
                ];
                $this->admmodel->updData($udata);
                // $this->admmodel->update(['token' => $token]);
                session()->setFlashdata('suce', 'SUCCESS FOR SEND EMAIL!!!');
            } else {
                d($row);
                session()->setFlashdata('faile', 'EMAIL/USERNAME IS DOES NOT EXIST!!!');
                // return redirect()->to('admin/forgotpw');
            }
        }
        return view('admin/forgotpw');
    }
    function resetpw()
    {
        $data = ['titlepg' => 'RESET PW'];
        $email = $this->request->getGet('email');
        $token = $this->request->getGet('token');
        $err = [];
        $row = $this->admmodel->getData($email);
        if ($row != null) {
            // session()->setFlashdata($err);
            // return redirect()->back();
            if ($token != $row['token']) {
                $err[] = 'TOKEN DOES NOT VALID';
                // return redirect()->back();
            }
        } else {
            $err[] = 'THERE IS AN ERROR';
        }
        if ($err) {
            session()->setFlashdata('err', $err);
            // return redirect()->back();
        }

        if ($this->request->getMethod() == 'post') {
            // dd($row);
            // $scs = [];
            $password = $this->request->getVar('password');
            $passwordc = $this->request->getVar('passwordc');
            $rule = [
                'password' => 'required|min_length[4]',
                'passwordc' => [
                    'rules' => 'matches[password]',
                    'errors' => ['matches' => 'PASSWORD MUST BE MATCHES !!!']
                ]

            ];
            // $this->admmodel->getData($useremail);
            if ($this->validate($rule)) {
                $updpw = [
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'token' => null
                ];
                $this->admmodel->updData($updpw);
                // $scs[] = 'PASSWORD HAS BEEN CHANGED';
                session()->setFlashdata('msg', 'PASSWORD HAS BEEN CHANGED !!!');
                return redirect()->to('/admin');
            } else {
                $val = \Config\Services::validation();
                // $val->getErrors();
                session()->setFlashdata('val', $val);
            }
        }
        return view('admin/resetpw', $data);
    }
}
