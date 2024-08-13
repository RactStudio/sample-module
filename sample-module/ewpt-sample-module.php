<?php
// essential-wp-tools/modules/sample-module/ewpt-sample-module.php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use Essential\WP\Tools\ewpt as ewpt;

// Register settings
add_action( 'init', function () {
	ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_disable_all_sample_module_options', 'boolean');
	ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_sample_module_menu_link', 'string');
	
	//ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_sample_module_demo_switch', 'boolean');
	//ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_sample_module_demo_input', 'string');
	//ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_sample_module_demo_select', 'string');
	//ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_sample_module_demo_textarea', 'string');
	//ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_sample_module_demo_multiselect', 'string');
	//ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_sample_module_demo_color', 'color');
	//ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_sample_module_demo_html', 'html_raw');
	//ewpt::register_setting_data('ewpt_sample_module_settings', 'ewpt_sample_module_demo_post', 'html_post');
});

// Menu of the Module
add_action( 'admin_menu', function () {
	// Get the option for menu visibility
	$menu_visibility_option = get_option('ewpt_sample_module_menu_link', 'sub_menu');
	// Module menu name parameters
	$module_name = 'Sample Module'; // Define the module name/title here
	ewpt::assign_modules_menu_link($menu_visibility_option, $module_name);
});

// Callback function to render the settings page
if (!function_exists('ewpt_sample_module_settings_page')) {
function ewpt_sample_module_settings_page() {
    // Include the module config file
	include(plugin_dir_path(__FILE__) . 'ewpt-sample-module-config.php');
	
?>

	<div id="ewpt-page-header" class="ewpt-page-header">
	
		<?php
		// Include the module header file
		include EWPT_PLUGIN_PATH . 'inc/ewpt-modules-header.php';
		?>
		
	</div>
	
    <div id="ewpt-page-main" class="wrap ewpt-page-main">
		<div id="ewpt-page-body" class="ewpt-page-body">
			
			<h1>
			
				<!-- Show Mask -->
				<div id="ewpt-mask"></div>
				
				<?php
				// Include the module header file
				include EWPT_PLUGIN_PATH . 'inc/ewpt-modules-header-sub.php';
				?>
				
			</h1>
	
			<!-- Tab -->
			<h2 class="nav-tab-wrapper">
				<a href="#<?php echo sanitize_html_class($EWPT_MODULE_TAB_DEFAULT); ?>" class="nav-tab">Settings</a>
				<!-- Add more Module Settings Page Tab Here -->
				<a href="#sample-tab" class="nav-tab">Sample Tab</a>
				<a href="#about-module" class="nav-tab">About</a>
				<div class="nav-tab ewpt-save-button"><p class="submit"><input form="<?php echo sanitize_html_class(strtolower(EWPT_SHORT_SLUG)); ?>-form" type="submit" name="submit" id="submit" class="ewpt-save-btn button button-primary" value="Save Changes"></p></div>
			</h2>
			
			<form id="<?php echo sanitize_html_class(strtolower(EWPT_SHORT_SLUG)); ?>-form" name="<?php echo sanitize_html_class(strtolower(EWPT_SHORT_SLUG)); ?>-form" method="post" action="options.php">
			
				<?php wp_nonce_field( esc_attr(strtolower(EWPT_SHORT_SLUG).'_nonce'), esc_attr(strtolower(EWPT_SHORT_SLUG).'_nonce') ); ?>
				<?php //settings_errors(); ?>
				<?php settings_fields(esc_attr(strtolower(EWPT_SHORT_SLUG.'_'.$EWPT_MODULE_VAR.'_settings'))); ?>
				<?php //do_settings_sections(esc_attr(strtolower(EWPT_SHORT_SLUG.'_'.$EWPT_MODULE_VAR.'_settings'))); ?>
				<?php //do_settings_sections(esc_attr(strtolower(EWPT_SHORT_SLUG.'-'.$EWPT_MODULE_SLUG))); ?>
				
				<div id="<?php echo sanitize_html_class($EWPT_MODULE_TAB_DEFAULT); ?>" class="tab-content" style="display: none;">
					<div class="tab-pane">
						<h3 class="ewpt-no-top-border"><?php echo esc_attr($EWPT_MODULE_NAME); ?> Settings</h3>
						
						<table class="form-table ewpt-form ewpt-border-radius-bottom-5px">
							<tr valign="top">
								<th scope="row">All Options</th>
								<td>
									<label>
										<input type="checkbox" name="ewpt_disable_all_sample_module_options" value="1" <?php checked(get_option('ewpt_disable_all_sample_module_options', 0)) ?> />
										Disable
									</label>
								</td>
								<td>
									<div class='ewpt-info-red'>
										Disable all options action and won't load hooks files, unchecked means all actions are active.
									</div>
								</td>
							</tr>
							
							<tr valign="top">
								<th scope="row">Menu Link</th>
								<td>
										<select name="ewpt_sample_module_menu_link">
											<option value="sub_menu" <?php selected(get_option("ewpt_sample_module_menu_link"), 'sub_menu'); ?>>Sub Menu</option>
											<option value="main_menu" <?php selected(get_option("ewpt_sample_module_menu_link"), 'main_menu'); ?>>Main Menu</option>
											<option value="hidden_menu" <?php selected(get_option("ewpt_sample_module_menu_link"), 'hidden_menu'); ?>>Hide Menu</option>
										</select>
								</td>
								<td>
									<div class='ewpt-info-blue'>
										'Sub Menu': Add this module settings page link inside 'EWPT Dashboard' menu.<br/>
										'Main Menu': Add this module settings page link as main menu link (standalone).<br/>
										'Hide menu': Hide this settings page link. Link only available on 'EWPT Dashboard' page.
									</div>
								</td>
							</tr>
						</table>
						
					</div>
					
					<div class="ewpt-save-button" style="margin: 30px 0 0 0;">
						<p class="submit"><input form="<?php echo sanitize_html_class(EWPT_SHORT_SLUG); ?>-form" type="submit" name="submit" id="submit" class="ewpt-save-btn button button-primary" value="Save Changes"></p>
					</div>
					
				</div>
				
				<!-- Sample Tab -->
				<div id="sample-tab" class="tab-content" style="display: none;">
					<div class="tab-pane">
						
						<h3 class="ewpt-no-top-border">Sample Tab Title</h3>
						<table class="form-table ewpt-form ewpt-form-border-bottom ewpt-border-radius-bottom-5px">

							<tr valign="top">
								<th scope="row">Options Title</th>
								<td>
									<label>
										<input type="checkbox" name="" value="1"  />
										Enable / Disable
									</label>
								</td>
								<td>
									<div class='ewpt-info-blue'>
										Instructions of the option
									</div>
								</td>
							</tr>
							
						</table>
						
					</div>
					
					<div class="ewpt-save-button" style="margin: 30px 0 0 0;">
						<p class="submit"><input form="<?php echo sanitize_html_class(EWPT_SHORT_SLUG); ?>-form" type="submit" name="submit" id="submit" class="ewpt-save-btn button button-primary" value="Save Changes"></p>
					</div>
					
				</div>
				
				<?php
				// Include the module about file
				include(EWPT_PLUGIN_PATH . 'inc/ewpt-about-modules.php');
				?>
				
				<?php //submit_button('Save Changes'); ?>
						
			</form>
						
		</div>

		<div id="ewpt-page-footer" class="ewpt-page-footer">
			
			<?php
			// Include the module footer file
			include(EWPT_PLUGIN_PATH . 'inc/ewpt-modules-footer.php');
			?>
			
		</div>
		
	</div>
	
	
    <?php
}

	// Include the actions (mostly ajax call)
	include plugin_dir_path(__FILE__) . 'ewpt-sample-module-actions.php';

} // if (!function_exists('ewpt_sample_module_settings_page'))