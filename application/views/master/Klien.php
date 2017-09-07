<button type="button" class="btn btn-cyan margin-bottom-20" style="margin-top:-1em" onclick="showFormKlien('add');" id="btnAddKlien"><i class="fa fa-plus"></i>&nbsp;Tambah Klien</button>

<section  class="tile border top blue" id="sectionKlien" style="display:none">
    <!-- tile header -->
    <div class="tile-header">
    	<h1><strong>Form Input</strong> Klien</h1>
	</div>
    <!-- /tile header -->
    
    <form id="form-klien" name="form-klien" method="post" autocomplete="off" action="<?php echo site_url(); ?>/master/setData" >
    	<input type="hidden" name="act" id="act" readonly="readonly" />
        <input type="hidden" name="id" id="id" readonly="readonly" />
        <input type="hidden" name="tipe" id="tipe" readonly="readonly" value="klien" />
        <!-- tile body -->
        <div class="tile-body">
            <div class="row" id="row-1">
                <div class="form-group col-sm-4">
                    <label for="nama_klien">Nama Klien</label>
                    <input type="text" class="form-control" id="nama_klien" placeholder="Nama Klien" name="KLIEN[NAMA_KLIEN]" wajib="yes">
                </div>
                <div class="form-group col-sm-4">
                    <label for="deskripsi_klien">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi_klien" placeholder="Deskripsi Klien" name="KLIEN[DESKRIPSI_KLIEN]">
                </div>
                <div class="form-group col-sm-4">
                    <label for="status_klien">Status</label>
                    <select class="chosen-select form-control" id="status_klien" name="KLIEN[STATUS_KLIEN]">
                    	<option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset col-sm-8">
                    <a href="javascript:void(0)" onclick="saveData('#form-klien','_msg','sectionKlien','tabelKlien')" class="btn btn-greensea" id="btnSave">
                    	<i class="fa fa-save"></i>&nbsp;Simpan
					</a>
                    <a href="javascript:void(0)" onclick="cancel('form-klien')" class="btn btn-red">
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
            <table class="table table-datatable table-bordered" id="tabelKlien" style="width:100%">
            	<thead>
                    <tr>
                    	<th>#</th>
                        <th>Nama Klien</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
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
		tableData('tabelKlien','<?php echo site_url('master/klien'); ?>');
	});
	
	function showFormKlien(act,id){
		if(act=='add'){
			var hidden = $('#sectionKlien').css('display');
			if(hidden==="none"){
				$.get(site_url+'/master/getData/klien', function(data) {
					$("#act").val(data.act);
				}, 'json');
				cancel("form-klien");
				$("#sectionKlien").show('slow');
			}else{
				$("#sectionKlien").hide('slow');
			}
		}else if(act=='update'){
			$.ajax({
				type: "POST",
				url: site_url+'/master/getData/klien',
				dataType: "json",
				data: {'id':id},
				success: function(data) {
					$("#sectionKlien").show('slow');
					$("#act").val(data.act);
					//difinisi id input
					$.each(data.klien, function(key, value) {
						$("#" + key).val(value);
					});
				}
			}, 'json');
		}
	}
</script>