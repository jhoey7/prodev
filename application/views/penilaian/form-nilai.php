<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header" style="background-color:#f8f8f8 !important;">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3 class="modal-title thin" id="modalConfirmLabel">Penilaian Karyawan</h3>
		</div>
		<div class="modal-body">
			<form role="form" id="form-nilai" name="form-nilai" action="<?php echo site_url('penilaian/setData'); ?>" method="post">
            	<input type="hidden" name="NILAI[id_proyek]" id="id_proyek" value="<?php echo $id_proyek; ?>" readonly="readonly" />
            	<input type="hidden" name="NILAI[id_karyawan]" id="id_karyawan" value="<?php echo $id_karyawan; ?>" readonly="readonly" />
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="nilai_pekerjaan">Nilai Pekerjaan</label>
                        <input type="number" class="form-control" id="nilai_pekerjaan" name="NILAI[nilai_pekerjaan]" maxlength="3" min="1" max="100" value="<?php echo $nilai_pekerjaan; ?>" readonly="readonly">
                    </div>
               	</div>
                <div class="row">
                    <div class="form-group col-sm-4">
                        <label for="nilai_attitude">Nilai Perilaku</label>
                        <input type="number" class="form-control" id="nilai_attitude" name="NILAI[nilai_perilaku]" maxlength="3" min="1" max="100" >
                    </div>
               	</div>
                <div class="row">
                    <div class="form-group col-sm-8">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" id="catatan" placeholder="Catatan" name="NILAI[deskripsi_nilai]"></textarea>
                    </div>
				</div>
			</form>
		</div>
		<div class="modal-footer">
			<a href="javascript:void(0)" onclick="saveNilai('#form-nilai')" class="btn btn-green" id="btnSave">
                <i class="fa fa-save"></i>&nbsp;Update
            </a>
			<button class="btn btn-red" data-dismiss="modal" aria-hidden="true">Close</button>
		</div>
	</div>
</div>
<script>
	function saveNilai(formid){
		if($(formid + ' #nilai').val() > 100){
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
						tableData('tablePenilaian',data.url);
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