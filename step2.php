<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FRIZZÉ - Escaripelas</title>

<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css" />

<script src="jquery/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/html2canvas.js"></script>
<script>
$(function() {
	$('#loading').hide();
	$(".escarapela").draggable({helper: "clone"});
	$( "#divRecuadro" ).droppable({
		drop: function (e, ui) {
	
			if ($(ui.draggable)[0].id != "") {
				x = ui.helper.clone();
				ui.helper.remove();
				x.draggable({
					helper: 'original',
					containment: '#divRecuadro',
					tolerance: 'fit'
				});
				x.children('img').removeClass('still');
				x.children('img').addClass('moved');
				x.appendTo('#divRecuadro');
			}
	
		}
	});
	
	$('body').click(function(event) {
		var div=event.target;
		if($(div).attr('class')=='moved'){
			$('.moved').css('border','0px');
			$('.ui-resizable').resizable('destroy');
			$(div).css('border','1px dashed white');
			$(div).resizable({
				maxHeight: 200,
				maxWidth:200,
				minHeight: 77,
				minWidth: 73
			});
		}else{
			$('.ui-resizable').resizable('destroy');
			$('.moved').css('border','0px');
			$('.moved').removeClass('ui-resizable');
		}
		
	});
	
	$('#btnSiguiente').click(function(){
		$('#loading').show();
		$('#divArrastra').hide();
		$('#divStep').hide();
		$('.still').css('border','0px');
		$('.ui-resizable').resizable('destroy');
		html2canvas($( "#divRecuadro" ), {
			onrendered: function(canvas) {
				var dataURL = canvas.toDataURL();
				$.ajax({
					type: "POST",
					url: "guardar.php",
					data: { 
						imgBase64: dataURL
					}
				}).done(function(o) {
					window.location.href = "step3.php";
				});
			}
		});
	});
	$('#divLimpiar').click(function(){
		$('.moved').remove();
	});
	
});
</script>
</head>

<body>
	<div id="divGeneral">
    	<div><img src="img/header.png" /></div>
    	<div id="divTituloS1">
	    	<img src="img/titulo-s2.png" />        
        </div>
		<div id="divRecuadro" style="background:url(img/fotoprueba.jpg)">
            <div style="float:left; padding:2px;" id="divStep"><img src="img/s2.png" /></div>
            <div style="float:right; padding:0px; width:131px; height:435px; background:url(img/arrastra.png)" id="divArrastra">
           	  <div style="margin-top:140px; text-align:center; width:104px; padding-left:25px;">
                <div style="height:77px; width:73px;" id="esc1" class="escarapela"><img src="img/escarapela1.png" width="100%" height="100%" class="still" style="cursor:move"/></div>
                <div style="height:15px;"></div>
                <div style="height:77px; width:73px;" id="esc2" class="escarapela"><img src="img/escarapela1.png" width="100%" height="100%" class="still" style="cursor:move" /></div>
                <div style="height:15px;"></div>
                <div style="height:77px; width:73px;" id="esc3" class="escarapela"><img src="img/escarapela1.png" width="100%" height="100%" class="still" style="cursor:move" /></div>
                <div style="height:77px; width:73px; margin-top:15px;" id="divLimpiar">LIMPIAR</div>
              </div>
            </div><br />
      </div>
    	<div id="divTxtBottom">
	    	<a href="step1.php"><img src="img/anterior.png" border="0" /></a>&nbsp;&nbsp;<a style="cursor:pointer" id="btnSiguiente"><img src="img/siguiente.png" border="0" /></a>
        </div>
    </div>
    <div id="loading">
  		<img id="loading-image" src="img/ajax-loader.gif" alt="Loading..." />
    </div>
</body>
</html>
