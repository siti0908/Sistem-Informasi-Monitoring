<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Monitoring extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('MMonitoring','MInvoice','MVendor'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $nama_client = $_SESSION['nama_client'];
        $hak_akses = $_SESSION['hak_akses'];

        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'monitoring/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'monitoring/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'monitoring/index.html';
            $config['first_url'] = base_url() . 'monitoring/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MMonitoring->total_rows($q);
        $monitoring = $this->MMonitoring->get_limit_data($config['per_page'], $start, $q);

        if($hak_akses != "admin"){ 
            // jika bukan admin, maka tampilkan sesuai nama client
            $monitoring = $this->db->query("SELECT * FROM monitoring where nama_client = '$nama_client' order by id_monitoring DESC")->result();    
        }else{
            $monitoring = $this->db->query("SELECT * FROM monitoring order by id_monitoring DESC")->result();
        }
        

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'monitoring_data' => $monitoring,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );

        // $this->load->view('monitoring/monitoring_list', $data);
          $data['page'] = 'monitoring/monitoring_list';
        $this->load->view('template',$data );
    }

    public function read($id) 
    {
        $row = $this->MMonitoring->get_by_id($id);
        if ($row) {
            $data = array(
		'id_monitoring' => $row->id_monitoring,
		'kode_pesanan' => $row->kode_pesanan,
		'nama_client' => $row->nama_client,
		'alamat' => $row->alamat,
		'jenis_transportasi' => $row->jenis_transportasi,
		'status_customer' => $row->status_customer,
		'jenis_barang' => $row->jenis_barang,
        'berat_barang' => $row->berat_barang,
		'tanggal_pengiriman' => $row->tanggal_pengiriman,
		'rute_pengiriman' => $row->rute_pengiriman,
        'status_pengiriman' => $row->status_pengiriman,
        'foto_1' => $row->foto_1,
        'foto_2' => $row->foto_2,
        'foto_3' => $row->foto_3,
		'foto_4' => $row->foto_4,
	    );
            // $this->load->view('monitoring/monitoring_read', $data);
            $data['page'] = 'monitoring/monitoring_read';
        $this->load->view('template',$data );
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('monitoring'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('monitoring/create_action'),
	    'id_monitoring' => set_value('id_monitoring'),
	    'kode_pesanan' => set_value('kode_pesanan'),
	    'nama_client' => set_value('nama_client'),
	    'alamat' => set_value('alamat'),
	    'jenis_transportasi' => set_value('jenis_transportasi'),
	    'status_customer' => set_value('status_customer'),
	    'jenis_barang' => set_value('jenis_barang'),
        'berat_barang' => set_value('berat_barang'),
	    'tanggal_pengiriman' => set_value('tanggal_pengiriman'),
	    'rute_pengiriman' => set_value('rute_pengiriman'),
        'status_pengiriman' => set_value('status_pengiriman'),
        'foto_1' => set_value('foto_1'),
        'foto_2' => set_value('foto_2'),
        'foto_3' => set_value('foto_3'),
	    'foto_4' => set_value('foto_4'),
        'isDisabled' => ""
	);
         $list_kode_pesanan =  $this->MInvoice->get_all_union(); // ambil kode pesanan

         $temp_kode_pesanan = array(); // buat variabel sementara

         // looping dan cari kode_pesanan yang belum pernah di input ke tabel monitoring
         foreach ($list_kode_pesanan as $value){
            $isMonitoring = $this->db->query("SELECT kode_pesanan from monitoring where kode_pesanan = '$value->kode_pesanan'")->num_rows();
            if($isMonitoring<1){
                array_push($temp_kode_pesanan,$value->kode_pesanan);
            }
         }

         // kirim variabel yang berisi kode pesanan yang belum pernah terpakai
         $data['list_invoice'] = $temp_kode_pesanan;
        // $this->load->view('monitoring/monitoring_form', $data);
        $data['page'] = 'monitoring/monitoring_form';
        $this->load->view('template',$data );
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

             $config['upload_path']   ='./assets/dokumentasi';
            $config['allowed_types'] = 'jpg|jpeg|gif|pdf|docx|png|image';
            $this->load->library('upload',$config);

            //foto 1 
            if(!empty($_FILES['foto_1']['name'])){
               $this->upload->do_upload('foto_1');
               $data=$this->upload->data();
               $foto_1=$data['file_name'];
            }
              else {
                $foto_1=null;
            }
            //foto 2
            if(!empty($_FILES['foto_2']['name'])){
               $this->upload->do_upload('foto_2');
               $data=$this->upload->data();
               $foto_2=$data['file_name'];
            }
              else {
                $foto_2=null;
            }
             //foto 3
            if(!empty($_FILES['foto_3']['name'])){
               $this->upload->do_upload('foto_3');
               $data=$this->upload->data();
               $foto_3=$data['file_name'];
            }
              else {
                $foto_3=null;
            }

              //foto 4
            if(!empty($_FILES['foto_4']['name'])){
               $this->upload->do_upload('foto_4');
               $data=$this->upload->data();
               $foto_4=$data['file_name'];
            }
              else {
                $foto_4=null;
            }

            $data = array(
		'kode_pesanan' => $this->input->post('kode_pesanan',TRUE),
		'nama_client' => $this->input->post('nama_client',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'jenis_transportasi' => $this->input->post('jenis_transportasi',TRUE),
		'status_customer' => $this->input->post('status_customer',TRUE),
		'jenis_barang' => $this->input->post('jenis_barang',TRUE),
        'berat_barang' => $this->input->post('berat_barang',TRUE),
		//'tanggal_pengiriman' => $this->input->post('tanggal_pengiriman',TRUE),
		'rute_pengiriman' => $this->input->post('rute_pengiriman',TRUE),
        'status_pengiriman' => $this->input->post('status_pengiriman',TRUE),
        'foto_1' => $foto_1,
        'foto_2' => $foto_2,
        'foto_3' => $foto_3,
		'foto_4' => $foto_4,
	    );

            $this->MMonitoring->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('monitoring'));


          
        }
    }
    
public function get_invoice()
    {
        $kode_pesanan = $this->input->post('kode_pesanan');
        $data = $this->db->query("select i.nama_client,i.alamat,i.status_customer,v.jenis_transportasi from invoice i left join vendor v ON (i.kode_pesanan = v.kode_pesanan) where i.kode_pesanan='$kode_pesanan' ")->row();
        
        echo json_encode($data);
    }


    // public function get_vendor()
    // {
    //     $id = $this->input->post('kode_pesanan');
        // $data = $this->db->query("select * from vendor where kode_pesanan='$id'")->row();
    //     echo json_encode($data);
    // }


    public function update($id) 
    {
        $row = $this->MMonitoring->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('monitoring/update_action'),
		'id_monitoring' => set_value('id_monitoring', $row->id_monitoring),
		'kode_pesanan' => set_value('kode_pesanan', $row->kode_pesanan),
		'nama_client' => set_value('nama_client', $row->nama_client),
		'alamat' => set_value('alamat', $row->alamat),
		'jenis_transportasi' => set_value('jenis_transportasi', $row->jenis_transportasi),
		'status_customer' => set_value('status_customer', $row->status_customer),
		'jenis_barang' => set_value('jenis_barang', $row->jenis_barang),
        'berat_barang' => set_value('berat_barang', $row->berat_barang),
		'tanggal_pengiriman' => set_value('tanggal_pengiriman', $row->tanggal_pengiriman),
		'rute_pengiriman' => set_value('rute_pengiriman', $row->rute_pengiriman),
        'status_pengiriman' => set_value('status_pengiriman', $row->status_pengiriman),
        'foto_1' => set_value('foto_1', $row->foto_1),
        'foto_2' => set_value('foto_2', $row->foto_2),
        'foto_3' => set_value('foto_3', $row->foto_3),
		'foto_4' => set_value('foto_4', $row->foto_4),
        'isDisabled' => "disabled"
	    );
         $list_kode_pesanan =  $this->MInvoice->get_all_union(); // ambil kode pesanan

         $temp_kode_pesanan = array(); // buat variabel sementara

         // looping dan cari kode_pesanan yang belum pernah di input ke tabel monitoring
         foreach ($list_kode_pesanan as $value){
            $isMonitoring = $this->db->query("SELECT kode_pesanan from monitoring where kode_pesanan = '$value->kode_pesanan'")->num_rows();
            if($isMonitoring<1){
                array_push($temp_kode_pesanan,$value->kode_pesanan);
            }
         }
         array_push($temp_kode_pesanan, $row->kode_pesanan);
         // print_r($temp_kode_pesanan);die;
            // $this->load->view('monitoring/monitoring_form', $data);
         $data['list_invoice'] = $temp_kode_pesanan;
            $data['page'] = 'monitoring/monitoring_form';
        $this->load->view('template',$data );
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('monitoring'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules_for_update();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_monitoring', TRUE));
        } else {

       $id_monitoring = $this->input->post('id_monitoring', TRUE);
            $old_data = $this->db->query("select * from Monitoring where id_monitoring = $id_monitoring")->row();
            $data_old_for_insert = array(
                'id_monitoring' => $old_data->id_monitoring,
                'kode_pesanan' => $old_data->kode_pesanan,
                'nama_client' => $old_data->nama_client,
                'alamat' => $old_data->alamat,
                'jenis_transportasi' => $old_data->jenis_transportasi,
                'status_customer' => $old_data->status_customer,
                'jenis_barang' => $old_data->jenis_barang,
                'berat_barang' => $old_data->berat_barang,
                'tanggal_pengiriman' =>  $old_data->tanggal_pengiriman,
                'rute_pengiriman' =>  $old_data->rute_pengiriman,
                'status_pengiriman' =>  $old_data->status_pengiriman,
                'foto_1' =>  $old_data->foto_1,
                'foto_2' =>  $old_data->foto_2,
                'foto_3' =>  $old_data->foto_3,
                'foto_4' =>  $old_data->foto_4,
            );
           
            $this->db->insert('history_monitoring', $data_old_for_insert);

           $config['upload_path']   ='./assets/dokumentasi';
            $config['allowed_types'] = 'jpg|jpeg|gif|pdf|docx|png|image';
            $this->load->library('upload',$config);

            //foto 1 
            if(!empty($_FILES['foto_1']['name'])){
               $this->upload->do_upload('foto_1');
               $data=$this->upload->data();
               $foto_1=$data['file_name'];
            }
              else {
                $foto_1=null;
            }
            //foto 2
            if(!empty($_FILES['foto_2']['name'])){
               $this->upload->do_upload('foto_2');
               $data=$this->upload->data();
               $foto_2=$data['file_name'];
            }
              else {
                $foto_2=null;
            }
             //foto 3
            if(!empty($_FILES['foto_3']['name'])){
               $this->upload->do_upload('foto_3');
               $data=$this->upload->data();
               $foto_3=$data['file_name'];
            }
              else {
                $foto_3=null;
            }

              //foto 4
            if(!empty($_FILES['foto_4']['name'])){
               $this->upload->do_upload('foto_4');
               $data=$this->upload->data();
               $foto_4=$data['file_name'];
            }
              else {
                $foto_4=null;
            }
            


            $data = array(
		'kode_pesanan' => $this->input->post('kode_pesanan_hidden',TRUE),
		'nama_client' => $this->input->post('nama_client',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'jenis_transportasi' => $this->input->post('jenis_transportasi',TRUE),
		'status_customer' => $this->input->post('status_customer',TRUE),
		'jenis_barang' => $this->input->post('jenis_barang',TRUE),
        'berat_barang' => $this->input->post('berat_barang',TRUE),
		//'tanggal_pengiriman' => $this->input->post('tanggal_pengiriman',TRUE),
		'rute_pengiriman' => $this->input->post('rute_pengiriman',TRUE),
        'status_pengiriman' => $this->input->post('status_pengiriman',TRUE),
        'foto_1' => $foto_1,
        'foto_2' => $foto_2,
        'foto_3' => $foto_3,
		'foto_4' => $foto_4,
	    );

            $this->MMonitoring->update($this->input->post('id_monitoring', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('monitoring'));
        }
    }
    

  function getHistory(){
       $id_monitoring = $this->input->get('id_monitoring');

       $data = $this->db->query("SELECT * FROM history_monitoring where id_monitoring = $id_monitoring order by id_history DESC")->result();

        echo json_encode($data);
    }

    public function delete($id) 
    {
        $row = $this->MMonitoring->get_by_id($id);

        if ($row) {
            $this->MMonitoring->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('monitoring'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('monitoring'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kode_pesanan', 'kode pesanan', 'trim|required');
	// $this->form_validation->set_rules('nama_client', 'nama client', 'trim|required');
	// $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('jenis_transportasi', 'jenis transportasi', 'trim|required');
	$this->form_validation->set_rules('status_customer', 'status customer', 'trim|required');
	$this->form_validation->set_rules('jenis_barang', 'jenis barang', 'trim|required');
	$this->form_validation->set_rules('berat_barang', 'berat barang', 'trim|required');
	$this->form_validation->set_rules('rute_pengiriman', 'rute pengiriman', 'trim|required');
	$this->form_validation->set_rules('status_pengiriman', 'status pengiriman', 'trim|required');

	$this->form_validation->set_rules('id_monitoring', 'id_monitoring', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function _rules_for_update() 
    {
    // $this->form_validation->set_rules('kode_pesanan', 'kode pesanan', 'trim|required');
    // $this->form_validation->set_rules('nama_client', 'nama client', 'trim|required');
    // $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
    $this->form_validation->set_rules('jenis_transportasi', 'jenis transportasi', 'trim|required');
    $this->form_validation->set_rules('status_customer', 'status customer', 'trim|required');
    $this->form_validation->set_rules('jenis_barang', 'jenis barang', 'trim|required');
    $this->form_validation->set_rules('berat_barang', 'berat barang', 'trim|required');
    $this->form_validation->set_rules('rute_pengiriman', 'rute pengiriman', 'trim|required');
    $this->form_validation->set_rules('status_pengiriman', 'status pengiriman', 'trim|required');
    // $this->form_validation->set_rules('foto_1', 'foto 1', 'trim|required');
    // $this->form_validation->set_rules('foto_2', 'foto 2', 'trim|required');
    // $this->form_validation->set_rules('foto_3', 'foto 3', 'trim|required');
    // $this->form_validation->set_rules('foto_4', 'foto 4', 'trim|required');

    $this->form_validation->set_rules('id_monitoring', 'id_monitoring', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "monitoring.xls";
        $judul = "monitoring";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Transportasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Status Customer");
	xlsWriteLabel($tablehead, $kolomhead++, "Jenis Barang");
    xlsWriteLabel($tablehead, $kolomhead++, "Berat Barang");
	xlsWriteLabel($tablehead, $kolomhead++, "Tanggal Pengiriman");
	xlsWriteLabel($tablehead, $kolomhead++, "Rute Pengiriman");
    xlsWriteLabel($tablehead, $kolomhead++, "Status Pengiriman");
    xlsWriteLabel($tablehead, $kolomhead++, "Foto 1");
    xlsWriteLabel($tablehead, $kolomhead++, "Foto 2");
    xlsWriteLabel($tablehead, $kolomhead++, "Foto 3");
	xlsWriteLabel($tablehead, $kolomhead++, "Foto 4");

	foreach ($this->MMonitoring->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kode_pesanan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama_client);
	    xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_transportasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->status_customer);
	    xlsWriteLabel($tablebody, $kolombody++, $data->jenis_barang);
        xlsWriteLabel($tablebody, $kolombody++, $data->berat_barang);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tanggal_pengiriman);
	    xlsWriteLabel($tablebody, $kolombody++, $data->rute_pengiriman);
        xlsWriteLabel($tablebody, $kolombody++, $data->status_pengiriman);
        xlsWriteLabel($tablebody, $kolombody++, $data->foto_1);
        xlsWriteLabel($tablebody, $kolombody++, $data->foto_2);
        xlsWriteLabel($tablebody, $kolombody++, $data->foto_3);
	    xlsWriteLabel($tablebody, $kolombody++, $data->foto_4);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

}

/* End of file Monitoring.php */
/* Location: ./application/controllers/Monitoring.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-10-16 06:05:17 */
/* http://harviacode.com */