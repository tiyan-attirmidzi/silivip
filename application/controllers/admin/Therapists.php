<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Therapists extends Admin_Controller {

	private $pageCurrent = 'admin/therapists';
	private $pageContent = 'Terapis';

	public function __construct() {
        parent::__construct();
    }

    function selectData() {
        $id = $this->uri->segment(4);
        $data['select'] = $this->user->getOneTherapist($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function index()	{

		$data['pageCurrent'] = $this->pageCurrent;
		$data['pageTitle'] = 'Manajemen Data Terapis';
		$data['pageTitleSub'] = 'Data Terapis';
		$data['pageDescription'] = 'Anda dapat <code>menambah</code>, <code>mengubah</code> dan <code>menghapus</code>';
		$data['pageContent'] = $this->pageContent;
		$data['pagePaths'] = 'therapists';
		$data['therapists'] = $this->user->getAllTherapists('*', User::THERAPIST_ROLE);
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
		$this->load->view('pages/admin/therapist/index', $data);
		$this->load->view('includes/footer');

    }
    
    public function create() {

		// Start Validation
		// Validation account
		$this->form_validation->set_rules(
            'user_name',
            'Username',
            'required|trim|is_unique[tbl_users.user_name]', 
            array(
                'required' => '*) Masukkan <b>Username</b>', 
                'trim' => '*) Masukkan <b>Username</b> Dengan Benar',
                'is_unique' => '*) <b>Username</b> Telah Digunakan'
            )
        );
		$this->form_validation->set_rules(
            'user_email',
            'Email',
            'required|valid_email|is_unique[tbl_users.user_email]', 
            array(
                'required' => '*) Masukkan <b>Email</b>', 
                'valid_email' => '*) Masukkan Alamat <b>Email</b> Dengan Benar',
                'is_unique' => '*) Alamat <b>Email</b> Telah Digunakan'
            )
		);
		$this->form_validation->set_rules(
            'user_password', 
            'Password', 
            'required|min_length[8]',
            array(
                'required' => '*) Masukkan <b>Password</b>', 
                'min_length' => '*) <b>Password</b> Minimal 8 Karakter'            
            )
        );
        $this->form_validation->set_rules(
            'user_password_confirm',
            'Ulang Password', 
            'required|matches[user_password]',
            array(
                'required' => '*) Masukkan <b>Ulang Password</b>', 
                'matches' => '*) <b>Password</b> Tidak Valid'
            )
		);
        // Validation Therapist
		$this->form_validation->set_rules(
            'user_fullname',
            'Nama Lengkap Terapis',
            'required',
            array(
                'required' => '*) Masukkan <b>Nama Lengkap Terapis</b>'
            )
        );
		$this->form_validation->set_rules(
            'therapist_phone',
            'Nomor Handphone',
            'required',
            array(
                'required' => '*) Masukkan <b>Nomor Handphone</b>'
            )
        );
		// End Validation

		if ($this->form_validation->run() === TRUE) {
			// For user
            $user['user_name'] = $this->input->post('user_name');
            $user['user_email'] = $this->input->post('user_email');
            $user['user_fullname'] = $this->input->post('user_fullname');
			$user['user_password'] = sha1(md5($this->input->post('user_password')));
            $user['user_gender'] = $this->input->post('user_gender');
			$user['user_role'] = User::THERAPIST_ROLE;
			$createUser = $this->user->insertUser($user);
			// For Therapist
            $therapist['therapist_phone'] = $this->input->post('therapist_phone');
            $therapist['user_id'] = $createUser;
			$createTherapist = $this->user->insertTherapist($therapist);

			$this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::SUCCESS, "Berhasil!", "Anggota baru telah di tambahkan", "false"));
            redirect($this->pageCurrent, 'refresh');
		} else {
			$data['pageCurrent'] = $this->pageCurrent;
			$data['pageTitle'] = 'Tambah Data Terapis';
			$data['pageTitleSub'] = 'Form Tambah Terapis';
			$data['pageDescription'] = 'Data yang harus dilengkapi adalah data <code>Akun</code> dan <code>Terapis</code>';
			$data['pageContent'] = $this->pageContent;
			
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('pages/admin/therapist/create', $data);
			$this->load->view('includes/footer');
		}
		
    }

    public function update($id = null) {

        if ($id == null) {
			redirect($this->pageCurrent, 'refresh');
        }

        $data['therapist'] = $this->user->getOneTherapist($id);

        if ($this->input->post() != null) {
            // Start Validation
            // Validation account
            if ($data['therapist'][0]->user_name !== $this->input->post('user_name')) {
                $this->form_validation->set_rules(
                    'user_name',
                    'Username',
                    'required|trim|is_unique[tbl_users.user_name]', 
                    array(
                        'required' => '*) Masukkan <b>Username</b>', 
                        'trim' => '*) Masukkan <b>Username</b> Dengan Benar',
                        'is_unique' => '*) <b>Username</b> Telah Digunakan'
                    )
                );
            }

            if ($data['therapist'][0]->user_email !== $this->input->post('user_email')) {
                $this->form_validation->set_rules(
                    'user_email',
                    'Email',
                    'required|valid_email|is_unique[tbl_users.user_email]', 
                    array(
                        'required' => '*) Masukkan <b>Email</b>', 
                        'valid_email' => '*) Masukkan Alamat <b>Email</b> Dengan Benar',
                        'is_unique' => '*) Alamat <b>Email</b> Telah Digunakan'
                    )
                );
            }
            if ($this->input->post('user_password') != null) {
                    
                $this->form_validation->set_rules(
                    'user_password', 
                    'Password', 
                    'min_length[8]',
                    array(
                        'min_length' => '*) <b>Password</b> Minimal 8 Karakter'            
                    )
                );
                $this->form_validation->set_rules(
                    'user_password_confirm',
                    'Ulang Password', 
                    'required|matches[user_password]',
                    array(
                        'required' => '*) Masukkan <b>Ulang Password</b>', 
                        'matches' => '*) <b>Password</b> Tidak Valid'
                    )
                );

                if ($this->form_validation->run() === TRUE) {
                    $user['user_password'] = sha1(md5($this->input->post('user_password')));
                }

            }
            // Validation Therapist
            $this->form_validation->set_rules(
                'user_fullname',
                'Nama Lengkap Terapis',
                'required',
                array(
                    'required' => '*) Masukkan <b>Nama Lengkap Terapis</b>'
                )
            );
            $this->form_validation->set_rules(
                'therapist_phone',
                'Nomor Handphone',
                'required',
                array(
                    'required' => '*) Masukkan <b>Nomor Handphone</b>'
                )
            );
            // End Validation

            if ($this->form_validation->run() === TRUE) {
                // For user
                $user['user_name'] = $this->input->post('user_name');
                $user['user_email'] = $this->input->post('user_email');
                $user['user_fullname'] = $this->input->post('user_fullname');
                $user['user_gender'] = $this->input->post('user_gender');
                // For Therapist
                $therapist['therapist_phone'] = $this->input->post('therapist_phone');
                $update = $this->user->updateTherapist($data['therapist'][0]->user_id, $id, $user, $therapist);

                if ($update) {
                    $this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::SUCCESS, "Berhasil!", "Data telah diperbarui", "false"));
                    redirect($this->pageCurrent, 'refresh');
                }

            } else {
				$this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::ERROR, "Gagal!", "Data yang diinputkan tidak valid", "false"));
            }
        }

        $data['pageCurrent'] = $this->pageCurrent;
        $data['pageTitle'] = 'Edit Data Anak';
        $data['pageTitleSub'] = 'Form Edit Anak';
        $data['pageDescription'] = 'Data yang harus dilengkapi adalah data <code>Akun</code>, <code>Anak</code> dan <code>Orang tua</code>';
        $data['pageContent'] = $this->pageContent;
        $data['genders'] = ['Laki-laki','Perempuan'];
        
        $this->load->view('includes/header');
        $this->load->view('includes/sidebar');
        $this->load->view('pages/admin/therapist/update', $data);
        $this->load->view('includes/footer');

    }

    public function delete($id) {
        if ($id == null) {
			redirect($this->pageCurrent, 'refresh');
		}
        
        $data['therapist_id'] = $id;
        $therapist = $this->user->getWhereTherapist($data);
		$delete = $this->user->deleteTherapist($therapist[0]->user_id, $id);

		if ($delete) {
			$this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::SUCCESS, "Berhasil!", "Data telah dihapus", "false"));
			redirect($this->pageCurrent, 'refresh');
		} else {
			$this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::ERROR, "Gagal!", "Data tidak dapat dihapus", "false"));
			redirect($this->pageCurrent, 'refresh');
		}
    }

}