<?php
// essential-wp-tools/modules/sample-module/ewpt-sample-module-config.php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//Defined Variable Parameters
$EWPT_MODULE_NAME = "Sample Module";
$EWPT_MODULE_DESC = "This is a sample module for developers to build module for EWPT.";
$EWPT_MODULE_READY = "Development"; // eg: Production, Development
$EWPT_MODULE_VAR = "sample_module";
$EWPT_MODULE_SLUG = "sample-module";
$EWPT_MODULE_TAB_VAR = "SampleModule";
$EWPT_MODULE_TAB_DEFAULT = "default-settings";
$EWPT_MODULE_VERSION = "0.1.0";
$EWPT_MODULE_URL = "https://github.com/RactStudio/".$EWPT_MODULE_SLUG."/";
$EWPT_MODULE_AUTHOR = "RactStudio";
$EWPT_MODULE_AUTHOR_URL = "https://ractstudio.com/";
$EWPT_MODULE_DONATE = "https://www.patreon.com/RactStudio";

// Check module readiness
if ($EWPT_MODULE_READY == "Production") {
	$module_ready_class = "ewpt-info-green";
} elseif ($EWPT_MODULE_READY == "Development") {
	$module_ready_class = "ewpt-info-red";
} else {
	$module_ready_class = "ewpt-info-blue";
}