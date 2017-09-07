<div class="row cards">
	<div class="card-container col-lg-3 col-md-6 col-sm-12">
		<div class="card card-orange hover">
			<div class="front">        
				<h1>Total Pekerjaan</h1>
				<p id="users-count"><?php echo $jum_task; ?></p>
                <span class="fa-stack fa-2x pull-right">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-tasks fa-stack-1x"></i>
                </span>
			</div>
		</div>
	</div>

	<div class="card-container col-lg-3 col-md-6 col-sm-12">
		<div class="card card-red hover">
			<div class="front">        
                <h1>Pekerjaan Belum Selesai</h1>
                <p id="orders-count"><?php echo $jum_delay; ?></p>
                <span class="fa-stack fa-2x pull-right">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-tasks fa-stack-1x"></i>
                </span>
			</div>
		</div>
	</div>
    
    <div class="card-container col-lg-3 col-md-6 col-sm-12">
		<div class="card card-green hover">
			<div class="front">        
                <h1>Pekerjaan Sudah Selesai</h1>
                <p id="orders-count"><?php echo $jum_done; ?></p>
                <span class="fa-stack fa-2x pull-right">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-tasks fa-stack-1x"></i>
                </span>
			</div>
		</div>
	</div>
</div>
<div class="col-md-14">
	<!-- tile -->
	<section class="tile">
        <!-- tile header -->
        <div class="tile-header">
            <h1><strong>Time</strong> Line</h1>
        </div>
        <!-- /tile header -->

		<!-- tile body -->
		<div class="tile-body">
			<?php if($id_proyek) { ?>
            <div class="gantt"></div>
            <?php }else{ ?>
            <div class="null" style="text-align:center">Belum ada list pekerjaan</div>
            <?php } ?>
		</div>
		<!-- /tile body -->
	</section>
	<!-- /tile -->
</div>
<div class="row">
    <!-- col 8 -->
    <div class="col-lg-8 col-md-12">
        <!-- tile -->
        <section class="tile cornered">
            <!-- tile header -->
            <div class="tile-header">
                <h1><strong>Daftar</strong> Tasks</h1>
            </div>
            <!-- /tile header -->
            <!-- tile body -->
            <div class="tile-body nopadding">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableDashboard" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Proyek</th>
                                <th>Klien</th>
                                <th>PIC</th>
                                <th>Task</th>
                                <th>Status</th>
                                <th>End Date</th>
                                <th>End Finished</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /tile body -->
		</section>
		<!-- /tile -->
    </div>
    <!-- /col 8-->

	<!-- col 4 -->
	<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
		<!-- tile -->
		<section class="tile cornered">
            <!-- tile body -->
            <div class="tile-body">
            	<div id="morisTask" style="height: 250px;"></div>
            </div>
            <!-- /tile body -->
		</section>
		<!-- /tile -->
	</div>
	<!-- /col 4 -->
</div>
<?php if($id_proyek) { ?>
<script>
	$(function() {
		ganttChart(site_url + '/monitoring/getJson/<?php echo $this->azdgcrypt->crypt($id_proyek); ?>')
	});
</script>
<?php } ?>
<script>
	Morris.Donut({
		element: 'morisTask',
		data: [
			{label: "Ontrack", value: <?php echo $jum_ontarget; ?>},
			{label: "Overtime", value: <?php echo $jum_offtarget; ?>}
		],
		colors: ['#446CB3', '#96281B']
	});
	$(document).ready(function() {
		tableData('tableDashboard','<?php echo site_url('monitoring/getTable/'.$this->azdgcrypt->crypt($id_proyek)); ?>');
	});
</script>