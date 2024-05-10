<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Recruitment/Pelamar_model');
        $this->load->model('DataPosisi_model');
        $this->load->model('Hris_model');
        $this->load->helper('url', 'download');


        if (!$this->session->userdata('nik')) {
            redirect('auth');
        }
    }

    public function index()
    {
        // printr($_SESSION);
        $data['title'] = "Data Pelamar";
        $data['pelamar'] = $this->Pelamar_model->getAllPelamar();
        $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
        $data['user'] = $this->Hris_model->ambilUser();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('recruitment/pelamar', $data);
        $this->load->view('templates/footer');
    }





    public function hapus($id_pelamar)
    {
        if ($this->Pelamar_model->hapus($id_pelamar)) {
            $this->session->set_flashdata('message', 'Data berhasil dihapus');
        } else {
            $this->session->set_flashdata('message', 'Data gagal dihapus');
        }
        redirect('Recruitment/pelamar');
    }


    private function _kirimEmail()
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'belajarcoding78@gmail.com',
            'smtp_pass' => 'yivnmnsocwasssvv',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'wordwrap'  => TRUE
        ];


        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('belajarcoding78@gmail.com', 'PT. Sahaware Teknologi Indonesia');
        $this->email->to($this->input->post('email'));
        $data = [
            'id_posisi' => $this->input->post('id_pekerjaan'),
            'gmeet' => $this->input->post('gmeet'),
            'tanggal' => $this->input->post('tanggal'),
            'mulai' => $this->input->post('mulai'),
            'akhir' => $this->input->post('akhir'),
            'dataposisi' => $this->DataPosisi_model->getAllDataPosisi(),

        ];
        $card = $this->load->view('email_card', $data, TRUE);

        $this->email->subject('Interview Talent Hunt');
        $this->email->message($card);

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
    private function _kirimSoal($token, $id)
    {
        $file_data = $this->upload_file();
        if (is_array($file_data)) {

            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'belajarcoding78@gmail.com',
                'smtp_pass' => 'yivnmnsocwasssvv',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
                'wordwrap'  => TRUE
            ];


            $this->load->library('email', $config);
            $this->email->initialize($config);

            $this->email->from('belajarcoding78@gmail.com', 'PT. Sahaware Teknologi Indonesia');
            $this->email->to($this->input->post('email'));
            $data = [
                'id_posisi' => $this->input->post('posisi'),
                'pg' => $this->input->post('pg'),
                'essay' => $this->input->post('essay'),
                'upload' => $this->input->post('linkuploadjawaban'),
                'dataposisi' => $this->DataPosisi_model->getAllDataPosisi(),
                'token' => $token,
                'email' => $this->input->post('email')

            ];
            $card = $this->load->view('email_soal', $data, TRUE);

            $this->email->subject('Soal Tes Recruitment');
            $this->email->message($card);


            $this->email->attach($file_data['full_path']);

            if (!$this->email->send()) {
                $this->session->set_flashdata('message', 'Soal berhasil dikirim');
            } else {
            }
        } else {
            $this->session->set_flashdata('message', 'Soal harus di input');
            redirect('Recruitment/pelamar');
        }
    }

    public function pg()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('recruitment___pelamar', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('link_pg', $email);
                    redirect('recruitment/linkpg');
                    // linksoalpg
                } else {
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> link pg expired!</div>');
                    redirect('Recruitment/Expired');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Reset password failed! Token invalid!</div>');
                redirect('Recruitment/Expired');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Reset password failed! Wrong email!</div>');
            redirect('Recruitment/Expired');
        }
    }
    public function linkpg()
    {
        if (!$this->session->userdata('link_pg')) {
            redirect('recruitment/Expired');
            $this->load->view('recruitment/linkpg'); //Tampilanlinkpg

        }
    }


    public function _kirimnilai($id, $email, $data)
    {
        $file_data = $this->upload_berkas();
        if (is_array($file_data)) {

            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'belajarcoding78@gmail.com',
                'smtp_pass' => 'yivnmnsocwasssvv',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
                'wordwrap'  => TRUE
            ];


            $this->load->library('email', $config);
            $this->email->initialize($config);

            $this->email->from('belajarcoding78@gmail.com', 'PT. Sahaware Teknologi Indonesia');
            $this->email->to($email);
            $status = $data['status'];
            if ($status == 'diterima') {
                $card = $this->load->view('email_nilai', $data, TRUE);
                $data_update = array(
                    'status' => 'diterima',

                );
                $where = array('id_pelamar' => $id);
                $this->Pelamar_model->update_data($where, $data_update);
            } elseif ($status == 'ditolak') {
                $card = $this->load->view('email_nilaitolak', $data, TRUE);
                $data_update = array(
                    'status' => 'ditolak',

                );
                $where = array('id_pelamar' => $id);
                $this->Pelamar_model->update_data($where, $data_update);
            }
            $this->email->subject('penilaian & surat penerimaan/penolakan');
            $this->email->message($card);

            $this->email->attach($file_data['full_path']);

            if ($this->email->send()) {
                if (delete_files($file_data['file_path'])) {
                    // $this->Pelamar_model->statussoal($id);
                    $this->session->set_flashdata('message', 'penilaian & surat penerimaan/penolakan berhasil dikirim dikirim');
                    redirect('Recruitment/pelamar');
                }
            }
        } else {
            $this->session->set_flashdata('message', 'penilaian belum lengkap');
            redirect('Recruitment/pelamar');
        }
    }

    public function interview($id)
    {
        $this->form_validation->set_rules('gmeet', 'Gmeet', 'required', [
            'required' => 'Link Gmeet harus diisi !',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Pelamar";
            $data['pelamar'] = $this->Pelamar_model->getAllPelamar();
            $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
            $data['user'] = $this->Hris_model->ambilUser();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('recruitment/pelamar', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'link_interview' => $this->input->post('gmeet'),
                'tanggal_interview' => $this->input->post('tanggal'),
                'jam_mulai' => $this->input->post('mulai'),
                'jam_berakhir' => $this->input->post('akhir'),
            ];
            $this->db->where('id_pelamar', $id);
            $this->db->update('recruitment___pelamar', $data);
            $this->_kirimEmail();
            $this->Pelamar_model->statuspelamar($id);
            $this->session->set_flashdata('message', 'Jadwal interview berhasil dikirim ');
            redirect('Recruitment/pelamar');
        }
    }
    public function soal($id)
    {

        $this->form_validation->set_rules('pg', 'Soal PG', 'required', [
            'required' => 'Link Soal PG harus diisi !',
        ]);


        $this->form_validation->set_rules('linkuploadjawaban', 'Link Upload Jawaban', 'required', [
            'required' => 'Link Upload Jawaban harus diisi !',
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Pelamar";
            $data['pelamar'] = $this->Pelamar_model->getAllPelamar();
            $data['dataposisi'] = $this->DataPosisi_model->getAllDataPosisi();
            $data['user'] = $this->Hris_model->ambilUser();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('recruitment/pelamar', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('recruitment___pelamar', ['email' => $email])->row_array();
            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_kirimSoal($token, $id);


                $this->Pelamar_model->statushasilinterview($id);
                $this->session->set_flashdata('message', 'Soal berhasil dikirim');
                redirect('Recruitment/pelamar');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> email tidak ditemukan!</div>');
                redirect('Recruitment/pelamar');
            }
        }
    }
    public function nilai($id)
    {

        $data = [
            'pg' => $this->input->post('nilaipg'),
            'essay' => $this->input->post('nilaites'),
            'berkas' => $this->input->post('berkas'),
            'jadwal' => $this->input->post('jadwal'),
            'mulai' => $this->input->post('mulai'),
            'akhir' => $this->input->post('akhir'),
            'bertemu' => $this->input->post('bertemu'),
            'status' => $this->input->post('status' . $id),
            'dataposisi' => $this->DataPosisi_model->getAllDataPosisi(),
            'id_posisi' => $this->input->post('id_pekerjaan'),

        ];
        // printr($data['status']);
        $email = $this->input->post('email');
        $this->_kirimnilai($id, $email, $data);

        $this->session->set_flashdata('message', 'Surat penerimaan/penolakan berhasil dikirim');
        redirect('Recruitment/pelamar');
    }

    public function download_file($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/cv/' . $filename;
        if (!file_exists($file_path)) {
            redirect('recruitment/Pelamar');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }
    public function download_hasil($filename)
    {
        // Menentukan path file yang akan didownload
        $file_path = './dist/uploads/' . $filename;
        if (!file_exists($file_path)) {
            redirect('Recruitment/pelamar');
        };
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($file_path));
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        readfile($file_path);
    }

    public function upload_file()
    {
        $config['upload_path'] = './dist/uploads';
        $config['max_size'] = '4024';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('essay')) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }
    public function upload_berkas()
    {
        $config['upload_path'] = './dist/uploads';
        $config['max_size'] = '4024';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('berkas')) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }

    public function upload_hasil_interview()
    {
        $config['upload_path'] = './dist/uploads';
        $config['max_size'] = '4024';
        $config['allowed_types'] = 'doc|docx|pdf';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('hasil_interview')) {
            return $this->upload->data();
        } else {
            return $this->upload->display_errors();
        }
    }

    private function _hasilinterview($email, $id)
    {
        $file_data = $this->upload_hasil_interview();
        // printr($file_data);
        if (is_array($file_data)) {

            $config = [
                'protocol' => 'smtp',
                'smtp_host' => 'ssl://smtp.googlemail.com',
                'smtp_port' => 465,
                'smtp_user' => 'belajarcoding78@gmail.com',
                'smtp_pass' => 'yivnmnsocwasssvv',
                'mailtype' => 'html',
                'charset' => 'utf-8',
                'newline' => "\r\n",
                'wordwrap'  => TRUE
            ];


            $this->load->library('email', $config);
            $this->email->initialize($config);

            $this->email->from('belajarcoding78@gmail.com', 'PT. Sahaware Teknologi Indonesia');
            $this->email->to($email);
            $data = [
                'hasil_interview' => $this->input->post('status' . $id),

            ];
            $card = $this->load->view('hasil_interview', $data, TRUE);
            $this->email->subject('Hasil Interview');
            $this->email->message($card);

            $this->email->attach($file_data['full_path']);

            if ($this->email->send()) {
                if (delete_files($file_data['file_path'])) {
                    $this->session->set_flashdata('message', 'Hasil interview berhasil upload');
                }
            } else {
                "";
            }
        } else {
            $this->session->set_flashdata('message', 'Hasil interview belum di upload');
            redirect('Recruitment/pelamar');
        }
    }


    public function tambah_hasil_interview($id_pelamar)
    {
        // $id_pelamar = $this->input->post('id_pelamar');
        // Konfigurasi library upload
        $config['upload_path'] = './dist/uploads';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 2048;
        $id = $this->input->post('id');
        $status = $this->input->post('status' . $id);
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('hasil_interview')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('tambah_hasil_interview', $error);
        } else {
            $data = $this->upload->data();
            $nama_file = $data['file_name'];

            $this->Pelamar_model->tambah_hasil_interview($id_pelamar, $nama_file);
            $email = $this->input->post('email');

            $this->_hasilinterview($email, $id);
            if ($status == 'Lulus') {
                $data_update = array(
                    'status' => 'lulus',
                    'hasil_interview' => $nama_file
                );
                $where = array('id_pelamar' => $id);
                $this->Pelamar_model->update_data($where, $data_update);
                $this->session->set_flashdata('message', 'Hasil interview Lulus berhasil dikirim');
            } else {
                $data_update = array(
                    'status' => 'Tidak Lulus',
                    'hasil_interview' => $nama_file
                );
                $where = array('id_pelamar' => $id);
                $this->Pelamar_model->update_data($where, $data_update);
                $this->session->set_flashdata('message', 'Hasil interview tidak lulus berhasil dikirim');
            }

            redirect('Recruitment/pelamar');
        }
    }
}
