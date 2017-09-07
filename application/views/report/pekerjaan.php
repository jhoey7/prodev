<section  class="tile border top blue" id="sectionMonitoring">
    <form id="frmLaporanPros" name="frmLaporanPros" method="post" autocomplete="off" >
        <div class="tile-body">
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="nama_proyek">Nama Proyek</label>
                    <input type="text" class="form-control" id="nama_proyek" name="nama_proyek" placeholder="Klik Untuk Pencarian" onclick="tb_search('proyek','id_proyek;nama_proyek;nama_klien')" />
                    <input type="hidden" id="id_proyek" readonly="readonly" name="id_proyek" />
                </div>
                <div class="form-group col-sm-4">
                    <label for="nama_klien">Nama Klien</label>
                    <input type="text" class="form-control" id="nama_klien" name="nama_klien" placeholder="Nama Klien" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset col-sm-8">
                    <a href="javascript:void(0)" onclick="Laporan('frmLaporanPros','divLapProses','<?= base_url()."index.php/report/pekerjaan"?>');"class="btn btn-greensea" id="btnSearch">
                    	<i class="fa fa-check"></i>&nbsp;Proses
					</a>
                </div>
            </div>
        </div>
        <!-- /tile body -->
		<span id="divLapProses"></span>
    </form>
</section>