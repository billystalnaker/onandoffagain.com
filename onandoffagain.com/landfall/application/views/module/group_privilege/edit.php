<div class="row">
    <div class="col-lg-12">
		<h1 class="page-header">User Privileges</h1>
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
				Update User Group Privileges of Group '<?php echo $group['ugrp_name']; ?>'
			</div>
			<form action="<?php echo current_url(); ?>" method="POST" >
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="data_table">
							<thead>
								<tr>
									<th class="tooltip_trigger"
										title="The name of the privilege."/>
									Privilege Name
									</th>
									<th class="tooltip_trigger"
										title="A short description of the purpose of the privilege."/>
									Description
									</th>
									<th class="spacer_150 align_ctr tooltip_trigger"
										title="If checked, the user will be granted the privilege."/>
									User Has Privilege
									</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($privileges as $privilege){ ?>
									<tr>
										<td>
											<input type="hidden" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')]; ?>][id]" value="<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')]; ?>"/>
											<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'name')]; ?>
										</td>
										<td><?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'description')]; ?></td>
										<td class="align_ctr">
											<?php
											// Define form input values.
											$current_status	 = (in_array($privilege[$this->flexi_auth->db_column('user_privileges', 'id')], $group_privileges))?1:0;
											$new_status		 = (in_array($privilege[$this->flexi_auth->db_column('user_privileges', 'id')], $group_privileges))?'checked="checked"':NULL;
											?>
											<input type="hidden" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')]; ?>][current_status]" value="<?php echo $current_status ?>"/>
											<input type="hidden" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')]; ?>][new_status]" value="0"/>
											<input type="checkbox" name="update[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')]; ?>][new_status]" value="1" <?php echo $new_status ?>/>
										</td>
									</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<td colspan="3">
										<input type="submit" name="update_group_privilege" value="Update Group Privileges" class="link_button large"/>
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