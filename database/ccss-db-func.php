<?php

function ccss_get_css_information($exclude="")
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_INFO . " ";
	if($exclude != "") $sql .= "WHERE css_id not in ($exclude) ";
	return $wpdb->get_results( $sql );
}

function ccss_get_css_time()
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_TIME . " a LEFT JOIN " . CCSS_TABLE_CCSS_INFO . " b ON a.css_id = b.css_id";
	return $wpdb->get_results( $sql );
}

function ccss_get_css_by_time($state)
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_TIME . " a LEFT JOIN " . CCSS_TABLE_CCSS_INFO . " b ON a.css_id = b.css_id WHERE time_block = '" . $state . "'";
	return $wpdb->get_row( $sql );
}

function ccss_is_css_desc_duplicate($desc)
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_INFO . " WHERE css_desc = '" . $desc . "'";
	if(count( $wpdb->get_row( $sql )) == 0) return false;
	else return true;
}

function ccss_is_css_path_duplicate($path)
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_INFO . " WHERE css_path = '" . $path . "'";
	if(count( $wpdb->get_row( $sql )) == 0) return false;
	else return true;
}


// Date dependent

function ccss_get_css_by_date($date)
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_DATE . " a LEFT JOIN " . CCSS_TABLE_CCSS_INFO . " b ON a.css_id = b.css_id WHERE date = '" . $date . "'";
	return $wpdb->get_row( $sql );
}

function ccss_link_css_by_date($date, $css_id)
{
	global $wpdb;
	if(ccss_get_css_by_date($date) != null)
	{
		return $wpdb->update( CCSS_TABLE_CCSS_DATE, array( 'css_id' => $css_id ), array( 'date' => $date ), array( '%d' ), array( '%s' ) );
	}
	else
	{
		return $wpdb->insert( CCSS_TABLE_CCSS_DATE, array( 'date' => $date, css_id => $css_id ), array( '%s', '%d' ) );
	}
}

function ccss_unlink_css_by_date($date)
{
	global $wpdb;
	return $wpdb->update( CCSS_TABLE_CCSS_DATE, array( 'css_id' => null ), array( 'date' => $date ), array( '%d' ), array( '%s' ) );
}


// Day dependent

function ccss_get_css_day()
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_DAY . " a LEFT JOIN " . CCSS_TABLE_CCSS_INFO . " b ON a.css_id = b.css_id";
	return $wpdb->get_results( $sql );
}

function ccss_get_css_by_day($day)
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_DAY . " a LEFT JOIN " . CCSS_TABLE_CCSS_INFO . " b ON a.css_id = b.css_id WHERE day = '" . $day . "'";
	return $wpdb->get_row( $sql );
}



// Month dependent

function ccss_get_css_month()
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_MONTH . " a LEFT JOIN " . CCSS_TABLE_CCSS_INFO . " b ON a.css_id = b.css_id";
	return $wpdb->get_results( $sql );
}

function ccss_get_css_by_month($month)
{
	global $wpdb;
	$sql = "SELECT * FROM " . CCSS_TABLE_CCSS_MONTH . " a LEFT JOIN " . CCSS_TABLE_CCSS_INFO . " b ON a.css_id = b.css_id WHERE month = '" . $month . "'";
	return $wpdb->get_row( $sql );
}


?>