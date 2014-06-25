
<div class="row">
    <div class="col-lg-12">
		<h1 class="page-header">View Privileges</h1>
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
		<a href="<?php echo site_url('module/privileges/add') ?>" >Add a privilege...</a>
		<div class="panel panel-default">
			<div class="panel-heading">
				Privileges
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
									<th>Delete</th>
								</tr>
							</thead>
							<?php if(!empty($privileges)){ ?>
								<tbody>
									<?php foreach($privileges as $privilege){
										?>
										<tr>
											<td>
												<a href="<?php echo site_url("module/privileges/edit/".$privilege[$this->flexi_auth->db_column('user_privileges', 'id')]); ?>">
													<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'name')]; ?>
												</a>
											</td>
											<td>
												<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'description')]; ?>
											</td>
											<td class="align_ctr">
												<?php if($this->flexi_auth->is_privileged('Delete Users')){ ?>
													<input type="checkbox" name="delete_privilege[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')]; ?>]" value="1"/>
												<?php }else{ ?>
													<input type="checkbox" disabled="disabled"/>
													<small>Not Privileged</small>
													<input type="hidden" name="delete_privilege[<?php echo $privilege[$this->flexi_auth->db_column('user_privileges', 'id')]; ?>]" value="0"/>
												<?php } ?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							<?php } ?>
						</table>
					</div>
					<input class="btn btn-primary" type="submit" value="Update Privileges" name="update_privileges"/>
				</div>
			</form>
		</div>
    </div>
</div>