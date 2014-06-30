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

<form action="<?php echo current_url(); ?>" method="POST">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row">
                    <label class="col-md-3" >Location:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_st_light_location', $st_light['location']) ?>" name="update_st_light_location">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" >Description:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-list fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_st_light_desc', $st_light['description']) ?>" name="update_st_light_desc">
                    </div>
                </div>
				<div class="form-group row">
                    <label class="col-md-3" >Latitude Location:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_st_light_lat_loc', $st_light['lat']) ?>" name="update_st_light_lat_loc">
                    </div>
                </div> <div class="form-group row">
                    <label class="col-md-3" >Longitude Location:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-map-marker fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_st_light_long_loc', $st_light['long']) ?>" name="update_st_light_long_loc">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3" >Defect:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-wrench fa"></i></span>
						<?php
						echo form_dropdown('update_st_light_defect', $defect_options, set_value('update_st_light_defect', $st_light['defect_id']), "class='form-control'");
						?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Active:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-power-off fa"></i></span>
						<?php
						echo form_dropdown('update_st_light_active', array('y'=>'Yes', 'n'=>'No'), set_value('update_st_light_active', $st_light['active']), "class='form-control'");
						?>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" id="" name="update_st_light_submit">
                </div>
            </div>
        </div>
	</div>
</form>