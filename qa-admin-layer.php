<?php

	class qa_html_theme_layer extends qa_html_theme_base {

	// theme replacement functions

		function main_parts($content)
		{
			if ($this->template=='admin' && $this->request == 'admin/plugins') {

				$fields['plugins'] = array(
					'type' => 'custom',
					'label' => '<a name="plugin_contents">Plugin Settings:</a>',
					'html' => '',
				);
				

				$anchors = array();
				foreach ($content as $key => $part) {
					if (strpos($key, 'form_')===0) {
						$content[$key]['title'] .= ' <font size="1" style="cursor:pointer; color:blue" onclick="jQuery(\'html\').scrollTop(0)">top</font>';
					}
				}
				
			}
			qa_html_theme_base::main_parts($content);
		}
	}

