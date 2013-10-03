<?php
/*
 * Plugin Name: Script Library: Chosen
 * Plugin URI: http://wordpress.lowtone.nl/scripts-chosen
 * Plugin Type: lib
 * Description: Include Chosen Javascript libraries for better select boxes.
 * Version: 1.0
 * Author: Lowtone <info@lowtone.nl>
 * Author URI: http://lowtone.nl
 * License: http://wordpress.lowtone.nl/license
 */

namespace lowtone\scripts\chosen {

	use lowtone\content\packages\Package;

	// Includes
	
	if (!include_once WP_PLUGIN_DIR . "/lowtone-content/lowtone-content.php") 
		return trigger_error("Lowtone Content plugin is required", E_USER_ERROR) && false;

	$GLOBALS["lowtone_scripts_chosen"] = Package::init(array(
			Package::INIT_PACKAGES => array("lowtone\\scripts"),
			Package::INIT_SUCCESS => function() {

				wp_register_style("chosen", LIB_URL . "/lowtone-scripts-chosen/assets/styles/chosen.min.css");

				$dependencies = array(
						"chosen.jquery" => array("jquery"),
						"chosen.proto" => array("prototype")
					);

				return array(
						"registered" => \lowtone\scripts\register(__DIR__ . "/assets/scripts", $dependencies, "1.0.0")
					);
			}
		));

	function registered() {
		global $lowtone_scripts_chosen;
		
		return isset($lowtone_scripts_chosen["registered"]) ? $lowtone_scripts_chosen["registered"] : false;
	}
	
}