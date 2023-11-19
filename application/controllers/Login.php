<?php
class Login extends CI_Controller {
    public function __construct()
    {

        parent::__construct();
        $this->load->model('MUser');
    }
    public function index()
    {
        $this->load->view('login_view');
    }
    
    //  public function validasi()
    // {
    //     $username = $this->input->post('username');
    //     $password = $this->input->post('password');

    //     // Cek username
    //     if ($this->MUser->CheckUser($username,$password)) {
    //         // Verifikasi password
    //         $row = $this->MUser->get_by_username($username);

    //         if ($row) {
                
    //             if ($this->MUser->cekStatus($username)) {
    //                 $data_user = array(
    //                     'username' => $username,
    //                     'nama_client'=> $row->nama_client,
    //                     'hak_akses' => $row->hak_akses,
    //                     'is_login' => true
    //                 );

    //                 $this->session->set_userdata($data_user);
    //                 redirect(site_url('Dashboard'));
    //             } else {
    //                 $this->session->set_flashdata('status', 'Akun Anda Belum Di Approve');
    //                 redirect('Login');
    //             }
    //         } else {
    //             $this->session->set_flashdata('pesan', 'Username atau Password Anda Salah');
    //             redirect('Login');
    //         }
    //     } else {
    //         $this->session->set_flashdata('pesan', 'Username atau Password Anda Salah');
    //         redirect('Login');
    //     }
    // }

    public function validasi()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Cek username
        if ($this->MUser->CheckUser($username)) {
            // Verifikasi password
            $row = $this->MUser->get_by_username($username);

            if ($row && password_verify($password, $row->password)) {
                
                if ($this->MUser->cekStatus($username)) {
                    $data_user = array(
                        'username' => $username,
                        'hak_akses' => $row->hak_akses,
                        'nama_client'=> $row->nama_client,
                        'is_login' => true
                    );

                    $this->session->set_userdata($data_user);
                    redirect(site_url('Dashboard'));
                } else {
                    $this->session->set_flashdata('status', 'Akun Anda Belum Di Approve');
                    redirect('Login');
                }
            } else {
                $this->session->set_flashdata('pesan', 'Username atau Password Anda Salah');
                redirect('Login');
            }
        } else {
            $this->session->set_flashdata('pesan', 'Username atau Password Anda Salah');
            redirect('Login');
        }
    }


    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Login');
    }
}
?>