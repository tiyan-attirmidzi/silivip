<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Videos extends Admin_Controller {

	private $pageCurrent = 'admin/videos';
	private $pageContent = 'Anak';

	public function __construct() {
        parent::__construct();
	}
	
	public function index()	{

		$data['pageCurrent'] = $this->pageCurrent;
		$data['pageTitle'] = 'Manajemen Video';
		$data['pageTitleSub'] = 'Data Video';
		$data['pageDescription'] = 'Anda dapat <code>menambah</code>, <code>mengubah</code> dan <code>menghapus</code>';
		$data['pageContent'] = $this->pageContent;
		$data['pagePaths'] = 'childs';
		$data['childs'] = $this->user->getAllChilds('c.*, p.parent_phone, p.parent_mother_name, u.user_gender', User::CHILD_ROLE);
		$data['genders'] = [
			[
				'name' => 'Laki-laki',
				'label' => 'primary'
			],
			[
				'name' => 'Perempuan',
				'label' => 'warning'
			]
        ];
        
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('pages/admin/video/index', $data);
		$this->load->view('includes/footer');

	}

}