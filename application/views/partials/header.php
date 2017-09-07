<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
error_reporting(E_ERROR);
$parent = $this->uri->segment(1);
$child = $this->uri->segment(2);
?>
<!doctype html>
<html>
	<head>
        <title>P.M v.0.1</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=IE8">
    
        <link rel="icon" type="image/ico" href="<?php echo base_url(); ?>assets/images/favicon.ico" />
        <!-- Bootstrap -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
		<?php if($parent=="monitoring" || ($parent == "project" && $child=="view")) { ?>
        <link href="<?php echo base_url(); ?>assets/gant/style.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/gant/prettify.min.css" rel="stylesheet">
        <?php } ?>
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/animate.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/rickshaw.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-checkbox.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/chosen.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/chosen-bootstrap.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/js/plugins/tabdrop/css/tabdrop.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/morris.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/minoral.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap.css" rel="stylesheet">
    	<link href="<?php echo base_url(); ?>assets/css/jquery.jgrowl.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/datepicker3.css" rel="stylesheet">
        
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/jquery.nicescroll.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/blockui/jquery.blockUI.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/jquery.easypiechart.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/plugins/jquery.animateNumbers.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/plugins/datatables/ColReorderWithResize.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/datatables/tabletools/ZeroClipboard.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/plugins/rickshaw/raphael-min.js"></script> 
        <script src="<?php echo base_url(); ?>assets/js/plugins/rickshaw/d3.v2.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/rickshaw/rickshaw.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/plugins/skycons/skycons.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/plugins/jquery.sparkline.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/plugins/summernote/summernote.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/plugins/chosen/chosen.jquery.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/plugins/tabdrop/bootstrap-tabdrop.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris.min.js"></script>
    
        <script src="<?php echo base_url(); ?>assets/js/minoral.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootbox.js"></script>
    	<script src="<?php echo base_url(); ?>assets/js/plugins/jgrowl/jquery.jgrowl.min.js"></script>
    	<script src="<?php echo base_url(); ?>assets/js/plugins/datepicker/bootstrap-datepicker.js"></script>
        <?php if($parent=="monitoring" || ($parent == "project" && $child=="view")) { ?>
    	<script src="<?php echo base_url(); ?>assets/gant/js/jquery.cookie.min.js"></script>
    	<script src="<?php echo base_url(); ?>assets/gant/js/jquery.fn.gantt.js"></script>
    	<script src="<?php echo base_url(); ?>assets/gant/prettify.min.js"></script>
        <?php } ?>
        
        <script type="text/javascript">
          var base_url = "<?= base_url(); ?>";
          var site_url = "<?= site_url(); ?>";
        </script>
  
	</head>