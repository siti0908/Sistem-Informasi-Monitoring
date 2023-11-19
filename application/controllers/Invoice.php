<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('MInvoice','MVendor'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $nama_client = $_SESSION['nama_client'];
        $hak_akses = $_SESSION['hak_akses'];

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'invoice/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'invoice/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'invoice/index.html';
            $config['first_url'] = base_url() . 'invoice/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MInvoice->total_rows($q);
        $invoice = $this->MInvoice->get_limit_data($config['per_page'], $start, $q);


        if($hak_akses != "admin"){
        $invoice = $this->db->query("SELECT * FROM invoice where nama_client='$nama_client' order by id_invoice DESC")->result();

        }else{
        $invoice = $this->db->query("SELECT * FROM invoice order by id_invoice DESC")->result();

        }




        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'invoice_data' => $invoice,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        // $this->load->view('invoice/invoice_list', $data);
        $data['page'] = 'invoice/invoice_list';
        $this->load->view('template',$data );
    }

    public function read($id) 
    {
        $row = $this->MInvoice->get_by_id($id);
        if ($row) {
            $data = array(
		'id_invoice' => $row->id_invoice,
        'kode_pesanan' => $row->kode_pesanan,
		'nama_client' => $row->nama_client,
		'alamat' => $row->alamat,
		'jumlah_pembayaran' => $row->jumlah_pembayaran,
        'bukti_pembayaran' => $row->bukti_pembayaran,
		'tanggal_pembayaran' => $row->tanggal_pembayaran,
		'status' => $row->status,
        'jumlah_pembayaran_customer' => $row->jumlah_pembayaran,
        'bukti_pembayaran_customer' => $row->bukti_pembayaran,
        'tanggal_pembayaran_customer' => $row->tanggal_pembayaran,
        'status_customer' => $row->status,

	    );
            // $this->load->view('invoice/invoice_read', $data);
             $data['page'] = 'invoice/invoice_read';
        $this->load->view('template',$data );
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('invoice'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('invoice/create_action'),
        'id_invoice' => set_value('id_invoice'),
	    'kode_pesanan' => set_value('kode_pesanan'),
	    'nama_client' => set_value('nama_client'),
	    'alamat' => set_value('alamat'),
	    'jumlah_pembayaran' => set_value('jumlah_pembayaran'),
        'bukti_pembayaran' => set_value('bukti_pembayaran'),
	    'tanggal_pembayaran' => set_value('tanggal_pembayaran'),
	    'status' => set_value('status'),
        'jumlah_pembayaran_customer' => set_value('jumlah_pembayaran_customer'),
        'bukti_pembayaran_customer' => set_value('bukti_pembayaran_customer'),
        'tanggal_pembayaran_customer' => set_value('tanggal_pembayaran_customer'),
        'status_customer' => set_value('status_customer'),
	);
        $listVendor = $this->MVendor->get_all();
        $listVendorTemp = array(); // Inisialisasi array

        foreach ($listVendor as $key) {
            $kode_pesanan = $key->kode_pesanan;
            
            // Menggunakan metode CodeIgniter untuk menghindari SQL injection
            $this->db->where('kode_pesanan', $kode_pesanan);
            $this->db->where('bukti_pembayaran IS NOT NULL');
            $query = $this->db->get('invoice');

            // Menggunakan num_rows untuk menghitung hasil
            if ($query->num_rows() < 1) {
                $listVendorTemp[] = $kode_pesanan; // Menambahkan $kode_pesanan ke array
            }
        }

        // var_dump($listVendorTemp);die;


        $data['list_vendor'] =  $listVendorTemp;
        // $this->load->view('invoice/invoice_form', $data);
         $data['page'] = 'invoice/invoice_form';
        $this->load->view('template',$data );
    }


  
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
       
            $config['upload_path']   ='./assets/bukti pembayaran';
            $config['allowed_types'] = 'jpg|jpeg|gif|pdf|docx|png|image';
            $this->load->library('upload',$config);

            //bukti pembayaran 
            if(!empty($_FILES['bukti_pembayaran']['name'])){
               $this->upload->do_upload('bukti_pembayaran');
               $data=$this->upload->data();
               $bukti_pembayaran=$data['file_name'];
            }
              else {
                $bukti_pembayaran=null;
            }
            //bukti pembayaran customer
            if(!empty($_FILES['bukti_pembayaran_customer']['name'])){
               $this->upload->do_upload('bukti_pembayaran_customer');
               $data=$this->upload->data();
               $bukti_pembayaran_customer=$data['file_name'];
            }
              else {
                $bukti_pembayaran_customer=null;
            }

            $data = array(
        'kode_pesanan' => $this->input->post('kode_pesanan',TRUE),
		'nama_client' => $this->input->post('nama_client',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran',TRUE),
        'bukti_pembayaran' => $bukti_pembayaran,
		'tanggal_pembayaran' => $this->input->post('tanggal_pembayaran',TRUE),
        // 'tanggal_pembayaran' => $tanggal_pembayaran,
		'status' => $this->input->post('status',TRUE),
        'jumlah_pembayaran_customer' => $this->input->post('jumlah_pembayaran_customer',TRUE),
        'bukti_pembayaran_customer' => $bukti_pembayaran_customer,
        'tanggal_pembayaran_customer' =>$this->input->post('tanggal_pembayaran_customer',TRUE),
        'status_customer' => $this->input->post('status_customer',TRUE),
	    );

            $this->MInvoice->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('invoice'));
        }
    }

     public function get_vendor()
    {
        $id = $this->input->post('kode_pesanan');
        $data = $this->db->query("select * from vendor where kode_pesanan='$id'")->row();
        echo json_encode($data);
    }

    
    public function update($id) 
    {
        $row = $this->MInvoice->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('invoice/update_action'),
                'id_invoice' => set_value('id_invoice', $row->id_invoice),
        		'kode_pesanan' => set_value('kode_pesanan', $row->kode_pesanan),
        		'nama_client' => set_value('nama_client', $row->nama_client),
        		'alamat' => set_value('alamat', $row->alamat),
        		'jumlah_pembayaran' => set_value('jumlah_pembayaran', $row->jumlah_pembayaran),
                'bukti_pembayaran' => set_value('bukti_pembayaran', $row->bukti_pembayaran),
        		'tanggal_pembayaran' => set_value('tanggal_pembayaran', $row->tanggal_pembayaran),
        		'status' => set_value('status', $row->status),
                'jumlah_pembayaran_customer' => set_value('jumlah_pembayaran_customer', $row->jumlah_pembayaran_customer),
                'bukti_pembayaran_customer' => set_value('bukti_pembayaran_customer', $row->bukti_pembayaran_customer),
                'tanggal_pembayaran_customer' => set_value('tanggal_pembayaran_customer', $row->tanggal_pembayaran_customer),
                'status_customer' => set_value('status_customer', $row->status_customer),
        	    );
                $data['list_vendor'] =  $this->MVendor->get_all();
                // print_r($data['list_vendor'][0]->id_vendor);die;

            // $this->load->view('invoice/invoice_form', $data);
             $data['page'] = 'invoice/invoice_form';
            $this->load->view('template',$data );
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('invoice'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_invoice', TRUE));
        } else {

            $config['upload_path']   ='./assets/bukti pembayaran';
            $config['allowed_types'] = 'jpg|jpeg|gif|pdf|docx|png|image';
            $this->load->library('upload',$config);

            $bukti_pembayaran = "";
            $bukti_pembayaran_customer = "";

            //bukti pembayaran 
            if(!empty($_FILES['bukti_pembayaran']['name'])){
               $this->upload->do_upload('bukti_pembayaran');
               $data=$this->upload->data();
               $bukti_pembayaran=$data['file_name'];
            }

            //bukti pembayaran customer
            if(!empty($_FILES['bukti_pembayaran_customer']['name'])){
               $this->upload->do_upload('bukti_pembayaran_customer');
               $data=$this->upload->data();
               $bukti_pembayaran_customer=$data['file_name'];
            }

            $data = array(
              'kode_pesanan' => $this->input->post('kode_pesanan',TRUE),
              'nama_client' => $this->input->post('nama_client',TRUE),
               'alamat' => $this->input->post('alamat',TRUE),
              'jumlah_pembayaran' => $this->input->post('jumlah_pembayaran',TRUE),
              'tanggal_pembayaran' => $this->input->post('tanggal_pembayaran',TRUE),
              'status' => $this->input->post('status',TRUE),
              'jumlah_pembayaran_customer' => $this->input->post('jumlah_pembayaran_customer',TRUE),
              'tanggal_pembayaran_customer' => $this->input->post('tanggal_pembayaran_customer',TRUE),
              'status_customer' => $this->input->post('status_customer',TRUE),
            );

            if($bukti_pembayaran != ""){
              $data['bukti_pembayaran'] = $bukti_pembayaran;
            }

            if($bukti_pembayaran_customer != ""){
              $data['bukti_pembayaran_customer'] = $bukti_pembayaran_customer;
            }


            // $data['selected_kode_pesanan'] = $kode_pesanan['kode_pesanan']; // Gantilah $data_dari_database dengan data yang sebenarnya dari database
            // $this->load->view('invoice', $data);

            $this->MInvoice->update($this->input->post('id_invoice', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('invoice'));
        }

    }
    
    public function delete($id) 
    {
        $row = $this->MInvoice->get_by_id($id);

        if ($row) {
            $this->MInvoice->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('invoice'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('invoice'));
        }
    }

    public function _rules() 
    {
    $this->form_validation->set_rules('kode_pesanan', 'kode pesanan', 'trim|required');
	// $this->form_validation->set_rules('nama_client', 'nama client', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('jumlah_pembayaran', 'jumlah pembayaran', 'trim|required');
    //$this->form_validation->set_rules('bukti_pembayaran', 'bukti pembayaran', 'trim|required');
    //$this->form_validation->set_rules('status', 'status', 'trim|required');
    $this->form_validation->set_rules('jumlah_pembayaran_customer', 'jumlah pembayaran customer', 'trim|required');
    //$this->form_validation->set_rules('bukti_pembayaran', 'bukti pembayaran', 'trim|required');
    //$this->form_validation->set_rules('status_customer', 'status customer', 'trim|required');

	$this->form_validation->set_rules('id_invoice', 'id_invoice', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "invoice.xls";
        $judul = "invoice";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Nama Client");
	xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
	xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Pembayaran");
    xlsWriteLabel($tablehead, $kolomhead++, "Bukti Pembayaran");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Pembayaran");
	xlsWriteLabel($tablehead, $kolomhead++, "Status");
    xlsWriteLabel($tablehead, $kolomhead++, "Jumlah Pembayaran Customer");
    xlsWriteLabel($tablehead, $kolomhead++, "Bukti Pembayaran Customer");
    xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Pembayaran Customer");
    xlsWriteLabel($tablehead, $kolomhead++, "Status Customer");

	foreach ($this->MInvoice->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
        xlsWriteNumber($tablebody, $kolombody++, $data->kode_pesanan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->nama_client);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_pembayaran);
        xlsWriteLabel($tablebody, $kolombody++, $data->bukti_pembayaran);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_pembayaran);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status);
        xlsWriteNumber($tablebody, $kolombody++, $data->jumlah_pembayaran_customer);
        xlsWriteLabel($tablebody, $kolombody++, $data->bukti_pembayaran_customer);
        xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_pembayaran_customer);
        xlsWriteLabel($tablebody, $kolombody++, $data->status_customer);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Invoice.php */
/* Location: ./application/controllers/Invoice.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-10-08 11:45:43 */
/* http://harviacode.com */