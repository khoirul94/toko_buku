<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('BukuModel'); //load buku model ke controler ini
	}

	public function index()
	{
		$data ['buku'] = $this->BukuModel->view();

		$this->load->view('home', $data);
	}
}
