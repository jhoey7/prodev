<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class Search_act extends CI_Model
{
	function get_datatables($tipe,$id="")
    {
		$idKaryawan = $this->newsession->userdata('ID_KARYAWAN');
		if($tipe=="monitoring"){
			$field = "DISTINCT(a.nama_proyek) as nama_proyek, DATE_FORMAT(a.tanggal_awal_proyek ,'%d %b %Y') as tanggal_awal_proyek, 
					  DATE_FORMAT(a.tanggal_akhir_proyek ,'%d %b %Y') as tanggal_akhir_proyek, 
					  CASE
						WHEN (IFNULL(f_jum_task(b.id_proyek,'1',''),0) * 100) / IFNULL(f_jum_task(b.id_proyek,'2',''),0) < 100 THEN 'On Progress'
						WHEN (f_jum_task(b.id_proyek,'1','') * 100) / f_jum_task(b.id_proyek,'2','') = 100 THEN 'Done'
					  END AS status_proyek, a.id_proyek ";
			$this->db->select($field)->from('proyek a');
			$this->db->join('pekerjaan b','b.id_proyek = a.id_proyek','left');
			$this->db->where(array('a.id_pm'=>$idKaryawan));
			$this->db->where(array("(IFNULL(f_jum_task(b.id_proyek,'1',''),0) * 100) / IFNULL(f_jum_task(b.id_proyek,'2',''),0) < " => 100));
			$this->db->order_by('b.status_pekerjaan','desc');
		}elseif($tipe=="karyawan"){
			$field = "a.nama_karyawan, b.nama_jabatan, c.nama_divisi, a.id_karyawan ";
			$this->db->select($field)->from('karyawan a');
			$this->db->join('jabatan b','a.id_jabatan = b.id_jabatan','left');
			$this->db->join('divisi c','a.id_divisi = c.id_divisi','left');
			$this->db->join('pekerjaan d','a.id_karyawan = d.id_karyawan','inner');
			$this->db->join('proyek e','d.id_proyek = e.id_proyek','inner');
			$this->db->where(array('e.id_pm'=>$idKaryawan));
			$this->db->order_by('a.nama_karyawan','asc');
			$this->db->group_by('a.id_karyawan');
		}elseif($tipe=="proyek"){
			$field = "a.nama_proyek, b.nama_klien, a.id_proyek ";
			$this->db->select($field)->from('proyek a');
			$this->db->join('klien b','a.id_klien = b.id_klien','left');
			$this->db->where(array('a.id_pm'=>$idKaryawan));
		}
        $query = $this->db->get();
        return $query->result();
    }
}
?>