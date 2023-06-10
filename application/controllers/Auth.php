<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }
    public function index()
    {
        if ($this->session->userdata('username')) {
            redirect('admin');
        }
        $this->form_validation->set_rules('username', 'Nama Pengguna', 'required|trim', ['required' => '%s wajib diisi']);
        $this->form_validation->set_rules('password', 'Kata Sandi', 'required|trim', ['required' => '%s wajib diisi']);
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Halaman Masuk';
            $this->load->view('auth/login', $data);
        } else {
            // validasinya Success
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $username
                ];
                $this->session->set_userdata($data);
                $this->session->set_flashdata('toast', "Toast.fire({icon: 'success', title: 'Berhasil Masuk'});");
                redirect('admin');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-light-danger color-danger alert-dismissible show fade" role="alert"><i class="bi bi-exclamation-circle"></i> Nama pengguna dan kata sandi salah!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-light-danger color-danger alert-dismissible show fade" role="alert"><i class="bi bi-exclamation-circle"></i> Akun tidak ditemukan!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->set_flashdata('message', '<div class="alert alert-light-success color-success alert-dismissible show fade" role="alert"><i class="bi bi-check-circle"></i> Berhasil keluar!!<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
