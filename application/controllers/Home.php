<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
	var $content = "";
	var $bradcrumb = "";
		
	public function __construct() {        
	    parent::__construct();
		$this->load->model('dashboard_act','model');
	}

	function index($dok = ""){
		if($this->newsession->userdata('LOGGED')){
			if($this->content == "") {
				$arrdata = $this->model->getDashboard();
				$this->content = $this->load->view('welcome', $arrdata, true);
			}
			$crumb = '<li><a href="'.base_url().'"><i class="fa fa-home"></i> Home</a></li><li><a href="'.base_url().'">Dashboard</a></li>';
			$data = array(
							'_bradcrumb_'	=> $crumb,
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
	
	function getTask(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post"){
			$list = $this->model->get_datatables();
			$data = array();
			$no = 0;
			foreach ($list as $header) {
				if($this->newsession->userdata("IDJABATAN")==3){
					if($header->status_proyek=="Done"){
						$status = '<span class="label label-success">'.$header->status_proyek.'</span>';
					}else{
						$status = '<span class="label label-danger">'.$header->status_proyek.'</span>';
					}
				}else{
					if($header->status_pekerjaan >0){
						$status = "<div class=\"progress-list\"><div class=\"status pull-right\"><span class=\"animate-number\" data-value=\"".$header->status_pekerjaan."\" data-animation-duration=\"1500\">".$header->status_pekerjaan."</span>%</div><div class=\"clearfix\"></div><div class=\"progress progress-little no-radius\"><div class=\"progress-bar progress-bar-orange animate-progress-bar\" data-percentage=\"".$header->status_pekerjaan."%\" style=\"width: ".$header->status_pekerjaan."%;\"></div></div></idv>";
					}else{
						$status = "<div class=\"progress-list\"><div class=\"status pull-right\"><span class=\"animate-number\" data-value=\"0\" data-animation-duration=\"1500\">0</span>%</div><div class=\"clearfix\"></div><div class=\"progress progress-little no-radius\"><div class=\"progress-bar progress-bar-orange animate-progress-bar\" data-percentage=\"0%\" style=\"width: 0%;\"></div></div></idv>";
					}
				}
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $header->nama_proyek;
				$row[] = $header->nama_klien;
				if($this->newsession->userdata('IDJABATAN')!=3){
					$row[] = $header->deskripsi_pekerjaan;
				}
				$row[] = $status;
				$row[] = $header->tanggal_akhir_pekerjaan;
				$row[] = $header->tanggal_update_pekerjaan;
	 
				$data[] = $row;
			}
			$output = array("data" => $data);
			echo json_encode($output);
		}
	}
}
?>