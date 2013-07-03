<div style="background-color:#65d5e9; padding:5px;font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#FFFFFF">
	<div style="width:100%; text-align:center; margin-bottom:20px; margin-top:5px">
		<p><img src="img/header-small.png" /></p>
		<p>Seleccioná una foto de uno de tus álbumes</p>
	</div>
	<div style="text-align:center" id="items">
	<div style="width:100%; text-align:center; height:200px">Cargando...</div>
	</div>
</div>

<script>
$.ajax({ 
	url: "fb_albums.php",
}).done(function(data) {
	$('#items').html(data);
});

function viewAlbum(id) {
	$('#items').html('<div style="width:100%; text-align:center; height:200px">Cargando...</div>');
	$.ajax({
		url: "fb_photos.php?id="+id,
	}).done(function(data) {
		$('#items').html(data);
	});
}
</script>
