<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MMonitoring extends CI_Model
{

    public $table = 'monitoring';
    public $id = 'id_monitoring';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }
    
    // get total rows
    function total_rows($q = NULL) {
        $this->db->like('id_monitoring', $q);
	$this->db->or_like('kode_pesanan', $q);
	$this->db->or_like('nama_client', $q);
	$this->db->or_like('alamat', $q);
	$this->db->or_like('jenis_transportasi', $q);
	$this->db->or_like('status_customer', $q);
	$this->db->or_like('jenis_barang', $q);
    $this->db->or_like('berat_barang', $q);
	$this->db->or_like('tanggal_pengiriman', $q);
	$this->db->or_like('rute_pengiriman', $q);
    $this->db->or_like('status_pengiriman', $q);
    $this->db->or_like('foto_1', $q);
    $this->db->or_like('foto_2', $q);
    $this->db->or_like('foto_3', $q);
	$this->db->or_like('foto_4', $q);
	$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
    $this->db->select('m.*,i.nama_client,i.alamat,i.kode_pesanan,i.status_customer,v.jenis_transportasi,u.nama_client');
    $this->db->from('monitoring m');
    $this->db->join('invoice i', 'i.kode_pesanan = m.kode_pesanan');
    $this->db->join('vendor v', 'v.kode_pesanan = m.kode_pesanan');
    $this->db->join('user u', 'u.nama_client = m.nama_client');




        $this->db->order_by('m.id_monitoring', $this->order);
        $this->db->like('m.id_monitoring', $q);
	$this->db->or_like('m.kode_pesanan', $q);
	$this->db->or_like('m.nama_client', $q);
	$this->db->or_like('m.alamat', $q);
	$this->db->or_like('m.jenis_transportasi', $q);
	$this->db->or_like('m.status_customer', $q);
	$this->db->or_like('m.jenis_barang', $q);
    $this->db->or_like('m.berat_barang', $q);
	$this->db->or_like('m.tanggal_pengiriman', $q);
	$this->db->or_like('m.rute_pengiriman', $q);
    $this->db->or_like('m.status_pengiriman', $q);
    $this->db->or_like('m.foto_1', $q);
    $this->db->or_like('m.foto_2', $q);
    $this->db->or_like('m.foto_3', $q);
	$this->db->or_like('m.foto_4', $q);



     if($_SESSION['hak_akses']=='customer'){
        $this->db->where('u.nama_client',$_SESSION['nama_client']);
    }
    
	$this->db->limit($limit, $start);
        return $this->db->get()->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file MMonitoring.php */
/* Location: ./application/models/MMonitoring.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-10-16 06:05:17 */
/* http://harviacode.com */