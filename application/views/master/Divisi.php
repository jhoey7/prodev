<button type="button" class="btn btn-cyan margin-bottom-20" style="margin-top:-1em" onclick="showFormDivisi('add');" id="btnAddDivisi"><i class="fa fa-plus"></i>&nbsp;Tambah Divisi</button>

<section  class="tile border top blue" id="sectionDivisi" style="display:none">
    <!-- tile header -->
    <div class="tile-header">
    	<h1><strong>Form Input</strong> Divisi</h1>
	</div>
    <!-- /tile header -->
    
    <form id="form-divisi" name="form-divisi" method="post" autocomplete="off" action="<?php echo site_url(); ?>/master/setData" >
    	<input type="hidden" name="act" id="act" readonly="readonly" />
        <input type="hidden" name="id" id="id" readonly="readonly" />
        <input type="hidden" name="tipe" id="tipe" readonly="readonly" value="divisi" />
        <!-- tile body -->
        <div class="tile-body">
            <div class="row" id="row-1">
                <div class="form-group col-sm-4">
                    <label for="nama_divisi">Nama Divisi</label>
                    <input type="text" class="form-control" id="nama_divisi" placeholder="Nama Divisi" name="DIVISI[NAMA_DIVISI]" wajib="yes">
                </div>
                <div class="form-group col-sm-4">
                    <label for="deskripsi_divisi">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi_divisi" placeholder="Deskripsi Jabatan" name="DIVISI[DESKRIPSI_DIVISI]">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset col-sm-8">
                    <a href="javascript:void(0)" onclick="saveData('#form-divisi','_msg','sectionDivisi','tabelDivisi')" class="btn btn-greensea" id="btnSave">
                    	<i class="fa fa-save"></i>&nbsp;Simpan
					</a>
                    <a href="javascript:void(0)" onclick="cancel('form-divisi')" class="btn btn-red">
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
            <table class="table table-datatable table-bordered" id="tabelDivisi" style="width:100%">
            	<thead>
                    <tr>
                    	<th>#</th>
                        <th>Nama Divisi</th>
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
		tableData('tabelDivisi','<?php echo site_url('master/divisi');?>');
	});
	
	function showFormDivisi(act,id){
		if(act=='add'){
			var hidden = $('#sectionDivisi').css('display');
			if(hidden==="none"){
				$.get(site_url+'/master/getData/divisi', function(data) {
					$("#act").val(data.act);
				}, 'json');
				cancel("form-divisi");
				$("#sectionDivisi").show('slow');
			}else{
				$("#sectionDivisi").hide('slow');
			}
		} else if(act=='update') {
			$.ajax({
				type: "POST",
				url: site_url+'/master/getData/divisi',
				dataType: "json",
				data: {'id':id},
				success: function(data) {
					$("#sectionDivisi").show('slow');
					$("#act").val(data.act);
					//difinisi id input
					$.each(data.postDivisi, function(key, value) {
						$("#" + key).val(value);
					});
				}
			}, 'json');
		}
	}
</script>