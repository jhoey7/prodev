<button type="button" class="btn btn-danger margin-bottom-20" style="margin-top:-1em" onclick="showFormKaryawan('add');" id="btnAddUser"><i class="fa fa-plus"></i>&nbsp;Tambah Karyawan</button>

<section  class="tile border top blue" id="sectionKaryawan" style="display:none">
    <!-- tile header -->
    <div class="tile-header">
    	<h1><strong>Form Input</strong> Karywan</h1>
	</div>
    <!-- /tile header -->
    
    <form id="form-karyawan" name="form-karyawan" method="post" autocomplete="off" action="<?php echo site_url(); ?>/master/setData" >
    	<input type="hidden" name="act" id="act" readonly="readonly" />
        <input type="hidden" name="id" id="id" readonly="readonly" />
        <input type="hidden" name="tipe" id="tipe" readonly="readonly" value="karyawan" />
        <!-- tile body -->
        <div class="tile-body">
            <div class="row" id="row-1">
                <div class="form-group col-sm-4">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" placeholder="Username" name="KARYAWAN[USERNAME]" wajib="yes">
                </div>
                <div class="form-group col-sm-4" id="div-password">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="PASSWORD" wajib="yes">
                </div>
                <div class="form-group col-sm-4"  id="div-repeat-password">
                    <label for="re-password">Password repeat</label>
                    <input type="password" class="form-control" id="re-password" placeholder="Password repeat" name="repeatPassword" wajib="yes">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="nama_karyawan">Nama</label>
                    <input type="text" class="form-control" id="nama_karyawan" placeholder="Nama" name="KARYAWAN[NAMA_KARYAWAN]" wajib="yes">
                </div>
                <div class="form-group col-sm-4">
                    <label for="alamat_karyawan">Alamat</label>
                    <input type="text" class="form-control" id="alamat_karyawan" placeholder="Alamat" name="KARYAWAN[ALAMAT_KARYAWAN]">
                </div>
                <div class="form-group col-sm-4">
                    <label for="no_hp_karyawan">HP</label>
                    <input type="text" class="form-control" id="no_hp_karyawan" placeholder="Handphone" name="KARYAWAN[NO_HP_KARYAWAN]">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="InputEmail">Email</label>
                    <input type="email" class="form-control" id="email_karyawan" placeholder="Email" name="KARYAWAN[EMAIL_KARYAWAN]" wajib="yes">
                </div>
                <div class="form-group col-sm-4">
                    <label for="id_divisi">Divisi</label>
                    <select class="chosen-select form-control" id="id_divisi" name="KARYAWAN[ID_DIVISI]"></select>
                </div>
                <div class="form-group col-sm-4">
                    <label for="id_jabatan">Jabatan</label>
                    <select class="chosen-select form-control" id="id_jabatan" name="KARYAWAN[ID_JABATAN]"></select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-8">
                    <a href="javascript:void(0)" onclick="saveData('#form-karyawan','_msg','sectionKaryawan','tabelKaryawan')" class="btn btn-greensea" id="btnSave">
                    	<i class="fa fa-save"></i>&nbsp;Simpan
					</a>
                    <a href="javascript:void(0)" onclick="cancel('form-karyawan')" class="btn btn-red">
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
            <table class="table table-datatable table-bordered" id="tabelKaryawan" style="width:100%">
            	<thead>
                    <tr>
                    	<th>#</th>
                        <th>Username</th>
                        <th>Nama Karyawan</th>
                        <th>Alamat Karyawan</th>
                        <th>Telepon</th>
                        <th>Email</th>
                        <th>Divisi</th>
                        <th>Jabatan</th>
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
		tableData('tabelKaryawan','<?php echo site_url('master/karyawan'); ?>');
	} );
	
	function showFormKaryawan(act,id){	
		$('#id_jabatan option').remove();
		$('#id_divisi option').remove();
		if(act=='add'){
			var hidden = $('#sectionKaryawan').css('display');
			if(hidden==="none"){ 
				$.get(site_url+'/master/getData/karyawan', function(data) { 
					//select option untuk jabatan
					$.each(data.jabatan, function(i,o) {
						$('#id_jabatan')
							.append($('<option></option>')
							.val(o.id_jabatan)
							.html(o.nama_jabatan));
					});
					
					//select option untuk divisi
					$.each(data.divisi, function(i,o) {
						$('#id_divisi')
							.append($('<option ></option>')
							.val(o.id_divisi)
							.html(o.nama_divisi));
					});
					$("#act").val(data.act);
				}, 'json');
				
				$("#div-password").show();
				$("#div-repeat-password").show();
				$("#username").removeAttr('readonly');
				cancel("form-karyawan");
				$("#sectionKaryawan").show('slow');
			}else{
				$("#sectionKaryawan").hide('slow');
			}
		} else if(act=="update"){
			$.ajax({
				type: "POST",
				url: site_url+'/master/getData/karyawan',
				dataType: "json",
				data: {'id':id},
				success: function(data) {
					//select option untuk jabatan
					$.each(data.jabatan, function(i,o) {
						$('#id_jabatan')
							.append($('<option></option>')
							.val(o.id_jabatan)
							.html(o.nama_jabatan));
					});
					
					//select option untuk divisi
					$.each(data.divisi, function(i,o) {
						$('#id_divisi')
							.append($('<option ></option>')
							.val(o.id_divisi)
							.html(o.nama_divisi));
					});
					
					//define input
					$.each(data.karyawan, function(key, value) {
						$("#" + key).val(value);
						if(key=='username'){
							$("#" + key).attr('readonly','readonly');
						}
					});
					
					$("#sectionKaryawan").show('slow');
					$("#div-password").hide('slow');
					$("#div-repeat-password").hide('slow');
					$("#act").val(data.act);
				}
			}, 'json');
		}
	}
</script>