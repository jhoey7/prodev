<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Project extends CI_Controller {
	var $content = "";
	var $bradcrumb = "";
		
	public function __construct() {        
	    parent::__construct();
		$this->load->model('project_act','model');
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
		$this->bradcrumb = '<li><a href="'.site_url().'/project/daftar"><i class="fa fa-bar-chart-o"></i> Daftar Proyek</a></li>';
		$this->content = $this->load->view('project/daftar','',true);
		$this->index();
	}
	
	function loadData($tipe,$id=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=="post"){
			$list = $this->model->get_datatables($tipe,$this->azdgcrypt->decrypt($id));
			$data = array();
			$no = 0;
			if($tipe=="header"){
				foreach ($list as $header) {
					$status = round(((int)$header->jum_proyek_end * 100) / (int)$header->jum_dtl_proyek);
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $header->nama_proyek;
					$row[] = $header->tgl_awal_proyek;
					$row[] = $header->tgl_akhir_proyek;
					$row[] = $header->deskripsi_proyek;
					/*$row[] = $header->status_proyek;*/
					$row[] = $header->nama_klien;
					$row[] = $header->nama_karyawan;
					$row[] = "<div class=\"progress-list\"><div class=\"status pull-right\"><span class=\"animate-number\" data-value=\"".$status."\" data-animation-duration=\"1500\">".$status."</span>%</div><div class=\"clearfix\"></div><div class=\"progress progress-little no-radius\"><div class=\"progress-bar progress-bar-orange animate-progress-bar\" data-percentage=\"".$status."%\" style=\"width: ".$status."%;\"></div></div></idv>";
					if($this->newsession->userdata("IDJABATAN")==3){
						$row[] = "<a href=\"javascript:void(0);\" class=\"btn btn-success btn-sm\" title=\"Edit\" onclick=\"editHeader('".$this->azdgcrypt->crypt($header->id_proyek)."')\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" onclick=\"deleteData('".$this->azdgcrypt->crypt($header->id_proyek)."','project/setData/header','header','tableProject')\" class=\"btn btn-danger btn-sm\" title=\"Delete\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" class=\"btn btn-info btn-sm\" title=\"View\" onclick=\"actionProject('view','".$this->azdgcrypt->crypt($header->id_proyek)."')\"><i class=\"fa fa-arrow-circle-right\" aria-hidden=\"true\"></i></a>";
					}else{
						$row[] = "<a href=\"javascript:void(0);\" class=\"btn btn-info btn-sm\" title=\"View\" onclick=\"actionProject('view','".$header->id_proyek."')\"><i class=\"fa fa-arrow-circle-right\" aria-hidden=\"true\"></i></a>";
					}
		 
					$data[] = $row;
				}
			}
			elseif($tipe=="task")
			{
				$status = "";
				foreach ($list as $task) {
					if($task->status_pekerjaan > 0 ){
						$status = "<div class=\"progress-list\"><div class=\"status pull-right\"><span class=\"animate-number\" data-value=\"".$task->status_pekerjaan."\" data-animation-duration=\"1500\">".$task->status_pekerjaan."</span>%</div><div class=\"clearfix\"></div><div class=\"progress progress-little no-radius\"><div class=\"progress-bar progress-bar-orange animate-progress-bar\" data-percentage=\"".$task->status_pekerjaan."%\" style=\"width: ".$task->status_pekerjaan."%;\"></div></div></idv>";
					}else{
						$status = "<div class=\"progress-list\"><div class=\"status pull-right\"><span class=\"animate-number\" data-value=\"0\" data-animation-duration=\"1500\">0</span>%</div><div class=\"clearfix\"></div><div class=\"progress progress-little no-radius\"><div class=\"progress-bar progress-bar-orange animate-progress-bar\" data-percentage=\"0%\" style=\"width: 0%;\"></div></div></idv>";
					}
					
					if($task->nama_karyawan != ""){
						$pic = $task->nama_karyawan;
					}else{
						$pic = "<a href=\"javascript:void(0);\" onclick=\"pilihPIC('".$this->azdgcrypt->crypt($task->id_pekerjaan)."','".$this->azdgcrypt->crypt($task->id_proyek)."','".$this->azdgcrypt->crypt($task->thpKerja)."')\" class=\"btn btn-info btn-sm\" title=\"Pilih PIC\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i></a>";
					}
					
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $task->deskripsi_pekerjaan;
					$row[] = $task->bobot_pekerjaan;
					$row[] = $task->tgl_awal;
					$row[] = $task->tgl_akhir;
					$row[] = $pic;
					$row[] = $task->tahap_pekerjaan;
					$row[] = $status;
					if($this->newsession->userdata("IDJABATAN")==3){
						$row[] = $task->flag_telat;
					}
					if($this->newsession->userdata("IDJABATAN")==3){
						if($task->nama_karyawan==""){
							$row[] = "<a href=\"javascript:void(0);\" onclick=\"showFromTask('update','".$this->azdgcrypt->crypt($task->id_pekerjaan)."')\" class=\"btn btn-success btn-sm\" title=\"Update\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" onclick=\"deleteData('".$this->azdgcrypt->crypt($task->id_pekerjaan)."|".$this->azdgcrypt->crypt($task->id_proyek)."','project/setData/task','task','tableTask')\" class=\"btn btn-danger btn-sm\" title=\"Delete\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>";
						}else{
							$row[] = "<a href=\"javascript:void(0);\" onclick=\"showFromTask('update','".$this->azdgcrypt->crypt($task->id_pekerjaan)."')\" class=\"btn btn-success btn-sm\" title=\"Update\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" onclick=\"deleteData('".$this->azdgcrypt->crypt($task->id_pekerjaan)."|".$this->azdgcrypt->crypt($task->id_proyek)."','project/setData/task','task','tableTask')\" class=\"btn btn-danger btn-sm\" title=\"Delete\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" onclick=\"addSubPekerjaan('".$this->azdgcrypt->crypt($task->id_pekerjaan)."','".$this->azdgcrypt->crypt($task->id_proyek)."')\" class=\"btn btn-info btn-sm\" title=\"Sub Pekerjaan\"><i class=\"fa fa-edit\" aria-hidden=\"true\"></i></a>";
						}
					}else{
						if($task->id_karyawan == $this->newsession->userdata('ID_KARYAWAN') && $task->status_pekerjaan < 100){
							$row[] = "<a href=\"javascript:void(0);\" onclick=\"addSubPekerjaan('".$task->id_pekerjaan."','".$task->id_proyek."')\" class=\"btn btn-warning btn-sm\" title=\"Update Pekerjaan\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i></a>";
						}else{
							$row[] = "&nbsp;";
						}
					}
		 
					$data[] = $row;
				}
			}elseif($tipe=="sub_pekerjaan"){
				foreach ($list as $sub) {
					$status = "<span class=\"label label-success\">Selesai</span>";
					if($sub->status_sub_pekerjaan==0){
						$status = "<span class=\"label label-danger\">Belum Selesai</span>";
					}
					$no++;
					$row = array();
					$row[] = $no;
					$row[] = $sub->nama_sub_pekerjaan;
					$row[] = $sub->deskripsi_sub_pekerjaan;
					$row[] = $status;
					if($this->newsession->userdata("IDJABATAN")==3){
						$row[] = "<a href=\"javascript:void(0);\" class=\"btn btn-success btn-sm\" title=\"Edit\" onclick=\"editSubPekerjaan('".$this->azdgcrypt->crypt($sub->id_sub_pekerjaan)."')\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a>&nbsp;<a href=\"javascript:void(0);\" onclick=\"deleteData('".$this->azdgcrypt->crypt($sub->id_sub_pekerjaan)."|".$this->azdgcrypt->crypt($sub->id_pekerjaan)."','project/setData/sub_pekerjaan','sub-pekerjaan','tableSubPekerjaan')\" class=\"btn btn-danger btn-sm\" title=\"Delete\"><i class=\"fa fa-trash-o\" aria-hidden=\"true\"></i></a>";
					}else{
						if($sub->status_sub_pekerjaan == 0){
							$row[] = '<ul class="nolisttypes" id="todolist"><li><div class="checkbox check-cyan"><input type="checkbox" value="'.$sub->id_sub_pekerjaan.'" id="todo-'.$sub->id_sub_pekerjaan.'" name="SUB[ID_SUB_PEKERJAAN][]"><label for="todo-'.$sub->id_sub_pekerjaan.'">&nbsp;</label></div></li></ul>';
						}else{
							$row[] = '<ul class="nolisttypes" id="todolist"><li><div class="checkbox check-cyan"><input type="checkbox" value="'.$sub->id_sub_pekerjaan.'" id="todo-'.$sub->id_sub_pekerjaan.'" name="SUB[ID_SUB_PEKERJAAN][]" checked="checked" disabled><label for="todo-'.$sub->id_sub_pekerjaan.'">&nbsp;</label></div></li></ul>';
						}
					}
		 
					$data[] = $row;
				}
			}
			
			$output = array("data" => $data);
			echo json_encode($output);
		}
	}
	
	function view($id){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$this->bradcrumb = '<li><a href="'.site_url().'/project/daftar"><i class="fa fa-bar-chart-o"></i> PEKERJAAN</a></li>';
		$arrdata = $this->model->getHeader($this->azdgcrypt->decrypt($id));
		$this->content = $this->load->view('project/view',$arrdata,true);
		$this->index();
	}
	
	function getKaryawan($id){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$arrdata = $this->model->getKaryawan($id);
		echo json_encode($arrdata);
	}
	
	function create(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$this->bradcrumb = '<li><a href="'.site_url().'/project/create"><i class="fa fa-plus"></i> Tambah Proyek</a></li>';
		$arrdata 		 = $this->model->getData();
		$this->content 	 = $this->load->view('project/create',$arrdata,true);
		$this->index();
	}
	
	function edit($id){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$this->bradcrumb = '<li><a href="'.site_url().'/project/create"><i class="fa fa-plus"></i> Create Project</a></li>';
		$arrdata 		 = $this->model->getData($this->azdgcrypt->decrypt($id));
		$this->content 	 = $this->load->view('project/create',$arrdata,true);
		$this->index();
	}
	
	function setData($tipe){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=='post'){
			$arrdata = $this->model->setData($tipe);
			echo json_encode($arrdata);
		}
	}
	
	function getTask($id,$idDetil=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$arrdata = $this->model->getAnggota($this->azdgcrypt->decrypt($id),$this->azdgcrypt->decrypt($idDetil));
		echo json_encode($arrdata);
	}
	
	function updateTask(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		$arrdata = $this->model->getTask();
		echo $this->load->view('project/task',$arrdata,true);
	}
	
	function pic($idPekerjaan,$idProyek,$thpPekerjaan){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])!='post'){
			$arrdata = $this->model->getTask($this->azdgcrypt->decrypt($idPekerjaan));
			$arrdata['idPekerjaan'] = $this->azdgcrypt->decrypt($idPekerjaan);
			$arrdata['idProyek'] = $this->azdgcrypt->decrypt($idProyek);
			$arrdata['thpPekerjaan'] = $this->azdgcrypt->decrypt($thpPekerjaan);
			echo $this->load->view('project/pic',$arrdata,true);
		}else{
			$list = $this->model->get_datatables('pic',$this->azdgcrypt->decrypt($idProyek));
			$data = array();
			foreach ($list as $pic) {
				$round = round($pic->total_bobot / $pic->total_task);
				if($round == 0){
					$bobot_pekerjaan = "Idle";
				}elseif($round == 1){
					$bobot_pekerjaan = "Low";
				}elseif($round == 2){
					$bobot_pekerjaan = "Medium";
				}elseif($round == 3){
					$bobot_pekerjaan = "High";
				}
				$row = array();
				$row[] = '<div class="radio">
                            <input type="radio" name="PIC" id="PIC_'.$pic->id_karyawan.'" value="'.$this->azdgcrypt->crypt($pic->id_karyawan).'" class="radio">
                            <label for="PIC_'.$pic->id_karyawan.'">&nbsp;</label>
                          </div>';
				$row[] = $pic->nama_karyawan;
				$row[] = $pic->nama_jabatan;
				$row[] = $bobot_pekerjaan;
				
				$data[] = $row;
			}
			$output = array("data" => $data);
			echo json_encode($output);
		}
	}
	
	function sub_pekerjaan($idPekerjaan,$idProyek,$idSub=FALSE){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])!='post'){
			$idSub = $this->azdgcrypt->decrypt($idSub);
			$arrdata = $this->model->getSubPekerjaan($this->azdgcrypt->decrypt($idPekerjaan),$this->azdgcrypt->decrypt($idProyek),$idSub);
			if($idSub){
				$arrdata['action'] 	= 'update';
				echo json_encode($arrdata);
			}else{
				$arrdata['action'] 		= 'save';
				$arrdata['idPekerjaan'] = $this->azdgcrypt->decrypt($idPekerjaan);
				$arrdata['idProyek'] 	= $this->azdgcrypt->decrypt($idProyek);
				echo $this->load->view('project/sub_pekerjaan',$arrdata,true);
			}
		}else{
			$list = $this->model->get_datatables('pic',$idProyek);
			$data = array();
			foreach ($list as $pic) {
				$row = array();
				$row[] = '<div class="radio">
                            <input type="radio" name="PIC" id="PIC_'.$pic->id_karyawan.'" value="'.$pic->id_karyawan.'" class="radio">
                            <label for="PIC_'.$pic->id_karyawan.'">&nbsp;</label>
                          </div>';
				$row[] = $pic->nama_karyawan;
				$row[] = $pic->nama_jabatan;
				$row[] = $pic->status;
				
				$data[] = $row;
			}
			$output = array("data" => $data);
			echo json_encode($output);
		}
	}
}
?>