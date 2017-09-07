<!-- Main content -->
<section class="content" style="margin-top:-25px !important;">
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-4">
				<div class="form-group">
                    <h4><b>Nama Proyek</b> </h4>
                    <?php echo $nama_proyek; ?>
                </div>
			</div>

            <div class="col-md-4">
                <div class="form-group">
                    <h4><b>Pelaksana</b></h4>
                    <?php echo $nama_karyawan; ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    <h4><b>Nama Klien</b></h4>
                    <?php echo $nama_klien; ?>
            	</div>
			</div>  
		</div>  
	</div>
</section>
<div class="col-md-12">
    <div class="card">
		<?php if($this->newsession->userdata("IDJABATAN")==3){ ?>
        <a href="javascript:void(0)" class="btn btn-info margin-bottom-20" id="btnAddTask" onClick="showFromTask('add')"><i class="fa fa-plus"></i>&nbsp;Tambah Task</a>
        <section  class="tile border top blue" id="sectionTask" style="display:none;">
            <form id="form-task" name="form-task" method="post" autocomplete="off" action="<?php echo site_url(); ?>/project/setData/task">
                <input type="hidden" name="act" id="act" readonly="readonly" />
                <input type="hidden" name="id_pekerjaan" id="id_pekerjaan" readonly="readonly" />
                <input type="hidden" name="TASK[ID_PROYEK]" id="id_proyek" readonly="readonly" value="<?php echo $id_proyek; ?>" />
                <div class="tile-body">
                    <div class="row" id="row-1">
                        <div class="form-group col-sm-4">
                            <label for="tanggal_awal_pekerjaan">Tanggal Mulai</label>
                            <input type="text" class="form-control" id="tanggal_awal_pekerjaan" placeholder="dd/mm/yyyy" wajib="yes" name="TASK[TANGGAL_AWAL_PEKERJAAN]" />
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="tanggal_akhir_pekerjaan">Tanggal Selesai</label>
                            <input type="text" class="form-control" id="tanggal_akhir_pekerjaan" placeholder="dd/mm/yyyy" wajib="yes" name="TASK[TANGGAL_AKHIR_PEKERJAAN]" />
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="deskripsi_pekerjaan">Task</label>
                            <textarea class="form-control" id="deskripsi_pekerjaan" placeholder="Task" wajib="yes" name="TASK[DESKRIPSI_PEKERJAAN]"></textarea>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-sm-4">
                            <label for="bobot_pekerjaan">Bobot Pekerjaan</label>
                            <select id="bobot_pekerjaan" class="form-control" wajib="yes" name="TASK[BOBOT_PEKERJAAN]">
                                <option value="">-- Pilih Data --</option>
                                <option value="1">Low</option>
                                <option value="2">Medium</option>
                                <option value="3">High</option>
                            </select>
                            
                        </div>
                        <div class="form-group col-sm-4">
                            <label for="tahap_pekerjaan">Tahap Pekerjaan</label>
                            <select id="tahap_pekerjaan" class="form-control" wajib="yes" name="TASK[TAHAP_PEKERJAAN]">
                                <option value="">-- Pilih Data --</option>
                                <option value="1">Analisisi</option>
                                <option value="2">Develoment</option>
                                <option value="3">Testing</option>
                                <option value="4">Dokumentasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-offset col-sm-8">
                            <a href="javascript:void(0)" onclick="saveData('#form-task','_msg','sectionTask','tableTask')" class="btn btn-greensea" id="btnSave">
                                <i class="fa fa-save"></i>&nbsp;Simpan
                            </a>
                            <a href="javascript:void(0)" onclick="cancel('form-task')" class="btn btn-red">
                                <i class="fa fa-rotate-right"></i>&nbsp;Reset
                            </a>&nbsp;<span class="_msg"></span>
                        </div>
                    </div>
                </div>
                <!-- /tile body -->
            </form>
        </section>
        <?php } ?>
        <?php if($this->newsession->userdata("IDJABATAN")==3) { ?>
        <div class="col-md-14">
            <section class="tile border top red">
                <div class="tile-body">
                    <div class="row">
                        <div class="col-md-12">
                        	<b>Time Line</b>
                        	<div class="gantt"></div>
                        </div>
					</div>
				</div>
			</section>
		</div>
        <?php } ?>
        <div class="col-md-14">
            <section class="tile border top red">
                <div class="tile-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tile-body nopadding">
                                <div class="table-responsive">
                                    <table class="table table-datatable table-bordered" id="tableTask" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th width="2%">#</th>
                                                <th width="12%">Pekerjaan</th>
                                                <th width="7%">Bobot</th>
                                                <th width="9%">Start</th>
                                                <th width="9%">End</th>
                                                <th width="10%">PIC</th>
                                                <th width="12%">Tahap Pekerjaan</th>
                                                <th width="9%">Progres</th>
                                                <?php if($this->newsession->userdata("IDJABATAN")==3){ ?>
                                                <th width="7%">Telat?</th>
                                                <?php } ?>
                                                <th width="12%">Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    	</div>
    </div>
</div>
<script>
	$('#tanggal_awal_pekerjaan').datepicker({
		todayHighlight: false,
		format: 'dd/mm/yyyy',
		startDate: new Date('<?php echo $tanggal_awal_proyek; ?>'),
		endDate: new Date('<?php echo $tanggal_akhir_proyek; ?>'),
		autoclose: true,
	}).on('changeDate', function (selected) {
		var temp = $(this).datepicker('getDate');
		var d = new Date(temp);
		var minDate = d.setDate(d.getDate() + 1);
        $('#tanggal_akhir_pekerjaan').datepicker('setStartDate', new Date(minDate));
	});
	$('#tanggal_akhir_pekerjaan').datepicker({
		todayHighlight: false,
		format: 'dd/mm/yyyy',
		autoclose: true,
		endDate: new Date('<?php echo $tanggal_akhir_proyek; ?>')
	});
	$(document).ready(function() {
		//get tasklist
		tableData('tableTask','<?php echo site_url('project/loadData/task/'.$this->azdgcrypt->crypt($id_proyek)); ?>');
	} );
	
	function showFromTask(act,id){
		$('#form-task #id_karyawan option').remove();
		if(act=='add'){
			var hidden = $('#sectionTask').css('display');
			if(hidden==="none"){
				cancel("form-task");
				$("#sectionTask").show('slow');
			}else{
				$("#sectionTask").hide('slow');
			}
			$("#form-task #act").val('save');
		}else if(act=='update'){
			$.get(site_url+'/project/getTask/<?php echo $this->azdgcrypt->crypt($id_proyek); ?>/'+id, function(data) { 				
				//define input
				$.each(data.arrayData, function(key, value) {
					$("#form-task #" + key).val(value);
				});
				
				$("#sectionTask").show('slow');
				$("#form-task #act").val('update');
			}, 'json');
		}
	}
	<?php if($this->newsession->userdata("IDJABATAN")==3) { ?>
	$(function() {
		ganttChart(site_url + '/monitoring/getJson/<?php echo $this->azdgcrypt->crypt($id_proyek); ?>');
	});
	<?php } ?>
</script>