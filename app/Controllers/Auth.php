<?php

namespace App\Controllers;

use App\Models\ProfileModel;

class Auth extends BaseController
{

    protected $modelProfile;

    public function __construct()
    {
       $this->modelProfile = new ProfileModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Profile',
            'validation' => \Config\Services::validation()
        ];

        return view('login', $data);
    }

    public function login(){
        if (!$this->validate([
			'username' => [
			  'rules' => 'required',
			  'errors'=>[
				'required' => 'Username is empty.'
				]
			  ],
			'password' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'Password is empty.'
				  ]
				]
		  ])) {
	
			session()->setFlashdata('pesan', 'Gagal melakukan login.');
			session()->setFlashdata('alert', 'alert alert-danger alert-dismissible fade show');
			return redirect()->to('Auth')->withInput();
		}

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user_data = $this->modelProfile->where('username', $username)->find();

        if($user_data != null){
            if($password == $user_data[0]['password']){
                $this->session->set(['id_user' => $user_data[0]['id_users']]);
                return redirect()->to('Home'); 
            }else{
                session()->setFlashdata('pesan', 'Password salah.');
                session()->setFlashdata('alert', 'alert alert-danger alert-dismissible fade show');
                return redirect()->to('Auth')->withInput();
            }
        }else{
            session()->setFlashdata('pesan', 'Username salah.');
			session()->setFlashdata('alert', 'alert alert-danger alert-dismissible fade show');
			return redirect()->to('Auth')->withInput();
        }

    }

    public function logout(){
        $this->session->destroy();
        return redirect()->to('Auth');
    }
}