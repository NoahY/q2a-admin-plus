<?php

/*
	Plugin Name: Admin
	Plugin URI: https://github.com/NoahY/q2a-admin-plus
	Plugin Description: Provides admin additions
	Plugin Version: 0.1
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
	

/*
	Omit PHP closing tag to help avoid accidental output
*/
