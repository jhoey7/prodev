<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class Monitoring_act extends CI_Model
{
	function getTask($id){
		$idKaryawan = $this->newsession->userdata('ID_KARYAWAN');
		$role 		= $this->newsession->userdata('IDJABATAN');
		if(in_array($role,array("3"))){
			$field = "a.nama_proyek, b.deskripsi_pekerjaan, b.tanggal_awal_pekerjaan, b.tanggal_akhir_pekerjaan, c.nama_karyawan";
			$this->db->select($field)->from('proyek a');
			$this->db->join('pekerjaan b','a.id_proyek = b.id_proyek','inner');
			$this->db->join('karyawan c','c.id_karyawan = b.id_karyawan','left');
			$this->db->where(array('a.id_pm'=>$idKaryawan,'a.id_proyek'=>$id));
			$query = $this->db->get();
			return $query->result();
		}
	}
	
	function get_datatables($id)
    {
		$idKaryawan = $this->newsession->userdata('ID_KARYAWAN');
        $field = "a.nama_proyek, b.nama_klien, d.nama_karyawan, c.deskripsi_pekerjaan, c.status_pekerjaan, 
				  DATE_FORMAT(c.tanggal_akhir_pekerjaan, '%d %b %Y') AS tanggal_akhir_pekerjaan,
				  DATE_FORMAT(c.tanggal_update_pekerjaan, '%d %b %Y') AS tanggal_update_pekerjaan";
		$this->db->select($field)->from('proyek a');
		$this->db->join('klien b','a.id_klien = b.id_klien','left');
		$this->db->join('pekerjaan c','c.id_proyek = a.id_proyek','inner');
		$this->db->join('karyawan d','d.id_karyawan = c.id_karyawan','left');
		$this->db->where(array('a.id_pm'=>$idKaryawan, 'a.id_proyek'=>$id));
		$this->db->order_by('c.status_pekerjaan','desc');
        $query = $this->db->get();
        return $query->result();
    }
	
	function getData(){
		$idKaryawan = $this->newsession->userdata('ID_KARYAWAN');
		$idProyek = $this->input->post('id_proyek');
		$sql = 'SELECT 
				(
					SELECT COUNT(a.id_pekerjaan) FROM pekerjaan a INNER JOIN proyek b ON a.id_proyek = b.id_proyek 
						WHERE b.id_pm = "'.$idKaryawan.'" AND b.id_proyek = "'.$idProyek.'"
				) AS jum_task, 
				(
					SELECT COUNT(a.id_pekerjaan) FROM pekerjaan a LEFT JOIN proyek b ON a.id_proyek = b.id_proyek
						WHERE b.id_pm = "'.$idKaryawan.'" AND a.status_pekerjaan < 100 
					AND b.id_proyek = "'.$idProyek.'"
				) AS jum_delay,
				(
					SELECT COUNT(a.id_pekerjaan) FROM pekerjaan a LEFT JOIN proyek b ON a.id_proyek = b.id_proyek
						WHERE b.id_pm = "'.$idKaryawan.'" AND a.status_pekerjaan = 100 AND b.id_proyek = "'.$idProyek.'" 
				) AS jum_done,
				(
					SELECT COUNT(a.id_pekerjaan) FROM pekerjaan a INNER JOIN proyek b ON a.id_proyek = b.id_proyek
						WHERE b.id_pm = "'.$idKaryawan.'" AND b.id_proyek = "'.$idProyek.'" AND ((a.status_pekerjaan = 100
					AND a.flag_telat = 1) OR (DATE_FORMAT(NOW(), "%Y-%m-%d") > a.tanggal_akhir_pekerjaan 
					AND a.status_pekerjaan < 100 AND a.flag_telat <> 1))
				) AS jum_offtarget,
				(
					SELECT COUNT(a.id_pekerjaan) FROM pekerjaan a INNER JOIN proyek b ON a.id_proyek = b.id_proyek
						WHERE b.id_pm = "'.$idKaryawan.'" AND b.id_proyek = "'.$idProyek.'" AND ((a.status_pekerjaan = 100
					AND a.flag_telat <> 1) OR 
					(DATE_FORMAT(NOW(), "%Y-%m-%d") < a.tanggal_akhir_pekerjaan AND a.status_pekerjaan < 100 AND a.flag_telat <> 1))
				) AS jum_ontarget
			FROM DUAL';
		$res = $this->db->query($sql);
		return $res->row_array();
	}
}
?>