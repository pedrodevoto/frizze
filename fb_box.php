<div id="items">
cargando...
</div>
<script>
$.ajax({ 
	url: "fb_albums.php",
}).done(function(data) {
	$('#items').html(data);
});
function viewAlbum(id) {
	$('#items').html("cargando...");
	$.ajax({
		url: "fb_photos.php?id="+id,
	}).done(function(data) {
		$('#items').html(data);
	});
}
</script>
