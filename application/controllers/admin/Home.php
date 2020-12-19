<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function index()	{
		
		$this->load->view('includes/header');
		$this->load->view('includes/sidebar');
		$this->load->view('pages/admin/home');
		$this->load->view('includes/footer');

	}
}

?>