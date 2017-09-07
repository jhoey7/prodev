<div class="col-md-14">
    <section class="tile border top red">
        <!-- tile body -->
        <div class="tile-body">
        	<div class="row">
        		<div class="col-md-12">
                    <div class="tile-body nopadding">
                        <div class="table-responsive">
                            <table class="table table-datatable table-bordered" id="tableProject" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="1%">#</th>
                                        <th width="15%">Nama Proyek</th>
                                        <th width="11%">Tanggal Mulai</th>
                                        <th width="11%">Tanggal Selesai</th>
                                        <th width="14%">Deskripsi Proyek</th>
                                        <!--<th>Status Project</th>-->
                                        <th width="12%">Klien</th>
                                        <th width="12%">Proyek Manager</th>
                                        <th width="12%">Progress</th>
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
<script>
	$(document).ready(function() {
		tableData('tableProject','<?php echo site_url('project/loadData/header'); ?>');
	} );
	
	function actionProject(action,id){
		if(action=="view"){
			setTimeout(function(){
				location.href = site_url + '/project/' + action + '/' + id ;
			}, 1000);
		}
	}
</script>