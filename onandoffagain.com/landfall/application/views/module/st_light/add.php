<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add St. Lights</h1>
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

<form action="<?php echo current_url(); ?>" method="POST" class="insert_st_light_form">
    <div class="row">
		<div class="col-md-6">
			<div class="form-group row">
				<label class="col-md-3" >Location:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
					<input class="form-control" type="text" value="<?php echo set_value('insert_st_light_location') ?>" name="insert_st_light_location">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3" >Description:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa-list fa"></i></span>
					<input class="form-control" type="text" value="<?php echo set_value('insert_st_light_desc') ?>" name="insert_st_light_desc">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3" >Latitude Location:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
					<input class="form-control insert_st_light_lat_loc" type="text" value="<?php echo set_value('insert_st_light_lat_loc') ?>" name="insert_st_light_lat_loc">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3" >Longitude Location:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
					<input class="form-control insert_st_light_long_loc" type="text" value="<?php echo set_value('insert_st_light_long_loc') ?>" name="insert_st_light_long_loc">
				</div>
			</div>
			<div class="form-group row">
				<label class="col-md-3">Active:</label>
				<div class="input-group col-md-9">
					<span class="input-group-addon"><i class="fa-power-off fa"></i></span>
					<?php
					echo form_dropdown('insert_st_light_active', array('y'=>'Yes', 'n'=>'No'), set_value('insert_st_light_active'), "class='form-control'");
					?>
				</div>
			</div>
			<div class="form-group">
				<input class="form-control btn btn-primary" type="submit" id="insert_st_light_submit" name="insert_st_light_submit">
			</div>
		</div>
    </div>
</form>