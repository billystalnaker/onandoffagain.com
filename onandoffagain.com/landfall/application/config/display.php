<?php

$scripts			 = array();
$scripts[0]['type']	 = 'application/javascript';
$scripts[0]['src']	 = '/js/jquery.js';

$scripts[1]['type']	 = 'application/javascript';
$scripts[1]['src']	 = '/js/bootstrap.min.js';

$scripts[2]['type']	 = 'application/javascript';
$scripts[2]['src']	 = '/js/default.js';

$scripts[3]['type']	 = 'application/javascript';
$scripts[3]['src']	 = '/js/bootbox.min.js';

$scripts[4]['type']	 = 'application/javascript';
$scripts[4]['src']	 = '/js/sb-admin.js';

$scripts[5]['type']	 = 'application/javascript';
$scripts[5]['src']	 = '/js/jquery.metisMenu.js';

$links				 = array();
$links[0]['href']	 = '/css/bootstrap.css';
$links[0]['rel']	 = 'stylesheet';
$links[0]['type']	 = 'application/css';

$links[1]['href']	 = '/css/font-awesome.min.css';
$links[1]['rel']	 = 'stylesheet';
$links[1]['type']	 = 'application/css';

$links[2]['href']	 = '/css/default.css';
$links[2]['rel']	 = 'stylesheet';
$links[2]['type']	 = 'application/css';

$links[3]['href']	 = '/css/sb-admin.css';
$links[3]['rel']	 = 'stylesheet';
$links[3]['type']	 = 'application/css';

$config = array(
	'scripts'	=>$scripts,
	'links'		=>$links
);
?>