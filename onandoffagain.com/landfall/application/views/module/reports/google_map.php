<div id="google_map_div">

</div>
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
<div id="st_light_update_form_div_holder" class="js_var">
    <div class="default_container">
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
			<input class="ajax_st_light_id" name="st_light_id" type="hidden" value="" />
		</form>
    </div>
</div>
<div class="js_var">
	<?php echo $this->load->view('module/st_light/add', $this->data, true) ?>
	<?php echo $this->load->view('module/st_light/edit', $this->data, true) ?>
</div>
<!--<img src="http://onandoffagain.com/landfall/public/img/map-pin-green-md.png"/>-->
<span id="marker_get_api_url" class="js_var"><?php echo site_url('api/get_markers') ?></span>
<span id="marker_update_api_url" class="js_var"><?php echo site_url('api/update_marker') ?></span>
<span id="marker_insert_api_url" class="js_var"><?php echo site_url('api/insert_marker') ?></span>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0489Z_hDDbhW86dMxnMe8Fu0tAt9COys" type="text/javascript"></script>
<script type="text/javascript">
	var markers=[];
	function initialize(){
		var mapOptions={
			center: new google.maps.LatLng(34.24, -77.811),
			zoom: 15
		};
		var map=new google.maps.Map(document.getElementById("google_map_div"),
				mapOptions);
		google.maps.event.addListener(map, 'click', function(event){
			var mouseLocation=event.latLng;
			$(".insert_st_light_lat_loc").attr('value', mouseLocation.k);
			$(".insert_st_light_long_loc").attr('value', mouseLocation.A);
			$(".insert_st_light_form .col-md-6").removeClass('col-md-6').addClass('col-md-12');
			$(".insert_st_light_form #insert_st_light_submit").hide();
			var modal_div=$('<div></div>').append($('.insert_st_light_form').clone());
			bootbox.dialog({
				message: modal_div.html(),
				title: 'Add a St. Light?',
				buttons: {
					cancel: {
						label: 'Cancel',
						className: 'btn-default'
					},
					submit: {
						label: 'Submit',
						class_name: 'btn-primary',
						callback: function(){
							//insert and place marker
							var $objs=$('.modal-body .insert_st_light_form').serializeArray();
							$.post($('#marker_insert_api_url').text(), $objs, function(data){
								if(data!=false){
									$.post('/landfall/api/get_markers/'+data, function(data){
										$.each(data, function(index, element){
											var marker=new google.maps.Marker({
												position: new google.maps.LatLng(element.position.lat, element.position.long),
												map: map,
												title: element.title
											});
											delete element.title;
											delete element.position;
											$.extend(true, marker, element);
											markers.push(marker);
											add_st_light_update_event_listener(marker);
										});
									});
								}else{
									//show error on page
								}
							});
						}
					}
				}

			});
		});
		$.ajaxSetup({
			async: false
		});
		$.post($('#marker_get_api_url').text(), function(data){
			$.each(data, function(index, element){
				var marker=new google.maps.Marker({
					position: new google.maps.LatLng(element.position.lat, element.position.long),
					map: map,
//		    icon: 'http://onandoffagain.com/landfall/public/img/map-pin-green-md.png',
					title: element.title
				});
				delete element.title;
				delete element.position;
				$.extend(true, marker, element);
				markers.push(marker);
			});
		});
		console.log(markers);
		$.each(markers, function(index, element){
			add_st_light_update_event_listener(element);
		});
		$.ajaxSetup({
			async: true
		});
	}
	function add_st_light_update_event_listener(element){
		google.maps.event.addListener(element, 'click', function(){
			$(".update_st_light_defect option").each(function(){
				if($(this).val()==element.defect_id){
					$(this).attr('selected', 'selected');
				}else{
					$(this).attr('selected', false);
				}
			});
			$(".ajax_st_light_id").attr('value', element.id);
			$(".update_st_light_active option").each(function(){
				if($(this).val()==element.active){
					$(this).attr('selected', 'selected');
				}else{
					$(this).attr('selected', false);
				}
			});
			$(".update_st_light_form .col-md-6").removeClass('col-md-6').addClass('col-md-12');
			$(".update_st_light_form #update_st_light_submit").hide();
			$(".update_st_light_desc").attr('value', element.description);
			$(".update_st_light_location").attr('value', element.location);
			$(".remove_in_ajax").remove();

			var modal_div=$('<div></div>').append($('.update_st_light_form').clone());
			bootbox.dialog({
				message: modal_div.html(),
				title: 'What to do?',
				buttons: {
					cancel: {
						label: 'Cancel',
						className: 'btn btn-default'
					},
					submit: {
						label: 'Submit',
						className: 'btn btn-primary',
						callback: function(){
							var $objs=$('.modal-body .update_st_light_form').serializeArray();
							$.post($('#marker_update_api_url').text(), $objs, function(data){
								$.each($objs, function(obj_index, obj_element){
									if(obj_element.name=="update_st_light_defect"){
										element.defect_id=obj_element.value;
									}else if(obj_element.name=="update_st_light_active"){
										element.active=obj_element.value;
									}else if(obj_element.name=="update_st_light_desc"){
										element.description=obj_element.value;
									}else if(obj_element.name=="update_st_light_location"){
										element.location=obj_element.value;
									}
								});
							});
						}
					}
				}
			});
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);
</script>