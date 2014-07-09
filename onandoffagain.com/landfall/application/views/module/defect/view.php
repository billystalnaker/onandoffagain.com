
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">View Defects</h1>
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
	<?php if($this->flexi_auth->is_privileged('Add Defects')){ ?>
    	<a href="<?php echo site_url('module/defects/add') ?>" >Add a defect...</a>
	<?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                Defects
            </div>
            <!-- /.panel-heading -->
            <form action="<?php echo current_url(); ?>" method="POST" >
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
				    <th>Defect Type</th>
                                    <th>Active</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
			    <?php if(!empty($defects)){
				?>
    			    <tbody>
				    <?php foreach($defects as $defect){ ?>
					<tr>
					    <td>
						<?php if($this->flexi_auth->is_privileged('Add Defects')){ ?>
	    					<a href="<?php echo site_url("module/defects/edit/".$defect['id']); ?>">
							<?php echo $defect['name']; ?>
	    					</a>
						<?php }else{ ?>
						    <?php echo $defect['name']; ?>
						<?php } ?>
					    </td>
					    <td>
						<?php echo $defect['description']; ?>
					    </td>
					    <td>
						<?php echo isset($defect_types[$defect['defect_type_id']])?$defect_types[$defect['defect_type_id']]:"None"; ?>
					    </td>
					    <td>
						<?php echo ($defect['active'] === 'y')?"Yes":"No"; ?>
					    </td>
					    <td class="align_ctr">
						<?php if($this->flexi_auth->is_privileged('Delete Defects')){ ?>
	    					<input type="checkbox" name="delete_defect[<?php echo $defect['id']; ?>]" value="1"/>
						<?php }else{ ?>
	    					<input type="checkbox" disabled="disabled"/>
	    					<small>Not Privileged</small>
	    					<input type="hidden" name="delete_defect[<?php echo $defect['id']; ?>]" value="0"/>
						<?php } ?>
					    </td>
					</tr>
				    <?php } ?>
    			    </tbody>
			    <?php } ?>
                        </table>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Update Defects" name="update_defects"/>
                </div>
            </form>
        </div>
    </div>
</div>