<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {
	var $content = "";
	var $bradcrumb = "";
		
	public function __construct() {        
	    parent::__construct();
		$this->load->model('search_act','model');
		$this->load->model('dashboard_act','dashboard');
	}

	function index($dok = ""){
		if($this->newsession->userdata('LOGGED')){
			if($this->content == "") {
				$arrdata = $this->dashboard->getDashboard();
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
	
	function get_search(){
		$arrdata['tipe'] = $this->input->post('tipe');
		$arrdata['id'] 	 = $this->input->post('id');
		echo $this->load->view("search", $arrdata, true);
	}
	
	function loadData($tipe,$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post"){
			$list = $this->model->get_datatables($tipe,$id);
			$data = array();
			$no = 0;
			foreach ($list as $header) {
				$no++;
				$row = array();
				$row[] = $no;
				if($tipe=="monitoring"){
					$row[] = $header->nama_proyek;
					$row[] = $header->tanggal_awal_proyek;
					$row[] = $header->tanggal_akhir_proyek;
					$row[] = $header->status_proyek;
					$key = $header->id_proyek."|".$header->nama_proyek;
				}elseif($tipe=="karyawan"){
					$row[] = $header->nama_karyawan;
					$row[] = $header->nama_divisi;
					$row[] = $header->nama_jabatan;
					$key = $header->id_karyawan."|".$header->nama_karyawan;
				}elseif($tipe=="proyek"){
					$row[] = $header->nama_proyek;
					$row[] = $header->nama_klien;
					$key = $header->id_proyek."|".$header->nama_proyek."|".$header->nama_klien;
				}
				$row[] = "<a href=\"javascript:void(0);\" class=\"btn btn-info btn-sm\" title=\"Pilih\" onclick=\"td_pilih('".$tipe."','".$key."','".$id."')\"><i class=\"fa fa-check-circle-o\" aria-hidden=\"true\"></i>&nbsp;Pilih</a>";		 
				$data[] = $row;
			}
			
			$output = array("data" => $data);
			echo json_encode($output);
		}
	}
}
?>