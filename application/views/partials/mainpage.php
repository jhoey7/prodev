<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
error_reporting(E_ERROR);
$dashboard="";$user="";$master="";$jabatan="";$divisi="";$klien="";$karyawan="";$proyek="";$create="";$list="";$monitoring="";$penilaian="";
$report="";$report_penilaian="";$report_pekerjaan="";
$parent = $this->uri->segment(1);
$child = $this->uri->segment(2);
if($parent=="master"){
	$master = "open";
	if($child=="jabatan"){
		$jabatan = 'class="active"';
	}elseif($child=="divisi"){
		$divisi = 'class="active"';
	}elseif($child=="klien"){
		$klien = 'class="active"';
	}elseif($child=="karyawan"){
		$karyawan = 'class="active"';
	}
}elseif($parent=="report"){
	$report = "open";
	if($child=="penilaian"){
		$report_penilaian = 'class="active"';
	}elseif($child=="pekerjaan"){
		$report_pekerjaan = 'class="active"';
	}
}elseif($parent=="project"){
	$proyek = "open";
	if($child=="daftar" || $child=="view") $list = 'class="active"';
	elseif($child=="create") $create = 'class="active"';
}elseif($parent=="monitoring"){
	$monitoring = 'class="active"';
}elseif($parent=="penilaian"){
	$penilaian = 'class="active"';
}elseif($parent==""){
	$dashboard = 'class="active"';
}
$role = $this->newsession->userdata('IDJABATAN');
?>
{_header_}
    <body class="lightgrey-scheme">
        <!-- Preloader -->
        <div class="mask"><div id="loader"></div></div>
        <!--/Preloader -->
    
        <!-- Wrap all page content here -->
        <div id="wrap">
            <!-- Make page fluid -->
            <div class="row">
                <!-- Fixed navbar -->
                <div class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <!-- Branding -->
                    <div class="navbar-header col-md-2">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>">
                            <strong>P.M</strong> <span class="divider vertical"></span> v.0.1
                        </a>
                        <div class="sidebar-collapse">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Branding end -->
    
                    <!-- .nav-collapse -->
                    <div class="navbar-collapse">
                        <!-- Content collapsing at 768px to sidebar -->
                        <div class="collapsing-content">
                            <!-- User Controls -->
                            <div class="user-controls">
                                <ul>
                                    <li class="dropdown messages">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                            <!--<span class="badge badge-red" id="user-new-messages">3</span>--> 
                                            <strong style="color:red;">{_welcome_}</strong> <i class="fa fa-angle-down-x">&nbsp;</i>
                                        </a>
                                        <div class="profile-photo">
                                            <img src="<?php echo  base_url(); ?>assets/images/profile-photo.jpg" alt />
                                        </div>
                                        <!--<ul class="dropdown-menu wide arrow red nopadding">
                                            <li><h1>You have <strong>3</strong> new messages</h1></li>
                                            <li>
                                                <a class="cyan" href="#">
                                                    <div class="profile-photo">
                                                        <img src="<?php echo  base_url(); ?>assets/images/ici-avatar.jpg" alt />
                                                    </div>
                                                    <div class="message-info">
                                                        <span class="sender">Ing. Imrich Kamarel</span>
                                                        <span class="time">12 mins</span>
                                                        <div class="message-content">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="green" href="#">
                                                    <div class="profile-photo">
                                                        <img src="<?php echo  base_url(); ?>assets/images/arnold-avatar.jpg" alt />
                                                    </div>
                                                    <div class="message-info">
                                                        <span class="sender">Arnold Karlsberg</span>
                                                        <span class="time">1 hour</span>
                                                        <div class="message-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <div class="profile-photo">
                                                        <img src="<?php echo  base_url(); ?>assets/images/profile-photo.jpg" alt />
                                                    </div>
                                                    <div class="message-info">
                                                        <span class="sender">John Douey</span>
                                                        <span class="time">3 hours</span>
                                                        <div class="message-content">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="red" href="#">
                                                    <div class="profile-photo">
                                                        <img src="<?php echo base_url(); ?>assets/images/peter-avatar.jpg" alt />
                                                    </div>
                                                    <div class="message-info">
                                                        <span class="sender">Peter Kay</span>
                                                        <span class="time">5 hours</span>
                                                        <div class="message-content">Ut enim ad minim veniam, quis nostrud exercitation</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="orange" href="#">
                                                    <div class="profile-photo">
                                                        <img src="<?php echo base_url(); ?>assets/images/george-avatar.jpg" alt />
                                                    </div>
                                                    <div class="message-info">
                                                        <span class="sender">George McCain</span>
                                                        <span class="time">6 hours</span>
                                                        <div class="message-content">Lorem ipsum dolor sit amet, consectetur adipisicing elit</div>
                                                    </div>
                                                </a>
                                            </li>
                                            <li><a href="#">Check all messages <i class="fa fa-angle-right"></i></a></li>
                                        </ul>
                                    </li>-->
    
                                    <li class="dropdown settings">
                                        <a class="dropdown-toggle options" data-toggle="dropdown" href="#">
                                            <i class="fa fa-cog"></i>
                                        </a>                    
                                        <ul class="dropdown-menu arrow">            
                                            <li>
                                                <a href="<?php echo site_url(); ?>/user/profile"><i class="fa fa-user"></i> Profile</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url(); ?>/user/reset_password"><i class="fa fa-key"></i> Change Password</a>
                                            </li>                
                                            <!--<li>
                                                <a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge badge-red" id="user-inbox">3</span></a>
                                            </li>  -->              
                                            <li class="divider"></li>                
                                            <li>
                                                <a href="<?php echo site_url(); ?>/user/logout"><i class="fa fa-power-off"></i> Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <!-- User Controls end -->
                        </div>
                        <!-- /Content collapsing at 768px to sidebar -->
                        
                        <!-- Sidebar -->
                        <ul class="nav navbar-nav side-nav" id="navigation">
                            <li class="collapsed-content">
                                <!-- Collapsed content pasting here at 768px -->
                            </li>
                            <li class="user-status status-online" id="user-status">
                                <div class="profile-photo">
                                    <img src="<?php echo base_url(); ?>assets/images/profile-photo.jpg" alt />
                                </div>
                                <div class="user">
                                    <strong>{_welcome_}</strong>
                                    <span class="role">{_role_}</span>
                                    <div class="status">
                                        <ul>
                                            <li class="dropdown change-status">
                                                <a class="dropdown-toggle my-status" data-toggle="dropdown" href="#">Online</a>
                                                <!--<ul class="dropdown-menu arrow">
                                                    <li>
                                                        <a href="#" id="status-online" data-status="status-online">Online</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" id="status-away" data-status="status-away">Away</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" id="status-invisible" data-status="status-invisible">Invisible</a>
                                                    </li>
                                                </ul>-->
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li <?php echo $dashboard; ?>>
                                <a href="<?php echo base_url(); ?>" title="Dashboard">
                                    <i class="fa fa-dashboard">
                                        <span class="overlay-label red"></span>
                                    </i> 
                                    Dashboard 
                                    <!--<b class="fa fa-angle-left dropdown-arrow"></b>
                                    <span class="badge badge-cyan">1</span>-->
                                </a>
                                <!--<ul class="dropdown-menu">
                                    <li class="active">
                                        <a href="index.html" title="Overview">
                                            <i class="fa fa-eye"><span class="overlay-label red80"></span></i>
                                            Overview
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mail.html" title="Inbox">
                                            <i class="fa fa-envelope"><span class="overlay-label red60"></span></i>
                                            Inbox
                                        </a>
                                    </li>
                                </ul>-->
                            </li>
                            <?php if($role==6){ ?>
                            <li class="dropdown <?php echo $master; ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Master">
                                    <i class="fa fa-suitcase">
                                        <span class="overlay-label green"></span>
                                    </i>
                                    Master <b class="fa fa-angle-left dropdown-arrow"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li <?php echo $jabatan; ?>>
                                        <a href="<?php echo site_url(); ?>/master/jabatan" title="Jabatan">
                                            <i class="fa fa-address-card-o"><span class="overlay-label green80"></span></i>
                                            Jabatan
                                        </a>
                                    </li>
                                    <li <?php echo $divisi; ?>>
                                        <a href="<?php echo site_url(); ?>/master/divisi" title="Divisi">
                                            <i class="fa fa-university"><span class="overlay-label green60"></span></i>
                                            Divisi
                                        </a>
                                    </li>
                                    <li <?php echo $klien; ?>>
                                        <a href="<?php echo site_url(); ?>/master/klien" title="Proyek">
                                            <i class="fa fa-handshake-o"><span class="overlay-label green60"></span></i>
                                            Klien
                                        </a>
                                    </li>
                                    <li <?php echo $karyawan; ?>>
                                    	<a href="<?php echo site_url(); ?>/master/karyawan" title="Karyawan">
                                            <i class="fa fa-user">
                                                <span class="overlay-label orange"></span>
                                            </i> 
                                            Karyawan 
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php 
							} 
							if(in_array($role,array('1','2','3','4','5'))){
							?>
                            <li class="dropdown <?php echo $proyek; ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Proyek">
                                    <i class="fa fa-list">
                                        <span class="overlay-label green"></span>
                                    </i>
                                    Proyek <b class="fa fa-angle-left dropdown-arrow"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li <?php echo $list; ?>>
                                        <a href="<?php echo site_url(); ?>/project/daftar" title="List Project">
                                            <i class="fa fa-bar-chart-o">
                                                <span class="overlay-label green80"></span>
                                            </i> 
                                            List Proyek 
                                        </a>
                                    </li>
                                    <?php if(in_array($role,array('3'))){ ?>
                                    <li <?php echo $create; ?>>
                                        <a href="<?php echo site_url(); ?>/project/create" title="Tambah Project">
                                            <i class="fa fa-plus">
                                                <span class="overlay-label green80"></span>
                                            </i> 
                                            Tambah Proyek 
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php 
							} 
							if(in_array($role,array("3"))) {
							?>
                            <li <?php echo $monitoring; ?>>
                            	<a href="<?php echo site_url('/monitoring/view'); ?>" title="Monitoring">
                                    <i class="fa fa-eye">
                                        <span class="overlay-label greensea"></span>
                                    </i> 
                                    Monitoring Proyek 
                                    <!--<b class="fa fa-angle-left dropdown-arrow"></b>
                                    <span class="badge badge-cyan">1</span>-->
                                </a>
                            </li>
                            <li <?php echo $penilaian; ?>>
                            	<a href="<?php echo site_url('/penilaian/daftar'); ?>" title="Penilaian">
                                    <i class="fa fa-line-chart">
                                        <span class="overlay-label drank"></span>
                                    </i> 
                                    Penilaian 
                                    <!--<b class="fa fa-angle-left dropdown-arrow"></b>
                                    <span class="badge badge-cyan">1</span>-->
                                </a>
                            </li>
                            <li class="dropdown <?php echo $report; ?>">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Report">
                                    <i class="fa fa-bar-chart">
                                        <span class="overlay-label amethyst"></span>
                                    </i>
                                    Report <b class="fa fa-angle-left dropdown-arrow"></b>
                                </a>
                                <ul class="dropdown-menu">
                                    <li <?php echo $report_pekerjaan; ?>>
                                        <a href="<?php echo site_url(); ?>/report/pekerjaan" title="Report Proyek">
                                            <i class="fa fa-book">
                                                <span class="overlay-label amethyst80"></span>
                                            </i> 
                                            Report Proyek 
                                        </a>
                                    </li>
                                    <li <?php echo $report_penilaian; ?>>
                                        <a href="<?php echo site_url(); ?>/report/penilaian" title="Report Penilaian">
                                            <i class="fa fa-money">
                                                <span class="overlay-label amethyst80"></span>
                                            </i> 
                                            Report Penilaian 
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <?php } ?>
                        </ul>
                        <!-- Sidebar end -->
                    </div>
                    <!--/.nav-collapse -->
                </div>
                <!-- Fixed navbar end -->
                
                <!-- Page content -->
                <div id="content" class="col-md-12">
                    
                    <!-- breadcrumbs -->
                    <div class="breadcrumbs">
                        <ol class="breadcrumb">
                            {_bradcrumb_}
                        </ol>
                    </div>
                    <!-- /breadcrumbs -->
    
                    <!-- content main container -->
                    <div class="main">
                		{_content_}
                    </div>
                    <!-- /content container -->
                    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirmLabel" aria-hidden="true"></div>
            
                </div>
                <!-- Page content end -->
        
            </div>
            <!-- Make page fluid-->
        
        </div>
        <!-- Wrap all page content end -->
        <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirmLabel" aria-hidden="true"></div>
    </body>
</html>
