<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_Model extends CI_Model {

		public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getDataKategori()
		{
			$this->db->select("id,nama");
			$query = $this->db->get('kategori');
			return $query->result();
		}

		public function insertKategori()
		{
			$object = array('nama' => $this->input->post('nama') );
			$this->db->insert('kategori', $object);
		}


		public function getKategori($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('kategori');
			return $query->result();

		}

		public function updateById($id)
		{
			$data = array('nama' => $this->input->post('nama'), );
			$this->db->where('id', $id);
			$this->db->update('kategori', $data);
		}

		public function deleteKategori($id)
		{
			$this->db->delete('kategori',array('id' => $id));
		}
}

 ?>