<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function index()
	{
		$this->load->model('barang_model');
		$data["barang_list"] = $this->barang_model->getDataBarang();
		$this->load->view('barang',$data);	
	}

	public function create()
	{
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('barang_model');	
		$data["kategori_list"] = $this->barang_model->getDataKategori();
		if($this->form_validation->run()==FALSE){

			$this->load->view('tambah_barang_view',$data);

		}
		else
		{
			$config['upload_path']		='./assets/uploads';
			$config['allowed_types']	='gif|jpg|png';
			$config['max_size']			= 1000000000;
			$config['max_width']		= 10240;
			$config['max_height']		= 7680;
			$this->load->library('upload', $config);
			if (! $this->upload->do_upload('userfile')) 
			{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('tambah_barang_view', $error);
			}
			else
			{
				$this->barang_model->insertBarang();
				$this->load->view('tambah_barang_sukses', $data);
			}
		}
	}
	//method update butuh parameter id berapa yang akan di update
	public function update($id)
	{
		//load library
		$this->load->helper('url','form');	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->load->model('barang_model');
		
		$data["kategori_list"] = $this->barang_model->getDataKategori();
		$data['barang']=$this->barang_model->getBarang($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_barang_view',$data);

		}else{
			$this->barang_model->updateById($id);
			$this->load->view('edit_barang_sukses');

		}
	}

	public function datatable()
	{
		$this->load->model('barang_model');
		$data["barang_list"] = $this->barang_model->getDataBarang();
		$this->load->view('barang_datatables', $data);
	}

	public function delete($id)
	{
		$this->load->model('barang_model');
		$this->barang_model->deleteBarang($id);
		$data['barang_list']=$this->barang_model->getDataBarang();
		$this->load->view('barang',$data);
	}
}


 ?>