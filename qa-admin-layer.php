<?php

	class qa_html_theme_layer extends qa_html_theme_base {

	// theme replacement functions

		function head_custom() {
			qa_html_theme_base::head_custom();
		
			$this->output("
<style>
.qa-nav-main-item{
	position:relative;
}
.qa-nav-main-item ul{
	padding-top:1px;
	z-index:1000;
	background:#fff; /* Adding a background makes the dropdown work properly in IE7+. Make this as close to your page's background as possible (i.e. white page == white background). */
	background:rgba(255,255,255,0); /* But! Let's make the background fully transparent where we can, we don't actually want to see it if we can help it... */
	list-style:none;
	position:absolute;
	left:-9999px; /* Hide off-screen when not needed (this is more accessible than display:none;) */
}
.qa-nav-main-item ul li{
	padding-top:1px; /* Introducing a padding between the li and the a give the illusion spaced items */
	float:none;
}
.qa-nav-main-item ul a{
	white-space:nowrap; /* Stop text wrapping and creating multi-line dropdown items */
	font-size:75%;
}
.qa-nav-main-item:hover ul{ /* Display the dropdown on hover */
	left:0; /* Bring back on-screen when needed */
}
</style>
");
		
		}

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
		
		function nav_list($navigation, $class, $level=null)
		{
			if($class == 'nav-sub-dropdown') {
				$this->output('<UL CLASS="qa-'.$class.'-list'.(isset($level) ? (' qa-'.$class.'-list-'.$level) : '').'">');

				foreach ($navigation as $key => $navlink)
					$this->nav_item($key, $navlink, $class, $level);
				
				$this->output('</UL>');
			}
			else if(!is_array($navigation['admin$']) || $class != 'nav-sub') {
				qa_html_theme_base::nav_list($navigation, $class, $level=null);
			}
		}
		
		function nav_item($key, $navlink, $class, $level=null)
		{
			if($class == 'nav-sub-dropdown')
				$class = 'nav-sub';
			if($key == 'admin'&& $class == 'nav-main') {
				$this->output('<LI CLASS="qa-'.$class.'-item'.(@$navlink['opposite'] ? '-opp' : '').
					(@$navlink['state'] ? (' qa-'.$class.'-'.$navlink['state']) : '').' qa-'.$class.'-'.$key.'">');
				$this->nav_link($navlink, $class);
				
				//qa_error_log($this->content['navigation']['sub']);
				
				require_once QA_INCLUDE_DIR.'qa-app-admin.php';
				$this->nav_list(qa_admin_sub_navigation(), 'nav-sub-dropdown', 1+$level);
				
				$this->output('</LI>');
			}
			else		
				qa_html_theme_base::nav_item($key, $navlink, $class, $level=null);

		}

	}

