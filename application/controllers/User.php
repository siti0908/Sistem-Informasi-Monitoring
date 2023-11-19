<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'user/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'user/index.html';
            $config['first_url'] = base_url() . 'user/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->User_model->total_rows($q);
        $user = $this->User_model->get_limit_data($config['per_page'], $start, $q);
        $user = $this->db->query("SELECT * FROM user order by id_client DESC")->result();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'user_data' => $user,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('user/user_list', $data);
            $data['page'] = 'user/user_list';
        $this->load->view('template',$data );
    }

    public function read($id) 
    {
        $row = $this->User_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_client' => $row->id_client,
		'nama_client' => $row->nama_client,
		'alamat' => $row->alamat,
		'no_tlp' => $row->no_tlp,
		'username' => $row->username,
		'password' => $row->password,
		'email' => $row->email,
		'status' => $row->status,
		'hak_akses' => $row->hak_akses,
	    );
            // $this->load->view('user/user_read', $data);
            $data['page'] = 'user/user_read';
        $this->load->view('template',$data );
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
 public function list_approve()
    {
        $row = $this->User_model->CheckApprove();
        $data = array (
            'user_data' => $row
        );
        $data['page'] = 'user/user_approve';
        $this->load->view('template', $data);
    }

    public function approve($id)
    {
        $data = array (
            'status' => 'approve'
        );
        $this->User_model->update ($id, $data);
        $this->session->set_flashdata('message', 'Update Record Success');
        redirect(site_url('user/list_approve'));
    }
    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('user/create_action'),
	    'id_client' => set_value('id_client'),
	    'nama_client' => set_value('nama_client'),
	    'alamat' => set_value('alamat'),
	    'no_tlp' => set_value('no_tlp'),
	    'username' => set_value('username'),
	    'password' => set_value('password'),
	    'email' => set_value('email'),
	    // 'status' => set_value('status'),
	    // 'hak_akses' => set_value('hak_akses'),
	);
        // $this->load->view('user/user_form', $data);
        $data['page'] = 'user/user_form';
        $this->load->view('registrasi_view',$data );
    }
    
   
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $data = array(
		'nama_client' => $this->input->post('nama_client',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_tlp' => $this->input->post('no_tlp',TRUE),
		'username' => $this->input->post('username',TRUE),
		'password' => $this->hash_password($this->input->post('password',TRUE)),
        // 'password' => $this->input->post('password',TRUE),
		'email' => $this->input->post('email',TRUE),
		// 'status' => $this->input->post('status',TRUE),
		// 'hak_akses' => $this->input->post('hak_akses',TRUE),

	    );

           

            $this->User_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
         return $this->load->view('login_view', $data);
        }
    }

    private function hash_password($password){

               return password_hash($password, PASSWORD_DEFAULT);
            }
    
    public function update($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('user/update_action'),
		'id_client' => set_value('id_client', $row->id_client),
		'nama_client' => set_value('nama_client', $row->nama_client),
		'alamat' => set_value('alamat', $row->alamat),
		'no_tlp' => set_value('no_tlp', $row->no_tlp),
		'username' => set_value('username', $row->username),
		// 'password' => set_value('password', $row->password),
		'email' => set_value('email', $row->email),
		// 'status' => set_value('status', $row->status),
		// 'hak_akses' => set_value('hak_akses', $row->hak_akses),
	    );
            // $this->load->view('user/user_form', $data);
            $data['page'] = 'user/user_form';
        $this->load->view('template',$data );
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_client', TRUE));
        } else {
            $data = array(
		'nama_client' => $this->input->post('nama_client',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_tlp' => $this->input->post('no_tlp',TRUE),
		'username' => $this->input->post('username',TRUE),
		// 'password' => $this->input->post('password',TRUE),
		'email' => $this->input->post('email',TRUE),
		// 'status' => $this->input->post('status',TRUE),
		// 'hak_akses' => $this->input->post('hak_akses',TRUE),
	    );

            $this->User_model->update($this->input->post('id_client', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('user'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->User_model->get_by_id($id);

        if ($row) {
            $this->User_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('user'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('user'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_client', 'nama client', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_tlp', 'no tlp', 'trim|required');
	$this->form_validation->set_rules('username', 'username', 'trim|required');
	// $this->form_validation->set_rules('password', 'password', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
	// $this->form_validation->set_rules('status', 'status', 'trim|required');
	// $this->form_validation->set_rules('hak_akses', 'hak akses', 'trim|required');

	$this->form_validation->set_rules('id_client', 'id_client', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "user.xls";
        $judul = "user";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Client");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Tlp");
	xlsWriteLabel($tablehead, $kolomhead++, "Username");
	xlsWriteLabel($tablehead, $kolomhead++, "Password");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
	xlsWriteLabel($tablehead, $kolomhead++, "Hak Akses");

	foreach ($this->User_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_client);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_tlp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->username);
	    xlsWriteLabel($tablebody, $kolombody++, $data->password);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
	    xlsWriteLabel($tablebody, $kolombody++, $data->hak_akses);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file User.php */
/* Location: ./application/controllers/User.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-10-06 11:33:01 */
/* http://harviacode.com */