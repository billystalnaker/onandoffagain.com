
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Users</h1>
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
		<a href="<?php echo site_url('module/user/action/add') ?>" >Add a user...</a>
		<div class="panel panel-default">
			<div class="panel-heading">
				Users
			</div>
			<!-- /.panel-heading -->
			<form action="" method="POST" >
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="data_table">
							<thead>
								<tr>
									<th>Email</th>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Group</th>
									<th>Privileges</th>
									<th>Delete</th>
								</tr>
							</thead>
							<?php if(!empty($users)){ ?>
								<tbody>
									<?php foreach($users as $user){ ?>
										<tr>
											<td>
												<a href="<?php echo site_url("module/user/action/edit/id/".$user[$this->flexi_auth->db_column('user_acc', 'id')]); ?>">
													<?php echo $user[$this->flexi_auth->db_column('user_acc', 'email')]; ?>
												</a>
											</td>
											<td>
												<?php echo $user['upro_first_name']; ?>
											</td>
											<td>
												<?php echo $user['upro_last_name']; ?>
											</td>
											<td class="align_ctr">
												<?php echo $user[$this->flexi_auth->db_column('user_group', 'name')]; ?>
											</td>
											<td class="align_ctr">
												<a href="<?php echo 'auth_admin/update_user_privileges/'.$user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>">Manage</a>
											</td>
											<td class="align_ctr">
												<?php if($this->flexi_auth->is_privileged('Delete Users')){ ?>
													<input type="checkbox" name="delete_user[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="1"/>
												<?php }else{ ?>
													<input type="checkbox" disabled="disabled"/>
													<small>Not Privileged</small>
													<input type="hidden" name="delete_user[<?php echo $user[$this->flexi_auth->db_column('user_acc', 'id')]; ?>]" value="0"/>
												<?php } ?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							<?php } ?>
						</table>
					</div>
					<input class="btn btn-primary" type="submit" value="Update Users" name="update_users"/>
				</div>
			</form>
		</div>
	</div>
</div>