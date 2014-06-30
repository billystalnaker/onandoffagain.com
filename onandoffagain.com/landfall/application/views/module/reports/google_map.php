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
					var h2=$("<h2></h2>").html('What needs to happen?');
					var label=$("<label></label>").html('Test:').addClass('col-md-3');
					var icon=$("<i></i>").addClass('fa fa-map-marker');
					var span=$("<span></span").addClass('input-group-addon').append(icon);
					var input=$("<input />").addClass('form-control').attr('name', 'test_name').attr('type', 'text');
					var input_group=$("<div></div>").addClass('input-group col-md-9').append(span).append(input);
					var form_group=$("<div></div>").addClass('form-group row').append(label).append(input_group);
					var col_6=$("<div></div>").addClass('col-md-6').append(form_group);
					var row=$("<div></div>").addClass('row').append(col_6);
					var form=$("<form></form>").attr('id', 'update_st_light_form').append(row);
					var message=$("<div></div>").addClass('st_light_confirm').append(h2).append(form);
					bootbox.confirm(message.html(), function(result){
						if(result===true){
							var $objs=$('#update_st_light_form').serializeArray();
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