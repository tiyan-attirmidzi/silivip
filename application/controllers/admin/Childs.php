<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Childs extends Admin_Controller {

	private $pageCurrent = 'admin/childs';
	private $pageContent = 'Anak';

	public function __construct() {
        parent::__construct();
    }

    function selectData() {
        $id = $this->uri->segment(4);
        $data['select'] = $this->user->getOneChild($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function index()	{

		$data['pageCurrent'] = $this->pageCurrent;
		$data['pageTitle'] = 'Manajemen Data Anak';
		$data['pageTitleSub'] = 'Data Anak';
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
		$this->load->view('pages/admin/child/index', $data);
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
		// Validation child
		$this->form_validation->set_rules(
            'child_name',
            'Nama Lengkap Anak',
            'required',
            array(
                'required' => '*) Masukkan <b>Nama Lengkap Anak</b>'
            )
        );
        $this->form_validation->set_rules(
            'child_pob',
            'Tempat Lahir',
            'required',
            array(
                'required' => '*) Masukkan <b>Tempat Lahir</b>'
            )
        );
        $this->form_validation->set_rules(
            'child_dob',
            'Tanggal Lahir',
            'required',
            array(
                'required' => '*) Masukkan <b>Tanggal Lahir</b>'
            )
		);
		// Validation parent
        $this->form_validation->set_rules(
            'parent_father_name',
            'Nama Ayah',
            'required',
            array(
                'required' => '*) Masukkan <b>Nama Ayah</b>'
            )
        );
        $this->form_validation->set_rules(
            'parent_mother_name',
            'Nama Ibu',
            'required',
            array(
                'required' => '*) Masukkan <b>Nama Ibu</b>'
            )
        );
		$this->form_validation->set_rules(
            'parent_phone',
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
            $user['user_fullname'] = $this->input->post('child_name');
			$user['user_password'] = sha1(md5($this->input->post('user_password')));
            $user['user_gender'] = $this->input->post('user_gender');
			$user['user_role'] = User::CHILD_ROLE;
			$createUser = $this->user->insertUser($user);
			// For parent
			$parent['parent_father_name'] = $this->input->post('parent_father_name');
            $parent['parent_mother_name'] = $this->input->post('parent_mother_name');
			$parent['parent_phone'] = $this->input->post('parent_phone');
			$createParent = $this->user->insertParent($parent);
			// For child
            $child['child_name'] = $this->input->post('child_name');
            $child['child_pob'] = $this->input->post('child_pob');
            $child['child_dob'] = $this->input->post('child_dob');
            $child['user_id'] = $createUser;
			$child['parent_id'] = $createParent;
			$createChild = $this->user->insertChild($child);

			$this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::SUCCESS, "Berhasil!", "Anggota baru telah di tambahkan", "false"));
            redirect($this->pageCurrent, 'refresh');
		} else {
			$data['pageCurrent'] = $this->pageCurrent;
			$data['pageTitle'] = 'Tambah Data Anak';
			$data['pageTitleSub'] = 'Form Tambah Anak';
			$data['pageDescription'] = 'Data yang harus dilengkapi adalah data <code>Akun</code>, <code>Anak</code> dan <code>Orang tua</code>';
			$data['pageContent'] = $this->pageContent;
			
			$this->load->view('includes/header');
			$this->load->view('includes/sidebar');
			$this->load->view('pages/admin/child/create', $data);
			$this->load->view('includes/footer');
		}
		
    }

    public function update($id = null) {

        if ($id == null) {
			redirect($this->pageCurrent, 'refresh');
        }

        $data['child'] = $this->user->getOneChild($id);

        if ($this->input->post() != null) {
            // Start Validation
            // Validation account
            if ($data['child'][0]->user_name !== $this->input->post('user_name')) {
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

            if ($data['child'][0]->user_email !== $this->input->post('user_email')) {
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
            // Validation child
            $this->form_validation->set_rules(
                'child_name',
                'Nama Lengkap Anak',
                'required',
                array(
                    'required' => '*) Masukkan <b>Nama Lengkap Anak</b>'
                )
            );
            $this->form_validation->set_rules(
                'child_pob',
                'Tempat Lahir',
                'required',
                array(
                    'required' => '*) Masukkan <b>Tempat Lahir</b>'
                )
            );
            $this->form_validation->set_rules(
                'child_dob',
                'Tanggal Lahir',
                'required',
                array(
                    'required' => '*) Masukkan <b>Tanggal Lahir</b>'
                )
            );
            // Validation parent
            $this->form_validation->set_rules(
                'parent_father_name',
                'Nama Ayah',
                'required',
                array(
                    'required' => '*) Masukkan <b>Nama Ayah</b>'
                )
            );
            $this->form_validation->set_rules(
                'parent_mother_name',
                'Nama Ibu',
                'required',
                array(
                    'required' => '*) Masukkan <b>Nama Ibu</b>'
                )
            );
            $this->form_validation->set_rules(
                'parent_phone',
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
                $user['user_fullname'] = $this->input->post('child_name');
                $user['user_gender'] = $this->input->post('user_gender');
                // For parent
                $parent['parent_father_name'] = $this->input->post('parent_father_name');
                $parent['parent_mother_name'] = $this->input->post('parent_mother_name');
                $parent['parent_phone'] = $this->input->post('parent_phone');
                // For child
                $child['child_name'] = $this->input->post('child_name');
                $child['child_pob'] = $this->input->post('child_pob');
                $child['child_dob'] = $this->input->post('child_dob');
                $update = $this->user->updateChild($data['child'][0]->user_id, $data['child'][0]->parent_id, $id, $user, $parent, $child);

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
        $this->load->view('pages/admin/child/update', $data);
        $this->load->view('includes/footer');

    }

    public function delete($id) {
        if ($id == null) {
			redirect($this->pageCurrent, 'refresh');
		}
        
        $data['child_id'] = $id;
        $child = $this->user->getWhereChild($data);
		$delete = $this->user->deleteChild($child[0]->user_id, $child[0]->parent_id, $id);

		if ($delete) {
			$this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::SUCCESS, "Berhasil!", "Data telah dihapus", "false"));
			redirect($this->pageCurrent, 'refresh');
		} else {
			$this->session->set_flashdata('alertSweet', $this->alert->sweetAlert(Alert::ERROR, "Gagal!", "Data tidak dapat dihapus", "false"));
			redirect($this->pageCurrent, 'refresh');
		}
    }

}
