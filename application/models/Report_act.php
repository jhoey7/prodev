<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ERROR);
class Report_act extends CI_Model
{	
	function getData($tipe){
		if($tipe=="penilaian"){
			$sql = "SELECT a.nama_proyek, a.tanggal_awal_proyek, b.nilai_pekerjaan, b.nilai_perilaku,
					DATE_FORMAT(a.tanggal_awal_proyek,'%d %M %Y') as tgl_proyek 
					FROM proyek a INNER JOIN nilai b ON a.id_proyek = b.id_proyek 
					WHERE b.id_karyawan = '".$this->input->post('id_karyawan')."' 
					AND DATE_FORMAT(a.tanggal_awal_proyek,'%Y') = '".$this->input->post('periode')."'";
		}elseif($tipe=="pekerjaan"){
			$sql = "SELECT 
					CASE a.tahap_pekerjaan 
						WHEN 1 THEN 'Analisis' 
						WHEN 2 THEN 'Development'
						WHEN 3 THEN 'Testing'
						WHEN 4 THEN 'Dokumentasi'
					END AS fase, a.deskripsi_pekerjaan, b.nama_karyawan, 
					DATE_FORMAT(a.tanggal_awal_pekerjaan, '%d %M %Y') as tgl_awal,
					DATE_FORMAT(a.tanggal_akhir_pekerjaan, '%d %M %Y') as tgl_akhir,
					DATE_FORMAT(a.tanggal_update_pekerjaan, '%d %M %Y') as tgl_selesai,
					IF(
						(SELECT COUNT(DISTINCT(id_pekerjaan)) FROM pekerjaan  
						WHERE id_karyawan = a.id_karyawan AND id_proyek = a.id_proyek AND ((a.status_pekerjaan = 100
						AND a.flag_telat = 1) OR (DATE_FORMAT(NOW(), '%Y-%m-%d') > a.tanggal_akhir_pekerjaan 
						AND a.status_pekerjaan < 100 AND a.flag_telat <> 1))) > 0,
						'Offtime','Ontime'
					) AS status
					FROM pekerjaan a LEFT JOIN karyawan b ON a.id_karyawan = b.id_karyawan 
					WHERE a.id_proyek = '".$this->input->post('id_proyek')."' 
					ORDER BY b.nama_karyawan ASC";
		}
		$res = $this->db->query($sql)->result_array();
		return $res;
	}
}
?>