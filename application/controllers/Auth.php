<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }


    public function index()
    {
        if ($this->session->userdata('nik')) {
            redirect('hris');
        }
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username harus diisi!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password harus diisi!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->Auth_model->ambilUser($username);

        // jika usernya ada
        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                unset($user['password']);
                $this->session->set_userdata($user); // ini disession agar data nya terambil global
                $this->session->set_flashdata('message', 'Selamat Datang ' . $user['nama_karyawan'] . ', Anda Berhasil Login!');
                redirect('hris'); // lokasi setelah melakukan akticitas login
            } elseif ($user['status'] == 'Tidak Aktif') {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align: center;">  Akun sudah tidak aktif! </div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align: center;">  Password Anda Salah! </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align: center;"> User tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('nik');
        $this->session->unset_userdata('email');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="text-align: center;"> Anda berhasil logout!</div>');
        redirect('auth');
    }


    private function _kirimEmail($token)
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'belajarcoding78@gmail.com',
            'smtp_pass' => 'yivnmnsocwasssvv',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('belajarcoding78@gmail.com', 'PT. Sahaware Teknologi Indonesia');
        $this->email->to($this->input->post('email'));

        $this->email->subject('Reset Password');
        $this->email->message('Klik link ini untuk reset password : <a class="btn btn-success" href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function lupaPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email harus diisi !',
            'valid_email' => 'Yang Anda Masukan Bukan Email !'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Lupa Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/lupapassword');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('data_karyawan', ['email' => $email])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_kirimEmail($token);

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="text-align: center;"> Silahkan cek email anda untuk reset password!</div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align: center;"> Email anda tidak terdaftar!</div>');
                redirect('auth/lupapassword');
            }
        }
    }

    public function resetpassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('data_karyawan', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->ubahPassword();
                } else {
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align: center;"> Reset password gagal! Reset password sudah expired!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align: center;"> Reset password gagal! Token invalid!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="text-align: center;"> Reset password gagal! Email salah!</div>');
            redirect('auth');
        }
    }

    public function ubahPassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password baru', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Password tidak cocok!',
            'min_length' => 'Password terlalu pendek!'
        ]);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password1]', [
            'matches' => 'Password tidak cocok!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ubah Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/ubahpassword');
            $this->load->view('templates/auth_footer');
        } else {
            $this->Auth_model->ubahPassword();
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="text-align: center;"> Reset password berhasil!</div>');
            redirect('auth');
        }
    }
}
