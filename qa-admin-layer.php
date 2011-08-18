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
						$content[$key]['title'] .= ' <font size="1"><a href="#plugin_contents">top</a></font>';
						$anchor = preg_replace('/.+ACTION="([^"]+)"/','$1', $part['tags']);
						$fields[] = array(
							'type' => 'custom',
							'html' => '<a href="'.$anchor.'">'.preg_replace('/<[^>]+>/','', $part['title']).'</a>',
						);
					}
				}

				$form=array(
					'style' => 'tall',
					
					'fields' => $fields,
				);
				
				$keys = array_keys($content);
				$vals = array_values($content);

				$insertBefore = array_search('form_', $keys);

				$keys2 = array_splice($keys, $insertBefore);
				$vals2 = array_splice($vals, $insertBefore);

				$keys[] = 'form_links';
				$vals[] = $form;

				$content = array_merge(array_combine($keys, $vals), array_combine($keys2, $vals2));				
				
			}
			qa_html_theme_base::main_parts($content);
		}
	}

