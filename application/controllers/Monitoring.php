<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Monitoring extends CI_Controller {
	var $content = "";
	var $bradcrumb = "";
		
	public function __construct() {        
	    parent::__construct();
		$this->load->model('monitoring_act','model');
	}

	function index($dok = ""){
		if($this->newsession->userdata('LOGGED')){
			if($this->content == "") {
				$this->load->model('dashboard_act');
				$arrdata = $this->dashboard_act->getDashboard();
				$this->content = $this->load->view('welcome', $arrdata, true);
			}
			$crumb = '<li><a href="'.base_url().'"><i class="fa fa-home"></i> Home</a></li><li><a href="'.base_url().'">Dashboard</a></li>';
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
	
	function view(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$this->bradcrumb = '<li><a href="'.site_url().'/monitoring/view"><i class="fa fa-eye"></i> Monitoring Proyek</a></li>';
		$this->content = $this->load->view('monitoring/view', '', true);
		$this->index();
	}
	
	function getData(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post"){
			$arrdata = $this->model->getData();
			$arrdata['id_proyek'] = $this->input->post('id_proyek');
			echo $this->load->view('monitoring/hasil', $arrdata, true);
		}
	}
	
	function getJson($id){
		$arrdata = $this->model->getTask($this->azdgcrypt->decrypt($id));
		$data = array();
		$no = 1;
		foreach($arrdata as $list){
			$row = array();
			
			if($no==1){
				$row['name'] = $list->nama_proyek;
			}else{
				$row['name'] = "";
			}
			
			if($no%2==0){
				$list->customClass = "ganttOrange";
			}elseif($no%3==0){
				$list->customClass = "ganttBlue";
			}else{
				$list->customClass = "ganttRed";
			}
			
			$row['desc'] = $list->deskripsi_pekerjaan;
			$row['values'] = array(
									array(
											"from"			=> $list->tanggal_awal_pekerjaan,
											"to"			=> $list->tanggal_akhir_pekerjaan,
											"label"			=> $list->deskripsi_pekerjaan,
											"desc"			=> $list->nama_karyawan,
											"customClass" 	=> $list->customClass
									)
							  );
			
			$data[] = $row;
			$no++;
		}
		echo json_encode($data);
	}
	
	function getTable($id){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post"){
			$list = $this->model->get_datatables($this->azdgcrypt->decrypt($id));
			$data = array();
			$no = 0;
			foreach ($list as $table) {
				if($table->status_pekerjaan >0){
					$status = "<div class=\"progress-list\"><div class=\"status pull-right\"><span class=\"animate-number\" data-value=\"".$table->status_pekerjaan."\" data-animation-duration=\"1500\">".$table->status_pekerjaan."</span>%</div><div class=\"clearfix\"></div><div class=\"progress progress-little no-radius\"><div class=\"progress-bar progress-bar-orange animate-progress-bar\" data-percentage=\"".$table->status_pekerjaan."%\" style=\"width: ".$table->status_pekerjaan."%;\"></div></div></idv>";
				}else{
					$status = "<div class=\"progress-list\"><div class=\"status pull-right\"><span class=\"animate-number\" data-value=\"0\" data-animation-duration=\"1500\">0</span>%</div><div class=\"clearfix\"></div><div class=\"progress progress-little no-radius\"><div class=\"progress-bar progress-bar-orange animate-progress-bar\" data-percentage=\"0%\" style=\"width: 0%;\"></div></div></idv>";
				}
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $table->nama_proyek;
				$row[] = $table->nama_klien;
				$row[] = $table->nama_karyawan;
				$row[] = $table->deskripsi_pekerjaan;
				$row[] = $status;
				$row[] = $table->tanggal_akhir_pekerjaan;
				$row[] = $table->tanggal_update_pekerjaan;
	 
				$data[] = $row;
			}
			$output = array("data" => $data);
			echo json_encode($output);
		}
	}
}
?>