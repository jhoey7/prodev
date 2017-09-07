<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class Master_act extends CI_Model
{
	function getData($tipe){
		if($this->input->post('id')) $act = "update";
		else $act = 'save';
		
		if($tipe=="jabatan"){
			$param = "postJabatan";
			$sql = 'SELECT nama_jabatan, deskripsi_jabatan, id_jabatan as id FROM jabatan WHERE id_jabatan = "'.$this->azdgcrypt->decrypt($this->input->post('id')).'"';
		}elseif($tipe=="divisi"){
			$param = "postDivisi";
			$sql = 'SELECT nama_divisi, deskripsi_divisi, id_divisi as id FROM divisi WHERE id_divisi = "'.$this->azdgcrypt->decrypt($this->input->post('id')).'"';
		}elseif($tipe=="klien"){
			$param = "klien";
			$sql = 'SELECT nama_klien, deskripsi_klien, id_klien as id, status_klien FROM klien WHERE id_klien = "'.$this->azdgcrypt->decrypt($this->input->post('id')).'"';
		}elseif($tipe=="karyawan"){
			$param = "karyawan";
			$sql = 'SELECT username, nama_karyawan, alamat_karyawan, no_hp_karyawan, email_karyawan, id_karyawan as id, id_jabatan, id_divisi 
					FROM karyawan WHERE id_karyawan = "'.$this->input->post('id').'"';
			$jabatan = $this->db->query('SELECT id_jabatan, nama_jabatan FROM jabatan')->result_array();
			$divisi  = $this->db->query('SELECT id_divisi, nama_divisi FROM divisi')->result_array();
		}
		$data = $this->db->query($sql)->row_array();
		return array("act"=>$act, $param=>$data, "jabatan"=>$jabatan,"divisi"=>$divisi);
	}
	
	function setData(){
		$action	= $this->input->post('act');
		$id 	= $this->input->post('id');
		$tipe	= $this->input->post('tipe');
		
		if($tipe=="jabatan"){
			#untuk mendevinisikan apa saja yang di post dari form karyawan
			foreach($this->input->post('JABATAN') as $a=>$b){
				$JABATAN[$a] = $b;
			}
			
			if($action=="save"){
				#cek username sudah ada di db atau blm
				$sql = "SELECT nama_jabatan FROM jabatan WHERE nama_jabatan = '".$JABATAN["NAMA_JABATAN"]."'";
				$result = $this->db->query($sql);
				if($result->num_rows() > 0){
					#jika sudah ada
					return array("msg"=>"Nama Jabatan sudah ada di database.","status"=>"failed");
				}else{
					#get last id
					$query = $this->db->query("SELECT MAX(id_jabatan) AS id FROM jabatan");
					if ($query->num_rows() > 0) {
						$result = $query->row();
						$id = $result->id;
					}
					#jika belum ada maka akan insert
					$JABATAN['id_jabatan'] = $id + 1;
					$exec = $this->db->insert('jabatan',$JABATAN);
					if($exec){
						return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/master/jabatan");
					}else{
						return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
					}
				}
			}elseif($action=="update"){
				$this->db->where(array('id_jabatan' => $id));
				$exec = $this->db->update('jabatan',$JABATAN);
				if($exec){
					return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/master/jabatan");
				}else{
					return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
				}
			}elseif($action=="delete"){
				$this->db->where(array('id_jabatan' => $this->azdgcrypt->decrypt($id)));
				$exec = $this->db->delete('jabatan');
				if($exec){
					return array("msg"=>"Data Berhasil Dihapus.","status"=>"success","url"=>site_url()."/master/jabatan");
				}else{
					return array("msg"=>"Data Gagal Dihapus.","status"=>"failed");
				}
			}
		}if($tipe=="klien"){
			#untuk mendevinisikan apa saja yang di post dari form karyawan
			foreach($this->input->post('KLIEN') as $a=>$b){
				$KLIEN[$a] = $b;
			}
			
			if($action=="save"){
				#cek username sudah ada di db atau blm
				$sql = "SELECT nama_klien FROM klien WHERE nama_klien = '".$DIVISI["NAMA_KLIEN"]."'";
				$result = $this->db->query($sql);
				if($result->num_rows() > 0){
					#jika sudah ada
					return array("msg"=>"Nama Klien sudah ada di database.","status"=>"failed");
				}else{
					#get last id
					$query = $this->db->query("SELECT MAX(id_klien) AS id FROM klien");
					if ($query->num_rows() > 0) {
						$result = $query->row();
						$id = $result->id;
					}
					#jika belum ada maka akan insert
					$KLIEN['id_klien'] = $id + 1;
					$exec = $this->db->insert('klien',$KLIEN);
					if($exec){
						return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/master/klien");
					}else{
						return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
					}
				}
			}elseif($action=="update"){
				$this->db->where(array('id_klien' => $id));
				$exec = $this->db->update('klien',$KLIEN);
				if($exec){
					return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/master/klien");
				}else{
					return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
				}
			}elseif($action=="delete"){
				$this->db->where(array('id_klien' => $this->azdgcrypt->decrypt($id)));
				$exec = $this->db->delete('klien');
				if($exec){
					return array("msg"=>"Data Berhasil Dihapus.","status"=>"success","url"=>site_url()."/master/klien");
				}else{
					return array("msg"=>"Data Gagal Dihapus.","status"=>"failed");
				}
			}
		}elseif($tipe=='divisi'){
			#untuk mendevinisikan apa saja yang di post dari form karyawan
			foreach($this->input->post('DIVISI') as $a=>$b){
				$DIVISI[$a] = $b;
			}
			
			if($action=="save"){
				#cek username sudah ada di db atau blm
				$sql = "SELECT nama_divisi FROM divisi WHERE nama_divisi = '".$DIVISI["NAMA_DIVISI"]."'";
				$result = $this->db->query($sql);
				if($result->num_rows() > 0){
					#jika sudah ada
					return array("msg"=>"Nama Divisi sudah ada di database.","status"=>"failed");
				}else{
					#get last id
					$query = $this->db->query("SELECT MAX(id_divisi) AS id FROM divisi");
					if ($query->num_rows() > 0) {
						$result = $query->row();
						$id = $result->id;
					}
					#jika belum ada maka akan insert
					$DIVISI['id_divisi'] = $id + 1;
					$exec = $this->db->insert('divisi',$DIVISI);
					if($exec){
						return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/master/divisi");
					}else{
						return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
					}
				}
			}elseif($action=="update"){
				$this->db->where(array('id_divisi' => $id));
				$exec = $this->db->update('divisi',$DIVISI);
				if($exec){
					return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/master/divisi");
				}else{
					return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
				}
			}elseif($action=="delete"){
				$this->db->where(array('id_divisi' => $this->azdgcrypt->decrypt($id)));
				$exec = $this->db->delete('divisi');
				if($exec){
					return array("msg"=>"Data Berhasil Dihapus.","status"=>"success","url"=>site_url()."/master/divisi");
				}else{
					return array("msg"=>"Data Gagal Dihapus.","status"=>"failed");
				}
			}
		}elseif($tipe=='karyawan'){
			foreach($this->input->post('KARYAWAN') as $a=>$b){
				$KARYAWAN[$a] = $b;
			}
			if($action=="save"){
				#cek username sudah ada di db atau blm
				$sql = "SELECT id_karyawan FROM karyawan WHERE username = '".$KARYAWAN["USERNAME"]."'";
				$result = $this->db->query($sql);
				if($result->num_rows() > 0){
					#jika sudah ada
					return array("msg"=>"Username sudah ada di database.","status"=>"failed");
				}else{
					#get last id
					$query = $this->db->query("SELECT MAX(id_karyawan) AS id FROM karyawan");
					if ($query->num_rows() > 0) {
						$result = $query->row();
						$id = $result->id;
					}
					#jika belum ada maka akan insert
					$KARYAWAN['id_karyawan'] = $id + 1;
					$KARYAWAN['PASSWORD']	 = password_hash($this->input->post('PASSWORD'), PASSWORD_BCRYPT);//md5($this->input->post('PASSWORD'));
					$exec = $this->db->insert('karyawan',$KARYAWAN);
					if($exec){
						return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/master/karyawan");
					}else{
						return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
					}
				}
			}elseif($action=="update"){
				$this->db->where(array('id_karyawan' => $id));
				$exec = $this->db->update('karyawan',$KARYAWAN);
				if($exec){
					return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/master/karyawan");
				}else{
					return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
				}
			}elseif($action=="delete"){
				$this->db->where(array('id_karyawan' => $idKaryawan));
				$exec = $this->db->delete('karyawan');
				if($exec){
					return array("msg"=>"Data Berhasil Dihapus.","status"=>"success","url"=>site_url()."/master/karyawan");
				}else{
					return array("msg"=>"Data Gagal Dihapus.","status"=>"failed");
				}
			}
		}
	}
	
	function get_datatables($tipe)
    {
        $this->_get_datatables_query($tipe);
        $query = $this->db->get();
        return $query->result();
    }
	
	 private function _get_datatables_query($tipe)
    {
		if($tipe=="jabatan"){
			$field = "nama_jabatan, deskripsi_jabatan,id_jabatan";
			$this->db->select($field)->from('jabatan');
		}elseif($tipe=="divisi"){
			$field = "nama_divisi, deskripsi_divisi, id_divisi";
			$this->db->select($field)->from('divisi');
		}elseif($tipe=="klien"){
			$field = "nama_klien, deskripsi_klien, 
						CASE status_klien 
							WHEN 0 THEN 'Tidak Aktif'
							WHEN 1 THEN 'Aktif'
						END AS status,id_klien";
			$this->db->select($field)->from('klien');
		}elseif($tipe=="karyawan"){
			$field = "a.username, a.nama_karyawan, a.alamat_karyawan, a.no_hp_karyawan, a.email_karyawan, 
					  b.nama_divisi, c.nama_jabatan, a.id_karyawan";
			$this->db->select($field)->from('karyawan a');
			$this->db->join('divisi b','a.id_divisi = b.id_divisi','left');
			$this->db->join('jabatan c','a.id_jabatan = c.id_jabatan','left');
		}
    }
}
?>