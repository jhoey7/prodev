<div class="col-md-14">
    <section class="tile border top red">
        <!-- tile body -->
        <div class="tile-body">
        	<div class="row">
        		<div class="col-md-12">
                    <div class="tile-body nopadding">
                        <div class="table-responsive">
                            <table class="table table-datatable table-bordered" id="tablePenilaian" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Project</th>
                                        <th>Nama Klien</th>
                                        <th>Nama Karyawan</th>
                                        <th>Total Task</th>
                                        <th>On Target</th>
                                        <th>Overtime</th>
                                        <th>Action</th>
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
		tableData('tablePenilaian','<?php echo site_url('penilaian/loadData'); ?>');
	} );
</script>