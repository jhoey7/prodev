<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class Penilaian_act extends CI_Model
{
	function get_datatables($tipe,$id="")
    {
		$idKaryawan = $this->newsession->userdata('ID_KARYAWAN');
        $field = "a.nama_proyek, b.nama_klien, c.nama_karyawan, e.id_proyek, e.id_karyawan,
				(
					SELECT COUNT(deskripsi_pekerjaan) FROM pekerjaan 
					WHERE id_proyek = a.id_proyek AND id_karyawan = e.id_karyawan
				) AS jum_task, 
				(
					SELECT COUNT(DISTINCT(detil.id_pekerjaan)) FROM pekerjaan detil 
					WHERE detil.id_karyawan = e.id_karyawan  AND detil.id_proyek = a.id_proyek 
					AND (
						(
							detil.status_pekerjaan = 100 AND detil.flag_telat <> 1
						) 
						OR 
						(
							DATE_FORMAT(NOW(), '%Y-%m-%d') < detil.tanggal_akhir_pekerjaan 
							AND detil.status_pekerjaan < 100 AND detil.flag_telat <> 1
						)
					)
				 ) AS jum_ontarget,
				(
					SELECT COUNT(detil.id_pekerjaan) FROM pekerjaan detil 
					WHERE detil.id_karyawan = e.id_karyawan AND detil.id_proyek = a.id_proyek 
					AND (
						(
							detil.status_pekerjaan = 100 AND detil.flag_telat = 1
						) 
							OR 
						(
							DATE_FORMAT(NOW(), '%Y-%m-%d') > detil.tanggal_akhir_pekerjaan 
							AND detil.status_pekerjaan < 100 AND detil.flag_telat <> 1
						)
					)
				) AS jum_offtarget";
		$this->db->select($field)->from('proyek a');
		$this->db->join('klien b','a.id_klien = b.id_klien','left');
		$this->db->join('pekerjaan e','e.id_proyek = a.id_proyek','inner');
		$this->db->join('karyawan c','c.id_karyawan = e.id_karyawan','left');
		$this->db->group_by('a.id_proyek, e.id_karyawan');
		$this->db->where(array("a.id_pm"=>$idKaryawan,"e.flag_nilai"=>"0"));
		$this->db->where("(f_jum_task(a.id_proyek, '1', '') * 100) / f_jum_task(a.id_proyek, '2', '') = 100",NULL,FALSE);
        $query = $this->db->get();
        return $query->result();
    }
	
	function setData(){
		foreach($this->input->post('NILAI') as $a=>$b){
			$NILAI[$a] = $b;
		}
		$NILAI['tanggal_penilaian'] = date('Y-m-d');
		if($this->db->insert('nilai',$NILAI)){
			$this->db->where(array(
								'id_proyek'		=> $NILAI['id_proyek'],
								'id_karyawan'	=> $NILAI['id_karyawan']
			));
			$exec = $this->db->update('pekerjaan',array('flag_nilai'=>'1'));
		}
		if($exec){
			return array("msg"=>"Data Berhasil Diupdate.","status"=>"success","url"=>site_url()."/penilaian/loadData");
		}else{
			return array("msg"=>"Data Gagal Diupdate.","status"=>"failed");
		}
	}
	
	function getNilai($idProyek, $idKaryawan){
		$query = "SELECT f_jum_task(b.id_proyek,'2','".$idKaryawan."') as jum_dtl_proyek, 
				  (SELECT COUNT(DISTINCT(a.id_pekerjaan)) FROM pekerjaan a 
					WHERE a.id_karyawan = b.id_karyawan AND a.id_proyek = b.id_proyek AND ((a.status_pekerjaan = 100
					AND a.flag_telat <> 1) OR 
					(DATE_FORMAT(NOW(), '%Y-%m-%d') < a.tanggal_akhir_pekerjaan AND a.status_pekerjaan < 100 AND a.flag_telat <> 1))
				  ) AS jum_ontarget,
				  (SELECT COUNT(DISTINCT(a.id_pekerjaan)) FROM pekerjaan a 
					WHERE a.id_karyawan = b.id_karyawan AND a.id_proyek = b.id_proyek AND ((a.status_pekerjaan = 100
					AND a.flag_telat = 1) OR (DATE_FORMAT(NOW(), '%Y-%m-%d') > a.tanggal_akhir_pekerjaan 
					AND a.status_pekerjaan < 100 AND a.flag_telat <> 1))
				  ) AS jum_offtarget
				  FROM pekerjaan b WHERE id_karyawan = '".$idKaryawan."' AND id_proyek = '".$idProyek."'";
		$doQuery = $this->db->query($query);
		return $doQuery->row_array();
	}
}
?>