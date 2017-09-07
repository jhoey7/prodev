<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Penilaian extends CI_Controller {
	var $content = "";
	var $bradcrumb = "";
		
	public function __construct() {        
	    parent::__construct();
		$this->load->model('penilaian_act','model');
	}

	function index(){
		if($this->newsession->userdata('LOGGED')){
			if($this->content == "") {
				$this->content = $this->load->view('welcome', '', true);
			}
			$data = array(
							'_bradcrumb_'	=> $this->bradcrumb,
							'_content_' 	=> $this->content,
						  	'_welcome_' 	=> $this->newsession->userdata('NAMA'),
						  	'_role_' 		=> $this->newsession->userdata('JABATAN'),
						  	'_header_' 		=> $this->load->view('partials/header','',true)
			);
			$this->parser->parse('partials/mainpage', $data);
		}else{
			$this->newsession->sess_destroy();
			$this->load->view('login');
		}
	}
	
	function daftar(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$this->bradcrumb = '<li><a href="'.site_url().'/penilaian/daftar"><i class="fa fa-line-chart"></i> Daftar Karyawan Yang Belum Dinilai</a></li>';
		$this->content = $this->load->view('penilaian/daftar','',true);
		$this->index();
	}
	
	function loadData(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post"){
			$list = $this->model->get_datatables();
			$data = array();
			$no = 0;
			foreach ($list as $header) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $header->nama_proyek;
				$row[] = $header->nama_klien;
				$row[] = $header->nama_karyawan;
				$row[] = '<span class="label label-info">'.$header->jum_task.'</span>';
				$row[] = '<span class="label label-success">'.$header->jum_ontarget.'</span>';
				$row[] = '<span class="label label-danger">'.$header->jum_offtarget.'</span>';
				$row[] = "<a href=\"javascript:void(0);\" class=\"btn btn-info btn-sm\" title=\"View\" onclick=\"nilai('".$header->id_proyek."','".$header->id_karyawan."')\"><i class=\"fa fa-arrow-circle-right\" aria-hidden=\"true\"></i></a>";
	 
				$data[] = $row;
			}
			$output = array("data" => $data);
			echo json_encode($output);
		}
	}
	
	function nilai(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$idProyek 	= $this->input->post('id_proyek');
		$idKaryawan = $this->input->post('id_karyawan');
		
		$nilai 		= $this->model->getNilai($idProyek,$idKaryawan);
		$onTime 	= $nilai['jum_ontarget'] * (100 / $nilai['jum_dtl_proyek']);
		$offTime 	= ($nilai['jum_offtarget'] * (100 / $nilai['jum_dtl_proyek'])) * 50/100;
		
		$arrdata['nilai_pekerjaan'] = $onTime + $offTime;
		$arrdata['id_proyek'] 		= $idProyek;
		$arrdata['id_karyawan'] 	= $idKaryawan;
		echo $this->load->view('penilaian/form-nilai',$arrdata,true);
	}
	
	function setData(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=='post'){
			$arrdata = $this->model->setData();
			echo json_encode($arrdata);
		}
	}
}
?>