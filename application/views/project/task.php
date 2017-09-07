<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3 class="modal-title thin" id="modalConfirmLabel">Update Task</h3>
		</div>
		<div class="modal-body">
			<form role="form" id="form-progres" name="form-progres" action="<?php echo site_url('project/setData/progress'); ?>" method="post">
            	<input type="hidden" name="id" id="id" value="<?php echo $data['id_pekerjaan'] ?>" readonly="readonly" />
            	<input type="hidden" name="endTask" id="endTask" value="<?php echo $data['tanggal_akhir_pekerjaan'] ?>" readonly="readonly" />
            	<input type="hidden" name="id_proyek" id="id_proyek" value="<?php echo $data['id_proyek'] ?>" readonly="readonly" />
				<div class="row">
					<div class="form-group col-sm-8">
                        <label for="deskripsi_pekerjaan">Pekerjaan</label>
                        <input type="text" class="form-control" id="deskripsi_pekerjaan" value="<?php echo $data['deskripsi_pekerjaan'] ?>" readonly="readonly">
                    </div>
             	</div>
                <div class="row">
                    <div class="form-group col-sm-8">
                        <label for="catatan_pekerjaan">Catatan</label>
                        <textarea class="form-control" id="catatan_pekerjaan" placeholder="Catatan" name="catatan_pekerjaan"><?php echo $data['catatan_pekerjaan']; ?></textarea>
                    </div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<a href="javascript:void(0)" onclick="saveTask('#form-progres')" class="btn btn-green" id="btnSave">
                <i class="fa fa-save"></i>&nbsp;Update
            </a>
			<button class="btn btn-red" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>
</div>
<script>
	function saveTask(formid){
		if($(formid + ' #status_pekerjaan').val() > 100){
			$.jGrowl('Progress tidak boleh melebihi 100', {
				beforeOpen: function(e,m,o){
					$(e).width( "300px" );
				}
			});
		}else{
			$.ajax({
				type: "POST",
				url: $(formid).attr('action'),
				dataType: "json",
				data: $(formid).serialize(),
				success: function(data) {
					if(data.status==="success"){
						$.jGrowl(data.msg, {
							beforeOpen: function(e,m,o){
								$(e).width( "300px" );
							}
						});
						$('#modalConfirm').modal('toggle');
						tableData('tableTask',data.url);
					}else{
						$.jGrowl(data.msg, {
							beforeOpen: function(e,m,o){
								$(e).width( "300px" );
							}
						});
					}
				},
				error: function() {
					$.jGrowl('Please Contact Your Administrator');
				}
			})
		}
	}
</script>