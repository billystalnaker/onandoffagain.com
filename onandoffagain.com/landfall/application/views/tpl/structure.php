<html>
    <head>
	<?php
	$links = $this->config->item('links');
	if(is_array($links)){
	    foreach($links as $link){
		echo link_tag($link, array('public'=>true));
	    }
	}
	?>
    </head>
    <body >
	<?php
	echo $this->load->view('tpl/nav');
	?>
        <div class="container main_container">
	    <?php
	    echo $content;
	    ?>
        </div>
    </body>
    <footer>
<?php
$scripts = $this->config->item('scripts');
if(is_array($scripts)){
    foreach($scripts as $script){
	echo script_tag($script);
    }
}
?>

    </footer>
</html>