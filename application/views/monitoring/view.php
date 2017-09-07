<section  class="tile border top blue" id="sectionMonitoring">
    <form id="form-monitoring" name="form-monitoring" method="post" autocomplete="off" action="<?php echo site_url(); ?>/monitoring/getData" >
        <div class="tile-body">
            <div class="row" id="row-1">
                <div class="form-group col-sm-4">
                    <label for="nama_proyek">Pilih Proyek</label>
                    <input type="text" class="form-control" id="nama_proyek" placeholder="Klik Untuk Pencarian" onclick="tb_search('monitoring','id_proyek;nama_proyek')" />
                    <input type="hidden" id="id_proyek" readonly="readonly" name="id_proyek" />
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset col-sm-8">
                    <a href="javascript:void(0)" onclick="search_data('form-monitoring')" class="btn btn-greensea" id="btnSearch">
                    	<i class="fa fa-check"></i>&nbsp;Proses
					</a>
                </div>
            </div>
        </div>
        <!-- /tile body -->
    </form>
</section>
<span id="view"></span>