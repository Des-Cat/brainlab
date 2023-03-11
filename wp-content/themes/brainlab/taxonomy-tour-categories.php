<?php
get_header();
// Connect to the database
global $wpdb;

// Get the current tour category
$current_term = get_queried_object();

// Query to get data from the custom table "tour_fields"
$query = $wpdb->prepare( "
    SELECT *
    FROM {$wpdb->prefix}tour_fields
    WHERE tour_category = '$current_term->name'
" );

// Get the results of the query
$results = $wpdb->get_results( $query );

// Check if there are any results
if ( $results ) {
	// Loop through the results array
	foreach ( $results as $result ) {
		$dates    = explode( ", ", $result->tour_date );
		$min_date = null; // variable to store the minimum date
		$today    = new DateTime(); // create a DateTime object for today's date

		foreach ( $dates as $date_str ) {
			$date = DateTime::createFromFormat( 'd/m/Y', $date_str ); // create a DateTime object from the date string
			if ( $date > $today ) { // check that the date is not expired
				if ( $min_date === null || $date < $min_date ) {
					$min_date = $date; // if the current date is less than the minimum date, update the variable
				}
			}
		}
		// Output the data from the custom table with classes
		echo '<div class="tour-data"><span class="label">Tour Name</span>' . ': ' . $result->tour_name . '</div>';
		echo '<div class="tour-data"><span class="label">Tour Category</span>' . ': ' . $result->tour_category . '</div>';
		if ( $min_date !== null ) {
			echo '<div class="tour-data"><span class="label">Next Tour Date</span>' . ': ' . $min_date->format( 'd/m/Y' ) . '</div><br><br>';
		} else {
			echo '<div class="tour-data"><span class="label">Next Tour Date</span>' . ': ' . 'Tour completed' . '</div><br><br>';
		}

	}
}
?>