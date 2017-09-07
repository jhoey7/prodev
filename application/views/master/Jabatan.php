<button type="button" class="btn btn-cyan margin-bottom-20" style="margin-top:-1em" onclick="showFormJabatan('add');" id="btnAddJabatan"><i class="fa fa-plus"></i>&nbsp;Tambah Jabatan</button>

<section  class="tile border top blue" id="sectionJabatan" style="display:none">
    <!-- tile header -->
    <div class="tile-header">
    	<h1><strong>Form Input</strong> Jabatan</h1>
	</div>
    <!-- /tile header -->
    
    <form id="form-jabatan" name="form-jabatan" method="post" autocomplete="off" action="<?php echo site_url(); ?>/master/setData" >
    	<input type="hidden" name="act" id="act" readonly="readonly" />
        <input type="hidden" name="id" id="id" readonly="readonly" />
        <input type="hidden" name="tipe" id="tipe" readonly="readonly" value="jabatan" />
        <!-- tile body -->
        <div class="tile-body">
            <div class="row" id="row-1">
                <div class="form-group col-sm-4">
                    <label for="nama_jabatan">Nama Jabatan</label>
                    <input type="text" class="form-control" id="nama_jabatan" placeholder="Nama Jabatan" name="JABATAN[NAMA_JABATAN]" wajib="yes">
                </div>
                <div class="form-group col-sm-4">
                    <label for="deskripsi_jabatan">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi_jabatan" placeholder="Deskripsi Jabatan" name="JABATAN[DESKRIPSI_JABATAN]">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset col-sm-8">
                    <a href="javascript:void(0)" onclick="saveData('#form-jabatan','_msg','sectionJabatan','tabelJabatan')" class="btn btn-greensea" id="btnSave">
                    	<i class="fa fa-save"></i>&nbsp;Simpan
					</a>
                    <a href="javascript:void(0)" onclick="cancel('form-jabatan')" class="btn btn-red">
                    	<i class="fa fa-rotate-right"></i>&nbsp;Reset
					</a>&nbsp;<span class="_msg"></span>
                </div>
            </div>
        </div>
        <!-- /tile body -->
    </form>
</section>
<section class="tile border top red">
	<!-- tile body -->
	<div class="tile-body nopadding">
		<div class="table-responsive">
            <table class="table table-datatable table-bordered" id="tabelJabatan" style="width:100%">
            	<thead>
                    <tr>
                    	<th>#</th>
                        <th>Nama Jabatan</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
		</div>
	</div>
	<!-- /tile body -->
</section>
<script>
	$(document).ready(function() {
		tableData('tabelJabatan','<?php echo site_url('master/jabatan');?>');
	});
	
	function showFormJabatan(act,id){
		if(act=='add'){
			var hidden = $('#sectionJabatan').css('display');
			if(hidden==="none"){
				$.get(site_url+'/master/getData/jabatan', function(data) {
					$("#act").val(data.act);
				}, 'json');
				cancel("form-jabatan");
				$("#sectionJabatan").show('slow');
			}else{
				$("#sectionJabatan").hide('slow');
			}
		} else if(act=='update') {
			$.ajax({
				type: "POST",
				url: site_url+'/master/getData/jabatan',
				dataType: "json",
				data: {'id':id},
				success: function(data) {
					$("#sectionJabatan").show('slow');
					$("#act").val(data.act);
					//difinisi id input
					$.each(data.postJabatan, function(key, value) {
						$("#" + key).val(value);
					});
				}
			}, 'json');
		}
	}
</script>