<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class User_act extends CI_Model
{
	function login($uid_, $pwd_, $adm=FALSE){
		$query="SELECT a.id_karyawan, a.nama_karyawan, a.alamat_karyawan, a.no_hp_karyawan, a.email_karyawan,
				b.nama_jabatan, c.nama_divisi, b.id_jabatan, c.id_divisi, a.password
				FROM karyawan a LEFT JOIN jabatan b ON a.id_jabatan = b.id_jabatan
				LEFT JOIN divisi c ON a.id_divisi = c.id_divisi
				WHERE a.username=".$this->db->escape($uid_);
		$data = $this->db->query($query);
		if($data->num_rows() > 0){
			$hash = $data->row();
			if(password_verify($pwd_, $hash->password)) {
				foreach($data->result_array() as $row){
					$datses['LOGGED'] 		= true;
					$datses['IP'] 			= $_SERVER['REMOTE_ADDR'];
					$datses['ID_KARYAWAN'] 	= $row['id_karyawan'];
					$datses['NAMA'] 		= $row['nama_karyawan'];
					$datses['ALAMAT'] 		= $row['alamat_karyawan'];
					$datses['HP'] 			= $row['no_hp_karyawan'];
					$datses['EMAIL'] 		= $row['email_karyawan'];
					$datses['JABATAN'] 		= $row['nama_jabatan'];
					$datses['DIVISI'] 		= $row['nama_divisi'];
					$datses['IDJABATAN'] 	= $row['id_jabatan'];
					$datses['IDDIVISI'] 	= $row['id_divisi'];
					$datses['USER_NAME'] 	= $uid_;
					$datses['PASSWORD'] 	= $pwd_;
				}
				date_default_timezone_set('Asia/Jakarta');
				$this->newsession->set_userdata($datses);
				return 1;
			} else {
				return 2;
			}
		}else{
			return 0;
		}
	}
	
	function setData($type){
		$idKaryawan = $this->input->post('id');
		if($type=="profile"){
			foreach($this->input->post('KARYAWAN') as $a=>$b){
				$KARYAWAN[$a] = $b;
			}
			$this->db->where(array('id_karyawan' => $idKaryawan));
			$exec = $this->db->update('karyawan',$KARYAWAN);
			if($exec){
				$datses['NAMA'] 		= $KARYAWAN['NAMA_KARYAWAN'];
				$datses['ALAMAT'] 		= $KARYAWAN['ALAMAT_KARYAWAN'];
				$datses['HP'] 			= $KARYAWAN['NO_HP_KARYAWAN'];
				$datses['EMAIL'] 		= $KARYAWAN['EMAIL_KARYAWAN'];
				$datses['USER_NAME'] 	= $KARYAWAN['USERNAME'];
				$this->newsession->set_userdata($datses);
				return array("msg"=>"Data Berhasil Disimpan.","status"=>"success", "url"=>site_url()."/user/profile");
			}else{
				return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
			}
		}elseif($type=="reset_password"){
			$this->db->where(array('id_karyawan' => $idKaryawan));
			$exec = $this->db->update('karyawan',array('password'=>password_hash($this->input->post('password_baru'), PASSWORD_BCRYPT)));
			if($exec){
				$datses['PASSWORD'] = $this->input->post('password_baru');
				$this->newsession->set_userdata($datses);
				return array("msg"=>"Data Berhasil Disimpan.","status"=>"success", "url"=>base_url());
			}else{
				return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
			}
		}
	}
}
?>