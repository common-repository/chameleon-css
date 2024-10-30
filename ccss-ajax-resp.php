<?php

	ob_start();
	require_once("../../../wp-config.php");
	ob_end_clean();
	
	require_once ("./chameleon-css.php");
	
	global $wpdb;
	
	if(get_option('ccss_datetime_source') == 'server')
	{
		$today = getdate();
		$hour = $today['hours'];
		$date = date('Y-m-d');
		$dayOfWeek = date('l');
		$monthString = date('F');
	}
	else 
	{
		$client_year = $_POST['year'];
		$client_month = $_POST['month'];
		$client_day = $_POST['day'];
		$client_hour = $_POST['hour'];
		$client_date = $client_year . '-' . $client_month . '-' . $client_day;
		$client_day = $_POST['dayOfWeek'];
		
		$dayOfWeek = $client_day;
		$monthString = $_POST['monthString'];
		$hour = $client_hour;
		$date = $client_date;
	}
	
	
	
	// Time dependent
	if($hour >= 5 && $hour <= 8){			// Sun rise
		$state = CCSS_SUNRISE;
	}
	else if($hour >= 9 && $hour <= 15){		// Day
		$state = CCSS_DAY;
	}
	else if($hour >= 16 && $hour <= 18){	// Sun set
		$state = CCSS_SUNSET;
	}
	else if( ($hour >= 19 && $hour <= 23) || ($hour >= 0 && $hour <= 4)){		// Night
		$state = CCSS_NIGHT;
	}
	
	$css_time_info = ccss_get_css_by_time($state);
	if($css_time_info->css_id != null)
	{
		$css['time_dependent'] = '<link media="screen" href="' . $css_time_info->css_path . '" type="text/css" rel="stylesheet">';
		$css['time_dependent'] = ent2ncr($css['time_dependent']);
	}
	
	// Date dependent
	$css_date_info = ccss_get_css_by_date($date);
	if($css_date_info->css_id != null)
	{
		$css['date_dependent'] = '<link media="screen" href="' . $css_date_info->css_path . '" type="text/css" rel="stylesheet">';
		$css['date_dependent'] = ent2ncr($css['date_dependent']);
	}
	
	// Day dependent
	$css_day_info = ccss_get_css_by_day($dayOfWeek);
	if($css_day_info->css_id != null)
	{
		$css['day_dependent'] = '<link media="screen" href="' . $css_day_info->css_path . '" type="text/css" rel="stylesheet">';
		$css['day_dependent'] = ent2ncr($css['date_dependent']);
	}
	
	// Month dependent
	$css_month_info = ccss_get_css_by_month($monthString);
	if($css_month_info->css_id != null)
	{
		$css['month_dependent'] = '<link media="screen" href="' . $css_month_info->css_path . '" type="text/css" rel="stylesheet">';
		$css['month_dependent'] = ent2ncr($css['month_dependent']);
	}
	

	echo json_encode(array("css_time_path" => $css_time_info->css_path, "css_date_path" => $css_date_info->css_path, "css_day_path" => $css_day_info->css_path, "css_month_path" => $css_month_info->css_path));
	
	return true;

?>