<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model','user');
    }

	public function register()
	{
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        $this->data['view'] = 'register';
		$this->load->view('layout_user', $this->data);
	}

	public function addRegister()
	{
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
		$email = $_POST['email'];
		$nama = $_POST['nama'];
		$password = $_POST['password'];

		$config['upload_path'] = './public/img';
		$config['allowed_types'] = 'jpg|png|jpeg';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			$error = $this->upload->display_errors();
			// menampilkan pesan error
			print_r($error);
		} else {
			$result = $this->upload->data();

			$this->session->set_flashdata('success','User berhasil dibuat'); 
			$query = $this->user->addUser($email, $nama, $password, $result['file_name']);
			redirect('login');
		}
	}

	public function cekEmail()
	{
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        $data = $this->user->cekEmail($_POST['email']);
		
		echo json_encode($data);
	}

	public function forgot()
	{
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        $this->data['view'] = 'forgot';
		$this->load->view('layout_user', $this->data);
	}

	public function forgot_password()
	{
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
		$token = $this->user->insertToken($this->user->cekEmail($_POST['email'])->id);
		$qstring = $this->base64url_encode($token);
		$url = site_url() . 'user/reset_password/token/' . $qstring;

		$this->data['view'] = 'forgot';
		$this->data['email'] = $_POST['email'];
		$this->data['url'] = $url;
		$this->load->view('layout_user', $this->data);
	}
	
	public function reset_password()
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        $token = $this->base64url_decode($this->uri->segment(4));
        $cleanToken = $this->security->xss_clean($token);

        $user_info = $this->user->isTokenValid($cleanToken);         

        if (!$user_info) {
            $this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');
            redirect(site_url('login'), 'refresh');
        }else {
			$this->data['view'] = 'reset_password';
			$this->data['email'] = $user_info->email;
			$this->load->view('layout_user', $this->data);
		}
	}

	public function updatePassword()
	{
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
		$email = $_POST['email'];
		$password = $_POST['password'];

		$this->session->set_flashdata('success','berhasil Reset Password'); 
		$query = $this->user->updatePassword($email, $password);
		redirect('login');
	}

	public function base64url_encode($data)
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

	public function index()
	{
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
        $this->data['view'] = 'login';
		$this->load->view('layout_user', $this->data);
	}

	public function cekUser()
	{
        if ($this->session->userdata('email')) {
            redirect('dashboard');
        }
		if (!$this->user->cekEmail($_POST['email'])) {
			$this->session->set_flashdata('success','User Tidak terdaftar'); 
		}else {
			if ($this->user->cekUser($_POST['email'], $_POST['password'])) {
				redirect('dashboard');
			}else {
				$this->session->set_flashdata('success','Password salah'); 
			}
		}
		redirect('login');
	}

	public function logout()
	{
        $this->session->sess_destroy();
		redirect('login');
	}
}
