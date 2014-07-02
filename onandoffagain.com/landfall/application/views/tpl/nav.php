<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo site_url('home') ?>">Landfall</a>
    </div>
    <!-- /.navbar-header -->

	<?php if($is_logged){ ?>
		<ul class="nav navbar-top-links navbar-right">
			<!-- /.dropdown -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
					</li>
					<li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
					</li>
					<li class="divider"></li>
					<li><a class="sign-out" href="javascript:void(0);" data-alt="<?php echo site_url('account/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
					</li>
				</ul>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
		</ul>
		<!-- /.navbar-top-links -->

		<div class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav" id="side-menu">
					<li class="navbar-user-info">
						<span><?php echo $user_info; ?></span>
					</li>
					<li class="sidebar-search">
						<div class="input-group custom-search-form">
							<input type="text" class="form-control" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">
									<i class="fa fa-search"></i>
								</button>
							</span>
						</div>
						<!-- /input-group -->
					</li>
					<li>
						<a href="<?php echo site_url('home/dashboard'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
					</li>

					<?php if($this->flexi_auth->is_privileged('Users')){ ?>
						<li>
							<a href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<?php if($this->flexi_auth->is_privileged('Add Users')){ ?>
									<li>
										<a href="<?php echo site_url('module/users/add'); ?>">Add</a>
									</li>
								<?php } ?>
								<?php if($this->flexi_auth->is_privileged('View Users')){ ?>
									<li>
										<a href="<?php echo site_url('module/users/view'); ?>">View</a>
									</li>
								<?php } ?>
							</ul>
							<!-- /.nav-second-level -->
						</li>
					<?php } ?>
					<?php if($this->flexi_auth->is_privileged('Groups')){ ?>
						<li>
							<a href="#"><i class="fa fa-group fa-fw"></i> Groups<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<?php if($this->flexi_auth->is_privileged('Add Groups')){ ?>
									<li>
										<a href="<?php echo site_url('module/groups/add'); ?>">Add</a>
									</li>
								<?php } ?>
								<?php if($this->flexi_auth->is_privileged('View Groups')){
									?>
									<li>
										<a href="<?php echo site_url('module/groups/view'); ?>">View</a>
									</li>
								<?php } ?>
							</ul>
							<!-- /.nav-second-level -->
						</li>
					<?php } ?>
					<?php if($this->flexi_auth->is_privileged('Privileges')){ ?>
						<li>
							<a href="#"><i class="fa fa-key fa-fw"></i> Privileges<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<?php if($this->flexi_auth->is_privileged('Add Privileges')){ ?>
									<li>
										<a href="<?php echo site_url('module/privileges/add'); ?>">Add</a>
									</li>
								<?php } ?>

								<?php if($this->flexi_auth->is_privileged('View Privileges')){ ?>
									<li>
										<a href="<?php echo site_url('module/privileges/view'); ?>">View</a>
									</li>
								<?php } ?>
							</ul>
							<!-- /.nav-second-level -->
						</li>
					<?php } ?>

					<?php if($this->flexi_auth->is_privileged('St Lights')){ ?>
						<li>
							<a href="#"><i class="fa fa-lightbulb-o fa-fw"></i> St. Lights<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<?php if($this->flexi_auth->is_privileged('Add St Lights')){ ?>
									<li>
										<a href="<?php echo site_url('module/st_lights/add'); ?>">Add</a>
									</li>
								<?php } ?>

								<?php if($this->flexi_auth->is_privileged('View St Lights')){ ?>
									<li>
										<a href="<?php echo site_url('module/st_lights/view'); ?>">View</a>
									</li>
								<?php } ?>
							</ul>
							<!-- /.nav-second-level -->
						</li>
					<?php } ?>
					<?php if($this->flexi_auth->is_privileged('Defects')){ ?>
						<li>
							<a href="#"><i class="fa fa-wrench fa-fw"></i> Defects<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<?php if($this->flexi_auth->is_privileged('Add Defects')){ ?>
									<li>
										<a href="<?php echo site_url('module/defects/add'); ?>">Add</a>
									</li>
								<?php } ?>

								<?php if($this->flexi_auth->is_privileged('View Defects')){ ?>
									<li>
										<a href="<?php echo site_url('module/defects/view'); ?>">View</a>
									</li>
								<?php } ?>
							</ul>
							<!-- /.nav-second-level -->
						</li>
					<?php } ?>
					<?php if($this->flexi_auth->is_privileged('Reports')){ ?>
						<li>
							<a href="#"><i class="fa fa-list-alt fa-fw"></i> Reports<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<?php if($this->flexi_auth->is_privileged('St Light Map')){ ?>
									<li>
										<a href="<?php echo site_url('module/reports/st_light_map'); ?>">St. Light Map</a>
									</li>
								<?php } ?>

								<?php if($this->flexi_auth->is_privileged('St Light Report')){ ?>
									<li>
										<a href="<?php echo site_url('module/reports/st_light_report'); ?>">St. Light Report</a>
									</li>
								<?php } ?>
							</ul>
							<!-- /.nav-second-level -->
						</li>
					<?php } ?>
				</ul>
				<!-- /#side-menu -->
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	<?php } ?>
</nav>