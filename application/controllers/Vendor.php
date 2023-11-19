<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('MVendor');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'vendor/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'vendor/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'vendor/index.html';
            $config['first_url'] = base_url() . 'vendor/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MVendor->total_rows($q);
        $vendor = $this->MVendor->get_limit_data($config['per_page'], $start, $q);
        $vendor = $this->db->query("SELECT * FROM vendor order by id_vendor DESC")->result();

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'vendor_data' => $vendor,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        //$this->load->view('vendor/vendor_list', $data);
        $data['page'] = 'vendor/vendor_list';
        $this->load->view('template',$data );
    }

 public function generateKode($id)
  {
    $result = '';
    // only get the date from datetime
    $date = date('Y-m-d');
    $date = str_replace('-', '', $date);
    $date = substr($date, 2, 6);

    // generate 
    $result = "H".$date . "0" .$id;
    return $result;
  }

  public function read($id) 
    {
        $row = $this->MVendor->get_by_id($id);
        if ($row) {
            $data = array(
		'id_vendor' => $row->id_vendor,
        'kode_pesanan' => $row->kode_pesanan,
		'nama_vendor' => $row->nama_vendor,
		'alamat' => $row->alamat,
		'no_tlp' => $row->no_tlp,
		'email' => $row->email,
        'jenis_transportasi' => $row->jenis_transportasi,
        'jumlah_pembayaran' => $row->jumlah_pembayaran,
        'tanggal_pesanan' => $row->tanggal_pesanan,
		'nama_client' => $row->nama_client,
	    );
            $data['page'] = 'vendor/vendor_read';
        $this->load->view('template',$data );
            //$this->load->view('vendor/vendor_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('vendor'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('vendor/create_action'),
	    'id_vendor' => set_value('id_vendor'),
        'kode_pesanan' => set_value('kode_pesanan'),
	    'nama_vendor' => set_value('nama_vendor'),
	    'alamat' => set_value('alamat'),
	    'no_tlp' => set_value('no_tlp'),
	    'email' => set_value('email'),
        'jenis_transportasi' => set_value('jenis_transportasi'),
        'jumlah_pembayaran' => set_value('jumlah_pembayaran'),
        'tanggal_pesanan' => set_value('tanggal_pesanan'),
	    'nama_client' => set_value('nama_client'),
	);
        $data['page'] = 'vendor/vendor_form';
        $this->load->view('template',$data );
        //$this->load->view('vendor/vendor_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
        'nama_vendor' => $this->input->post('nama_vendor',TRUE),
        'kode_pesanan' => $this->input->post('kode_pesanan',TRUE),
        'alamat' => $this->input->post('alamat',TRUE),
        'no_tlp' => $this->input->post('no_tlp',TRUE),
        'email' => $this->input->post('email',TRUE),
        'jenis_transportasi' => $this->input->post('jenis_transportasi',TRUE),
        'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran',TRUE),
        'tanggal_pesanan' => $this->input->post('tanggal_pesanan',TRUE),
        'nama_client' => $this->input->post('nama_client',TRUE),
        );
            $tanggal_pesanan = $this->input->post('tanggal_pesanan',TRUE);
            $last_id = $this->MVendor->insert($data);
            $kode_pesanan = $this->generateKode($last_id,$tanggal_pesanan);
            // print_r("UPDATE Vendor SET kode_pesanan='".$kode_pesanan."' where id_vendor = '".$last_id."'");die;
            $var = $this->db->query("UPDATE Vendor SET kode_pesanan='$kode_pesanan' where id_vendor = '$last_id'");
            // print_r($var);die;

            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('vendor'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->MVendor->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('vendor/update_action'),
		'id_vendor' => set_value('id_vendor', $row->id_vendor),
        'kode_pesanan' => set_value('kode_pesanan', $row->kode_pesanan),
		'nama_vendor' => set_value('nama_vendor', $row->nama_vendor),
		'alamat' => set_value('alamat', $row->alamat),
		'no_tlp' => set_value('no_tlp', $row->no_tlp),
		'email' => set_value('email', $row->email),
        'jenis_transportasi' => set_value('jenis_transportasi', $row->jenis_transportasi),
        'jumlah_pembayaran' => set_value('jumlah_pembayaran', $row->jumlah_pembayaran),
        'tanggal_pesanan' => set_value('tanggal_pesanan', $row->tanggal_pesanan),
		'nama_client' => set_value('nama_client', $row->nama_client),
	    );
            $data['page'] = 'vendor/vendor_form';
        $this->load->view('template',$data );
            //$this->load->view('vendor/vendor_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('vendor'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_vendor', TRUE));
        } else {
            $data = array(
        'kode_pesanan' => $this->input->post('kode_pesanan',TRUE),
		'nama_vendor' => $this->input->post('nama_vendor',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'no_tlp' => $this->input->post('no_tlp',TRUE),
		'email' => $this->input->post('email',TRUE),
        'jenis_transportasi' => $this->input->post('jenis_transportasi',TRUE),
        'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran',TRUE),
        'tanggal_pesanan' => $this->input->post('tanggal_pesanan',TRUE),
		'nama_client' => $this->input->post('nama_client',TRUE),
	    );
            


            $this->MVendor->update($id_vendor, $data);         
            $this->MVendor->update($this->input->post('id_vendor', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('vendor'));
            
        }
    }
    
    public function delete($id) 
    {
        $row = $this->MVendor->get_by_id($id);

        if ($row) {
            $this->MVendor->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('vendor'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('vendor'));
        }
    }

    public function _rules() 
    {
    // $this->form_validation->set_rules('kode_pesanan', 'kode pesanan', 'trim|required');
	$this->form_validation->set_rules('nama_vendor', 'nama vendor', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('no_tlp', 'no tlp', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');
    $this->form_validation->set_rules('jenis_transportasi', 'jenis transportasi', 'trim|required');
    $this->form_validation->set_rules('jumlah_pembayaran', 'jumlah pembayaran', 'trim|required');
	$this->form_validation->set_rules('nama_client', 'nama_client', 'trim|required');

	$this->form_validation->set_rules('id_vendor', 'id_vendor', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "vendor.xls";
        $judul = "vendor";
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
    xlsWriteLabel($tablehead, $kolomhead++, "Kode Pesanan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Vendor");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "No Tlp");
	xlsWriteLabel($tablehead, $kolomhead++, "Email");
    xlsWriteLabel($tablehead, $kolomhead++, "Jenis Transportasi");
    xlsWriteLabel($tablehead, $kolomhead++, "jumlah Pembayaran");
    xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Pesanan");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Client");

	foreach ($this->MVendor->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteLabel($tablebody, $kolombody++, $data->kode_pesanan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_vendor);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->no_tlp);
	    xlsWriteLabel($tablebody, $kolombody++, $data->email);
        xlsWriteLabel($tablebody, $kolombody++, $data->jenis_transportasi);
        xlsWriteLabel($tablebody, $kolombody++, $data->jumlah_pembayaran);
        xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_pesanan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_client);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Vendor.php */
/* Location: ./application/controllers/Vendor.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-10-06 12:47:43 */
/* http://harviacode.com */