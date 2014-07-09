<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">St. Light Defects</h1>
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
        <div class="panel panel-default">
            <div class="panel-heading">
                Update Defects of the St. Light '<?php echo $st_light['location']; ?>'
            </div>
            <form action="<?php echo current_url(); ?>" method="POST" >
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="data_table">
                            <thead>
                                <tr>
                                    <th class="tooltip_trigger"
                                        title="The name of the defect."/>
                                    Name
                                    </th>
                                    <th class="tooltip_trigger"
                                        title="A short description of the purpose of the defect."/>
                                    Description
                                    </th>
                                    <th class="spacer_150 align_ctr tooltip_trigger"
                                        title="If checked, the defect will apply to this St. Light and add the comment along with it."/>
                                    St. Light has Defect
                                    </th>
                                    <th class="spacer_150 align_ctr tooltip_trigger"
                                        title="The comment for this St. Light Defect."/>
                                    St. Light Defect Comment
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
				<?php foreach($defects as $defect){ ?>
    				<tr>
    				    <td>
    					<input type="hidden" name="update[<?php echo $defect['id']; ?>][id]" value="<?php echo $defect['id']; ?>"/>
					    <?php echo $defect['name']; ?>
    				    </td>
    				    <td><?php echo $defect['description']; ?></td>
    				    <td class="align_ctr">
					    <?php
					    // Define form input values.
					    $current_status	 = (in_array($defect['id'], $st_light_defects['defects']))?1:0;
					    $new_status	 = (in_array($defect['id'], $st_light_defects['defects']))?'checked="checked"':NULL;
					    ?>
    					<input type="hidden" name="update[<?php echo $defect['id']; ?>][current_status]" value="<?php echo $current_status ?>"/>
    					<input type="hidden" name="update[<?php echo $defect['id']; ?>][new_status]" value="0"/>
    					<input type="checkbox" name="update[<?php echo $defect['id']; ?>][new_status]" value="1" <?php echo $new_status ?>/>
    				    </td>
    				    <td>
    					<textarea cols="75" rows="3" name="update[<?php echo $defect['id']; ?>][new_comment]"><?php echo(isset($st_light_defects[$defect['id']]) && $st_light_defects[$defect['id']] != '')?$st_light_defects[$defect['id']]:''; ?></textarea>
    					<input type="hidden" name="update[<?php echo $defect['id']; ?>][current_comment]" value="<?php echo(isset($st_light_defects[$defect['id']]) && $st_light_defects[$defect['id']] != '')?$st_light_defects[$defect['id']]:''; ?>"/>
    				    </td>
    				</tr>
				<?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="4">
                                        <input type="submit" name="update_st_light_defect" value="Update St. Light Defects" class="link_button large"/>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>