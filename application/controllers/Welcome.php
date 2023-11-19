<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


	public function index()
	{
		$this->load->helper('qrcode');

		$data['project'] = $this->db->query("SELECT id,project_code,name,client_name FROM PROJECT")->result_array();
        //$data['data_barang'] = $this->db->query("SELECT id_order,request_pickup,pengirim,penerima,tujuan,tarif,berat,nilai_barang,keterangan FROM DATA_BARANG")->result_array();
        
		$this->load->view('welcome_message', $data);
	}

	public function print()
	{
		$this->load->helper('qrcode');
		$data['project'] = $this->db->query("SELECT id,project_code,name,client_name FROM PROJECT")->result_array();
		//$data['data_barang'] = $this->db->query("SELECT id_order,request_pickup,pengirim,penerima,tujuan,tarif,berat,nilai_barang,keterangan FROM DATA_BARANG")->result_array();
		$this->load->view('print', $data);
	}

	public function cetak_resi($id)
	{
		$this->load->helper('qrcode');
		// Load Zend Barcode Helper
		$this->load->helper('barcode');

		$data['detail_project'] = $this->db->query("SELECT * FROM PROJECT WHERE id='$id'")->row_array();
		//$data['data_barang'] = $this->db->query("SELECT * FROM DATA_BARANG WHERE id_order='$id_order'")->row_array();
		$this->load->view('cetak_resi', $data);
	}
}
