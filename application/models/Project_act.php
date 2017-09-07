<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class Project_act extends CI_Model
{	
	function getHeader($id){
		$func = get_instance();
		$func->load->model("main", "main", true);
		$sql = 'SELECT a.id_proyek, a.nama_proyek, a.tanggal_awal_proyek, a.tanggal_akhir_proyek, a.deskripsi_proyek, 
					a.status_proyek, b.nama_klien, c.nama_karyawan 
				FROM proyek a INNER JOIN klien b on a.id_klien = b.id_klien 
					INNER JOIN karyawan c ON a.id_pm = c.id_karyawan 
				WHERE a.id_proyek = "'.$id.'"';
		$data = $this->db->query($sql)->row_array();
		$data['jabatan'] = $func->main->get_combobox('SELECT id_jabatan, nama_jabatan FROM jabatan WHERE id_jabatan NOT IN(3,6)','id_jabatan','nama_jabatan',true);
		$data['karyawan'] = $func->main->get_combobox('SELECT id_karyawan, nama_karyawan FROM karyawan','id_karyawan','nama_karyawan',true);
		return $data;
	}
	
	function getKaryawan($id){
		if($id) $where = ' WHERE a.id_jabatan = "'.$id.'"';
		$sql = 'SELECT a.id_karyawan, a.nama_karyawan FROM karyawan a'.$where;
		$data = $this->db->query($sql)->result_array();
		return array("karyawan"=>$data);
	}
	
	function getData($id){
		$func = get_instance();
		$func->load->model("main", "main", true);
		$data['klien'] 	  = $func->main->get_combobox('SELECT id_klien, nama_klien FROM klien','id_klien','nama_klien');
		$data['act']	  = 'save';
		if($id){
			$sql = 'SELECT id_proyek, nama_proyek, DATE_FORMAT(tanggal_awal_proyek,"%d/%m/%Y") as tanggal_awal_proyek, 
					DATE_FORMAT(tanggal_akhir_proyek,"%d/%m/%Y") as tanggal_akhir_proyek, 
					deskripsi_proyek, status_proyek, id_klien, id_pm
					FROM proyek 
					WHERE id_proyek = "'.$id.'"';
			$data['sess'] 	= $this->db->query($sql)->row_array();
			$data['act']	= 'update';
		}
		return $data;
	}
	
	function getAnggota($id,$idDetil=""){
		if($idDetil){
			$data = 'SELECT a.id_pekerjaan, DATE_FORMAT(a.tanggal_awal_pekerjaan,"%d/%m/%Y") AS tanggal_awal_pekerjaan, 
					 	DATE_FORMAT(a.tanggal_akhir_pekerjaan,"%d/%m/%Y") AS tanggal_akhir_pekerjaan, a.deskripsi_pekerjaan,
					 	a.bobot_pekerjaan, a.status_pekerjaan, a.tahap_pekerjaan, a.id_proyek, a.id_karyawan 
					 FROM pekerjaan a WHERE a.id_pekerjaan = '.$idDetil;
			$resData = $this->db->query($data)->row_array();
		}
		return array("arrayData"=>$resData);
	}
	
	function setData($tipe=""){
		$func = get_instance();
		$func->load->model("main", "main", true);
		$action = $this->input->post('act');
		
		if($tipe=="header"){
			#untuk mendevinisikan apa saja yang di post dari form proyek
			foreach($this->input->post('PROJECT') as $a=>$b){
				$PROJECT[$a] = $b;
			}
			
			if($action=="save"){
				#cek nama proyek sudah ada di db atau blm
				$sql = "SELECT id_proyek FROM proyek WHERE nama_proyek = '".$PROJECT["NAMA_PROYEK"]."'";
				$result = $this->db->query($sql);
				if($result->num_rows() > 0){
					#jika sudah ada
					return array("msg"=>"Nama Proyek sudah ada di database.","status"=>"failed");
				}else{
					#get last id
					$query = $this->db->query("SELECT MAX(id_proyek) AS id FROM proyek");
					if ($query->num_rows() > 0) {
						$result = $query->row();
						$id = $result->id;
					}
					#jika belum ada maka akan insert
					$PROJECT['id_pm'] 			 	 = $this->newsession->userdata("ID_KARYAWAN");
					$PROJECT['id_proyek'] 			 = $id + 1;
					$PROJECT['TANGGAL_AWAL_PROYEK']  = date("Y-m-d", strtotime(str_replace('/', '-',$this->input->post('tanggal_awal'))));
					$PROJECT['TANGGAL_AKHIR_PROYEK'] = date("Y-m-d", strtotime(str_replace('/', '-',$this->input->post('tanggal_akhir'))));
					
					$exec = $this->db->insert('proyek',$PROJECT);
					if($exec){
						return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/project/view/".($id+1));
					}else{
						return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
					}
				}
			}elseif($action=='update'){
				$id = $this->input->post('id');
				$PROJECT['TANGGAL_AWAL_PROYEK']  = date("Y-m-d", strtotime(str_replace('/', '-',$this->input->post('tanggal_awal'))));
				$PROJECT['TANGGAL_AKHIR_PROYEK'] = date("Y-m-d", strtotime(str_replace('/', '-',$this->input->post('tanggal_akhir'))));
				
				$this->db->where(array('id_proyek'=>$id));
				$exec = $this->db->update('proyek',$PROJECT);
				if($exec){
					return array("msg"=>"Data Berhasil Diupdate.","status"=>"success","url"=>site_url()."/project/daftar");
				}else{
					return array("msg"=>"Data Gagal Diupdate.","status"=>"failed");
				}
			}elseif($action=="delete"){
				$idProyek = $this->azdgcrypt->decrypt($this->input->post('id'));
				$query = "DELETE FROM sub_pekerjaan WHERE id_pekerjaan IN 
						  (SELECT id_pekerjaan FROM pekerjaan WHERE id_proyek = '".$idProyek."')";
				$this->db->query($query);
				$this->db->where(array('id_proyek'=>$idProyek));
				$this->db->delete('pekerjaan');
				$this->db->where(array('id_proyek'=>$idProyek));
				$exec = $this->db->delete('proyek');
				if($exec){
					return array("msg"=>"Data Berhasil Dihapus.","status"=>"success","url"=>site_url()."/project/loadData/header");
				}else{
					return array("msg"=>"Data Gagal Dihapus.","status"=>"failed");
				}
			}
		}elseif($tipe=="task"){
			foreach($this->input->post('TASK') as $a=>$b){
				$TASK[$a] = $b;
			}
			$TASK['TANGGAL_AWAL_PEKERJAAN']  = date("Y-m-d", strtotime(str_replace('/', '-',$TASK['TANGGAL_AWAL_PEKERJAAN'])));
			$TASK['TANGGAL_AKHIR_PEKERJAAN'] = date("Y-m-d", strtotime(str_replace('/', '-',$TASK['TANGGAL_AKHIR_PEKERJAAN'])));
			if($action=="save"){
				$exec = $this->db->insert('pekerjaan',$TASK);
				if($exec){
					return array("msg"=>"Data Berhasil Disimpan.","status"=>"success","url"=>site_url()."/project/loadData/task/".$this->azdgcrypt->crypt($TASK['ID_PROYEK']),'ganChart'=>site_url('monitoring/getJson/'.$this->azdgcrypt->crypt($TASK['ID_PROYEK'])));
				}else{
					return array("msg"=>"Data Gagal Disimpan.","status"=>"failed");
				}
			}elseif($action=="update"){
				$this->db->where(array('id_pekerjaan' => $this->input->post('id_pekerjaan')));
				$exec = $this->db->update('pekerjaan',$TASK);
				if($exec){
					return array("msg"=>"Data Berhasil Diupdate.","status"=>"success","url"=>site_url()."/project/loadData/task/".$this->azdgcrypt->crypt($TASK['ID_PROYEK']),'ganChart'=>site_url('monitoring/getJson/'.$this->azdgcrypt->crypt($TASK['ID_PROYEK'])));
				}else{
					return array("msg"=>"Data Gagal Diupdate.","status"=>"failed");
				}
			}elseif($action=="delete"){
				$postId = explode("|",$this->input->post('id'));
				$this->db->where(array('id_pekerjaan' => $this->azdgcrypt->decrypt($postId[0])));
				$this->db->delete('sub_pekerjaan');
				$this->db->where(array('id_pekerjaan' => $this->azdgcrypt->decrypt($postId[0])));
				$exec = $this->db->delete('pekerjaan');
				if($exec){
					return array("msg"=>"Data Berhasil Dihapus.","status"=>"success","url"=>site_url()."/project/loadData/task/".$postId[1],'ganChart'=>site_url('monitoring/getJson/'.$postId[1]));
				}else{
					return array("msg"=>"Data Gagal Dihapus.","status"=>"failed");
				}
			}
		}elseif($tipe=="progress"){
			$id_detil = $this->input->post('id');
			$id_proyek = $this->input->post('id_proyek');
			if(date("Y-m-d") > $this->input->post('endTask')){
				$arrdata['flag_telat'] = 1;
			}
			$arrdata['status_pekerjaan'] = 100;
			$arrdata['catatan_pekerjaan'] = $this->input->post('catatan_pekerjaan');
			$arrdata['tanggal_update_pekerjaan'] = date('Y-m-d');
			$this->db->where(array('id_pekerjaan' => $id_detil));
			$exec = $this->db->update('pekerjaan',$arrdata);
			if($exec){
				return array("msg"=>"Status Pekerjaan Berhasil Diupdate.","status"=>"success","url"=>site_url()."/project/loadData/task/".$id_proyek);
			}else{
				return array("msg"=>"Status Pekerjaan Gagal Diupdate.","status"=>"failed");
			}
		}elseif($tipe=="pic"){
			$id_proyek = $this->input->post('id_proyek');
			$this->db->where(array('id_pekerjaan'=>$this->input->post('id_pekerjaan')));
			$exec = $this->db->update('pekerjaan',array('id_karyawan'=>$this->azdgcrypt->decrypt($this->input->post('PIC'))));
			if($exec){
				return array("msg"=>"PIC Berhasil Diupdate.","status"=>"success","url"=>site_url()."/project/loadData/task/".$this->azdgcrypt->crypt($id_proyek));
			}else{
				return array("msg"=>"PIC Gagal Diupdate.","status"=>"failed");
			}
		}elseif($tipe=="sub_pekerjaan"){
			$idProyek = $this->input->post('id_proyek');
			foreach($this->input->post("SUB") as $a=>$b){
				$SUB[$a] = $b;
			}
			if($action=="save"){
				$exec = $this->db->insert('sub_pekerjaan',$SUB);
				if($exec){
					return array("msg"=>"Sub Task Berhasil Ditambahkan.","status"=>"success","url"=>site_url()."/project/loadData/sub_pekerjaan/".$this->azdgcrypt->crypt($SUB['id_pekerjaan']));
				}else{
					return array("msg"=>"Sub Task Gagal Ditambahkan.","status"=>"failed");
				}
			}elseif($action=="update"){
				$this->db->where(array("id_sub_pekerjaan"=>$this->input->post('id_sub_pekerjaan')));
				$exec = $this->db->update('sub_pekerjaan',$SUB);
				if($exec){
					return array("msg"=>"Sub Task Berhasil Diudate.","status"=>"success","url"=>site_url()."/project/loadData/sub_pekerjaan/".$this->azdgcrypt->crypt($SUB['id_pekerjaan']));
				}else{
					return array("msg"=>"Sub Task Gagal Diudate.","status"=>"failed");
				}
			}elseif($action=="delete"){
				$id = explode("|",$this->input->post('id'));
				$this->db->where(array("id_sub_pekerjaan"=>$this->azdgcrypt->decrypt($id[0])));
				$exec = $this->db->delete('sub_pekerjaan');
				if($exec){
					return array("msg"=>"Sub Task Berhasil Dihapus.","status"=>"success","url"=>site_url()."/project/loadData/sub_pekerjaan/".$id[1]);
				}else{
					return array("msg"=>"Sub Task Gagal Dihapus.","status"=>"failed");
				}
			}elseif($action=="update_subTask"){
				$arrdetil = $this->input->post('SUB');
				if(count($arrdetil)==0){
					return array('msg'=>'Checklist Salah Satu Sub Task Terlebih Dahulu','status'=>'failed');
				}else{
					$arrkeys = array_keys($arrdetil);
					for ($i = 0; $i < count($arrdetil[$arrkeys[0]]); $i++) {
						for ($j = 0; $j < count($arrkeys); $j++) {
							$data[$arrkeys[$j]] = $arrdetil[$arrkeys[$j]][$i];
						}
						$this->db->where(array('id_sub_pekerjaan'=>$data['ID_SUB_PEKERJAAN']));
						$this->db->update('sub_pekerjaan',array('status_sub_pekerjaan'=>'1'));
					}
					$TotalSubTask = $func->main->get_uraian('SELECT COUNT(id_sub_pekerjaan) AS jumlah FROM sub_pekerjaan WHERE id_pekerjaan = "'.$this->input->post('id_pekerjaan').'"','jumlah');
					$TotalSubTaskDone = $func->main->get_uraian('SELECT COUNT(id_sub_pekerjaan) AS jumlah FROM sub_pekerjaan WHERE id_pekerjaan = "'.$this->input->post('id_pekerjaan').'" AND status_sub_pekerjaan = "1"','jumlah');
					
					$PEKERJAAN['status_pekerjaan'] = round(($TotalSubTaskDone / $TotalSubTask) * 100);
					if(date("Y-m-d") > $this->input->post('endTask')){
						$PEKERJAAN['flag_telat'] = 1;
					}
					
					if(round(($TotalSubTaskDone / $TotalSubTask) * 100)==100){
						$PEKERJAAN['tanggal_update_pekerjaan'] = date('Y-m-d');
					}
					
					$this->db->where(array('id_pekerjaan'=>$this->input->post('id_pekerjaan')));
					$exec = $this->db->update('pekerjaan',$PEKERJAAN);
					if($exec){
						return array("msg"=>"Sub Task Berhasil Diupdate.","status"=>"success","url"=>site_url()."/project/loadData/task/".$this->input->post('id_proyek'));
					}else{
						return array("msg"=>"Sub Task Gagal Diupdate.","status"=>"failed");
					}
				}
			}
		}
	}
	
	function get_datatables($tipe,$id="")
    {
        $this->_get_datatables_query($tipe,$id);
        $query = $this->db->get();
        return $query->result();
    }
	
	 private function _get_datatables_query($tipe,$id="")
    {
		$idJabatan 	= $this->newsession->userdata("IDJABATAN");
		$idKaryawan = $this->newsession->userdata("ID_KARYAWAN");
		if($tipe=="header"){
			if(!in_array($idJabatan,array(3))){
				$a = ", f_jum_task(a.id_proyek,'1','".$idKaryawan."') as jum_proyek_end, f_jum_task(a.id_proyek,'2','".$idKaryawan."') as jum_dtl_proyek";
			}else{
				$a = ", f_jum_task(a.id_proyek, '1', '') as jum_proyek_end, f_jum_task(a.id_proyek, '2', '') as jum_dtl_proyek";
			}
			$field = "a.nama_proyek, DATE_FORMAT(a.tanggal_awal_proyek, '%d %b %Y') AS tgl_awal_proyek, 
					  DATE_FORMAT(a.tanggal_akhir_proyek, '%d %b %Y') AS tgl_akhir_proyek, a.deskripsi_proyek, 
					  CASE a.status_proyek 
					  	WHEN 1 THEN 'Maintenence'
						WHEN 2 THEN 'Development'
					  END AS status_proyek, b.nama_klien, c.nama_karyawan, a.id_proyek $a ";
			$this->db->select($field)->from('proyek a');
			$this->db->join('klien b','a.id_klien = b.id_klien','left');
			$this->db->join('karyawan c','a.id_pm = c.id_karyawan','left');
			if($this->newsession->userdata("IDJABATAN")!='3'){
				$this->db->join('pekerjaan d','a.id_proyek = d.id_proyek','inner');
				$this->db->group_by('a.id_proyek');
				$this->db->where(array('d.id_karyawan'=>$this->newsession->userdata('ID_KARYAWAN')));
			}else{
				$this->db->where(array('a.id_pm'=>$this->newsession->userdata('ID_KARYAWAN')));
			}
			$this->db->order_by('a.id_proyek','desc');
		}elseif($tipe=="task"){
			$field = "a.deskripsi_pekerjaan, a.id_proyek, a.catatan_pekerjaan, b.id_karyawan, 
					CASE a.bobot_pekerjaan 
						WHEN '1' THEN '<span class=\"label label-success\">Low</span>'
						WHEN '2' THEN '<span class=\"label label-warning\">Medium</span>'
						WHEN '3' THEN '<span class=\"label label-danger\">High</span>'
					END AS bobot_pekerjaan, DATE_FORMAT(a.tanggal_awal_pekerjaan,'%d %b %Y') as tgl_awal, 
					DATE_FORMAT(a.tanggal_akhir_pekerjaan,'%d %b %Y') as tgl_akhir, b.nama_karyawan, 
					CASE a.tahap_pekerjaan 
						WHEN '1' THEN 'Analisis'
						WHEN '2' THEN 'Development'
						WHEN '3' THEN 'Testing'
						WHEN '4' THEN 'Dokumentasi'
						WHEN '5' THEN 'Lainnya'
					END AS tahap_pekerjaan, a.status_pekerjaan, a.id_pekerjaan, a.tanggal_akhir_pekerjaan,
					CASE a.flag_telat
						WHEN 0 THEN 'Tidak' 
						WHEN 1 THEN 'Ya'
					END AS flag_telat, a.tahap_pekerjaan as thpKerja";
			$this->db->select($field)->from('pekerjaan a');
			$this->db->join('karyawan b','a.id_karyawan = b.id_karyawan','left');
			$this->db->where(array('a.id_proyek'=>$id));
			if($this->newsession->userdata("IDJABATAN")!="3"){
				$this->db->where(array('a.id_karyawan'=>$this->newsession->userdata("ID_KARYAWAN")));
			}
		}elseif($tipe=="pic"){
			if($id==3) $id = 4;
			elseif($id==4) $id = 5;
			$field = "a.nama_karyawan, b.nama_jabatan, IFNULL((SELECT SUM(bobot_pekerjaan) FROM pekerjaan WHERE id_karyawan = a.id_karyawan AND status_pekerjaan < 100),'0') AS total_bobot, (SELECT COUNT(id_pekerjaan) FROM pekerjaan WHERE id_karyawan = a.id_karyawan AND status_pekerjaan < 100 ) AS total_task, a.id_karyawan";
			$this->db->select($field)->from('karyawan a');
			$this->db->join('jabatan b','a.id_jabatan = b.id_jabatan','left');
			$this->db->where(array('b.id_jabatan'=>$id));
		}elseif($tipe=="sub_pekerjaan"){
			$field = "a.nama_sub_pekerjaan, a.deskripsi_sub_pekerjaan, a.status_sub_pekerjaan, a.id_sub_pekerjaan, a.id_pekerjaan";
			$this->db->select($field)->from('sub_pekerjaan a');
			$this->db->where(array('a.id_pekerjaan'=>$id));
		}
    }
	
	function getTask($idPekerjaan=""){
		$id_detail = $this->input->post("id");
		if($id_detail=="") $id_detail = $idPekerjaan;
		$query = $this->db->query("SELECT a.id_pekerjaan, a.deskripsi_pekerjaan, a.status_pekerjaan, a.tanggal_akhir_pekerjaan, a.id_proyek, a.catatan_pekerjaan, CASE a.bobot_pekerjaan WHEN 1 THEN 'Low' WHEN 2 THEN 'Medium' WHEN 3 THEN 'High' END AS bobot_pekerjaan, a.tanggal_awal_pekerjaan, b.nama_karyawan FROM pekerjaan a LEFT JOIN karyawan b ON a.id_karyawan= b.id_karyawan WHERE a.id_pekerjaan = ".$id_detail);
		return array("data"=>$query->row_array());
	}
	
	function getSubPekerjaan($idPekerjaan,$idProyek,$idSub=FALSE){
		if(!$idSub){
			$query = $this->db->query("SELECT a.id_pekerjaan, a.deskripsi_pekerjaan, a.status_pekerjaan, a.tanggal_akhir_pekerjaan, a.id_proyek, a.catatan_pekerjaan, CASE a.bobot_pekerjaan WHEN 1 THEN 'Low' WHEN 2 THEN 'Medium' WHEN 3 THEN 'High' END AS bobot_pekerjaan, a.tanggal_awal_pekerjaan, b.nama_karyawan, a.tanggal_akhir_pekerjaan FROM pekerjaan a LEFT JOIN karyawan b ON a.id_karyawan= b.id_karyawan WHERE a.id_pekerjaan = ".$idPekerjaan);
		}elseif($idSub){
			$query = $this->db->query("SELECT id_sub_pekerjaan, nama_sub_pekerjaan, deskripsi_sub_pekerjaan FROM sub_pekerjaan WHERE id_sub_pekerjaan = '".$idSub."'");
		}
		return array("data"=>$query->row_array());
	}
}
?>