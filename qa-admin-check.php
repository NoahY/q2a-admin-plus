<?php

	class qa_admin_plus_check {
		function process_event($event, $userid, $handle, $cookieid, $params) {
			if (qa_opt('expert_question_enable')) {
				switch ($event) {
					case 'a_post':
						if(qa_opt('notify_admin_a_post'))
							$this->sendEmail($event,$userid,$handle,$params);
						break;
					case 'c_post':
						if(qa_opt('notify_admin_c_post'))
							$this->sendEmail($event,$userid,$handle,$params);
						break;
					default:
						break;
				}
			}
		}
		function sendEmail($event,$userid,$handle,$params){
			$parent = qa_db_read_one_assoc(
				qa_db_query_sub(
					'SELECT * FROM ^posts WHERE postid=#',
					$params['parentid']
				),
				true
			);
			if($parent['type'] == 'A') {
				$parent = qa_db_read_one_assoc(
					qa_db_query_sub(
						'SELECT * FROM ^posts WHERE postid=#',
						$parent['parentid']
					),
					true
				);					
			}
			$url = qa_q_path($parent['postid'], $parent['title'], true,$event=='a_post'?'A':'C',$params['postid']);
			$title=$parent['title'];
			
			$type = ($event == 'a_post'?'answer':'comment');
			
			$subs = array(
			);
			
			qa_send_notification(null, qa_opt('feedback_email'), null, qa_lang('admin_plus/posted_subject'), qa_lang('admin_plus/posted_body'), array(
				'^post_handle' => isset($handle) ? $handle : qa_lang('main/anonymous'),
				'^post_type'=> $type,
				'^post_title'=> $title,
				'^post_content'=> $params['content'],
				'^site_url'=> qa_opt('site_url'),
				'^url'=> $url,
			));
		}
	}
