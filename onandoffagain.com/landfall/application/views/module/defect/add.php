<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Add Defects</h1>
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
                    <label class="col-md-3" >Name:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa fa-wrench"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_defect_name') ?>" name="insert_defect_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" >Description:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-list fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('insert_defect_desc') ?>" name="insert_defect_desc">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Active:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-power-off fa"></i></span>
						<?php
						echo form_dropdown('insert_defect_active', array('y'=>'Yes', 'n'=>'No'), set_value('insert_defect_active'), "class='form-control'");
						?>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" id="" name="insert_defect_submit">
                </div>
            </div>
        </div>
</form>