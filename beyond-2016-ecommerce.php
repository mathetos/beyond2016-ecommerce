<?php
/*
Plugin Name: Beyond 2016 E-Commcerce
Plugin URI: https://www.mattcromwell.com
Description: This is an extension of the "Beyond 2016" theme. It enhances the archives and single product pages for the Give Donation plugin, Easy Digital Downloads, and WooCommerce for "Beyond 2016".
Version: 1.0.0
Author: webdevmattcrom
Author URI: https://www.mattcromwell.com
License: GPLv2 or later
Text Domain: b16ecom
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2016 Matt Cromwell
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

// Globals
define( 'B16ECOM_SLUG', 'b16ecom' );
define( 'WB16ECOM_PATH', plugin_dir_path( __FILE__ ) );
define( 'B16ECOM_URL', plugin_dir_url( __FILE__ ) );
define( 'B16ECOM_VERSION', '1.0' );

class B16ECOM_Loader {

  public function __construct() {
    $this->plugin_slug = B16ECOM_SLUG;
    $this->version = B16ECOM_VERSION;

    add_action( 'plugins_loaded', array( $this, 'give_templates' ), 1, 1);
    add_action( 'plugins_loaded', array( $this, 'edd_templates' ), 1);
    add_action( 'plugins_loaded', array( $this, 'woo_templates' ), 1);
  }

  public function give_templates() {
      require_once( WB16ECOM_PATH . '/integrations/give/give-bootstrapper.php');

  }

  function edd_templates() {
    if ( class_exists('Easy_Digital_Downloads') ) {
      require_once( WB16ECOM_PATH . '/integrations/edd/edd-bootstrapper.php');
    }
  }

  function woo_templates() {
    if ( class_exists('WooCommerce') ) {
      require_once( WB16ECOM_PATH . '/integrations/woocommerce/woocommerce-bootstrapper.php');
    }
  }

  public function run() {
  }
}

function run_b16ecom_loader() {

    $b16ecom = new B16ECOM_Loader();
    $b16ecom->run();

}

run_b16ecom_loader();
