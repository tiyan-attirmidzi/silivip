<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auths extends Public_Controller {

	public function index()	{

		// Start Validation
        $this->form_validation->set_rules(
            'username',
            'Email',
            'required|trim',
            array(
                'required' => '*) Masukkan <b>Username/Email</b> Anda',
                'trim' => '*) Masukkan <b>Username</b> dengan Benar'
            )
        );
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|min_length[6]',
            array(
                'required' => '*) Masukkan <b>Password</b> Anda',
                'min_length' => '*) <b>Password</b> Minimal 6 Karakter'
            )
        );
		// End Validation

		if ($this->form_validation->run() == true) {

			$username = $this->input->post('username');
			$password = sha1(md5($this->input->post('password')));
			$result = $this->user->attempt($username, $password);

			if (!empty($result) && count($result) > 0) {

				$filePath = [User::PATH_IMAGE_ADMIN,User::PATH_IMAGE_THERAPIST,User::PATH_IMAGE_CHILD];
				$fileImage = ['male.png','female.png'];
				$image = base_url().$filePath[$result->user_role].$fileImage[$result->user_gender];

                $dataSession = array(
                    'id' => $result->user_id,
                    'username' => $result->user_name,
                    'email' => $result->user_email,
                    'name' => $result->user_fullname,
					'gender' => $result->user_gender,
					'role' => $result->user_role,
                    'image' => $image
                );

                $this->session->set_userdata($dataSession);

                if ($result->role == User::ADMIN_ROLE) {
                    redirect('admin/');
                } elseif ($result->role == User::THERAPIST_ROLE) {
                    redirect('therapist/');
                } else {
                    redirect('child/');
                }

            } else {

				$this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::ERROR, "Login Gagal!", "Username/Email dan Password Tidak Valid", "false"));
				redirect('/', 'refresh');
				
            }
		}

		$this->load->view('pages/auth/login');

	}

	public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
	}
}
