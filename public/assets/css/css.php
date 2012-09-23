<?php
// start output buffering
ob_start();

// send headers
header('Content-type: text/css; charset: UTF-8');
header('Cache-control: must-revalidate');
//header('Expires: ' . gmdate('D, d M Y H:i:s', time() + (60*60)) . ' GMT');

// get the name of the requested file
$page = filter_input(INPUT_SERVER, 'QUERY_STRING');

// pull in the global CSS files
require 'reset.css';
require 'base.css';

// pull in the master CSS file if needed
if (!in_array($page, array('account', 'error'))) {
	require 'master.css';
}

// pull in the requested file if it exists
if ($css = realpath($page . '.css')) {
	require $css;
}

// add css for the profiler
echo '#codeigniter_profiler{clear:both;}';

// echo the output
ob_end_flush();