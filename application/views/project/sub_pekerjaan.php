<?php
	if($this->newsession->userdata('IDJABATAN')==3){
		$style = 'margin-top:-35px;';
		$style1 = 'style="margin-top:-20px !important;"';
	}else{
		$style = '';
		$style1 = '';
	}
?>
<div class="modal-dialog" style="width:70% !important;">
	<?php if($this->newsession->userdata('IDJABATAN')!=3) { ?>
	<form id="form-subPekerjaan" name="form-subPekerjaan" method="post" action="<?php echo site_url('project/setData/sub_pekerjaan'); ?>">
    	<input type="hidden" name="id_pekerjaan" id="id_pekerjaan" value="<?php echo $idPekerjaan; ?>" readonly />
    	<input type="hidden" name="id_proyek" id="id_proyek" value="<?php echo $idProyek; ?>" readonly />
    	<input type="hidden" name="act" id="act" value="update_subTask" readonly />
    	<input type="hidden" name="endTask" id="endTask" value="<?php echo $data['tanggal_akhir_pekerjaan']; ?>" readonly />
   	<?php } ?>
		<div class="modal-content">
			<div class="modal-header" style="background-color:#f8f8f8 !important;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title thin" id="modalConfirmLabel">Sub Pekerjaan</h3>
			</div>
			<div class="modal-body" <?php echo $style1; ?>>
            	<?php if($this->newsession->userdata('IDJABATAN')==3) { ?>
            	<form id="form-sub-task" method="post" autocomplete="off" action="<?php echo site_url('project/setData/sub_pekerjaan'); ?>">
                	<input type="hidden" name="SUB[id_pekerjaan]" id="id_pekerjaan" value="<?php echo $idPekerjaan; ?>" readonly />
    				<input type="hidden" name="id_proyek" id="id_proyek" value="<?php echo $idProyek; ?>" readonly />
                    <input type="hidden" name="act" id="act" value="<?php echo $action; ?>" readonly />
                    <input type="hidden" name="id_sub_pekerjaan" id="id_sub_pekerjaan" readonly />
                    <?php } ?>
            		<section class="tile border top" id="sectionSubTask">
                        <div class="tile-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="tile-body nopadding">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Pekerjaan</th>
                                                    <th>PIC</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="danger">
                                                    <td><?php echo $data['deskripsi_pekerjaan']; ?></td>
                                                    <td><?php echo $data['nama_karyawan']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php if($this->newsession->userdata('IDJABATAN')==3) { ?>
                            <div class="row" style="margin-top:10px !important;">
                                <div class="form-group col-sm-4">
                                    <label for="nama_sub_pekerjaan">Nama Sub Pekerjaan</label>
                                    <input type="text" class="form-control" id="nama_sub_pekerjaan" name="SUB[nama_sub_pekerjaan]" placeholder="Sub Pekerjaan" wajib="yes">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="deskripsi_sub_pekerjaan">Deskripsi</label>
                                    <input type="text" class="form-control" id="deskripsi_sub_pekerjaan" name="SUB[deskripsi_sub_pekerjaan]" placeholder="Deskripsi">
                                </div>
                                <div class="form-group col-sm-4">
                                    <label for="button">&nbsp;</label>
                                    <a href="javascript:void(0);" id="buttonSub" class="btn btn-greensea" style="margin-top:25px; margin-left:-33px;" onclick="saveData('#form-sub-task','_msg','sectionSubTask','tableSubPekerjaan')"><i class="fa fa-save"></i>&nbsp;Simpan</a>
                                    <div class="_msg" style="margin-top:-32px; margin-left:65px;"></div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
					</section>
                <?php if($this->newsession->userdata('IDJABATAN')==3) { ?>
                </form>
                <?php } ?>
            	<section class="tile border top" style="border-top:2px solid red !important; <?php echo $style; ?>">
                	<div class="tile-body nopadding">
                    	<div class="table-responsive">
                            <table class="table table-datatable table-bordered" id="tableSubPekerjaan" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="49%">Nama Sub Pekerjaan</th>
                                        <th width="30%">Deskripsi</th>
                                        <th width="10%">Status</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                            </table>
                    	</div>
                	</div>
            	</section>
			</div>
            <div class="modal-footer">
            	<?php if($this->newsession->userdata('IDJABATAN')!=3) { ?>
                <a href="javascript:void(0);" class="btn btn-greensea" onClick="saveData('#form-subPekerjaan','_msg','sectionSubTask','tableTask');">Simpan</a>
                <?php } ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
		</div>
    <?php if($this->newsession->userdata('IDJABATAN')!=3) { ?>
    </form>
    <?php } ?>
</div>
<script>
	$(document).ready(function() {
		//get tasklist
		tableData('tableSubPekerjaan','<?php echo site_url('project/loadData/sub_pekerjaan/'.$this->azdgcrypt->crypt($idPekerjaan)); ?>');
	} );
    $(function(){
      	//todo's
    	$('#todolist li label').click(function() {
        	$(this).toggleClass('done');
      	});
	});
	
	function editSubPekerjaan(SubID){
		$.get(site_url+'/project/sub_pekerjaan/<?php echo $this->azdgcrypt->crypt($idPekerjaan)."/".$this->azdgcrypt->crypt($idProyek)."/"; ?>'+SubID, function(data) { 				
		//define input
		$.each(data.data, function(key, value) {
			$("#form-sub-task #" + key).val(value);
		});
		
		$("#form-sub-task #act").val('update');
	}, 'json');
	}
</script>