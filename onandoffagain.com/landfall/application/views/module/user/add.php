<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Users</h1>
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
					<label class="col-md-3" >Email:</label>
					<div class="input-group col-md-9">
						<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
						<input class="form-control" type="text" value="<?php echo set_value('insert_user_email') ?>" name="insert_user_email">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3" >User Name:</label>
					<div class="input-group col-md-9">
						<span class="input-group-addon"><i class="fa-user fa"></i></span>
						<input class="form-control" type="text" value="<?php echo set_value('insert_user_user_name') ?>" name="insert_user_user_name">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3" >First Name:</label>
					<div class="input-group col-md-9">
						<span class="input-group-addon"><i class="fa-user fa"></i></span>
						<input class="form-control" type="text" value="<?php echo set_value('insert_user_first_name') ?>" name="insert_user_first_name">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3">Last Name:</label>
					<div class="input-group col-md-9">
						<span class="input-group-addon"><i class="fa-user fa"></i></span>
						<input class="form-control" type="text" value="<?php echo set_value('insert_user_last_name') ?>" name="insert_user_last_name">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3">Group:</label>
					<div class="input-group col-md-9">
						<span class="input-group-addon"><i class="fa-users fa"></i></span>
						<?php
						echo form_dropdown('insert_user_group_id', $group_options, set_value('insert_user_group_id'), "class='form-control'");
						?>
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3">Password:</label>
					<div class="input-group col-md-9">
						<span class="input-group-addon"><i class="fa-key fa"></i></span>
						<input class="form-control" type="password" value="<?php echo set_value('insert_user_password') ?>" name="insert_user_password">
					</div>
				</div>
				<div class="form-group row">
					<label class="col-md-3">Password Confirmation:</label>
					<div class="input-group col-md-9">
						<span class="input-group-addon"><i class="fa-lock fa"></i></span>
						<input class="form-control" type="password" value="<?php echo set_value('insert_user_password_confirmation') ?>"  name="insert_user_password_confirmation">
					</div>
				</div>
				<div class="form-group">
					<input class="form-control btn btn-primary" type="submit" id="" name="insert_user_submit">
				</div>

			</div>
		</div>
</form>