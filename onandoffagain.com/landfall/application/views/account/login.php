<?php echo validation_errors();?>

<?php
$attributes = array(
    'method'=>'POST',
    'role'	=>'form',
    'class'	=>'form-center'
);
echo form_open(site_url('account'), $attributes);
?>
<h2 class="form-signin-heading">Please sign in</h2>
<input name="username" type="username" class="form-control" placeholder="Username" autofocus="" value="<?php echo set_value('username');?>">
<input name="password" type="password" class="form-control" placeholder="Password" value="<?php echo set_value('password');?>">
<label class="checkbox">
    <input name="remember_me"type="checkbox" value="remember-me"> Remember me
</label>
<button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
<?php
echo form_close();
?>