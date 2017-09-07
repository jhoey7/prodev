<section  class="tile border top blue" id="sectionProject">
    <!-- tile header -->
    <div class="tile-header">
    	<h1><strong>Form Input</strong> Proyek</h1>
	</div>
    <!-- /tile header -->
    
    <form id="form-input-project" name="form-input-project" method="post" autocomplete="off" action="<?php echo site_url(); ?>/project/setData/header" >
    	<input type="hidden" name="act" id="act" value="<?php echo $act; ?>" readonly />
        <input type="hidden" name="id" id="id" value="<?php echo $sess['id_proyek']; ?>" readonly />
        <!-- tile body -->
        <div class="tile-body">
            <div class="row" id="row-1">
                <div class="form-group col-sm-4">
                    <label for="nama_project">Nama Proyek</label>
                    <input type="text" class="form-control" id="nama_project" placeholder="Nama Proyek" name="PROJECT[NAMA_PROYEK]" wajib="yes" value="<?php echo $sess['nama_proyek']; ?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="tangga_awal">Tanggal Mulai</label>
                    <input type="text" class="form-control" id="tanggal_awal" placeholder="Tanggal Mulai" name="tanggal_awal" wajib="yes" value="<?php echo $sess['tanggal_awal_proyek']; ?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="tanggal_akhir">Tanggal Selesai</label>
                    <input type="text" class="form-control" id="tanggal_akhir" placeholder="Tanggal Selesai" name="tanggal_akhir" wajib="yes" value="<?php echo $sess['tanggal_akhir_proyek']; ?>">
                </div>
            </div>
            
            <div class="row">
                <!--<div class="form-group col-sm-4">
                    <label for="status_proyek">Status</label>
                    <?php echo form_dropdown('PROJECT[STATUS_PROYEK]', array(''=>'-- Pilih Data --','1'=>'Maintenence','2'=>'Development'), $sess['status_proyek'], 'id="status_proyek" class="form-control" parsley-trigger="change" parsley-required="true" parsley-error-container="#selectbox" wajib="yes"'); ?>
                </div>-->
               <div class="form-group col-sm-4">
                    <label for="id_klien">Klien</label>
                    <?php echo form_dropdown('PROJECT[ID_KLIEN]', $klien, $sess['id_klien'], 'id="id_klien" class="form-control" parsley-trigger="change" parsley-required="true" parsley-error-container="#selectbox" wajib="yes"'); ?>
                </div>
                <div class="form-group col-sm-4">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" rows="2" name="PROJECT[DESKRIPSI_PROYEK]" placeholder="Deskripsi Proyek"><?php echo $sess['deskripsi_proyek']; ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-8">
                    <a href="javascript:void(0)" onclick="saveData('#form-input-project','_msg','sectionProject')" class="btn btn-greensea" id="btnSave">
                    	<i class="fa fa-save"></i>&nbsp;Simpan
					</a>
                    <a href="javascript:void(0)" onclick="cancel('form-input-project')" class="btn btn-red">
                    	<i class="fa fa-rotate-right"></i>&nbsp;Reset
					</a>&nbsp;<span class="_msg"></span>
                </div>
            </div>
        </div>
        <!-- /tile body -->
    </form>
</section>
<script>
	$('#tanggal_awal').datepicker({
		todayHighlight: false,
		format: 'dd/mm/yyyy',
		startDate: '+1d',
		autoclose: true
	}).on('changeDate', function (selected) {
		var temp = $(this).datepicker('getDate');
		var d = new Date(temp);
		var minDate = d.setDate(d.getDate() + 1);
        $('#tanggal_akhir').datepicker('setStartDate', new Date(minDate));
	});
	$('#tanggal_akhir').datepicker({
		todayHighlight: false,
		format: 'dd/mm/yyyy',
		autoclose: true,
      	clearDates: true
    });
</script>