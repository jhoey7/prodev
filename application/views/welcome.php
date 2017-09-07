<?php
	$role = $this->newsession->userdata("IDJABATAN");
?>
<?php 
if($role!=6){
?>
<div class="row cards">
	<div class="card-container col-lg-3 col-md-6 col-sm-12">
		<div class="card card-green hover">
			<div class="front">        
				<h1>Total Proyek</h1>
				<p id="users-count"><?php echo $jum_proyek; ?></p>
                <span class="fa-stack fa-2x pull-right">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-newspaper-o fa-stack-1x"></i>
                </span>
			</div>
		</div>
	</div>

	<div class="card-container col-lg-3 col-md-6 col-sm-12">
		<div class="card card-orange hover">
			<div class="front">        
                <h1>Task Belum Selesai</h1>
                <p id="orders-count"><?php echo $jum_delay; ?></p>
                <span class="fa-stack fa-2x pull-right">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-tasks fa-stack-1x"></i>
                </span>
			</div>
		</div>
	</div>
    
	<div class="card-container col-lg-3 col-md-6 col-sm-12">
		<div class="card card-cyan hover">
			<div class="front">        
                <h1>Task Sudah Selesai</h1>
                <p id="sales-count"><?php echo $jum_done; ?></p>
                <span class="fa-stack fa-2x pull-right">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-check-square-o fa-stack-1x"></i>
                </span>
			</div>
		</div>
	</div>
	
	<?php if(in_array($role,array("3"))){ ?>
    <div class="card-container col-lg-3 col-md-6 col-sm-12">
        <div class="card card-red hover">
            <div class="front">        
                <h1>Off Target</h1>
                    <p id="visits-count"><?php echo $jum_offtarget; ?></p>
                    <span class="fa-stack fa-2x pull-right">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-thumb-tack fa-stack-1x"></i>
                </span>
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php if(in_array($role,array("3"))){ ?>
<div class="row cards">
    <div class="card-container col-lg-3 col-md-6 col-sm-12">
        <div class="card card-amethyst hover">
            <div class="front">        
                <h1>Karyawan Belum Dinilai</h1>
                    <p id="visits-count"><?php echo $jum_karyawan; ?></p>
                    <span class="fa-stack fa-2x pull-right">
                    <i class="fa fa-circle fa-stack-2x"></i>
                    <i class="fa fa-users fa-stack-1x"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<div class="row">
    <!-- col 8 -->
    <div class="col-lg-8 col-md-12">
        <!-- tile -->
        <section class="tile cornered">
            <!-- tile header -->
            <div class="tile-header">
           		<?php if(!in_array($role,array("3"))){ ?>
                <h1><strong>Daftar</strong> Task</h1>
                <?php } else { ?>
                <h1><strong>Daftar</strong> Proyek</h1>
                <?php } ?>
            </div>
            <!-- /tile header -->
            <!-- tile body -->
            <div class="tile-body nopadding">
                <div class="table-responsive">
                    <table class="table table-hover" id="tableDashboard">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Proyek</th>
                                <th>Klien</th>
                                <?php if(!in_array($role,array("3"))){ ?>
                                <th>Task</th>
                                <?php } ?>
                                <th>Status</th>
                                <th>End Date</th>
                                <?php if(!in_array($role,array("3"))){ ?>
                                <th>Task Finished</th>
                                <?php } ?>
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
            	<div id="morris-donut-example" style="height: 250px;"></div>
            </div>
            <!-- /tile body -->
		</section>
		<!-- /tile -->
	</div>
	<!-- /col 4 -->
</div>
<script>
	Morris.Donut({
		element: 'morris-donut-example',
		data: [
			{label: "Ontrack", value: <?php echo $jum_ontarget; ?>},
			{label: "Overtime", value: <?php echo $jum_offtarget; ?>}
		],
		colors: ['#446CB3', '#96281B']
	});
	$(document).ready(function() {
		//get data anggota
		tableData('tableDashboard','<?php echo site_url('home/getTask'); ?>');
	});
</script>
<?php
}else{
?>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <section class="tile cornered">
            <div class="tile-header">
            	Selamat Datang
            </div>
		</section>
	</div>
</div>
<?php } ?>