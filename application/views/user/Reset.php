<section  class="tile border top blue" id="sectionReset">
    <!-- tile header -->
    <div class="tile-header">
    	<h1><strong>Reset</strong> Password</h1>
	</div>
    <!-- /tile header -->
    
    <form id="form-reset-password" name="form-reset-password" method="post" autocomplete="off" action="<?php echo site_url(); ?>/user/reset_password" >
        <input type="hidden" name="id" id="id" readonly="readonly" value="<?php echo $this->newsession->userdata('ID_KARYAWAN'); ?>" />
        <!-- tile body -->
        <div class="tile-body">
            <div class="row" id="row-1">
                <div class="form-group col-sm-4">
                    <label for="old-password">Password Lama</label>
                    <input type="password" class="form-control" id="old-password" placeholder="Password Lama" name="password_lama" wajib="yes">
                </div>
                <div class="form-group col-sm-4">
                    <label for="new-password">Password Baru</label>
                    <input type="password" class="form-control" id="new-password" placeholder="Password Baru" name="password_baru" wajib="yes">
                </div>
                <div class="form-group col-sm-4">
                    <label for="re-type-password">Re-type Password Baru</label>
                    <input type="password" class="form-control" id="re-type-password" placeholder="Re-type Password" name="re_type_password">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-offset col-sm-8">
                    <a href="javascript:void(0)" onclick="resetPassword('#form-reset-password','_msg')" class="btn btn-greensea" id="btnSave">
                    	<i class="fa fa-save"></i>&nbsp;Update
					</a>
                    <a href="javascript:void(0)" onclick="cancel('form-reset-password')" class="btn btn-red">
                    	<i class="fa fa-rotate-right"></i>&nbsp;Reset
					</a>&nbsp;<span class="_msg"></span>
                </div>
            </div>
        </div>
        <!-- /tile body -->
    </form>
</section>
<script>
	function resetPassword(formid,divid){
		var password 	= '<?php echo $this->newsession->userdata('PASSWORD'); ?>';
		var oldPassword = $('#old-password').val();
		var newPassword = $('#new-password').val();
		var reTypePassword = $('#re-type-password').val();
		if (validasi(divid,formid)) {
			bootbox.confirm({
				message: "Apakah Anda yakin ingin mengganti Password Anda ?",
				buttons: {
					confirm: {
						label: 'Yes',
						className: 'btn-success'
					},
					cancel: {
						label: 'No',
						className: 'btn-danger'
					}
				},
				callback: function (r) {
					if(r==true){
						if(password != oldPassword){
							$(formid + " ." + divid).css('color', 'red');
							$(formid + " ." + divid).addClass('alert alert-red');
							$(formid + " ." + divid).html('Password Lama Anda tidak sesuai');
						}else if(newPassword != reTypePassword){
							$(formid + " ." + divid).css('color', 'red');
							$(formid + " ." + divid).addClass('alert alert-red');
							$(formid + " ." + divid).html('Password Baru Anda tidak sesuai');
						}else{
							$.ajax({
								type: "POST",
								url: $(formid).attr('action'),
								dataType: "json",
								data: $(formid).serialize(),
								beforeSend: function() {
									$(formid + " ." + divid).html('Plaease Wait...');
								},
								success: function(data) {
									if(data.status==="success"){
										$(formid + " ." + divid).css('color', 'green');
										$(formid + " ." + divid).addClass('alert alert-greensea');
										$(formid + " ." + divid).html(data.msg);
										setTimeout(function(){
											location.href = data.url;
										}, 3000);
									}else{
										$(formid + " ." + divid).css('color', 'red');
										$(formid + " ." + divid).addClass('alert alert-red');
										$(formid + " ." + divid).html(data.msg);
									}
								},error: function() {
									$(formid + " ." + divid).css('color', 'red');
									$(formid + " ." + divid).addClass('alert alert-red');
									$(formid + " ." + divid).html('Please Contact Your Administrator');
								}
							})
						}
					}else{
						bootbox.hideAll();
						$(formid + " ." + divid).html('').removeClass('alert alert-red');
					}
				}
			})
		}
	}
</script>