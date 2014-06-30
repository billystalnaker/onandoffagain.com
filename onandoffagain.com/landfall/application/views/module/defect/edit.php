<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Edit Defects</h1>
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
                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_defect_name', $defect['name']) ?>" name="update_defect_name">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3" >Description:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-list fa"></i></span>
                        <input class="form-control" type="text" value="<?php echo set_value('update_defect_desc', $defect['description']) ?>" name="update_defect_desc">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3">Active:</label>
                    <div class="input-group col-md-9">
                        <span class="input-group-addon"><i class="fa-power-off fa"></i></span>
                        <?php
                        echo form_dropdown('update_defect_active', array('y' => 'Yes', 'n' => 'No'), set_value('update_defect_active', $defect['active']), "class='form-control'");
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-primary" type="submit" id="" name="update_defect_submit">
                </div>
            </div>
        </div>
    </div>
</form>