<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FRIZZÉ - Escaripelas</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script>
function goTo(a) {
	top.location.href='<?=$app_url?>&app_data=' + a;
}
</script>
</head>

<body>
	<div id="divGeneral">
    	<div><img src="img/frizze.png" /></div>
    	<div id="divLogoInicio">
	    	<img src="img/logo-inicio.png" />
        </div>
    	<div id="divBtnIngresar">
        	<a href="#" onclick='goTo("step1")'>
	    		<img src="img/btn-ingresar.png" border="0" />
            </a>
        </div>
    	<div id="divTxtBottom">
	    	<img src="img/beber.png" />
        </div>
    </div>
</body>
</html>