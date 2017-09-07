<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	var $content = "";
	var $bradcrumb = "";
		
	public function __construct() {        
	    parent::__construct();
		$this->load->model('user_act','model');
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
	
	function login($sessid="", $isajax=""){
		error_reporting(E_ALL ^ E_NOTICE);
		if(strtolower($_SERVER['REQUEST_METHOD'])!="post"){
			echo "2|Login gagal, mohon coba lagi";
			exit();
		}else{
			$uid = $this->input->post('username');
			$pwd = $this->input->post('password');
			$this->load->model('user_act');
			$hasil = $this->user_act->login($uid, $pwd);
			if($hasil=="1"){
				echo "1|Login Berhasil. Please Wait....";
				exit();
			}elseif($hasil == "2") {
				echo "2|Password Anda salah.";
				exit();
			}else{ 
				echo "0|Username Anda tidak terdaftar/salah.";
				exit();
			}	
		}
	}
	
	function profile(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=='post'){
			$arrdata = $this->model->setData('profile');
			echo json_encode($arrdata);
		}else{
			$this->bradcrumb = '<li><a href="'.site_url().'/user/profile"><i class="fa fa-user"></i> User Profile</a></li>';
			$this->content = $this->load->view('user/profile','',true);
			$this->index();
		}
	}
	
	function reset_password(){
		if(!$this->newsession->userdata('LOGGED')){
			$this->index();
			return;
		}
		if(strtolower($_SERVER['REQUEST_METHOD'])=='post'){
			$arrdata = $this->model->setData('reset_password');
			echo json_encode($arrdata);
		}else{
			$this->bradcrumb = '<li><a href="'.site_url().'/user/reset_password"><i class="fa fa-key"></i> Reset Password</a></li>';
			$this->content = $this->load->view('user/reset','',true);
			$this->index();
		}
	}
	
	function logout(){
		$this->newsession->sess_destroy();		
		redirect(base_url());
	}
}
?>