
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Defect Types</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php if(!empty($message)){ ?>
    <div id="message">
	<?php echo $message; ?>
    </div>
<?php } ?>

<div class="row">
    <div class="col-lg-12">
	<?php if($this->flexi_auth->is_privileged('Add Defect Types')){ ?>
    	<a href="<?php echo site_url('module/defect_types/add') ?>" >Add a defect type...</a>
	<?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Defect Types
            </div>
            <!-- /.panel-heading -->
            <form action="<?php echo current_url(); ?>" method="POST" >
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th>Name</th>
				    <th>Flag Color</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
			    <?php if(!empty($defect_types)){
				?>
    			    <tbody>
				    <?php foreach($defect_types as $defect_type){ ?>
					<tr>
					    <td>
						<?php if($this->flexi_auth->is_privileged('Edit Defect Types')){ ?>
	    					<a href="<?php echo site_url("module/defect_types/edit/".$defect_type['id']); ?>">
							<?php echo $defect_type['name']; ?>
	    					</a>
						<?php }else{ ?>
						    <?php echo $defect_type['name']; ?>
						<?php } ?>
					    </td>
					    <td>
						<?php echo $defect_type['flag_color']; ?>
					    </td>
					    <td class="align_ctr">
						<?php if($this->flexi_auth->is_privileged('Delete Defect Types')){ ?>
	    					<input type="checkbox" name="delete_defect_type[<?php echo $defect_type['id']; ?>]" value="1"/>
						<?php }else{ ?>
	    					<input type="checkbox" disabled="disabled"/>
	    					<small>Not Privileged</small>
	    					<input type="hidden" name="delete_defect_type[<?php echo $defect_type['id']; ?>]" value="0"/>
						<?php } ?>
					    </td>
					</tr>
				    <?php } ?>
    			    </tbody>
			    <?php } ?>
                        </table>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Update Defect Types" name="update_defect_types"/>
                </div>
            </form>
        </div>
    </div>
</div>