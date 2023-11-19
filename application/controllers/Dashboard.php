<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	public function index()
	{
		$nama_client = $_SESSION['nama_client'];
		$hak_akses = $_SESSION['hak_akses'];

		$data['page'] = 'dashboard_view';

		if($hak_akses != "admin"){
			$data['jml_invoice']=$this->db->query("SELECT * from Invoice where nama_client='".$nama_client."'")->num_rows();
		$data['jml_user']=$this->db->query("SELECT * from User where nama_client='".$nama_client."'")->num_rows();
		$data['jml_vendor']=$this->db->query("SELECT * from Vendor where nama_client='".$nama_client."'")->num_rows();
		$data['jml_monitoring']=$this->db->query("SELECT * from Monitoring where nama_client='".$nama_client."'")->num_rows();
		$data['invoice_data'] = $this->db->query("SELECT * FROM Invoice WHERE nama_client='$nama_client' and (status_customer = 'Unpaid' OR status = 'Unpaid') ORDER BY kode_pesanan DESC LIMIT 5 ")->result();
		$data['monitoring_data'] = $this->db->query("SELECT * FROM Monitoring WHERE nama_client='$nama_client' and (status_pengiriman = 'Belum Dikirim' OR status_pengiriman = 'Dalam Perjalanan') ORDER BY kode_pesanan DESC LIMIT 5")->result();
		}else{
			$data['jml_invoice']=$this->db->query("SELECT * from Invoice")->num_rows();
		$data['jml_user']=$this->db->query("SELECT * from User")->num_rows();
		$data['jml_vendor']=$this->db->query("SELECT * from Vendor")->num_rows();
		$data['jml_monitoring']=$this->db->query("SELECT * from Monitoring")->num_rows();
		$data['invoice_data'] = $this->db->query("SELECT * FROM Invoice WHERE (status_customer = 'Unpaid' OR status = 'Unpaid') ORDER BY kode_pesanan DESC LIMIT 5 ")->result();
		$data['monitoring_data'] = $this->db->query("SELECT * FROM Monitoring WHERE (status_pengiriman = 'Belum Dikirim' OR status_pengiriman = 'Dalam Perjalanan') ORDER BY kode_pesanan DESC LIMIT 5")->result();
		}
		




 
		$this->load->view('template',$data );
	}
}
