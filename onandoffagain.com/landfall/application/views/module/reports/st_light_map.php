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
<div class="js_var">
	<?php echo $this->load->view('module/st_light/add', $this->data, true); ?>
	<?php echo $this->load->view('module/st_light/edit', $this->data, true); ?>
	<?php echo $this->load->view('module/st_light_defect/edit_dynamic', $this->data, true); ?>
</div>
<span id="marker_get_api_url" class="js_var"><?php echo site_url('api/get_markers') ?></span>
<span id="marker_update_api_url" class="js_var"><?php echo site_url('api/update_marker') ?></span>
<span id="marker_insert_api_url" class="js_var"><?php echo site_url('api/insert_marker') ?></span>
<span id="defect_get_api_url" class="js_var"><?php echo site_url('api/get_defects') ?></span>
<span id="st_light_defect_get_api_url" class="js_var"><?php echo site_url('api/get_st_light_defects') ?></span>
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $this->config->item('google_maps_api_key'); ?>" type="text/javascript"></script>
<script type="text/javascript">
	var markers=[];
	$(function(){
		$(".insert_st_light_form .col-md-6").append($('.dynamic_st_light_defect').clone().removeClass('dynamic_st_light_defect').addClass('update_st_light_defect')).removeClass('col-md-6').addClass('col-md-12');
		$(".update_st_light_form .col-md-6").append($('.dynamic_st_light_defect').clone().removeClass('dynamic_st_light_defect').addClass('insert_st_light_defect')).removeClass('col-md-6').addClass('col-md-12');
		$(".insert_st_light_form #insert_st_light_submit").hide();
		$(".update_st_light_form #update_st_light_submit").hide();
		google.maps.event.addDomListener(window, 'load', initialize);
	});
	function initialize(){
		var mapOptions={
			center: new google.maps.LatLng(34.24, -77.811),
			zoom: 15
		};
		var map=new google.maps.Map(document.getElementById("google_map_div"),
				mapOptions);
		google.maps.event.addListener(map, 'click', function(event){
			var mouseLocation=event.latLng;
			$(".insert_st_light_lat_loc").attr('value', mouseLocation.lat());
			$(".insert_st_light_long_loc").attr('value', mouseLocation.lng());
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
												icon: element.icon_image,
												map: map,
												title: element.title
											});
											delete element.title;
											delete element.position;
											$.extend(true, marker, element);
											markers.push(marker);
											add_st_light_marker_event_listener(marker);
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
					icon: element.icon_image,
					title: element.title
				});
				delete element.title;
				delete element.position;
				$.extend(true, marker, element);
				markers.push(marker);
			});
		});
		$.each(markers, function(index, element){
			add_st_light_marker_event_listener(element);
		});
		$.ajaxSetup({
			async: true
		});
	}
	function add_st_light_marker_event_listener(element){
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
			$.post('/landfall/api/get_st_light_defects/'+element.id, function(st_light_defects){
				$.post($('#defect_get_api_url').text(), function(data){
					$.each(data, function(index, element){
						var current_status=(($.inArray(element.id, st_light_defects.defects)>=0)?1:0);
						var new_status=(($.inArray(element.id, st_light_defects.defects)>=0)?true:false);
						$('.update_st_light_form  input[name="update['+element.id+'][current_status]"]').attr('value', current_status);
						$('.update_st_light_form  input[name="update['+element.id+'][new_status]"]').prop('checked', new_status);
						$('.update_st_light_form  [name="update['+element.id+'][comment]"]').val(st_light_defects[element.id]);
					});
				});
			});
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
								$.each(data, function(obj_index, obj_element){
									element.defect_id=obj_element.defect_id;
									element.setIcon(data[obj_index].icon_image);
									element.active=obj_element.active;
									element.description=obj_element.description;
									element.title=obj_element.description;
									element.location=obj_element.location;
								});
							});
						}
					}
				}
			});
		});
	}
</script>