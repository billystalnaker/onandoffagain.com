<?php

$scripts = array();
$i		 = 0;

$scripts[$i]['type'] = 'application/javascript';
$scripts[$i]['src']	 = '/js/jquery.js';
$i++;
$scripts[$i]['type'] = 'application/javascript';
$scripts[$i]['src']	 = '/js/bootstrap.min.js';
$i++;
$scripts[$i]['type'] = 'application/javascript';
$scripts[$i]['src']	 = '/js/default.js';
$i++;
$scripts[$i]['type'] = 'application/javascript';
$scripts[$i]['src']	 = '/js/bootbox.min.js';
$i++;
$scripts[$i]['type'] = 'application/javascript';
$scripts[$i]['src']	 = '/js/sb-admin.js';
$i++;
$scripts[$i]['type'] = 'application/javascript';
$scripts[$i]['src']	 = '/js/jquery.metisMenu.js';
$i++;
$scripts[$i]['type'] = 'application/javascript';
$scripts[$i]['src']	 = '/js/jquery.dataTables.js';
$i++;
$scripts[$i]['type'] = 'application/javascript';
$scripts[$i]['src']	 = '/js/dataTables.bootstrap.js';
$i++;
$scripts[$i]['type'] = 'application/javascript';
$scripts[$i]['src']	 = '/js/bootstrap-switch.min.js';
$i++;

$links	 = array();
$i		 = 0;

$links[$i]['href']	 = '/css/bootstrap.css';
$links[$i]['rel']	 = 'stylesheet';
$links[$i]['type']	 = 'application/css';
$i++;
$links[$i]['href']	 = '/css/font-awesome.min.css';
$links[$i]['rel']	 = 'stylesheet';
$links[$i]['type']	 = 'application/css';
$i++;
$links[$i]['href']	 = '/css/default.css';
$links[$i]['rel']	 = 'stylesheet';
$links[$i]['type']	 = 'application/css';
$i++;
$links[$i]['href']	 = '/css/sb-admin.css';
$links[$i]['rel']	 = 'stylesheet';
$links[$i]['type']	 = 'application/css';
$i++;
$links[$i]['href']	 = '/css/dataTables.bootstrap.css';
$links[$i]['rel']	 = 'stylesheet';
$links[$i]['type']	 = 'application/css';
$i++;
$links[$i]['href']	 = '/css/bootstrap-switch.min.css';
$links[$i]['rel']	 = 'stylesheet';
$links[$i]['type']	 = 'application/css';
$i++;

$config = array(
	'scripts'	=>$scripts,
	'links'		=>$links
);
?>