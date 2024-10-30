<?php

// admin template
require_once(CCSS_PLUGIN_DIR . '/admin/ccss-admin-css-list.php');


// DB manipulate function
require_once CCSS_PLUGIN_DIR . '/database/ccss-db-func.php';





function add_css(){
	
	global $wpdb;
	$css_desc = $_POST['css_desc'];
	$css_path = $_POST['css_path'];
	
	// Check CURL extension
	if(!in_array('curl', get_loaded_extensions())){
		$msg = "PHP Curl extension is disabled.<br />Please enabled it or disable the 'file checking' in setting option.";
		$msg_type = 'error';
		echo json_encode(array("msg" => $msg, "msg_type" => $msg_type));
		exit;
	}
	
	if( (get_option('ccss_file_check') == 'file-check-disable') ? true : url_exists($css_path))
	{
		if($css_desc == '')
		{
			$msg = "CSS description is required field";
			$msg_type = 'error';
		}
		else if(preg_match('/.css/',$css_path) == 0)
		{
			$msg = "CSS path is required field";
			$msg_type = 'error';
		}
		else if(ccss_is_css_desc_duplicate($css_desc))
		{
			$msg = "CSS description is duplicate";
			$msg_type = 'error';
		}
		else if(ccss_is_css_path_duplicate($css_path))
		{
			$msg = "CSS path is duplicate";
			$msg_type = 'error';
		}
		else
		{
			$wpdb->insert( CCSS_TABLE_CCSS_INFO, array( 'css_desc' => $css_desc, 'css_path' => $css_path ), array( '%s', '%s' ) );
			$ccss_css_info_set = ccss_get_css_information();
			
			ob_start();
				echo ccss_admin_css_list($ccss_css_info_set);
			$msg = ob_get_contents();
			ob_end_clean();
			
			$msg_type = 'data';
		}
	}
	else
	{
		$msg = "CSS file does not exist";
		$msg_type = 'error';
	}
	
	echo json_encode(array("msg" => $msg, "msg_type" => $msg_type));
	exit;
}
add_action('wp_ajax_add_css', 'add_css');

function url_exists($url) {
    $handle   = curl_init($url);
    if (false === $handle)
    {
        return false;
    }
    curl_setopt($handle, CURLOPT_HEADER, false);
    curl_setopt($handle, CURLOPT_FAILONERROR, true);
    curl_setopt($handle, CURLOPT_NOBODY, true);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
    $connectable = curl_exec($handle);
    curl_close($handle);
    return $connectable;
}


function remove_css(){
	
	global $wpdb;
	$css_id = $_POST['css_id'];
	
	$wpdb->query("DELETE FROM " . CCSS_TABLE_CCSS_INFO . " WHERE css_id = " . $css_id );
	
	$ccss_css_info_set = ccss_get_css_information();
	echo ccss_admin_css_list($ccss_css_info_set);
	exit;
}
add_action('wp_ajax_remove_css', 'remove_css');


// Time function
function link_css_time()
{
	global $wpdb;
	$css_id = $_POST['css_id'];
	$time_block = $_POST['time_block'];
	
	$wpdb->update( CCSS_TABLE_CCSS_TIME, array( 'css_id' => $css_id ), array( 'time_block' => $time_block ), array( '%d' ), array( '%s' ) );
	
	exit;
}
add_action('wp_ajax_link_css_time', 'link_css_time');

function unlink_css_time()
{
	global $wpdb;
	$time_block = $_POST['time_block'];
	
	$wpdb->update( CCSS_TABLE_CCSS_TIME, array( 'css_id' => null ), array( 'time_block' => $time_block ), array( '%d' ), array( '%s' ) );
	
	exit;
}
add_action('wp_ajax_unlink_css_time', 'unlink_css_time');

// Date funtion
function get_css_date()
{
	$date = $_POST['date'];
	$css_info = ccss_get_css_by_date($date);
	
	if($css_info->css_id != null)
	{
		$msg = $css_info->css_desc;
		$msg_type = "found";
	}
	else
	{
		$msg_type = "not found";
	}
	
	echo json_encode(array("msg" => $msg, "msg_type" => $msg_type));
	exit;
}
add_action('wp_ajax_get_css_date', 'get_css_date');


function link_css_date()
{
	$date = $_POST['date'];
	$css_id = $_POST['css_id'];
	
	if(ccss_link_css_by_date($date, $css_id))
	{
		$msg_type = "success";
	}
	else
	{
		$msg_type = "not success";
	}
	
	echo json_encode(array("msg" => $msg, "msg_type" => $msg_type));
	exit;
}
add_action('wp_ajax_link_css_date', 'link_css_date');


function unlink_css_date()
{
	$date = $_POST['date'];
	
	if(ccss_unlink_css_by_date($date))
	{
		$msg_type = "success";
	}
	else
	{
		$msg_type = "not success";
		$msg = $date;
	}
	
	echo json_encode(array("msg" => $msg, "msg_type" => $msg_type));
	exit;
}
add_action('wp_ajax_unlink_css_date', 'unlink_css_date');


// Day function
function link_css_day()
{
	global $wpdb;
	$css_id = $_POST['css_id'];
	$day = $_POST['day'];
	
	$wpdb->update( CCSS_TABLE_CCSS_DAY, array( 'css_id' => $css_id ), array( 'day' => $day ), array( '%d' ), array( '%s' ) );
	
	exit;
}
add_action('wp_ajax_link_css_day', 'link_css_day');

function unlink_css_day()
{
	global $wpdb;
	$day = $_POST['day'];
	
	$wpdb->update( CCSS_TABLE_CCSS_DAY, array( 'css_id' => null ), array( 'day' => $day ), array( '%d' ), array( '%s' ) );
	
	exit;
}
add_action('wp_ajax_unlink_css_day', 'unlink_css_day');


// Month function
function link_css_month()
{
	global $wpdb;
	$css_id = $_POST['css_id'];
	$month = $_POST['month'];
	
	$wpdb->update( CCSS_TABLE_CCSS_MONTH, array( 'css_id' => $css_id ), array( 'month' => $month ), array( '%d' ), array( '%s' ) );
	
	exit;
}
add_action('wp_ajax_link_css_month', 'link_css_month');

function unlink_css_month()
{
	global $wpdb;
	$month = $_POST['month'];
	
	$wpdb->update( CCSS_TABLE_CCSS_MONTH, array( 'css_id' => null ), array( 'month' => $month ), array( '%d' ), array( '%s' ) );
	
	exit;
}
add_action('wp_ajax_unlink_css_month', 'unlink_css_month');



// Setting
function set_datetime_source()
{
	$source = $_POST['source'];
	
	update_option('ccss_datetime_source', $source);
	echo json_encode(array("msg" => 'saved', "msg_type" => 'success'));
	exit;
}
add_action('wp_ajax_set_datetime_source', 'set_datetime_source');

function set_status()
{
	$status = $_POST['status'];
	
	update_option('ccss_status', $status);
	echo json_encode(array("msg" => 'saved', "msg_type" => 'success'));
	exit;
}
add_action('wp_ajax_set_status', 'set_status');

function set_css_remember()
{
	$cssRemember = $_POST['css_remember'];
	
	update_option('ccss_remember', $cssRemember);
	echo json_encode(array("msg" => 'saved', "msg_type" => 'success'));
	exit;
}
add_action('wp_ajax_set_css_remember', 'set_css_remember');

function set_file_check()
{
	$fileCheck = $_POST['file_check'];
	
	update_option('ccss_file_check', $fileCheck);
	echo json_encode(array("msg" => 'saved', "msg_type" => 'success'));
	exit;
}
add_action('wp_ajax_set_file_check', 'set_file_check');


?>