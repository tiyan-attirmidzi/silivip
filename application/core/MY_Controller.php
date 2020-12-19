<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    protected $data = array();

    public function __construct() {
       parent::__construct();
       $this->load->model(
            array(
                'user'
            )
        );
    }

}

class User_Controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('id')) {
            $this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::ERROR, "Gagal!", "Anda Harus Login", "false"));
			redirect(site_url());
  	    }
    }
}

class Admin_Controller extends User_Controller {
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('role') != User::ADMIN_ROLE) {
            $this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::ERROR, "Gagal!", "Halaman ini tidak dapat anda akses", "false"));
    		redirect(site_url());
        }
    }
}

class Staff_Controller extends User_Controller {    
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('role') != User::THERAPIST_ROLE) {
            $this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::ERROR, "Gagal!", "Halaman ini tidak dapat anda akses", "false"));
    		redirect(site_url());
        }
    }
}

class CoRector_Controller extends User_Controller {    
    public function __construct() {
        parent::__construct();
        if($this->session->userdata('role') != User::CHILD_ROLE) {
            $this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::ERROR, "Gagal!", "Halaman ini tidak dapat anda akses", "false"));
    		redirect(site_url());
        }
    }
}

class Public_Controller extends MY_Controller {
    function __construct() {
		parent::__construct();
    }
}

?>
