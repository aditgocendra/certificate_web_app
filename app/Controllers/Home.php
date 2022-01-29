<?php

namespace App\Controllers;

use App\Models\CertificateModel;
use App\Models\ProfileModel;
use ZipArchive;

class Home extends BaseController
{

    protected $modelCert;
	protected $modelProfile;

    public function __construct()
    {
        $this->modelCert = new CertificateModel();
		$this->modelProfile = new ProfileModel();
    }

    public function index()
    {
		if($this->session->get('id_user') == null){
			return redirect()->to('Auth');
		}

        $data = [
            'title' => 'Certificate',
            'validation' => \Config\Services::validation(),
            'data_cert' => $this->modelCert->findAll(),
			'profile_data' => $this->modelProfile->where('id_users', $this->session->get('id_user'))->find()
        ];

        return view('cert_manage', $data);
    }

    public function addCert(){

        if (!$this->validate([
			'name' => [
			  'rules' => 'required',
			  'errors'=>[
				'required' => 'Name is empty.'
				]
			  ],
			'name_training' => [
				'rules' => 'required|is_unique[tbl_certificate.training_name]',
				'errors'=>[
				  'required' => 'Name training is empty.',
                  'is_unique' => 'Name training its be used.'
				  ]
				],
            'datepick_training' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'Date Training not is empty.'
					  ]
					],
			'organizer' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'Organizer is empty.'
					  ]
					],
			'from_pick' => [
				'rules' => 'required',
				'errors'=>[
					'required' => 'Date from is empty.'
						]
					],
			'to_pick' => [
				'rules' => 'required',
				'errors'=>[
					'required' => 'Date to is empty.'
						]
					],
			'certificate_add' => [
				'rules' => 'uploaded[certificate_add]|max_size[certificate_add,20560]|mime_in[certificate_add,application/pdf]',
				'errors'=>[
				  'uploaded' => 'Certificate is empty.',
				  'max_size' => 'Certificate large size.',
				  'mime_in' => 'Not pdf file'
				  ]
				]
		  ])) {
	
			session()->setFlashdata('pesan', 'Gagal menambahkan data.');
			session()->setFlashdata('alert', 'alert alert-danger alert-dismissible fade show');
			return redirect()->to('Home')->withInput();
		}

        // get file upload 
		$fileUpload = $this->request->getFile('certificate_add');

		// generate random file
		$nameFile = $fileUpload->getRandomName();

        // move to folder file 
		$fileUpload->move('certificate_file', $nameFile);

        $dataSave = [
            'name' => $this->request->getVar('name'),
            'training_name' => $this->request->getVar('name_training'),
            'training_date' => $this->request->getVar('datepick_training'),
            'organizer' => $this->request->getVar('organizer'),
            'from_date' => $this->request->getVar('from_pick'),
            'to_date' => $this->request->getVar('to_pick'),
            'name_cert' => $nameFile,
        ];

        // d($dataSave);
        $this->modelCert->save($dataSave);

        session()->setFlashdata('pesan', 'Berhasil menambahkan data.');
		session()->setFlashdata('alert', 'alert alert-success alert-dismissible fade show');
		return redirect()->to('Home')->withInput();
        
    }

    public function deleteCert($id_cert = null, $name_cert = null){
        if($id_cert != null and $name_cert != null){
            $this->modelCert->where('id_cert', $id_cert)->delete();
		
            unlink('certificate_file/'.$name_cert);
    
            session()->setFlashdata('pesan', 'Data sertifikat berhasil dihapus');
            session()->setFlashdata('alert', 'alert alert-warning alert-dismissible fade show');
    
            return redirect()->to(base_url('Home'));
        }
    }

    public function downloadFile(){
        // return $this->response->download('certificate_file/' . $nameFile, null);

		$zip = new ZipArchive;

		if($this->request->getPost('id') != null){
			$cert_data = $this->modelCert->find($this->request->getPost('id'));
			
			$zipname = 'certificate_training.zip';
			
			$zip->open($zipname, ZipArchive::OVERWRITE);
			
			foreach($cert_data as $crt){
				$zip->addFile('certificate_file/' . $crt['name_cert']);
				
			}
			$zip->close();

			header("Content-Disposition: attachment; filename=\"".$zipname."\"");
			header("Content-Length: ".filesize($zipname));
			readfile($zipname);

	    }else{
			session()->setFlashdata('pesan', 'Tidak ada sertifikat yang dipilih');
            session()->setFlashdata('alert', 'alert alert-warning alert-dismissible fade show');
			return redirect()->to(base_url('Home'));
		}
	}

    public function editCertView($id_cert = null){

        if($id_cert == null){
            return redirect()->to('Home');
        }

        $data = [
            'title' => 'Certificate',
            'validation' => \Config\Services::validation(),
            'select_data' => $this->modelCert->where('id_cert',$id_cert)->find(),
			'profile_data' => $this->modelProfile->where('id_users', 1)->find()
        ];

        return view('edit_cert', $data);
    }

    public function editCertificate(){
        if (!$this->validate([
            'id_cert' => [
                'rules' => 'required',
                'errors'=>[
                  'required' => 'Id cert empty.'
                  ]
                ],
			'name_edit' => [
			  'rules' => 'required',
			  'errors'=>[
				'required' => 'Name is empty.'
				]
			  ],
			'name_training_edit' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'Name training is empty.',
                  'is_unique' => 'Name training its be used.'
				  ]
				],
            'datepick_training_edit' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'Date Training not is empty.'
					  ]
					],
			'organizer_edit' => [
				'rules' => 'required',
				'errors'=>[
				  'required' => 'Organizer is empty.'
					  ]
					],
			'from_pick_edit' => [
				'rules' => 'required',
				'errors'=>[
					'required' => 'Date from is empty.'
						]
					],
			'to_pick_edit' => [
				'rules' => 'required',
				'errors'=>[
					'required' => 'Date to is empty.'
						]
					],
            'certificate_name_old' => [
				'rules' => 'required',
				'errors'=>[
					'required' => 'Name old is empty.'
						]
					],
			'certificate_edit' => [
				'rules' => 'max_size[certificate_edit,20560]|mime_in[certificate_edit,application/pdf]',
				'errors'=>[
				  'max_size' => 'Certificate large size.',
				  'mime_in' => 'Not pdf file'
				  ]
				]
		  ])) {
	
			session()->setFlashdata('pesan', 'Gagal mengubah data.');
			session()->setFlashdata('alert', 'alert alert-danger alert-dismissible fade show');
			return redirect()->to('Home')->withInput();
		}

        // get file upload 
		$imageUpload = $this->request->getFile('certificate_edit');
		
		
		if($imageUpload->getError() == 4){
			$nameFile = $this->request->getVar('certificate_name_old');	
		}else{
			// generate random file
			$nameFile = $imageUpload->getRandomName();
			// move to folder file upload
			$imageUpload->move('certificate_file', $nameFile);
			unlink('certificate_file/'. $this->request->getVar('certificate_name_old'));
		}

        $dataSave = [
            'name' => $this->request->getVar('name_edit'),
            'training_name' => $this->request->getVar('name_training_edit'),
            'training_date' => $this->request->getVar('datepick_training_edit'),
            'organizer' => $this->request->getVar('organizer_edit'),
            'from_date' => $this->request->getVar('from_pick_edit'),
            'to_date' => $this->request->getVar('to_pick_edit'),
            'name_cert' => $nameFile,
        ];

        $this->modelCert->update($this->request->getVar('id_cert'), $dataSave);

        session()->setFlashdata('pesan', 'Berhasil mengubah data.');
		session()->setFlashdata('alert', 'alert alert-success alert-dismissible fade show');
		return redirect()->to('Home');
    }


}
