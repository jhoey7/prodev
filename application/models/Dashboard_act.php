<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class Dashboard_act extends CI_Model
{
	function getDashboard(){
		$idKaryawan = $this->newsession->userdata('ID_KARYAWAN');
		$role = $this->newsession->userdata('IDJABATAN');
		if(!in_array($role,array("3"))){
			$sql = 'SELECT 
						(SELECT COUNT(a.id_proyek) FROM proyek a INNER JOIN pekerjaan b ON a.id_proyek = b.id_proyek
							WHERE b.id_karyawan = "'.$idKaryawan.'"
						) AS jum_proyek, 
						(SELECT COUNT(DISTINCT(a.id_pekerjaan)) FROM pekerjaan a WHERE a.id_karyawan = "'.$idKaryawan.'" 
							AND a.status_pekerjaan < 100 
						) AS jum_delay,
						(SELECT COUNT(DISTINCT(a.id_pekerjaan)) FROM pekerjaan a 
							WHERE a.id_karyawan = "'.$idKaryawan.'" AND a.status_pekerjaan = 100 
						) AS jum_done,
						(SELECT COUNT(DISTINCT(a.id_pekerjaan)) FROM pekerjaan a 
							WHERE a.id_karyawan = "'.$idKaryawan.'" AND ((a.status_pekerjaan = 100
							AND a.flag_telat = 1) OR (DATE_FORMAT(NOW(), "%Y-%m-%d") > a.tanggal_akhir_pekerjaan 
							AND a.status_pekerjaan < 100 AND a.flag_telat <> 1))
						) AS jum_offtarget,
						(SELECT COUNT(DISTINCT(a.id_pekerjaan)) FROM pekerjaan a 
							WHERE a.id_karyawan = "'.$idKaryawan.'" AND ((a.status_pekerjaan = 100
							AND a.flag_telat <> 1) OR 
							(DATE_FORMAT(NOW(), "%Y-%m-%d") < a.tanggal_akhir_pekerjaan AND a.status_pekerjaan < 100 AND a.flag_telat <> 1))
						) AS jum_ontarget
					FROM DUAL';
		}else{
			$sql = 'SELECT 
						(SELECT COUNT(a.id_proyek) FROM proyek a WHERE a.id_pm = "'.$idKaryawan.'"
						) AS jum_proyek, 
						(SELECT COUNT(a.id_pekerjaan) FROM pekerjaan a INNER JOIN proyek b ON a.id_proyek = b.id_proyek
							WHERE b.id_pm = "'.$idKaryawan.'" AND a.status_pekerjaan < 100 
						) AS jum_delay,
						(SELECT COUNT(a.id_pekerjaan) FROM pekerjaan a INNER JOIN proyek b ON a.id_proyek = b.id_proyek
							WHERE b.id_pm = "'.$idKaryawan.'" AND a.status_pekerjaan = 100 
						) AS jum_done,
						(SELECT COUNT(a.id_pekerjaan) FROM pekerjaan a INNER JOIN proyek b ON a.id_proyek = b.id_proyek
							WHERE b.id_pm = "'.$idKaryawan.'" AND ((a.status_pekerjaan = 100
							AND a.flag_telat = 1) OR (DATE_FORMAT(NOW(), "%Y-%m-%d") > a.tanggal_akhir_pekerjaan 
							AND a.status_pekerjaan < 100 AND a.flag_telat <> 1))
						) AS jum_offtarget,
						(SELECT COUNT(a.id_pekerjaan) FROM pekerjaan a INNER JOIN proyek b ON a.id_proyek = b.id_proyek
							WHERE b.id_pm = "'.$idKaryawan.'" AND ((a.status_pekerjaan = 100
							AND a.flag_telat <> 1) OR 
							(DATE_FORMAT(NOW(), "%Y-%m-%d") < a.tanggal_akhir_pekerjaan AND a.status_pekerjaan < 100 AND a.flag_telat <> 1))
						) AS jum_ontarget,
						(SELECT COUNT(b.id_pm) FROM pekerjaan a INNER JOIN proyek b ON a.id_proyek = b.id_proyek
							WHERE b.id_pm = "'.$idKaryawan.'" AND a.flag_nilai <> 1 AND 
							(f_jum_task(a.id_proyek, "1", "") * 100) / f_jum_task(a.id_proyek, "2", "") = 100 
						) AS jum_karyawan
					FROM DUAL';
		}
		$data = $this->db->query($sql)->row_array();
		return $data;
	}
	
	function get_datatables()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->result();
    }
	
	 private function _get_datatables_query()
    {
		$role = $this->newsession->userdata('IDJABATAN');
		if(!in_array($role,array("3"))){
			$field = "a.nama_proyek, b.nama_klien, c.deskripsi_pekerjaan, c.status_pekerjaan, 
					  DATE_FORMAT(c.tanggal_akhir_pekerjaan, '%d %b %Y') AS tanggal_akhir_pekerjaan, 
					  DATE_FORMAT(c.tanggal_update_pekerjaan, '%d %b %Y') AS tanggal_update_pekerjaan";
			$this->db->select($field)->from('proyek a');
			$this->db->join('klien b','a.id_klien = b.id_klien','left');
			$this->db->join('pekerjaan c','a.id_proyek = c.id_proyek','left');
			$this->db->where(array('c.id_karyawan'=>$this->newsession->userdata('ID_KARYAWAN')));
		}else{
			$field = "a.nama_proyek, b.nama_klien, 
					  CASE
						WHEN (IFNULL(f_jum_task(c.id_proyek,'1',''),0) * 100) / IFNULL(f_jum_task(c.id_proyek,'2',''),0) < 100 THEN 'On Progress'
						WHEN (f_jum_task(c.id_proyek,'1','') * 100) / f_jum_task(c.id_proyek,'2','') = 100 THEN 'Done'
					  END AS status_proyek, 
					  DATE_FORMAT(a.tanggal_akhir_proyek, '%d %b %Y') AS tanggal_akhir_pekerjaan";
			$this->db->select($field)->from('proyek a');
			$this->db->join('klien b','a.id_klien = b.id_klien','left');
			$this->db->join('pekerjaan c','a.id_proyek = c.id_proyek','left');
			$this->db->where(array('a.id_pm'=>$this->newsession->userdata('ID_KARYAWAN')));
			$this->db->group_by("a.id_proyek");
		}
	}
}
?>