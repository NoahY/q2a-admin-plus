<?php

	class qa_admin_plus_check {
		function process_event($event, $userid, $handle, $cookieid, $params) {
			if (qa_opt('expert_question_enable')) {
				switch ($event) {
					case 'a_post':
						if(qa_opt('notify_admin_a_post')) {
							$this->sendEmail($event,$userid,$handle,$params);
						}
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
			$email = $this->getEmail($userid);
			if($email == qa_opt('feedback_email'))
				return;

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
		function getEmail($userid) {
			require_once QA_INCLUDE_DIR.'qa-db-selects.php';
			if (QA_FINAL_EXTERNAL_USERS) {
					$email=qa_get_user_email($userid);
			
			} else {
				$useraccount=qa_db_select_with_pending(
					qa_db_user_account_selectspec($userid, true)
				);
				$email=@$useraccount['email'];
			}
			return $email;
		}
	}
