<?php 

/**
 *  Adds Layout Metabox to Give Edit Form Pages
 */

 function beyond2016_give_layout_metaboxes( $post ) {

 add_meta_box(
     'beyond2016_give_layout_options',      // Unique ID
     __( 'Page Layout Options', 'beyond2016' ),    // Title
     'beyond2016_give_layout_options',   // Callback function
     null,
     'side',         // Context
     'core'         // Priority
   );
 }

 add_action( 'add_meta_boxes_give_forms', 'beyond2016_give_layout_metaboxes', 10, 2 );


 /* Display the post meta box. */
 function beyond2016_give_layout_options( $post ) { ?>

    <?php
 		wp_nonce_field( basename( __FILE__ ), 'beyond2016_give_layout_nonce' );
       	
       	$beyond2016_page_meta = get_post_meta( $post->ID );
 	?>

 	<div class="instructions">
 	  	<p>This section gives you the ability to control the layout of your single Give forms. All of these can be set globally via the Customizer, but if you change them here, these options will be used for this form only.</p>
 	</div>

     <fieldset>
      	<legend for="beyond2016_main_sidebar_layout" id="beyond2016_main_sidebar_layout">
      		<strong><?php _e( "Main Sidebar", 'beyond2016' ); ?></strong>
      	</legend>

      	<label for="beyond2016-main-sidebar-disable">
        	<input type="radio" name="beyond2016-main-sidebar-layout" id="beyond2016-main-sidebar-disable" value="disable" <?php if ( isset ( $beyond2016_page_meta['beyond2016-main-sidebar-layout'] ) ) checked( $beyond2016_page_meta['beyond2016-main-sidebar-layout'][0], 'disable' ); ?>>
        	<?php _e( "Disable the Main Sidebar", 'beyond2016' ); ?>
      	</label><br />

      	<label for="beyond2016-main-sidebar-right">
        	<input type="radio" name="beyond2016-main-sidebar-layout" id="beyond2016-main-sidebar-right" value="right" <?php if ( isset ( $beyond2016_page_meta['beyond2016-main-sidebar-layout'] ) ) checked( $beyond2016_page_meta['beyond2016-main-sidebar-layout'][0], 'right' ); ?>>
        	<?php _e( "Right-hand Main Sidebar", 'beyond2016' ); ?>
      	</label><br />

      	<label for="beyond2016-main-sidebar-left">
        	<input type="radio" name="beyond2016-main-sidebar-layout" id="beyond2016-main-sidebar-left" value="left" <?php if ( isset ( $beyond2016_page_meta['beyond2016-main-sidebar-layout'] ) ) checked( $beyond2016_page_meta['beyond2016-main-sidebar-layout'][0], 'left' ); ?>>
        	<?php _e( "Left-hand Main Sidebar", 'beyond2016' ); ?>
      	</label>
    </fieldset>

    <fieldset>
      	<legend for="beyond2016_hide_give_elements" id="beyond2016_hide_give_elements">
      		<strong><?php _e( "Hide Elements", 'beyond2016' ); ?></strong>
      	</legend>
      	<label for="disable-give-title">
            <input type="checkbox" name="disable-give-title" id="disable-give-title" value="yes" <?php if ( isset ( $beyond2016_page_meta['disable-give-title'] ) ) checked( $beyond2016_page_meta['disable-give-title'][0], 'yes' ); ?> />
            <?php _e( 'Hide the Form Title?', 'beyond2016' )?>
        </label><br />
        <label for="hide-give-bottom-sidebar">
            <input type="checkbox" name="hide-give-bottom-sidebar" id="hide-give-bottom-sidebar" value="yes" <?php if ( isset ( $beyond2016_page_meta['hide-give-bottom-sidebar'] ) ) checked( $beyond2016_page_meta['hide-give-bottom-sidebar'][0], 'yes' ); ?> />
            <?php _e( 'Hide the Bottom Sidebar?', 'beyond2016' )?>
        </label><br />
        <label for="hide-footer">
            <input type="checkbox" name="hide-footer" id="hide-footer" value="yes" <?php if ( isset ( $beyond2016_page_meta['hide-footer'] ) ) checked( $beyond2016_page_meta['hide-footer'][0], 'yes' ); ?> />
            <?php _e( 'Hide the Footer?', 'beyond2016' )?>
        </label>
    </fieldset>

    <fieldset>
      	<legend for="beyond2016_hide_give_sidebar" id="beyond2016_hide_give_sidebar">
      		<strong><?php _e( "Hide Give Sidebar", 'beyond2016' ); ?></strong>
      	</legend>
      	<label for="hide-give-sidebar">
            <input type="checkbox" name="hide-give-sidebar" id="hide-give-sidebar" value="yes" <?php if ( isset ( $beyond2016_page_meta['hide-give-sidebar'] ) ) checked( $beyond2016_page_meta['hide-give-sidebar'][0], 'yes' ); ?> />
            <?php _e( 'Hide the Give Sidebar?', 'beyond2016' )?>
        </label>
    </fieldset>

   <?php }

   /**
    * Save post metadata when a post is saved.
    *
    * @param int $post_id The post ID.
    * @param post $post The post object.
    * @param bool $update Whether this is an existing post being updated or not.
    */
   function save_beyond2016_give_layout_options( $post_id, $post, $update ) {

     // Save Sidebar Layout Option
     if( isset( $_POST[ 'beyond2016-main-sidebar-layout' ] ) ) {
         update_post_meta( $post_id, 'beyond2016-main-sidebar-layout', $_POST[ 'beyond2016-main-sidebar-layout' ] );
     }

     // Save Disable Title Page Option
     if( isset( $_POST[ 'disable-give-title' ] ) ) {
       update_post_meta( $post_id, 'disable-give-title', 'yes' );
     } else {
         update_post_meta( $post_id, 'disable-give-title', '' );
     }

     // Save Hide Bottom Sidebar Page Option
     if( isset( $_POST[ 'hide-give-bottom-sidebar' ] ) ) {
       update_post_meta( $post_id, 'hide-give-bottom-sidebar', 'yes' );
     } else {
         update_post_meta( $post_id, 'hide-give-bottom-sidebar', '' );
     }

     // Save Hide Footer Page Option
     if( isset( $_POST[ 'hide-footer' ] ) ) {
       update_post_meta( $post_id, 'hide-footer', 'yes' );
     } else {
         update_post_meta( $post_id, 'hide-footer', '' );
     }

     // Save Hide Give Sidebar Option
     if( isset( $_POST[ 'hide-give-sidebar' ] ) ) {
       update_post_meta( $post_id, 'hide-give-sidebar', 'yes' );
     } else {
         update_post_meta( $post_id, 'hide-give-sidebar', '' );
     }

 }

 add_action( 'save_post_give_forms', 'save_beyond2016_give_layout_options', 10, 3 );
