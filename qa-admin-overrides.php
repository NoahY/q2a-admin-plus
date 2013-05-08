<?php
		
	function qa_fatal_error( $message ) {
		$message .=  ' ('.$_SERVER['REMOTE_ADDR'].')';
		echo 'Question2Answer fatal error:<P><FONT COLOR="red">'.qa_html($message, true).'</FONT></P>';
		echo '<P><FONT COLOR="red">Your IP address has been logged.</FONT></P>';
		@error_log('PHP Question2Answer fatal error: '.$message);

	}
						
/*							  
		Omit PHP closing tag to help avoid accidental output
*/							  
						  

