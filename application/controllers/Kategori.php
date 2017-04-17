<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {

	public function index()
	{
		$this->load->model('kategori_model');
		$data["kategori_list"] = $this->kategori_model->getDataKategori();
		$this->load->view('kategori',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('kategori_model');	
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_kategori_view');

		}
		else
		{
			$this->kategori_model->insertKategori();
			$data["kategori_list"] = $this->kategori_model->getDataKategori();	
			$this->load->view('kategori', $data);
		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('kategori_model');
		$data['kategori']=$this->kategori_model->getKategori($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_kategori_view',$data);

		}else{
			$this->kategori_model->updateById($id);
			$this->load->view('edit_kategori_sukses');

		}
	}

	public function datatable()
	{
		$this->load->model('kategori_model');
		$data["kategori_list"] = $this->kategori_model->getDataKategori();
		$this->load->view('kategori_datatables', $data);
	}

	public function delete($id)
	{
		$this->load->model('kategori_model');
		$this->kategori_model->deleteKategori($id);
		$data['kategori_list']=$this->kategori_model->getDataKategori();
		$this->load->view('kategori',$data);
	}
}


 ?>