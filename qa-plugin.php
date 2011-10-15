<?php

/*
	Plugin Name: Admin
	Plugin URI: https://github.com/NoahY/q2a-admin-plus
	Plugin Description: Provides admin additions
	Plugin Version: 1.0b
	Plugin Date: 2011-08-10
	Plugin Author: NoahY
	Plugin Author URI: http://www.question2answer.org/qa/user/NoahY
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.4
*/


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}

	qa_register_plugin_layer('qa-admin-layer.php', 'Admin Layer');
	
	qa_register_plugin_module('module', 'qa-php-widget.php', 'qa_php_admin', 'PHP Admin');

	// dev dump

	function qa_error_log($x) {
		ob_start();
		var_dump($x);
		$contents = ob_get_contents();
		ob_end_clean();
		error_log($contents);
	}


/*
	Omit PHP closing tag to help avoid accidental output
*/
