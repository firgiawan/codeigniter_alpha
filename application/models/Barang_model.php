<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataBarang()
		{
			$this->db->select("id,nama,kode,DATE_FORMAT(tanggal_beli,'%d-%m-%Y') as tanggal_beli,foto");
			$query = $this->db->get('barang');
			return $query->result();
		}

		public function getDataKategori()
		{
			$this->db->select("id,nama");
			$query = $this->db->get('kategori');
			return $query->result();
		}

		public function insertBarang()
		{
			$object = array(
				'nama' => $this->input->post('nama'), 
				'kode' => $this->input->post('kode'),
				'tanggal_beli' => $this->input->post('tanggal_beli'),
				'foto' => $this->upload->data('file_name'),
				'fk_kategori' => $this->input->post('kategori')
				);
			$this->db->insert('barang', $object);
		}


		public function getBarang($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('barang');
			return $query->result();

		}

		public function updateById($id)
		{
			$data = array('nama' => $this->input->post('nama'), );
			$this->db->where('id', $id);
			$this->db->update('barang', $data);
		}

		public function deleteBarang($id)
		{
			$this->db->delete('barang',array('id' => $id));
		}
}

 ?>