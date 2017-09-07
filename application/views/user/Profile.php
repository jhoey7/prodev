<section  class="tile border top blue" id="sectionProfile">
    <!-- tile header -->
    <div class="tile-header">
    	<h1><strong>Profile</strong> Karyawan</h1>
	</div>
    <!-- /tile header -->
    
    <form id="form-profile" name="form-profile" method="post" autocomplete="off" action="<?php echo site_url(); ?>/user/profile" >
        <input type="hidden" name="id" id="id" readonly="readonly" value="<?php echo $this->newsession->userdata('ID_KARYAWAN'); ?>" />
        <!-- tile body -->
        <div class="tile-body">
            <div class="row" id="row-1">
                <div class="form-group col-sm-4">
                    <label for="InputUsername">Username</label>
                    <input type="text" class="form-control" id="InputUsername" placeholder="Username" name="KARYAWAN[USERNAME]" wajib="yes" value="<?php echo $this->newsession->userdata("USER_NAME"); ?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="InputNama">Nama</label>
                    <input type="text" class="form-control" id="InputNama" placeholder="Nama" name="KARYAWAN[NAMA_KARYAWAN]" value="<?php echo $this->newsession->userdata("NAMA"); ?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="InputAlamat">Alamat</label>
                    <input type="text" class="form-control" id="InputAlamat" placeholder="Alamat" name="KARYAWAN[ALAMAT_KARYAWAN]" value="<?php echo $this->newsession->userdata("ALAMAT"); ?>">
                </div>
            </div>
            
            <div class="row">
                <div class="form-group col-sm-4">
                    <label for="InputHP">HP</label>
                    <input type="text" class="form-control" id="InputHP" placeholder="Handphone" name="KARYAWAN[NO_HP_KARYAWAN]" value="<?php echo $this->newsession->userdata("HP"); ?>">
                </div>
                <div class="form-group col-sm-4">
                    <label for="InputEmail">Email</label>
                    <input type="email" class="form-control" id="InputEmail" placeholder="Email" name="KARYAWAN[EMAIL_KARYAWAN]" value="<?php echo $this->newsession->userdata("EMAIL"); ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset-4 col-sm-8">
                    <a href="javascript:void(0)" onclick="saveData('#form-profile','_msg','sectionProfile')" class="btn btn-greensea" id="btnSave">
                    	<i class="fa fa-save"></i>&nbsp;Update
					</a>
                    <a href="javascript:void(0)" onclick="cancel('form-profile')" class="btn btn-red">
                    	<i class="fa fa-rotate-right"></i>&nbsp;Reset
					</a>&nbsp;<span class="_msg"></span>
                </div>
            </div>
        </div>
        <!-- /tile body -->
    </form>
</section>
<script>
	var id_divisi = '<?php echo $this->newsession->userdata("IDDIVISI"); ?>';
	var id_jabatan = '<?php echo $this->newsession->userdata("IDJABATAN"); ?>';
	$(document).ready(function(e) {
        $.get(site_url+'/karyawan/getData', function(data) { 
			//select option untuk jabatan
			$.each(data.jabatan, function(i,o) {
				$('#InputJabatan')
					.append($('<option></option>')
					.val(o.id_jabatan)
					.html(o.nama_jabatan));
			});
			
			//select option untuk divisi
			$.each(data.divisi, function(i,o) {
				$('#InputDivisi')
					.append($('<option ></option>')
					.val(o.id_divisi)
					.html(o.nama_divisi));
			});
			$("#act").val(data.act);
			$("#InputDivisi").val(id_divisi);
			$("#InputJabatan").val(id_jabatan);
		}, 'json');
    });
</script>