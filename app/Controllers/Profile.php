<?php

namespace App\Controllers;

use App\Models\ProfileModel;

class Profile extends BaseController
{

    protected $modelProfile;

    public function __construct()
    {
       $this->modelProfile = new ProfileModel();

       
    }

    public function index()
    {
        if($this->session->get('id_user') == null){
			return redirect()->to('Auth');
		}

        $data = [
            'title' => 'Profile',
            'validation' => \Config\Services::validation(),
            'profile_data' => $this->modelProfile->where('id_users', $this->session->get('id_user'))->find()
        ];

        return view('profile', $data);
    }

    public function updateProfile(){
        if (!$this->validate([
			'id_user' => [
			  'rules' => 'required',
			  'errors'=>[
				'required' => 'id not is empty.'
				]
			  ],
			'username' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'Username required.'
				  ]
				],
			'email' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'email required.'
					  ]
					],
			'gender' => [
				'rules' => 'required',
				'errors'=>[
					'required' => 'Gender required.'
						]
					],
			'whatsapp' => [
				'rules' => 'required',
				'errors'=>[
					'required' => 'Whatsapp required.'
						]
					],
			'image_profile' => [
				'rules' => 'max_size[image_profile,1024]|is_image[image_profile]|mime_in[image_profile,image/jpg,image/jpeg,image/png]',
				'errors'=>[
				  'max_size' => 'Image size to large.',
				  'is_image' => 'Not image',
				  'mime_in' => 'Not image'
				  ]
				],
            'image_profile_old' => [
				'rules' => 'required',
				'errors'=>[
					'required' => 'Path image product not is empty.'
				  ]
                ],
			'address' => [
				'rules' => 'required',
				'errors'=>[
					'required' => 'Address required.'
				  ]
				]
		  ])) {

			session()->setFlashdata('pesan', 'Gagal mengubah profile.');
			session()->setFlashdata('alert', 'alert alert-danger alert-dismissible fade show');
			return redirect()->to('Profile')->withInput();
		}

        // get image upload product
		$imageUpload = $this->request->getFile('image_profile');


		if($imageUpload->getError() == 4){
			$nameImage = $this->request->getVar('image_profile_old');
		}else{
			// generate random file
			$nameImage = $imageUpload->getRandomName();
			// move to folder image product
			$imageUpload->move('sbadmin/img', $nameImage);
			unlink('sbadmin/img/'.$this->request->getVar('image_profile_old'));
		}

	
		$data = [
			'username' => $this->request->getVar('username'),
			'email' => $this->request->getVar('email'),
			'gender' => $this->request->getVar('gender'),
			'whatsapp' => $this->request->getVar('whatsapp'),
			'image_profile' => $nameImage,
			'address' => $this->request->getVar('address')
		  ];

		$this->modelProfile->update($this->request->getVar('id_user'), $data);

		session()->setFlashdata('pesan', 'Berhasil mengubah profile.');
		session()->setFlashdata('alert', 'alert alert-success alert-dismissible fade show');
		return redirect()->to('Profile')->withInput();
    }

	public function changePass(){

		if (!$this->validate([
			'old_pass' => [
			  'rules' => 'required',
			  'errors'=>[
				'required' => 'Password field is empty.'
				]
			  ],
			'new_pass' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'New password field required.'
				  ]
				],
			'confirm_new_pass' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'Confirm new password required.'
					  ]
					]
		  ])) {

			session()->setFlashdata('pesan', 'Gagal mengubah profile.');
			session()->setFlashdata('alert', 'alert alert-danger alert-dismissible fade show');
			return redirect()->to('Profile')->withInput();
		}


		$old_pass = $this->request->getVar('old_pass');
		$new_pass = $this->request->getVar('new_pass');
		$confirm_pass = $this->request->getVar('confirm_new_pass');

		$user_profile = $this->modelProfile->where('id_users', $this->session->get('id_user'))->find();

		if($old_pass == $user_profile[0]['password']){
			if($new_pass == $confirm_pass){
				$data = [
					'password' => $new_pass
				  ];
		
				$this->modelProfile->update($this->session->get('id_user'), $data);

				session()->setFlashdata('pesan', 'Berhasil mengubah password');
				session()->setFlashdata('alert', 'alert alert-success alert-dismissible fade show');
				return redirect()->to('Profile')->withInput();

			}else{
				session()->setFlashdata('pesan', 'Password baru tidak sama dengan konfirmasi password.');
				session()->setFlashdata('alert', 'alert alert-danger alert-dismissible fade show');
				return redirect()->to('Profile')->withInput();
			}
		}else{
			session()->setFlashdata('pesan', 'Password lama tidak valid.');
			session()->setFlashdata('alert', 'alert alert-danger alert-dismissible fade show');
			return redirect()->to('Profile')->withInput();
    }
		}


}
