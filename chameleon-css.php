<?php

/*
	Plugin Name: Chameleon CSS
	Plugin URI: http://wegrass.com/playground/ccss
	Description: CSS Swither (Manual and Automatic by condition).
	Version: 1.2
	Author: Grass still Green
	Author URI: http://wegrass.com

	----------------------------------------------------------
	
	Copyright 2011  Grass still Green  (email : support@wegrass.com)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 2 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

global $wpdb;

if ( ! defined( 'CCSS_PLUGIN_DIR' ) )
	define( 'CCSS_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . plugin_basename( dirname( __FILE__ ) ) );

if ( ! defined( 'CCSS_PLUGIN_URL' ) )
	define( 'CCSS_PLUGIN_URL', WP_PLUGIN_URL . '/' . plugin_basename( dirname( __FILE__ ) ) );
	
if ( ! defined( 'CCSS_PLUGIN_BASENAME' ) )
	define( 'CCSS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
	
if ( ! defined( 'CCSS_PLUGIN_DIR_NAME' ) )
	define( 'CCSS_PLUGIN_DIR_NAME', trim( dirname( CCSS_PLUGIN_BASENAME ), '/' ) );

// Database
	
if ( ! defined( 'CCSS_DB_VER' ) )
	define( 'CCSS_DB_VER', "0.4" );

if ( ! defined( 'CCSS_VER' ) )
	define( 'CCSS_VER', "1.2" );
	
if ( ! defined( 'CCSS_TABLE_CCSS_INFO' ) )
	define( 'CCSS_TABLE_CCSS_INFO', $wpdb->prefix . "chameleon_css_info" );
	
if ( ! defined( 'CCSS_TABLE_CCSS_TIME' ) )
	define( 'CCSS_TABLE_CCSS_TIME', $wpdb->prefix . "chameleon_css_time" );
	
if ( ! defined( 'CCSS_TABLE_CCSS_DATE' ) )
	define( 'CCSS_TABLE_CCSS_DATE', $wpdb->prefix . "chameleon_css_date" );
	
if ( ! defined( 'CCSS_TABLE_CCSS_DAY' ) )
	define( 'CCSS_TABLE_CCSS_DAY', $wpdb->prefix . "chameleon_css_day" );
	
if ( ! defined( 'CCSS_TABLE_CCSS_MONTH' ) )
	define( 'CCSS_TABLE_CCSS_MONTH', $wpdb->prefix . "chameleon_css_month" );

// Time constant
if ( ! defined( 'CCSS_SUNRISE' ) )
	define( 'CCSS_SUNRISE', 'Sunrise' );
	
if ( ! defined( 'CCSS_DAY' ) )
	define( 'CCSS_DAY', 'Day' );
	
if ( ! defined( 'CCSS_SUNSET' ) )
	define( 'CCSS_SUNSET', 'Sunset' );
	
if ( ! defined( 'CCSS_NIGHT' ) )
	define( 'CCSS_NIGHT', 'Night' );
	
// Day constant
if ( ! defined( 'CCSS_MON' ) )
	define( 'CCSS_MON', 'Monday' );
	
if ( ! defined( 'CCSS_TUE' ) )
	define( 'CCSS_TUE', 'Tuesday' );
	
if ( ! defined( 'CCSS_WED' ) )
	define( 'CCSS_WED', 'Wednesday' );
	
if ( ! defined( 'CCSS_THU' ) )
	define( 'CCSS_THU', 'Thursday' );
	
if ( ! defined( 'CCSS_FRI' ) )
	define( 'CCSS_FRI', 'Friday' );

if ( ! defined( 'CCSS_SAT' ) )
	define( 'CCSS_SAT', 'Saturday' );
	
if ( ! defined( 'CCSS_SUN' ) )
	define( 'CCSS_SUN', 'Sunday' );
	
// Month constant
if ( ! defined( 'CCSS_JAN' ) )
	define( 'CCSS_JAN', 'January' );
	
if ( ! defined( 'CCSS_FEB' ) )
	define( 'CCSS_FEB', 'February' );
	
if ( ! defined( 'CCSS_MAR' ) )
	define( 'CCSS_MAR', 'March' );
	
if ( ! defined( 'CCSS_APR' ) )
	define( 'CCSS_APR', 'April' );
	
if ( ! defined( 'CCSS_MAY' ) )
	define( 'CCSS_MAY', 'May' );
	
if ( ! defined( 'CCSS_JUN' ) )
	define( 'CCSS_JUN', 'June' );
	
if ( ! defined( 'CCSS_JUL' ) )
	define( 'CCSS_JUL', 'July' );
	
if ( ! defined( 'CCSS_AUG' ) )
	define( 'CCSS_AUG', 'August' );
	
if ( ! defined( 'CCSS_SEP' ) )
	define( 'CCSS_SEP', 'September' );
	
if ( ! defined( 'CCSS_OCT' ) )
	define( 'CCSS_OCT', 'October' );
	
if ( ! defined( 'CCSS_NOV' ) )
	define( 'CCSS_NOV', 'November' );
	
if ( ! defined( 'CCSS_DEC' ) )
	define( 'CCSS_DEC', 'December' );
	
require_once CCSS_PLUGIN_DIR . '/database/ccss-db-func.php';
if(!class_exists('Services_JSON')) require_once CCSS_PLUGIN_DIR . '/exlib/JSON.php';
require_once CCSS_PLUGIN_DIR . '/admin/ccss-admin-ajax.php';
require_once CCSS_PLUGIN_DIR . '/ccss-widget.php';
	
	
// Admin

function ccss_menu()
{
    $ccss_css_info_set = ccss_get_css_information();
    $ccss_css_time = ccss_get_css_time();
    $ccss_css_day = ccss_get_css_day();
    $ccss_css_month = ccss_get_css_month();
    $ccss_css_date = ccss_get_css_by_date(date("Y-m-d"));
	include(CCSS_PLUGIN_DIR . '/admin/ccss-admin.php');
}


function ccss_admin_actions()
{
    $ccss_page = add_submenu_page("options-general.php", "Chameleon CSS", "Chameleon CSS", 1, "ccss", "ccss_menu");
	add_action( 'admin_head-' . $ccss_page, 'ccss_admin_head' );
}
add_action('admin_menu', 'ccss_admin_actions');

function ccss_admin_head()
{
    $admin_stylesheet_url = CCSS_PLUGIN_URL. '/admin/css/admin.css';
    $ccss_jquery_url = CCSS_PLUGIN_URL. '/js/jquery-1.4.4.min.js';
    $ccss_jquery_ui_url = CCSS_PLUGIN_URL. '/js/jquery-ui-1.8.8.custom.min.js';
    $ccss_date_format_url = CCSS_PLUGIN_URL. '/js/date.format.js';
    $ccss_jquery_ui_css_url = CCSS_PLUGIN_URL. '/admin/css/jquery-ui.css';
	
	echo '<script type="text/javascript" src="' . $ccss_jquery_url. '"></script>';
	echo '<script type="text/javascript" src="' . $ccss_jquery_ui_url. '"></script>';
	echo '<script type="text/javascript" src="' . $ccss_date_format_url. '"></script>';
	echo '<link rel="stylesheet" href="' . $admin_stylesheet_url . '" type="text/css" />';
	echo '<link rel="stylesheet" href="' . $ccss_jquery_ui_css_url . '" type="text/css" />';
}




// Activate
function ccss_activate() {
	global $wpdb;
	
	if(!get_option('ccss_datetime_source'))
	update_option('ccss_datetime_source', 'server');
	
	if(!get_option('ccss_status'))
	update_option('ccss_status', 'active');

	if(!get_option('ccss_remember'))
	update_option('ccss_remember', 'css-remember-enable');
	
	if(!get_option('ccss_file_check'))
	update_option('ccss_file_check', 'file-check-enable');
	
	$current_db_ver = get_option( "ccss_db_version" );

	if($current_db_ver != CCSS_DB_VER)
	{
		$sql = "CREATE TABLE " . CCSS_TABLE_CCSS_INFO . " (
				`css_id` INT NOT NULL AUTO_INCREMENT,
				`css_path` TEXT NOT NULL ,
				`css_desc` TEXT NOT NULL ,
				`css_media` SET( 'all', 'print', 'screen' ) NOT NULL ,
				PRIMARY KEY ( `css_id` )
				);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		// Time condition
		$sql = "CREATE TABLE " . CCSS_TABLE_CCSS_TIME . " (
				`time_block` VARCHAR(20) NOT NULL PRIMARY KEY ,
				`css_id` INT
				);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);

		$sql = "INSERT INTO " . CCSS_TABLE_CCSS_TIME . " (`time_block`, `css_id`)";
		$sql .= "VALUES ('" . CCSS_SUNRISE . "', NULL), ";
		$sql .= "('" . CCSS_DAY . "', NULL), ";
		$sql .= "('" . CCSS_SUNSET . "', NULL), ";
		$sql .= "('" . CCSS_NIGHT . "', NULL)";
		$results = $wpdb->query( $sql );

		// Date condition
		$sql = "CREATE TABLE " . CCSS_TABLE_CCSS_DATE . " (
				`date` DATE NOT NULL PRIMARY KEY ,
				`css_id` INT
				);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	
		
		// Day condition
		$sql = "CREATE TABLE " . CCSS_TABLE_CCSS_DAY . " (
				`day` VARCHAR(20) NOT NULL PRIMARY KEY ,
				`css_id` INT
				);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		
		$sql = "INSERT INTO " . CCSS_TABLE_CCSS_DAY . " (`day`, `css_id`)";
		$sql .= "VALUES ('" . CCSS_SUN . "', NULL), ";
		$sql .= "('" . CCSS_MON . "', NULL), ";
		$sql .= "('" . CCSS_TUE . "', NULL), ";
		$sql .= "('" . CCSS_WED . "', NULL), ";
		$sql .= "('" . CCSS_THU . "', NULL), ";
		$sql .= "('" . CCSS_FRI . "', NULL), ";
		$sql .= "('" . CCSS_SAT . "', NULL)";
		$results = $wpdb->query( $sql );
		
		// Month condition
		$sql = "CREATE TABLE " . CCSS_TABLE_CCSS_MONTH . " (
				`month` VARCHAR(20) NOT NULL PRIMARY KEY ,
				`css_id` INT
				);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
		
		$sql = "INSERT INTO " . CCSS_TABLE_CCSS_MONTH . " (`month`, `css_id`)";
		$sql .= "VALUES ('" . CCSS_JAN . "', NULL), ";
		$sql .= "('" . CCSS_FEB . "', NULL), ";
		$sql .= "('" . CCSS_MAR . "', NULL), ";
		$sql .= "('" . CCSS_APR . "', NULL), ";
		$sql .= "('" . CCSS_MAY . "', NULL), ";
		$sql .= "('" . CCSS_JUN . "', NULL), ";
		$sql .= "('" . CCSS_JUL . "', NULL), ";
		$sql .= "('" . CCSS_AUG . "', NULL), ";
		$sql .= "('" . CCSS_SEP . "', NULL), ";
		$sql .= "('" . CCSS_OCT . "', NULL), ";
		$sql .= "('" . CCSS_NOV . "', NULL), ";
		$sql .= "('" . CCSS_DEC . "', NULL)";
		$results = $wpdb->query( $sql );
		
	
		update_option( "ccss_db_ver", CCSS_DB_VER );
	}
}
register_activation_hook( __FILE__, 'ccss_activate' );


// Deactivate
function ccss_deactivate() {
	global $wpdb;

	$sql = "DROP TABLE " . CCSS_TABLE_CCSS_INFO;
	$results = $wpdb->query( $sql );
	
	$sql = "DROP TABLE " . CCSS_TABLE_CCSS_TIME;
	$results = $wpdb->query( $sql );
	
	$sql = "DROP TABLE " . CCSS_TABLE_CCSS_DATE;
	$results = $wpdb->query( $sql );
	
	$sql = "DROP TABLE " . CCSS_TABLE_CCSS_DAY;
	$results = $wpdb->query( $sql );
	
	$sql = "DROP TABLE " . CCSS_TABLE_CCSS_MONTH;
	$results = $wpdb->query( $sql );
}
register_deactivation_hook( __FILE__, 'ccss_deactivate' );

// Update
function ccss_update(){
	$current_ver = get_option( "ccss_version" );

	if($current_ver != CCSS_VER){
		
		if(!get_option('ccss_datetime_source'))
		update_option('ccss_datetime_source', 'server');
		
		if(!get_option('ccss_status'))
		update_option('ccss_status', 'active');

		if(!get_option('ccss_remember'))
		update_option('ccss_remember', 'css-remember-enable');
		
		if(!get_option('ccss_file_check'))
		update_option('ccss_file_check', 'file-check-enable');
		
		update_option( "ccss_version", CCSS_VER );
		
	}
}
add_action('init','ccss_update');


// Generate CSS List
function ccss_generate_list($option=""){ 
	
	if($option != ""){
		if(!is_array($option)){	// option as string
			parse_str($option, $option);
		}
	}

?>
	<ul id="ccss-list">
		<?php
		$ccss_css_info_set = ccss_get_css_information($option["exclude"]);
		foreach($ccss_css_info_set as $ccss_css_info){
			$listID = str_replace(" ", "-", strtolower($ccss_css_info->css_desc));
			echo "<li id='ccss-$listID'><a href='$ccss_css_info->css_path'>$ccss_css_info->css_desc</a></li>";
		}
		?>
	</ul>
<?
} 

// Generate CSS List
function ccss_list($option=""){ 
	ccss_generate_list($option);
} 

function ccss_header_scripts()
{
  // use JavaScript SACK library for Ajax
  wp_print_scripts( array( 'jquery' ));
  
?>

<!-- jQuery Cookie -->
<script type="text/javascript" src="<?php bloginfo( 'wpurl' ); ?>/wp-content/plugins/<?php echo CCSS_PLUGIN_DIR_NAME; ?>/js/jquery-cookie.js"></script>

<?php if( (get_option('ccss_remember') == "css-remember-enable") && (isset($_COOKIE["ccss_remembered_style"]))): ?>
 	<!-- CCSS remembered style -->
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo $_COOKIE["ccss_remembered_style"]; ?>" />
<?php endif; ?>

<!-- Chameleon CSS -->
<script type="text/javascript">
//<![CDATA[
	
	jQuery(document).ready(function($) {
		// do stuff when DOM is ready
		var now = new Date();
		
		var year = now.getFullYear();
		var month = now.getMonth() + 1;
		var day = now.getDate();
		var hour = now.getHours();
		
		var daySet = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday', 'Saturday'];
		var monthSet = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var dayOfWeek = daySet[now.getDay()];
		var monthString = monthSet[now.getMonth()];
		
		var ccssGetCSSUrl = "<?php bloginfo( 'wpurl' ); ?>/wp-content/plugins/<?php echo CCSS_PLUGIN_DIR_NAME; ?>/ccss-ajax-resp.php";
			$.post(ccssGetCSSUrl, {year:year, month:month, day:day, hour:hour, dayOfWeek:dayOfWeek, monthString:monthString},
			function(data, textStatus)
			{
				var fileref=document.createElement("link")
				fileref.setAttribute("rel", "stylesheet")
				
				if(data.css_month_path != null)
				{
					$("head").append("<link id='ccss-month' rel='stylesheet' type='text/css' href='"+data.css_month_path+"' />");
				}
				
				if(data.css_day_path != null)
				{
					$("head").append("<link id='ccss-day' rel='stylesheet' type='text/css' href='"+data.css_day_path+"' />");
				}
				
				if(data.css_date_path != null)
				{
					$("head").append("<link id='ccss-date' rel='stylesheet' type='text/css' href='"+data.css_date_path+"' />");
				}
				
				if(data.css_time_path != null)
				{
					$("head").append("<link id='ccss-time' rel='stylesheet' type='text/css' href='"+data.css_time_path+"' />");
				}
				
			}, "json");
			
			$("#ccss-list a").click(function(){
				$("link#ccss-manual").remove();
				$("head").append("<link id='ccss-manual' rel='stylesheet' type='text/css' href='"+$(this).attr("href")+"' />");
				<?php if(get_option('ccss_remember') == "css-remember-enable"): ?>
					$.cookie('ccss_remembered_style', $(this).attr("href"), {expires: 9999});
				<?php endif; ?>
				return false;
			});
			
			
	});        
//]]>
</script>
<!-- End of Chameleon CSS -->

<?php
} // end of PHP function myplugin_js_header
if(get_option('ccss_status') == "active") add_action('wp_head', 'ccss_header_scripts');

?>