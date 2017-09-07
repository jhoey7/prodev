<div class="modal-dialog" style="width:700px;">
	<div class="modal-content">
		<div class="modal-header" style="background-color:#f8f8f8 !important;">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3 class="modal-title thin" id="modalConfirmLabel">Pilih Proyek</h3>
		</div>
		<div class="modal-body">
            <section class="tile border top red">
                <div class="tile-body nopadding">
                    <div class="table-responsive">
                        <table class="table table-datatable table-bordered" id="tablePencarian" style="width:100%">
                            <thead>
                                <tr>
                                	<?php if($tipe=="monitoring") { ?>
                                        <th>#</th>
                                        <th>Nama Proyek</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                	<?php }elseif($tipe=="karyawan"){ ?>
                                    	<th>#</th>
                                        <th>Nama Karyawan</th>
                                        <th>Divisi</th>
                                        <th>Jabatan</th>
                                        <th>Action</th>
                                    <?php }elseif($tipe=="proyek"){ ?>
                                    	<th>#</th>
                                        <th>Nama Proyek</th>
                                        <th>Nama Klien</th>
                                        <th>Action</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </section>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		//get tasklist
		tableData('tablePencarian','<?php echo site_url('search/loadData/'.$tipe.'/'.$id); ?>');
	} );
</script>