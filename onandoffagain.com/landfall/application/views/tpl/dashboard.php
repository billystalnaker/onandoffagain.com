<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
	</div>
	<!-- /.col-lg-12 -->
</div>
<?php
if($is_logged){
	if(true || $this->flexi_auth->is_privileged('Users')){
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Users
					</div>
					<div class="panel-body">
						<div class="panel-group" id="user_accordion"><?php
							if(true || $this->flexi_auth->is_privileged('View Users')){
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#user_accordion" href="#view_user_panel" >View</a>
										</h4>
									</div>
									<div class="panel-collapse collapse in" id="view_user_panel">
										<div class="panel-body">
											<h3>View Users</h3>
											<p>Here you can view users.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra risus sit amet fermentum molestie. Donec hendrerit venenatis velit ultrices bibendum. Nunc elementum sem ipsum, et pellentesque quam dapibus sit amet. Nulla sed adipiscing orci. Nulla lacinia feugiat magna eu porta. </p>
											<a href="<?php echo site_url('module/users/action/view'); ?>">View Users</a>
										</div>
									</div>
								</div>
								<?php
							}
							if(true || $this->flexi_auth->is_privileged('Add Users')){
								?>
								<div class="panel panel-default">

									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#user_accordion" href="#add_user_panel">Add</a>
										</h4>
									</div>
									<div class="panel-collapse collapse" id="add_user_panel">
										<div class="panel-body">
											<h3>Add Users</h3>
											<p>Here you can add users.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra risus sit amet fermentum molestie. Donec hendrerit venenatis velit ultrices bibendum. Nunc elementum sem ipsum, et pellentesque quam dapibus sit amet. Nulla sed adipiscing orci. Nulla lacinia feugiat magna eu porta. </p>
											<a href="<?php echo site_url('module/users/action/add'); ?>">Add Users</a>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div><?php
	}
	if(true || $this->flexi_auth->is_privileged('Groups')){
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Groups
					</div>
					<div class="panel-body">
						<div class="panel-group" id="group_accordion"><?php
							if(true || $this->flexi_auth->is_privileged('View Groups')){
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#group_accordion" href="#view_group_panel" >View</a>
										</h4>
									</div>
									<div class="panel-collapse collapse in" id="view_group_panel">
										<div class="panel-body">
											<h3>View Groups</h3>
											<p>Here you can view groups.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra risus sit amet fermentum molestie. Donec hendrerit venenatis velit ultrices bibendum. Nunc elementum sem ipsum, et pellentesque quam dapibus sit amet. Nulla sed adipiscing orci. Nulla lacinia feugiat magna eu porta. </p>
											<a href="<?php echo site_url('module/groups/action/view'); ?>">View groups</a>
										</div>
									</div>
								</div>
								<?php
							}
							if(true || $this->flexi_auth->is_privileged('Add Groups')){
								?>
								<div class="panel panel-default">

									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#group_accordion" href="#add_group_panel">Add</a>
										</h4>
									</div>
									<div class="panel-collapse collapse" id="add_group_panel">
										<div class="panel-body">
											<h3>Add Groups</h3>
											<p>Here you can add groups.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra risus sit amet fermentum molestie. Donec hendrerit venenatis velit ultrices bibendum. Nunc elementum sem ipsum, et pellentesque quam dapibus sit amet. Nulla sed adipiscing orci. Nulla lacinia feugiat magna eu porta. </p>
											<a href="<?php echo site_url('module/groups/action/add'); ?>">Add groups</a>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div><?php
	}
	if(true || $this->flexi_auth->is_privileged('Privileges')){
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Privileges
					</div>
					<div class="panel-body">
						<div class="panel-group" id="privileges_accordion"><?php
							if(true || $this->flexi_auth->is_privileged('View Privilegess')){
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#privileges_accordion" href="#view_privileges_panel" >View</a>
										</h4>
									</div>
									<div class="panel-collapse collapse in" id="view_privileges_panel">
										<div class="panel-body">
											<h3>View Privileges</h3>
											<p>Here you can view privileges.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra risus sit amet fermentum molestie. Donec hendrerit venenatis velit ultrices bibendum. Nunc elementum sem ipsum, et pellentesque quam dapibus sit amet. Nulla sed adipiscing orci. Nulla lacinia feugiat magna eu porta. </p>
											<a href="<?php echo site_url('module/privileges/action/view'); ?>">View Privileges</a>
										</div>
									</div>
								</div>
								<?php
							}
							if(true || $this->flexi_auth->is_privileged('Add Privilegess')){
								?>
								<div class="panel panel-default">

									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#privileges_accordion" href="#add_privileges_panel">Add</a>
										</h4>
									</div>
									<div class="panel-collapse collapse" id="add_privileges_panel">
										<div class="panel-body">
											<h3>Add Privileges</h3>
											<p>Here you can add privileges.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra risus sit amet fermentum molestie. Donec hendrerit venenatis velit ultrices bibendum. Nunc elementum sem ipsum, et pellentesque quam dapibus sit amet. Nulla sed adipiscing orci. Nulla lacinia feugiat magna eu porta. </p>
											<a href="<?php echo site_url('module/privileges/action/add'); ?>">Add Privileges</a>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div><?php
	}
	if(true || $this->flexi_auth->is_privileged('St_Lights')){
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						St. Lights
					</div>
					<div class="panel-body">
						<div class="panel-group" id="st_light_accordion"><?php
							if(true || $this->flexi_auth->is_privileged('View St_lights')){
								?>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#st_light_accordion" href="#view_st_light_panel" >View</a>
										</h4>
									</div>
									<div class="panel-collapse collapse in" id="view_st_light_panel">
										<div class="panel-body">
											<h3>View St. Lights</h3>
											<p>Here you can view St. Lights.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra risus sit amet fermentum molestie. Donec hendrerit venenatis velit ultrices bibendum. Nunc elementum sem ipsum, et pellentesque quam dapibus sit amet. Nulla sed adipiscing orci. Nulla lacinia feugiat magna eu porta. </p>
											<a href="<?php echo site_url('module/st_lights/action/view'); ?>">View St. Lights</a>
										</div>
									</div>
								</div>
								<?php
							}
							if(true || $this->flexi_auth->is_privileged('Add St_lights')){
								?>
								<div class="panel panel-default">

									<div class="panel-heading">
										<h4 class="panel-title">
											<a data-toggle="collapse" data-parent="#st_light_accordion" href="#add_st_light_panel">Add</a>
										</h4>
									</div>
									<div class="panel-collapse collapse" id="add_st_light_panel">
										<div class="panel-body">
											<h3>Add St. Lights</h3>
											<p>Here you can add St. Lights.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec viverra risus sit amet fermentum molestie. Donec hendrerit venenatis velit ultrices bibendum. Nunc elementum sem ipsum, et pellentesque quam dapibus sit amet. Nulla sed adipiscing orci. Nulla lacinia feugiat magna eu porta. </p>
											<a href="<?php echo site_url('module/st_lights/action/add'); ?>">Add St. Lights</a>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div><?php
	}
}