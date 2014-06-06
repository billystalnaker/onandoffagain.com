
<?php
$object	 = $object_info['object'];
$_info	 = $object_info['info'];
//echo "<pre>";
//var_dump($_info);
//echo "</pre>";
echo validation_errors();
echo preg_replace('/\b(a)\s+([aeiou])/i', '$1n $2', $object);
?>

<h2>Add a <?php echo ucwords(str_replace('_', '', $object))?></h2>
<form class="form-horizontal" action="<?php echo site_url("objects/add/$object");?>" method="POST" role="form">
    <?php
    foreach($_info as $field){
	$field_id	 = $object.$field['Field'];
	$display_name	 = ucwords(str_replace('_', '', $object))." ".ucwords(str_replace('_', '', $field['Field']));
	$type		 = $field['Type'];
	$params		 = array(
	    'name'		=>$field_id,
	    'class'		=>'form-control',
	    'set_values'	=>true
	);
	?>
        <div class="form-group">
    	<label class="col-md-4 control-label" for="<?php echo $field_id;?>" ><?php echo $display_name;?>:</label>
    	<div class="col-md-8">
		<?php echo make_db_form_field($type, $params);?>
    	</div>
        </div>
    <?php }?>
    <div class="form-group">
	<label class="col-md-4 control-label" for="module_submit" ></label>
	<div class="col-md-8">
	    <input class="form-control" type="submit" value="Submit" name="module_submit"/>
	</div>
    </div>
</form>