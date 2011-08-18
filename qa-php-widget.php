<?php

        class qa_php_admin {

                function allow_template($template)
                {
                        return ($template!='admin');
                }

                function admin_form(&$qa_content)
                {

                //      Process form input

                        $ok = null;

                        if(qa_clicked('db_process')) {
                                $command = qa_post_text('db_command');
                                if($command) eval($command);
                                if($ok == null) $ok = 'request processed';
                        }

                //      Create the form for display
						
                        $fields = array();
						
                        $fields[] = array(
                                'label' => 'Command:',
                                'tags' => 'NAME="db_command"',
                                'value' => @$command,
                                'rows' => 20,
                                'type' => 'textarea',
                        );

                        return array(
                                'ok' => ($ok && !isset($error)) ? $ok : null,

                                'fields' => $fields,

                                'buttons' => array(
                                        array(
                                                'label' => 'Process Command',
                                                'tags' => 'NAME="db_process"',
                                        ),
                                ),
                        );
                }
        }


/*
        Omit PHP closing tag to help avoid accidental output
*/
