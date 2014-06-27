
<div class="row">
    <div class="col-lg-12">
		<h1 class="page-header">Groups</h1>
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
		<a href="<?php echo site_url('module/groups/add') ?>" >Add a group...</a>
		<div class="panel panel-default">
			<div class="panel-heading">
				Groups
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
									<th>Privileges</th>
									<th>Delete</th>
								</tr>
							</thead>
							<?php if(!empty($groups)){ ?>
								<tbody>
									<?php foreach($groups as $group){ ?>
										<tr>
											<td>
												<a href="<?php echo site_url("module/groups/edit/".$group[$this->flexi_auth->db_column('user_group', 'id')]); ?>">
													<?php echo $group[$this->flexi_auth->db_column('user_group', 'name')]; ?>
												</a>
											</td>
											<td>
												<?php echo $group[$this->flexi_auth->db_column('user_group', 'description')]; ?>
											</td>
											<td class="align_ctr">
												<a href="<?php echo site_url("module/group_privileges/".$group[$this->flexi_auth->db_column('user_group', 'id')]); ?>">Manage</a>
											</td>
											<td class="align_ctr">
												<?php if($this->flexi_auth->is_privileged('Delete Groups')){ ?>
													<input type="checkbox" name="delete_group[<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')]; ?>]" value="1"/>
												<?php }else{ ?>
													<input type="checkbox" disabled="disabled"/>
													<small>Not Privileged</small>
													<input type="hidden" name="delete_group[<?php echo $group[$this->flexi_auth->db_column('user_group', 'id')]; ?>]" value="0"/>
												<?php } ?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							<?php } ?>
						</table>
					</div>
					<input class="btn btn-primary" type="submit" value="Update Groups" name="update_groups"/>
				</div>
			</form>
		</div>
    </div>
</div>