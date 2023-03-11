<?php

class Custom_DB_Handler {
	public function __construct() {
		// When WordPress initializes, call the create_custom_table() method.
		add_action( 'init', array( $this, 'create_custom_table' ) );

		// When a post is saved, call the save_acf_data_to_custom_db() method.
		add_action( 'save_post', array( $this, 'save_acf_data_to_custom_db' ) );

		// When a post is deleted, call the delete_custom_data() method.
		add_action( 'delete_post', array( $this, 'delete_custom_data' ) );
	}

	// Create a new custom table in the WordPress database, if it doesn't exist already.
	public function create_custom_table() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'tour_fields';
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
			$charset_collate = $wpdb->get_charset_collate();
			$sql             = "CREATE TABLE $table_name (
			    id mediumint(9) NOT NULL AUTO_INCREMENT,
			    tour_name text NOT NULL,
			    tour_category text NOT NULL,
			    tour_date text NOT NULL,
			    PRIMARY KEY (id)
			) $charset_collate;";
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
	}

	// Save Advanced Custom Fields data to the custom table in the WordPress database.
	public function save_acf_data_to_custom_db( $post_id ) {
		if ( get_post_type( $post_id ) === 'tour' ) {
			global $wpdb;
			$table_name          = $wpdb->prefix . 'tour_fields';
			$tour_name           = get_field( 'tour_name', $post_id, true );
			$tour_category_terms = wp_get_post_terms( $post_id, 'tour-categories', array( 'fields' => 'all' ) );
			$tour_categories     = implode( ', ', array_map( function ( $term ) {
				return $term->name;
			}, $tour_category_terms ) );
			$tour_dates = get_field( 'tour_date_repeater', $post_id );

			$formatted_dates = array();
			if ($tour_dates) {
				foreach ( $tour_dates as $date ) {
					$date_unix         = strtotime( $date['tour_date'] );
					$formatted_dates[] = date( 'd/m/Y', $date_unix );
				}
			}

			// Check if the post already exists in the database
			$post_exists = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $table_name WHERE id = %d", $post_id ) );

			// If the post already exists, update the existing record
			if ( $post_exists ) {
				$wpdb->update(
					$table_name,
					array(
						'tour_name'     => $tour_name,
						'tour_category' => $tour_categories,
						'tour_date'     => maybe_unserialize( implode( ', ', $formatted_dates ) ),
					),
					array( 'id' => $post_id ),
					array( '%s', '%s', '%s' ),
					array( '%d' )
				);
			}
			// If the post does not exist, insert a new record
			else {
				$wpdb->insert(
					$table_name,
					array(
						'id'            => $post_id,
						'tour_name'     => $tour_name,
						'tour_category' => $tour_categories,
						'tour_date'     => maybe_unserialize( implode( ', ', $formatted_dates ) ),
					),
					array( '%d', '%s', '%s' )
				);
			}
		}
	}

	// Function deletes custom data associated with a tour post type from the 'tour_fields'
	public function delete_custom_data( $post_id ) {
		if ( get_post_type( $post_id ) === 'tour' ) {
			global $wpdb;
			$table_name = $wpdb->prefix . 'tour_fields';
			$wpdb->delete( $table_name, array( 'id' => $post_id ), array( '%d' ) );
		}
	}

}

new Custom_DB_Handler();
