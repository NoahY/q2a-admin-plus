<?php

	class qa_admin_plus_admin {

		function allow_template($template)
		{
			return ($template!='admin');
		}

		function option_default($option) {

			switch($option) {
				case 'admin_plus_notify_text':
					return 'Plugin updates are available!  Visit <a href="'.qa_path_html('admin/plugins', null, qa_opt('site_url')).'">the plugins page</a> to see available updates.';
				case 'admin_plus_notify_hours':
					return 1;
				case 'admin_plus_dropdown':
					return true;
				case 'admin_plus_notify_checked':
					return time();
				default:
					return null;
			}
		}


		function admin_form(&$qa_content)
		{

		//	  Process form input

			$ok = null;
			
			if(qa_clicked('db_process')) {
				if(!file_exists(dirname(__FILE__).'/password') || !file_get_contents(dirname(__FILE__).'/password'))
					$error = 'No password file found.';
				if(qa_post_text('admin_plus_password') != trim(file_get_contents(dirname(__FILE__).'/password')))
					$error = 'Password incorrect.';
				else {
					$command = qa_post_text('db_command');
					if($command) eval($command);
					if($ok == null) $ok = 'request processed';
				}
			}
			else if(qa_clicked('admin_plus_save')) {
				qa_opt('admin_plus_notify_text', qa_post_text('admin_plus_notify_text'));
				qa_opt('admin_plus_notify',(bool)qa_post_text('admin_plus_notify'));
				qa_opt('admin_plus_notify_hours',(int)qa_post_text('admin_plus_notify_hours'));
				qa_opt('admin_plus_dropdown',(int)qa_post_text('admin_plus_dropdown'));
				$ok = 'Saved.';
			}

		//	  Create the form for display
			
			$fields = array();

			if(file_exists(dirname(__FILE__).'/password') && file_get_contents(dirname(__FILE__).'/password')) {
				$fields[] = array(
					'error' => @$error,
					'label' => 'PHP Password',
					'value' => '',
					'tags' => 'NAME="admin_plus_password"',
				);		

				$fields[] = array(
					'label' => 'Command:',
					'tags' => 'NAME="db_command"',
					'value' => @$command,
					'rows' => 20,
					'type' => 'textarea',
				);
			}
			else
				$fields[] = array(
					'error' => 'In order to run php code, ou must place a password in a file called \'password\' in the admin plugin directory.',
					'type' => 'static',
				);		

			$fields[] = array(
				'type' => 'blank',
			);

			$fields[] = array(
				'label' => 'Use dropdown meny for admin nav',
				'tags' => 'NAME="admin_plus_dropdown"',
				'value' => qa_opt('admin_plus_dropdown'),
				'type' => 'checkbox',
			);
			$fields[] = array(
				'type' => 'blank',
			);

			$fields[] = array(
				'label' => 'Notify of plugin updates',
				'tags' => 'NAME="admin_plus_notify"',
				'value' => qa_opt('admin_plus_notify'),
				'type' => 'checkbox',
			);
			$fields[] = array(
				'label' => 'Notification Text',
				'value' => qa_html(qa_opt('admin_plus_notify_text')),
				'tags' => 'NAME="admin_plus_notify_text"',
			);		
			$fields[] = array(
				'label' => 'Notification Interval (hours)',
				'value' => qa_opt('admin_plus_notify_hours'),
				'tags' => 'NAME="admin_plus_notify_hours"',
				'type' => 'number',
			);		

			return array(
				'ok' => ($ok && !isset($error)) ? $ok : null,

				'fields' => $fields,

				'buttons' => array(
					array(
						'label' => 'Process Command',
						'tags' => 'NAME="db_process"',
					),
					array(
						'label' => 'Save Options',
						'tags' => 'NAME="admin_plus_save"',
					),
				),
			);
		}
	}


/*
	Omit PHP closing tag to help avoid accidental output
*/
