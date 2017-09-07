<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller {
	var $content = "";
	var $bradcrumb = "";
		
	public function __construct() {        
	    parent::__construct();
		$this->load->model('report_act','model');
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
	
	function penilaian($jenis=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtoupper($_SERVER['REQUEST_METHOD'])=="POST"){
			$arrdata['tipe'] = 'penilaian';
			$arrdata['data'] = $this->model->getData('penilaian');
			if($jenis=="pdf"){
				ini_set('memory_limit','-1');
				set_time_limit(0); 
				$arrdata['cetak'] = 'pdf';
				$html = $this->load->view('report/cetak', $arrdata, true);
				$this->load->library('mpdf');
				$this->mpdf=new mPDF('UTF-8','A4-L','','',8,8,35,25,10,13,'L');
				$this->mpdf->ignore_invalid_utf8 = true; 
				$this->mpdf->useOnlyCoreFonts = true;
				$this->mpdf->SetProtection(array('print'));
				$this->mpdf->SetAuthor("terry");
				$this->mpdf->SetCreator("terry");
				$this->mpdf->list_indent_first_level = 0; 
				$this->mpdf->SetDisplayMode('fullpage');
				$this->mpdf->AliasNbPages('[pagetotal]');
				$stylesheet = file_get_contents('assets/css/laporan.css');		
				$this->mpdf->SetHTMLHeader('<div>LAPORAN PENILAIAN
					<br />NAMA KARYAWAN : '.$this->input->post('nama_karyawan').'<br />
					PERIODE : '.$this->input->post('periode').'<br />
					</div><div align="right">Halaman {PAGENO} dari [pagetotal]</div>','0',true);
				$this->mpdf->SetHTMLFooter('<div align="right">Tgl.Cetak {DATE d-m-Y H:i:s}</div>','0',true);
				$this->mpdf->WriteHTML($stylesheet,1);
				$this->mpdf->WriteHTML($html,2);
				$this->mpdf->Output();		
				exit();
			}else{
				echo $this->load->view('report/view',$arrdata,true);
			}
		}else{
			$this->bradcrumb = '<li><a href="'.site_url().'/report/penilaian"><i class="fa fa-bar-chart-o"></i> Report Penilaian</a></li>';
			$this->content = $this->load->view('report/penilaian','',true);
			$this->index();
		}
	}
	
	function pekerjaan($jenis=""){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtoupper($_SERVER['REQUEST_METHOD'])=="POST"){
			$arrdata['tipe'] = 'pekerjaan';
			$arrdata['data'] = $this->model->getData('pekerjaan');
			if($jenis=="pdf"){
				ini_set('memory_limit','-1');
				set_time_limit(0); 
				$arrdata['cetak'] = 'pdf';
				$html = $this->load->view('report/cetak', $arrdata, true);
				$this->load->library('mpdf');
				$this->mpdf=new mPDF('UTF-8','A4-L','','',8,8,35,25,10,13,'L');
				$this->mpdf->ignore_invalid_utf8 = true; 
				$this->mpdf->useOnlyCoreFonts = true;
				$this->mpdf->SetProtection(array('print'));
				$this->mpdf->SetAuthor("terry");
				$this->mpdf->SetCreator("terry");
				$this->mpdf->list_indent_first_level = 0; 
				$this->mpdf->SetDisplayMode('fullpage');
				$this->mpdf->AliasNbPages('[pagetotal]');
				$stylesheet = file_get_contents('assets/css/laporan.css');		
				$this->mpdf->SetHTMLHeader('<div>LAPORAN PEKERJAAN
					<br />NAMA PROYEK : '.$this->input->post('nama_proyek').'<br />
					NAMA KLIEN : '.$this->input->post('nama_klien').'<br />
					</div><div align="right">Halaman {PAGENO} dari [pagetotal]</div>','0',true);
				$this->mpdf->SetHTMLFooter('<div align="right">Tgl.Cetak {DATE d-m-Y H:i:s}</div>','0',true);
				$this->mpdf->WriteHTML($stylesheet,1);
				$this->mpdf->WriteHTML($html,2);
				$this->mpdf->Output();		
				exit();
			}else{
				echo $this->load->view('report/view',$arrdata,true);
			}
		}else{
			$this->bradcrumb = '<li><a href="'.site_url().'/report/pekerjaan"><i class="fa fa-bar-chart-o"></i> Report Pekerjaan</a></li>';
			$this->content = $this->load->view('report/pekerjaan','',true);
			$this->index();
		}
	}
}
?>