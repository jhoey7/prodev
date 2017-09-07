$(function(){

  /*********************************/
  /* multilevel dropdowns function */
  /*********************************/
  
  $('li.dropdown-submenu a.dropdown-toggle').on('click', function(event) {
    // Avoid following the href location when clicking
    event.preventDefault(); 
    // Avoid having the menu to close when clicking
    event.stopPropagation();
    // If a menu is already open we close it
    if ($(this).parent().hasClass('open')) {
      $(this).parent().removeClass('open');
    // opening the one you clicked on
    } else if (!$(this).parent().hasClass('open')) {
      $('li.dropdown-submenu.open').removeClass('open');
      $(this).parent().addClass('open');
    }
    // resize scrollbar
    $("#navigation").getNiceScroll().resize();
  });

  /************************************/
  /* sidebar menu dropdowns functions */
  /************************************/
  $('#navigation .dropdown.open').data('closable', false);

  $('#navigation .dropdown').on({
    "shown.bs.dropdown": function() {
      $(this).data('closable', false);
      // resize scrollbar
      $("#navigation").getNiceScroll().resize();
    },
    "click": function() {
      $(this).data('closable', true);
      if (!$(this).hasClass('open') && !$(this).hasClass('change-status')) {
        $('li.dropdown.open').removeClass('open');
      }
      // resize scrollbar
      $("#navigation").getNiceScroll().resize();
    },
    "hide.bs.dropdown": function() {
      return $(this).data('closable');
      // resize scrollbar
      $("#navigation").getNiceScroll().resize();
    }
  });

  /*******************************/
  /* sidebar collapsing function */
  /*******************************/

  $('.sidebar-collapse a').on('click', function(){
    // Add or remove class collapsed
    $('#navigation').toggleClass('collapsed');
    
    if ($('#navigation').hasClass('collapsed')) {
      
      //make tooltiops active
      if ($('body').hasClass('direction-rtl')) {
        var placement = 'left';
      } else {
        var placement = 'right';
      }

      $('#navigation li a').tooltip({
        placement: placement,
        trigger: 'hover',
        html : true,
        container: 'body'
      });    

      if ($(window).width() < 768) {
        //if width is less than 768px move content to left 0px
        if ($('body').hasClass('direction-rtl')) {
          $('#content').animate({right: "0px"},150)
        } else {
          $('#content').animate({left: "0px"},150)
        }
      }
      else {
        //if width is not less than 768px give padding 55px to content
        if ($('body').hasClass('direction-rtl')) {
          $('#content').animate({paddingRight: "55px"},150)
        } else {
          $('#content').animate({paddingLeft: "55px"},150)
        }
      }

    } else {

      //destroy tooltips
      $('#navigation li a').tooltip('destroy');

      if ($(window).width() < 768) {
        //if width is less than 768px move content to left 210px
        if ($('body').hasClass('direction-rtl')) {
          $('#content').animate({right: "210px"},150)
        } else {
          $('#content').animate({left: "210px"},150)
        }      
      }
      else {
        //if width is not less than 768px give padding 265px to content
        if ($('body').hasClass('direction-rtl')) {
          $('#content').animate({paddingRight: "265px"},150)
        } else {
          $('#content').animate({paddingLeft: "265px"},150)
        }  
      }
    }

  });

  /*******************************/
  /* submenu collapsing function */
  /*******************************/

  $('#submenutoggle').click(function(){
    $(this).parent().parent().toggleClass('open');
  });

  var submenuWidth = 0;
  $('#content .submenu > *').not('.collapsed').each(function() { submenuWidth += $(this).width(); })
  
  var forceCollapsedSubmenu = function() {
    if ($(window).width() < (submenuWidth + 285)) {
      $('#content .submenu').addClass('force-collapse');
    } else {
      $('#content .submenu').removeClass('force-collapse');
    }
  };

  forceCollapsedSubmenu();

  $(window).resize(function() {
    forceCollapsedSubmenu();
  });

  /******************/
  /* main scrollbar */
  /******************/

  if ($('body').hasClass('direction-rtl')) {
    var scrollPlacement = 'left';
  } else {
    var scrollPlacement = 'right';
  }


  $("#content").not('.full-width').niceScroll({
    cursorcolor: '#000000',
    zindex: 999999,
    bouncescroll: true,
    cursoropacitymax: 0.4,
    cursorborder: '',
    cursorborderradius: 7,
    cursorwidth: '7px',
    background: 'rgba(0,0,0,.1)',
    autohidemode: false,
    railpadding: {top:0,right:2,left:2,bottom:0},
    railalign: scrollPlacement
  });

  /************************/
  /* navigation scrollbar */
  /************************/

  $("#navigation").niceScroll({
    cursorcolor: '#000000',
    zindex: 999999,
    bouncescroll: true,
    cursoropacitymax: 0.4,
    cursorborder: '',
    cursorborderradius: 0,
    cursorwidth: '4px',
    railalign: 'left',
    railoffset: {top:60,left:0}
  });

  /**************************************/
  /* run this function if window resize */
  /**************************************/

  var widthLess768 = function(){
    
    if ($(window).width() < 768) {
      var collapsedContent = $('.navbar-collapse .collapsing-content').html()
      
      //hide top navbar objects
      $('.navbar-collapse .collapsing-content').hide();
      
      //paste top navbar objects to sidebar
      $('.collapsed-content').html(collapsedContent);

      //make tooltiops active
      if ($('body').hasClass('direction-rtl')) {
        var placement = 'left';
      } else {
        var placement = 'right';
      }

      $('#navigation li a').tooltip({
        placement: placement,
        trigger: 'hover',
        html : true,
        container: 'body'
      });   

      //make navigation collapsed
      $('#navigation').addClass('collapsed');

      //move content if navigation is collapsed
      if ($('body').hasClass('direction-rtl')) {
        if ($('#navigation').hasClass('collapsed')) {
          $('#content').animate({right: "0px",paddingRight: "55px"},150)
        } else {
          $('#content').animate({paddingRight: "55px"},150)
        };
      } else {
        if ($('#navigation').hasClass('collapsed')) {
          $('#content').animate({left: "0px",paddingLeft: "55px"},150)
        } else {
          $('#content').animate({paddingLeft: "55px"},150)
        };
      }

      //page refresh function
      $('.page-refresh').click(function() {
        location.reload();
      });

      /**************************/
      /* color schemes tooltips */
      /**************************/
      $('#color-schemes li a').tooltip({
        placement: 'bottom',
        trigger: 'hover',
        html : true,
        container: 'body'
      });

      /**********************************/
      /* color scheme changing function */
      /**********************************/

      $('#color-schemes li a').click(function(){
        var scheme = $(this).attr('class');
        var lastClass = $('body').attr('class').split(' ').pop();

        $('body').removeClass(lastClass).addClass(scheme);
      });

    }

    else {

      //show content of top navbar
      $('.navbar-collapse .collapsing-content').show();
      
      //remove top navbar objects from sidebar
      $('.collapsed-content').html('');

      //tooltips destroy
      $('#navigation li a').tooltip('destroy');

      //make navigation not collapsed
      $('#navigation').removeClass('collapsed');

      //move content if navigation is not collapsed
      if ($('body').hasClass('direction-rtl')) {
        if ($('#navigation').hasClass('collapsed')) {
          $('#content').animate({right: "210px",paddingRight: "265px"},150)
        } else {
          $('#content').animate({paddingRight: "265px"},150)
        };
      } else {
        if ($('#navigation').hasClass('collapsed')) {
          $('#content').animate({left: "210px",paddingLeft: "265px"},150)
        } else {
          $('#content').animate({paddingLeft: "265px"},150)
        };
      }    
    }  

  };

  /**************************************/
  /* run this function after page ready */
  /**************************************/

  widthLess768();

  /**************************************/
  /* run this functions if window resize */
  /**************************************/

  $(window).resize(function() {
    //if submenu is opened close it
    $('.submenu').removeClass('open');

    widthLess768();

  });

  /*************************/
  /* page refresh function */
  /************************/

  $('.page-refresh').click(function() {
    location.reload();
  });

  /************************************************/
  /* ADD ANIMATION TO TOP MENU & SUBMENU DROPDOWN */
  /************************************************/

  $('.quick-action.dropdown, .submenu .nav .dropdown, .messages.dropdown, .settings.dropdown, .change-status.dropdown').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').addClass('animated fadeInDown');
    $(this).find('#user-inbox').addClass('animated bounceIn');
  });

  $('#navigation .dropdown').on('show.bs.dropdown', function(e){
    $(this).find('.dropdown-menu').addClass('animated fadeInDown');
  });

  /****************************/
  /* status changing function */
  /****************************/

  $('#user-status .dropdown li a').click(function(){
    var status = $(this).data('status');
    var lastClass = $('#user-status').attr('class').split(' ').pop();
    var myStatus = $(this).html();

    $('#user-status').removeClass(lastClass).addClass(status);
    $('#user-status .my-status').html(myStatus);
  });

  /**************************/
  /* color schemes tooltips */
  /**************************/
  
  $('#color-schemes li a').tooltip({
    placement: 'bottom',
    trigger: 'hover',
    html : true,
    container: 'body'
  });

  /**********************************/
  /* color scheme changing function */
  /**********************************/

  $('#color-schemes li a').click(function(){
    var scheme = $(this).attr('class');
    var lastClass = $('body').attr('class').split(' ').pop();

    $('body').removeClass(lastClass).addClass(scheme);
  });


  /**************************/
  /* block element function */
  /**************************/

  function elBlock(el) {    
    $(el).block({
      message: '<div class="el-reloader"></div>',
      overlayCSS: {
        opacity: 0.6,
        cursor: 'wait',
        backgroundColor: '#fff',
      },
      css: {
        padding: '5px',
        border: '0',
        backgroundColor: 'transparent'
      }
    });
  };
   
  /****************************/
  /* unblock element function */
  /****************************/

  function elUnblock(el) {
    $(el).unblock();
  };

  /*************************/
  /* tile refresh function */
  /*************************/

  $('.tile-header .controls .refresh').click(function() { 
    var el = $(this).parent().parent().parent();
    elBlock(el);
    window.setTimeout(function() {
      elUnblock(el);
    }, 1000);

    return false;
  });

  /************************/
  /* tile remove function */
  /************************/

  $('.tile-header .controls .remove').click(function() {
    $(this).parent().parent().parent().addClass('animated fadeOut');
    $(this).parent().parent().parent().attr('id', 'el_remove');
     setTimeout( function(){      
      $('#el_remove').remove(); 
     },500);

     return false;
  });

});


/******************/
/* page preloader */
/******************/

$(window).load(function() { 
  $("#loader").delay(500).fadeOut(300); 
  $(".mask").delay(800).fadeOut(300, function(){
    $('#user-new-messages').addClass('animated bounceIn');
    $('#user-status .my-status').addClass('animated bounceIn');
  });
});

function validasi(divid, formid) {
    if (formid == "" || typeof (formid) == "undefined")
        var formid = "";
    else
        var formid = formid;
    if (divid == "" || typeof (divid) == "undefined")
        var divid = "msg_";
    else
        var divid = divid;
    $(formid + " ." + divid).hide();
    $(formid + " ." + divid).css('color', '');
    $(formid + " ." + divid).fadeIn('slow');
    var notvalid = 0;
    var notnumber = 0;
    var regNumber = /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/;
    $.each($(formid + " input:visible, " + formid + " select:visible, " + formid + " textarea:visible, " + formid + " input:checkbox, " + formid + " input:radio"), function(n, element) {
        if ($(this).attr('wajib') == "yes" && ($(this).val() == "" || $(this).val() == null)) {
            $(this).addClass('wajib');
            notvalid++;
        }
        if ($(this).attr('format') == "angka" && (!regNumber.test($(this).val()) && $(this).val() != "")) {
            $(this).addClass('format');
            notnumber++;
        }
    });
    if (notvalid > 0 || notnumber > 0) {
        var val1 = "";
        var val2 = "";
        var val3 = "";
        var pisah = "";
        var pisah1 = "";
        if (notvalid > 0) {
            val1 = 'Ada ' + notvalid + ' Kolom Yang Harus Diisi';
        }
        if (notnumber > 0) {
            val2 = 'Ada ' + notnumber + ' Kolom Yang Harus Diisi Dengan Angka';
        }
        if (notvalid > 0 && notnumber > 0) {
            pisah = ' Dan ';
        }
        $(formid + " ." + divid).css('color', 'red');
		$(formid + " ." + divid).addClass('alert alert-red');
        $(formid + " ." + divid).html(val1 + pisah + val2 + pisah1 + val3);
        $(formid + " ." + divid).fadeIn('slow');
        return false;
    } else {
        return true;
    }
    return false;
}

function cancel(formid){
	$("input, textarea, select").removeClass('wajib');
	$("#"+formid+" span.uraian").html('');
	$("#"+formid+" span._msg").html('');
	$("#"+formid+" span._msg").removeClass('alert alert-red');
	$("#"+formid+" div._msg").html('');
	$("#"+formid+" div._msg").removeClass('alert alert-red');
	document.getElementById(formid).reset();
	return false;
};

function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};

function saveData(formid,divid,section,idTbl){
	if (validasi(divid,formid)) {
		if(formid=="#form-karyawan"){
			if($("#password").val() != $("#re-password").val()){
				$(formid + " ." + divid).css('color', 'red');
				$(formid + " ." + divid).addClass('alert alert-red');
				$(formid + " ." + divid).html('Password Anda tidak sama.');
				return false;
			}
			if(!isValidEmailAddress($("#email_karyawan").val())){
				$(formid + " ." + divid).css('color', 'red');
				$(formid + " ." + divid).addClass('alert alert-red');
				$(formid + " ." + divid).html('Email Anda tidak valid.');
				return false;
			}
		}
		bootbox.confirm({
			message: "Apakah Anda yakin ingin memproses data ini ?",
			buttons: {
				cancel: {
					label: 'No',
					className: 'btn-danger'
				},
				confirm: {
					label: 'Yes',
					className: 'btn-success'
				}
			},
			callback: function (r) {
				if(r==true){
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
								$.jGrowl(data.msg, {
									beforeOpen: function(e,m,o){
										$(e).width( "300px" );
									}
								});
								if(formid.replace("#","") == 'form-profile' || formid.replace("#","") == 'form-input-project'){
									setTimeout(function(){
										location.href = data.url;
									}, 2000);
									
								}else{
									cancel(formid.replace("#",""));
									if(formid.replace("#","") != 'form-sub-task'){
										$("#"+section).hide('slow');
									}
									if(formid.replace("#","") == 'form-subPekerjaan'){
										$('#modalConfirm').modal('toggle');
									}
									tableData(idTbl,data.url);
									if(formid.replace("#","") == 'form-task'){
										ganttChart(data.ganChart);
									}
								}
							}else{
								$.jGrowl(data.msg, {
									beforeOpen: function(e,m,o){
										$(e).width( "300px" );
									}
								});
							}
						},
						error: function() {
							$(formid + " ." + divid).css('color', 'red');
							$(formid + " ." + divid).addClass('alert alert-red');
							$(formid + " ." + divid).html('Please Contact Your Administrator');
						}
					});
				}else{
					bootbox.hideAll();
					$(formid + " ." + divid).html('').removeClass('alert alert-red');
				}
			}
		});
	}
	return false;
}

function deleteData(id,url,tipe,idTbl){
	bootbox.confirm({
		message: "Apakah Anda yakin akan memproses data ini ?",
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
				$.ajax({
					type: "POST",
					url: site_url+'/'+url,
					dataType: "json",
					data: {'act':'delete','id':id, 'tipe':tipe},
					success: function(data) {
						if(data.status==="success"){
							$.jGrowl(data.msg, {
								beforeOpen: function(e,m,o){
									$(e).width( "300px" );
								}
							});
							tableData(idTbl,data.url);
						}else{
							$.jGrowl(data.msg, {
								beforeOpen: function(e,m,o){
									$(e).width( "300px" );
								}
							});
						}
					},
					error: function() {
						$.jGrowl('Terjadi Kesalahan, silahkan hubungi Administrator Anda.', {
							beforeOpen: function(e,m,o){
								$(e).width( "300px" );
							}
						});
					}
				});
			}else{
				bootbox.hideAll();
			}
		}
	});
	return false;
}

function updateTask(id,endTask){
	$.ajax({
        url:  site_url + '/project/updateTask',
        type: 'POST',
        data: {id: id},
        success: function(html){
            $('#modalConfirm').modal('show').html(html);
        },
        error: function(){
            $.jGrowl('Terjadi Kesalahan, silahkan hubungi Administrator Anda.', {
				beforeOpen: function(e,m,o){
					$(e).width( "300px" );
				}
			});
        }  
    });
}

function nilai(idProyek,idKaryawan){
	$.ajax({
        url:  site_url + '/penilaian/nilai',
        type: 'POST',
        data: {id_proyek: idProyek, id_karyawan: idKaryawan},
        success: function(html){
            $('#modalConfirm').modal('show').html(html);
        },
        error: function(){
            $.jGrowl('Terjadi Kesalahan, silahkan hubungi Administrator Anda.', {
				beforeOpen: function(e,m,o){
					$(e).width( "300px" );
				}
			});
        }  
    });
}

function tb_search(tipe, id){
	$.ajax({
        url:  site_url + '/search/get_search',
        type: 'POST',
        data: {tipe: tipe, id: id},
        success: function(html){
            $('#modalConfirm').modal('show').html(html);
        },
        error: function(){
            alert("error");
        }  
    });
}

function td_pilih(tipe, value, id){
	var indexField = id.split(";");
	var indexValue = value.split("|");
	for (i = 0; i < indexField.length; i++) { 
		$("#" + indexField[i]).val(indexValue[i]);
	}
	$('#modalConfirm').modal('toggle');
}

function intInput(event, keyRE) {
	if ( String.fromCharCode(((navigator.appVersion.indexOf('MSIE') != (-1)) ? event.keyCode : event.charCode)).search(keyRE) != (-1)
		|| ( navigator.appVersion.indexOf('MSIE') == (-1)
			&& ( event.keyCode.toString().search(/^(8|9|13|45|46|35|36|37|39)$/) != (-1) 
				|| event.ctrlKey || event.metaKey ) ) ) {
		return true;
	} else {
		return false;
	}
}

function editHeader(id){
	setTimeout(function(){
		location.href = site_url + '/project/edit/'+id;
	}, 1000);
}

var table;
function tableData(idTable,url){
	table = $('#'+idTable).DataTable({ 
		"bSort": true,
		"order": [],
		"destroy": true,
		"lengthMenu": [[5, 10, 15, 20, 25, -1], [5, 10, 15, 20, 25, "All"]],
		"ajax": {
			"url": url,
			"type": "POST"
		},
		"columnDefs": [
			{ 
				"targets": [ 0 ],
				"orderable": false,
			},
		],
		'rowCallback': function(row, data, dataIndex){
			$(row).find('#'+idTable+' input[type="radio"]').prop('checked', false);
			$(row).removeAttr('checked');
      	}
	});
};

function search_data(formid){
	$.ajax({
		type: "POST",
		url: $("#" + formid).attr('action'),
		data: $("#" + formid).serialize(),
		success: function(data) {
			$("#view").html(data);
		},
		error: function() {
			$.jGrowl('Terjadi Kesalahan, silahkan hubungi Administrator Anda.', {
				beforeOpen: function(e,m,o){
					$(e).width( "300px" );
				}
			});
		}
	});
}

function ganttChart(url){
	"use strict";
	$(".gantt").gantt({
		source: url,
		navigate: "scroll",
		scale: "days",
		maxScale: "days",
		minScale: "days",
		itemsPerPage: 10,
		useCookie: true,
		onRender: function() {
			if (window.console && typeof console.log === "function") {
				console.log("chart rendered");
			}
		}
	});
	prettyPrint();
}

function pilihPIC(idPekerjaan,idProyek, thpPekerjaan){
	$.ajax({
        url:  site_url + '/project/pic/'+idPekerjaan+'/'+idProyek+'/'+thpPekerjaan,
        type: 'GET',
        success: function(html){
            $('#modalConfirm').modal('show').html(html);
        },
        error: function(){
            $.jGrowl('Terjadi Kesalahan, silahkan hubungi Administrator Anda.', {
				beforeOpen: function(e,m,o){
					$(e).width( "300px" );
				}
			});
        }  
    });
}

function addSubPekerjaan(idPekerjaan, idProyek){
	$.ajax({
        url:  site_url + '/project/sub_pekerjaan/'+idPekerjaan+'/'+idProyek,
        type: 'GET',
        success: function(html){
            $('#modalConfirm').modal('show').html(html);
        },
        error: function(){
           $.jGrowl('Terjadi Kesalahan, silahkan hubungi Administrator Anda.', {
				beforeOpen: function(e,m,o){
					$(e).width( "300px" );
				}
			});
        }  
    });
}


function Laporan(formid,divData,page){
	$.ajax({
		type: 'POST',
		url: page,
		data: $('#'+formid).serialize(),
		success: function(data){				
			$("#"+divData).html(data);
		}
	});
}

function cetak_laporan(tipe){
	document.frmLaporanPros.action = site_url + "/report/"+tipe+"/pdf";
	document.frmLaporanPros.method = "POST";
	document.frmLaporanPros.target = "_blank";
	document.frmLaporanPros.submit();
}