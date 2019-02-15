<?php

/**
 * Lightweight_Options_Framework
 *
 * @link       https://github.com/dev-nm/WP-StudioLink-Integration
 * @since      1.0.2
 *
 * @package    Studio_Link_Integration
 * @subpackage Studio_Link_Integration/admin
 */

class Lightweight_Options_Framework {
	
	private $menus;
	private $sections;
	private $fields;
	
	function __construct(){

	}
	
	// Load CSS and JS. This gets hooked from an enqueue_scripts hook
	public function load_dependencies(){
		$my_css_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'css/main.css' ));
		$my_js_ver  = date("ymd-Gis", filemtime( plugin_dir_path( __FILE__ ) . 'js/main.js' ));
		wp_enqueue_style( 'lof_css', plugin_dir_url( __FILE__ ) . 'css/main.css', array(), $my_css_ver);
		wp_enqueue_script( 'lof_js', plugin_dir_url( __FILE__ ) . 'js/main.js', array( 'jquery' ), $my_js_ver);
	}
	
	public function set_menus($menus){
		$this->menus = $menus;
	}
	
	public function set_sections($sections){
		$this->sections = $sections;
	}
	
	public function set_fields($fields){
		$this->fields = $fields;
	}
	
	public function default_settings() {
		$sections = $this->sections;
		$fields = $this->fields;
		$groups = array();
		foreach( (array) $sections as $section ){
			if( empty( $groups[$section['option_get']] ) ){
				// Create new Group
				$groups[$section['option_get']] = array();
			}
			foreach( $fields as $field ){
				// Fill the Groups
				if( $field['section'] = $section['id'] ){
					$value = (empty($field['default']) === false ? $field['default'] : '');
					$groups[$section['option_get']][$field['id']] = $value;
				}
			}
		}
		foreach( $groups as $key => $defaults ){
			add_option($key, $defaults);
		}
	}
	
	public function create_menus(){
		$menus = $this->menus;
		$callback = null;
		foreach( (array)$menus as $menu ){
			if( $menu['type'] == 'menu' ){
				if( isset( $menu['callback'] ) ) {
					$callback = $menu['callback'];
				} else {
					$callback = function() use ($menu) { $this->standart_menu_callback($menu); };
				}
				add_menu_page($menu['page_title'], $menu['menu_title'], $menu['capability'], $menu['slug'], function() use ($callback) { $this->settings_content($callback); }, $menu['icon'], $menu['position']);
				
				if( isset( $menu['submenu_title'] ) ){
					add_submenu_page($menu['slug'], $menu['page_title'], $menu['submenu_title'], $menu['capability'], $menu['slug']);
				}
			}
			if( $menu['type'] == 'submenu' ){
				if( isset( $menu['callback'] ) ) {
					$callback = $menu['callback'];
				} else {
					$callback = function() use ($menu) { $this->standart_menu_callback($menu); };
				}
				add_submenu_page($menu['parent_slug'], $menu['page_title'], $menu['menu_title'], $menu['capability'], $menu['slug'], function() use ($callback) { $this->settings_content($callback); });
			}
		}
	}
	
	public function create_sections() {
		$sections = $this->sections;
		foreach( (array)$sections as $section){
			add_settings_section( $section['id'], $section['title'], $section['callback'], $section['page'] );
		}
	}

	public function create_fields() {
		$fields = $this->fields;
		$sections = $this->sections;
		$groups = array();
		foreach( (array)$sections as $section){
			foreach( $fields as $field ){
				if( $field['section'] == $section['id'] ){
					add_settings_field( $field['id'], $field['label'], array( $this, 'field_callback' ), $section['page'], $field['section'], $field );
				}
			}
			if( empty( $groups[$section['page']] ) ){
				$groups[$section['page']] = $section['option_get'];
			}
		}
		foreach( $groups as $key => $group ) {
			register_setting( $key, $group );
		}
	}
	
	public function standart_menu_callback($menu){
		?>
		<div class="wrap">
			<h1><?php echo( $menu['page_title'] ); ?></h1>
			<?php settings_errors(); echo($var); ?>
			<form method="POST" action="options.php">
				<?php
					settings_fields( $menu['slug'] );
					do_settings_sections( $menu['slug'] );
					submit_button();
				?>
			</form>
		</div> 
		<?php
	}
	
	public function settings_content($callback) { 
		$menus = $this->menus;
		$active_page = isset( $_GET[ 'page' ] ) ? $_GET[ 'page' ] : '';
		if(!is_callable($callback)){
			return;
		}
		?>
		<div class="lof_table">
			<div class="lof_table_menu">
				<div class="vertical-menu">
					<?php
					foreach( $menus as $menu ){
						printf('<a href="?page=%s" class="%s">%s</a>',
						$menu['slug'],
						$active_page == $menu['slug'] ? 'active' : '',
						isset($menu['submenu_title']) === true ? $menu['submenu_title'] : $menu['menu_title']
						);
					}
					?>
				</div>
			</div>
			<div class="content"><?php call_user_func($callback); ?></div>
		</div>
		<?php
	}
	
	public function field_callback( $field ) {
		$sections = $this->sections;
		$section = null;
		foreach( $sections as $sectionvar ){
			if( $field['section'] == $sectionvar['id'] ){
				$section = $sectionvar;
			}
		}
		if( empty($section) ) {
			return;
		}
		$options = get_option( $section['option_get'] );
		$value = $options[ $field['id'] ];
		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}
		switch ( $field['type'] ) {
				case 'checkbox':
					printf('<input %s id="%s" name="%s" type="checkbox" value="1" aria-label="%s">',
						$value === '1' ? 'checked' : '',
						$field['id'],
						$section['option_get'] . '[' . $field['id'] . ']',
						__('Checkbox', 'studio-link-integration') . ' ' . $field['label'] . ' ' . __('with value', 'studio-link-integration') . ' ' . $value === '1' ? __('Checked', 'studio-link-integration') : __('not Checked', 'studio-link-integration')
					);
					break;
				case 'switch':
					echo('<div class="flipswitch">');
					printf('<input aria-label="%s" value="1" type="checkbox" name="%s" class="flipswitch-cb" id="%s" %s>',
						__('Switch', 'studio-link-integration') . ' ' . $field['label'] . ' ' . __('with value', 'studio-link-integration') . ' ' . $value === '1' ? __('On', 'studio-link-integration') : __('Off', 'studio-link-integration'),
						$section['option_get'] . '[' . $field['id'] . ']',
						$field['id'],
						$value === '1' ? 'checked' : ''
					);
					echo('<label class="flipswitch-label" for="' . $field['id'] . '"><div class="flipswitch-inner"></div><div class="flipswitch-switch"></div></label></div>');
					break;
				case 'textarea':
					printf( '<textarea aria-label="%s" name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>',
						__('Text Area', 'studio-link-integration') . ' ' . $field['label'] . ' ' . __('with value', 'studio-link-integration') . ' ' . $value,
						$section['option_get'] . '[' . $field['id'] . ']',
						$placeholder,
						$value
						);
					break;
				case 'twitterpost':
					printf( '<div class="form-group"><textarea aria-label="%s" name="%s" class="form-control status-box" rows="4" cols="50" placeholder="%s">%s</textarea><br><br>Übrig: <div class="counter">280</div></div>',
						__('Text Area', 'studio-link-integration') . ' ' . $field['label'] . ' ' . __('with value', 'studio-link-integration') . ' ' . $value,
						$section['option_get'] . '[' . $field['id'] . ']',
						$placeholder,
						$value
						);
					break;
				case 'custom':
					printf( '<div class="custom" id="%s">%s</div>',
						$section['option_get'] . '[' . $field['id'] . ']',
						$field['value']
						);
					break;
			default:
				printf( '<input aria-label="%s" name="%s" id="%s" type="%s" placeholder="%s" value="%s" />',
					__('Input Field', 'studio-link-integration') . ' ' . $field['label'] . ' ' . __('with value', 'studio-link-integration') . ' ' . $value,
					$section['option_get'] . '[' . $field['id'] . ']',
					$field['id'],
					$field['type'],
					$placeholder,
					$value
				);
		}
		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}
}