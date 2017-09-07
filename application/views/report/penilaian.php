<section  class="tile border top blue" id="sectionMonitoring">
    <form id="frmLaporanPros" name="frmLaporanPros" method="post" autocomplete="off" >
        <div class="tile-body">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="nama_karyawan">Nama Karyawan</label>
                    <input type="text" class="form-control" id="nama_karyawan" name="nama_karyawan" placeholder="Klik Untuk Pencarian" onclick="tb_search('karyawan','id_karyawan;nama_karyawan')" />
                    <input type="hidden" id="id_karyawan" readonly="readonly" name="id_karyawan" />
                </div>
                <div class="form-group col-sm-2">
                    <label for="periode">Periode Tahun</label>
                    <input type="text" class="form-control" id="periode" placeholder="yyyy" name="periode" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset col-sm-8">
                    <a href="javascript:void(0)" onclick="Laporan('frmLaporanPros','divLapProses','<?= base_url()."index.php/report/penilaian"?>');"class="btn btn-greensea" id="btnSearch">
                    	<i class="fa fa-check"></i>&nbsp;Proses
					</a>
                </div>
            </div>
        </div>
        <!-- /tile body -->
		<span id="divLapProses"></span>
    </form>
</section>
<script>
	$('#periode').datepicker({
		todayHighlight: false,
		format: 'yyyy',
		autoclose: true,
		viewMode: "years",
		minViewMode: "years"
	});
</script>