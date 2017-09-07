<?php
	if($data["bobot_pekerjaan"]=="Low"){
		$class = 'class="success"';
	}elseif($data["bobot_pekerjaan"]=="Medium"){
		$class = 'class="warning"';
	}else{
		$class = 'class="danger"';
	}
?>
<div class="modal-dialog" style="width:60% !important;">
	<form id="pic_task" name="pic_task" method="post" action="<?php echo site_url('project/setData/pic'); ?>">
    	<input type="hidden" name="id_pekerjaan" id="id_pekerjaan" value="<?php echo $idPekerjaan; ?>" readonly />
    	<input type="hidden" name="id_proyek" id="id_proyek" value="<?php echo $idProyek; ?>" readonly />
		<div class="modal-content">
			<div class="modal-header" style="background-color:#f8f8f8 !important;">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title thin" id="modalConfirmLabel">Pilih PIC</h3>
			</div>
			<div class="modal-body">
            	<section  class="tile border top blue">
                	<div class="tile-body">
                    	<div class="row">
                        	<div class="col-md-12">
                            	<div class="tile-body nopadding">
                                    <table class="table">
                                      <thead>
                                        <tr>
                                          <th>Nama Pekerjaan</th>
                                          <th>Bobot</th>
                                          <th>Start Date</th>
                                          <th>End Date</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr <?php echo $class; ?>>
                                          <td><?php echo $data['deskripsi_pekerjaan']; ?></td>
                                          <td><?php echo $data['bobot_pekerjaan']; ?></td>
                                          <td><?php echo date('d F Y',strtotime($data['tanggal_awal_pekerjaan'])); ?></td>
                                          <td><?php echo date('d F Y',strtotime($data['tanggal_akhir_pekerjaan'])); ?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                
                                  </div>
                            </div>
						</div>
					</div>
				</section>
            	<section class="tile border top red">
                	<div class="tile-body nopadding">
                    	<div class="table-responsive">
                            <table class="table table-datatable table-bordered" id="tablePIC" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="59%">Nama Karyawan</th>
                                        <th width="20%">Jabatan</th>
                                        <th width="20%">Status Pekerjaan</th>
                                    </tr>
                                </thead>
                            </table>
                    	</div>
                	</div>
            	</section>
			</div>
            <div class="modal-footer">
                <a href="javascript:void(0);" class="btn btn-greensea" onClick="savePic();">Simpan</a>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
		</div>
    </form>
</div>
<script>
	$(document).ready(function() {
		//get tasklist
		tableData('tablePIC','<?php echo site_url('project/pic/pic/'.$this->azdgcrypt->crypt($thpPekerjaan)); ?>');
	} );
	
	function savePic(){
		if($('input.radio').is(':checked')){
			$.ajax({
				type: "POST",
				dataType: "json",
				url: $("#pic_task").attr('action'),
				data: $("#pic_task").serialize(),
				success: function(data) { console.log(data.status);
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
					$.jGrowl('Terjadi Kesalahan, silahkan hubungi Administrator Anda.', {
						beforeOpen: function(e,m,o){
							$(e).width( "300px" );
						}
					});
				}
			});
		}else{
			$.jGrowl('Silahkan pilih PIC terlebih dahulu.', {
				beforeOpen: function(e,m,o){
					$(e).width( "300px" );
				}
			});
		}
	}
</script>