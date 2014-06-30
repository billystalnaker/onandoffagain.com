<div id="google_map_div">

</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0489Z_hDDbhW86dMxnMe8Fu0tAt9COys" type="text/javascript">
</script>
<style>
	html{
		height:100%;
	}
	body{
		height:100%;
	}
	#page-wrapper{
		height:100%;
		min-height:initial;
	}
	#wrapper{
		height:100%;
	}
	#google_map_div{
		height:100%;
	}
</style>
<div id="st_light_update_form_div" class="js_var">
	<h2>What needs to happen?</h2>
	<form class="st_light_update_form">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group row">
					<label class="col-md-3" >Defect:</label>
					<div class="input-group col-md-9">
						<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
						<?php
						echo form_dropdown('st_light_defect_id', $defect_options, '', "class='form-control st_light_defect_id'");
						?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3" >Active:</label>
					<div class="input-group col-md-9">
						<span class="input-group-addon"><i class="fa fa-power-off"></i></span>
						<?php
						echo form_dropdown('st_light_active', array('y'=>'Yes', 'n'=>'No'), 'n', "class='form-control st_light_active'");
						?>
					</div>
				</div>
			</div>
		</div>
		<input class="st_light_id" name="st_light_id" type="hidden" value="" />
	</form>
</div>
<span id="marker_get_api_url" class="js_var"><?php echo site_url('api/get_markers') ?></span>
<span id="marker_update_api_url" class="js_var"><?php echo site_url('api/update_marker') ?></span>
<script type="text/javascript">
	function initialize(){
		var mapOptions={
			center: new google.maps.LatLng(34.24, -77.811),
			zoom: 15
		};
		var map=new google.maps.Map(document.getElementById("google_map_div"),
				mapOptions);

		google.maps.event.addListener(map, 'click', function(event){
			var mouseLocation=event.latLng;
			console.log(mouseLocation);
		});
		$.ajaxSetup({
			async: false
		});
		$.post($('#marker_get_api_url').text(), function(data){
			console.log(data);
			$.each(data, function(index, element){
				var marker=new google.maps.Marker({
					position: new google.maps.LatLng(element.position.lat, element.position.long),
					map: map,
					title: element.title
				});
				google.maps.event.addListener(marker, 'click', function(){
					$(".st_light_defect_id").val(element.defect_id);
					$('.st_light_defect_id').selectmenu("refresh", true);
					$(".st_light_id").val(element.id);
					$(".st_light_active").val(element.active);
					$('.st_light_active').selectmenu("refresh", true);
					bootbox.confirm($('#st_light_update_form_div').html(), function(result){
						if(result===true){
							var $objs=$('.modal-body .st_light_update_form').serializeArray();
							console.log($objs);
							$.post($('#marker_update_api_url').text(), $objs, function(){

							});
						}
					});
				});
			});
		});
		$.ajaxSetup({
			async: true
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);

</script>