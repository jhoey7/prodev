<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Master extends CI_Controller {
	var $content = "";
	var $bradcrumb = "";
		
	public function __construct() {        
	    parent::__construct();
		$this->load->model('master_act','model');
	}

	function index(){
		if($this->newsession->userdata('LOGGED')){
			if($this->newsession->userdata('IDJABATAN')==6){
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
				redirect(base_url());
			}
		}else{
			$this->newsession->sess_destroy();
			$this->load->view('login');
		}
	}
	
	function jabatan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER["REQUEST_METHOD"])=="post"){
			$list = $this->model->get_datatables('jabatan');
			$data = array();
			$no = 0;
			foreach ($list as $jabatan) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $jabatan->nama_jabatan;
				$row[] = $jabatan->deskripsi_jabatan;
				$row[] = "<a href=\"javascript:void(0);\" class=\"btn btn-success btn-sm\" title=\"Edit\" onclick=\"showFormJabatan('update','".$this->azdgcrypt->crypt($jabatan->id_jabatan)."')\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" onclick=\"deleteData('".$this->azdgcrypt->crypt($jabatan->id_jabatan)."','master/setData','jabatan','tabelJabatan')\" class=\"btn btn-danger btn-sm\" title=\"Delete\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>";
	 
				$data[] = $row;
			}
			
			$output = array("data" => $data);
			echo json_encode($output);
		}else{
			$this->bradcrumb = '<li><a href="'.site_url().'/master/jabatan"><i class="fa fa-address-card-o"></i> Master</a></li><li><a href="'.site_url().'/master/jabatan">Daftar Jabatan</a></li>';
			$this->content = $this->load->view('master/jabatan','',true);
			$this->index();
		}
	}
	
	function divisi(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER["REQUEST_METHOD"])=="post"){
			$list = $this->model->get_datatables('divisi');
			$data = array();
			$no = 0;
			foreach ($list as $divisi) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $divisi->nama_divisi;
				$row[] = $divisi->deskripsi_divisi;
				$row[] = "<a href=\"javascript:void(0);\" class=\"btn btn-success btn-sm\" title=\"Edit\" onclick=\"showFormDivisi('update','".$this->azdgcrypt->crypt($divisi->id_divisi)."')\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" onclick=\"deleteData('".$this->azdgcrypt->crypt($divisi->id_divisi)."','master/setData','divisi','tabelDivisi')\" class=\"btn btn-danger btn-sm\" title=\"Delete\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>";
	 
				$data[] = $row;
			}
			
			$output = array("data" => $data);
			echo json_encode($output);
		}else{
			$this->bradcrumb = '<li><a href="'.site_url().'/master/divisi"><i class="fa fa-address-card-o"></i> Master</a></li><li><a href="'.site_url().'/master/divisi">Daftar Divisi</a></li>';
			$this->content = $this->load->view('master/divisi','',true);
			$this->index();
		}
	}
	
	function klien(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER["REQUEST_METHOD"])=="post"){
			$list = $this->model->get_datatables('klien');
			$data = array();
			$no = 0;
			foreach ($list as $klien) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $klien->nama_klien;
				$row[] = $klien->deskripsi_klien;
				$row[] = $klien->status;
				$row[] = "<a href=\"javascript:void(0);\" class=\"btn btn-success btn-sm\" title=\"Edit\" onclick=\"showFormKlien('update','".$this->azdgcrypt->crypt($klien->id_klien)."')\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" onclick=\"deleteData('".$this->azdgcrypt->crypt($klien->id_klien)."','master/setData','klien','tabelKlien')\" class=\"btn btn-danger btn-sm\" title=\"Delete\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>";
	 
				$data[] = $row;
			}
			
			$output = array("data" => $data);
			echo json_encode($output);
		}else{
			$this->bradcrumb = '<li><a href="'.site_url().'/master/klien"><i class="fa fa-handshake-o"></i> Master</a></li><li><a href="'.site_url().'/master/klien">Daftar Klien</a></li>';
			$this->content = $this->load->view('master/klien','',true);
			$this->index();
		}
	}
	
	function karyawan(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER["REQUEST_METHOD"])=="post"){
			$list = $this->model->get_datatables('karyawan');
			$data = array();
			$no = 0;
			foreach ($list as $karyawan) {
				$no++;
				$row = array();
				$row[] = $no;
				$row[] = $karyawan->username;
				$row[] = $karyawan->nama_karyawan;
				$row[] = $karyawan->alamat_karyawan;
				$row[] = $karyawan->no_hp_karyawan;
				$row[] = $karyawan->email_karyawan;
				$row[] = $karyawan->nama_divisi;
				$row[] = $karyawan->nama_jabatan;
				$row[] = "<a href=\"javascript:void(0);\" class=\"btn btn-success btn-sm\" title=\"Edit\" onclick=\"showFormKaryawan('update','".$karyawan->id_karyawan."')\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" onclick=\"deleteData('".$karyawan->id_karyawan."','karyawan/setData','karyawan','tabelKaryawan')\" class=\"btn btn-danger btn-sm\" title=\"Delete\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>";
	 
				$data[] = $row;
			}
			
			$output = array("data" => $data);
			echo json_encode($output);
		}else{
			$this->bradcrumb = '<li><a href="'.site_url().'/master/karyawan"><i class="fa fa-user"></i> Master</a></li><li><a href="'.site_url().'/master/karyawan">Daftar Karyawan</a></li>';
			$this->content = $this->load->view('master/karyawan','',true);
			$this->index();
		}
	}
	
	function getData($tipe){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$arrdata = $this->model->getData($tipe);
		echo json_encode($arrdata);
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
	
	function testEmail(){
		$this->load->model("main");
		$data = $this->main->sendMail();
		if($data){
			echo "berhasil";
		}else{
			echo "gagal";
		}
	}
}
?>