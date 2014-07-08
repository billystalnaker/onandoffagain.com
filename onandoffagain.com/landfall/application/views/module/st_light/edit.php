<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit St. Lights</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
if(!empty($message)){
	?>
	<div id="message">
		<?php echo $message; ?>
	</div>
<?php } ?>

<?php echo validation_errors("<div class='row'> <div class='alert alert-danger col-md-6'>", "</div><div class='col-md-6'></div></div>"); ?>

<form action="<?php echo site_url('/module/st_lights/edit/'.$st_light['id']); ?>" method="POST"class="update_st_light_form">
	<div class="row">
		<div class="col-md-6">
			<div class="form-group row">
				<label class="col-md-3" >Location:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
					<input class="form-control update_st_light_location" type="text" value="<?php echo set_value('update_st_light_location', isset($st_light['location'])?$st_light['location']:'') ?>" name="update_st_light_location">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3" >Description:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa-list fa"></i></span>
					<input class="form-control update_st_light_desc" type="text" value="<?php echo set_value('update_st_light_desc', isset($st_light['description'])?$st_light['description']:'') ?>" name="update_st_light_desc">
				</div>
			</div>
			<div class="form-group row remove_in_ajax">
				<label class="col-md-3" >Latitude Location:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
					<input class="form-control update_st_light_long" type="text" value="<?php echo set_value('update_st_light_lat_loc', isset($st_light['lat'])?$st_light['lat']:'') ?>" name="update_st_light_lat_loc">
				</div>
			</div>
			<div class="form-group row remove_in_ajax">
				<label class="col-md-3" >Longitude Location:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
					<input class="form-control update_st_light_long" type="text" value="<?php echo set_value('update_st_light_long_loc', isset($st_light['long'])?$st_light['long']:'') ?>" name="update_st_light_long_loc">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3">Active:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa-power-off fa"></i></span>
					<?php
					echo form_dropdown('update_st_light_active', array('y'=>'Yes', 'n'=>'No'), set_value('update_st_light_active', isset($st_light['active'])?$st_light['active']:''), "class='form-control update_st_light_active'");
					?>
				</div>
			</div>
			<div class="form-group">
				<input class="form-control btn btn-primary" type="submit" id="update_st_light_submit" name="update_st_light_submit">
			</div>
		</div>
	</div>
	<input class="ajax_st_light_id" name="st_light_id" type="hidden" value="" />
</form>