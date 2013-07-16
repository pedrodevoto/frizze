<?php
include("auth.php");
$pic = isset($_GET['pic'])?urldecode($_GET['pic']):"";
$filename = 'upload/' . substr($pic, strrpos($pic, '/') + 1);
if ($pic and !file_exists($filename)) {
	copy($pic, $filename);
}
$width = isset($_GET['width'])?$_GET['width']:"";
$height = isset($_GET['height'])?$_GET['height']:"";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FRIZZÉ - Escaripelas</title>

<link href="css/style1.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery/jquery-ui-1.10.3.custom/css/ui-lightness/jquery-ui-1.10.3.custom.css" />

<script src="jquery/jquery-ui-1.10.3.custom/js/jquery-1.9.1.js"></script>
<script src="jquery/jquery-ui-1.10.3.custom/js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>

<script>
$(function() {
	$('#divLogo').hide();
	$('#loading').hide();
	$(".escarapela").draggable({helper: "clone"});
	$( "#divRecuadro" ).droppable({
		tolerance: 'touch',
		drop: function (e, ui) {
			if ($(ui.draggable)[0].id != "") {
				x = ui.helper.clone();
				ui.helper.remove();
				x.draggable({
					helper: 'original',
					//containment: '#divRecuadro',
					tolerance: 'touch'
				});
				x.children('img').css('z-index','0');
				x.children('img').removeClass('still');
				x.children('img').addClass('moved');
				x.appendTo('#divRecuadro');
				//alert('test1');
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
				maxHeight: 700,
				maxWidth:700,
				minHeight: 77,
				minWidth: 73,
				stop: function(event, ui) {
					$(div).children('img').css('width',ui.size.width);
					$(div).children('img').css('height',ui.size.height);
				}
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
		$('#divLogo').show();
		$('.still').css('border','0px');
		$('.ui-resizable').resizable('destroy');

		var crear=0;
	
		var data="[";
		$('#divRecuadro').children('div').each(function () {
			var position = $(this).offset();
			var offset_x=$('#divRecuadro').offset().left;
			var offset_y=$('#divRecuadro').offset().top;
			data+='{"escarapela":"'+$(this).children('img').attr("src")+'","top":"'+ (position.top-offset_y)+'","left":"'+ (position.left-offset_x)+'","width":"'+$(this).children('img').css('width')+'","height":"'+$(this).children('img').css('height')+'","img":"'+ '<?=$filename?>'+'", "img_w":"'+<?=$width+0?>+'","img_h":"'+<?=$height+0?>+'"},';
			crear++;	
		});
		data = data.slice(0, -1);
		data+="]";
		
		if(crear===0){
			alert("You must place at least one tag in the photo!");
		}else{ 
			if ($.browser.msie && window.XDomainRequest) {
				window.location.href = "guardar.php?datos="+encodeURIComponent(data);
			}
			else {
				$.ajax({
				url: "guardar.php?datos="+encodeURIComponent(data),
				success: function(o){window.location.href = "step3.php?pic="+encodeURIComponent(o);}
				});
			}
		}

	});
	$('#divLimpiar').click(function(){
		$('.moved').remove();
	});
	
});
$(document).ready(function() {
	$("#divRecuadro").css({"background-image": "url('<?=$filename?>')", "background-repeat": "no-repeat", "background-position": "center"});
})
</script>
</head>

<body>
	<div id="divGeneral">
    	<div><img src="img/header.png" /></div>
    	<div id="divTituloS1">
	    	<img src="img/titulo-s2.png" />        
        </div>
		
        <div style="width:100%; height:433px; background-color:#f0f0f0; text-align:center; position:relative">
            
        	<div style="float:left; padding:2px; position:absolute; top:0px" id="divStep"><img src="img/s2.png" /></div>            
        	
            <div style="float:right; padding:0px; width:131px; height:435px; background:url(img/arrastra.png)" id="divArrastra">
           		<div style="margin-top:140px; text-align:center; width:104px; padding-left:25px;">
                    <div style="height:77px; width:73px; z-index:6" id="esc1" class="escarapela"><img src="img/escarapela1.png" width="100%" height="100%" class="still" style="cursor:move; z-index:0"/></div>
                    <div style="height:15px;"></div>
                    <div style="height:77px; width:73px; z-index:6" id="esc2" class="escarapela"><img src="img/escarapela2.png" width="100%" height="100%" class="still" style="cursor:move" /></div>
                    <div style="height:15px;"></div>
                    <div style="height:77px; width:73px; z-index:6" id="esc3" class="escarapela"><img src="img/escarapela3.png" width="100%" height="100%" class="still" style="cursor:move" /></div>
            	</div>
            	<div style="height:20px; width:100px; margin-top:8px; margin-left:15px" id="divLimpiar"><img src="img/borrar.png" width="100" height="20" style="cursor:pointer" /></div>
            </div><br />
            
            <div id="divRecuadro" style="width:<?=$width?>px; height:<?=$height?>px; margin-left:<?=(780-$width)/2?>px; margin-top:<?=(408-$height)/2?>px;"><div style="position:absolute; padding:2px; z-index:10000" id="divLogo"><img src="img/header-small4.png" /></div></div>

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
