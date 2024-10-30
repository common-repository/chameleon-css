<?php 

// admin template
require_once(CCSS_PLUGIN_DIR . '/admin/ccss-admin-css-list.php');
require_once(CCSS_PLUGIN_DIR . '/admin/ccss-admin-time-chart.php');
require_once(CCSS_PLUGIN_DIR . '/admin/ccss-admin-day-chart.php');
require_once(CCSS_PLUGIN_DIR . '/admin/ccss-admin-month-chart.php');
require_once(CCSS_PLUGIN_DIR . '/admin/ccss-admin-date-chart.php');
require_once(CCSS_PLUGIN_DIR . '/admin/ccss-admin-setting-chart.php');
require_once(CCSS_PLUGIN_DIR . '/admin/ccss-admin-help-chart.php');

?>



<script type="text/javascript">                                         
	$(document).ready(function() {
		// do stuff when DOM is ready
		
		$(".notify").hide();
		
		$("div.handle").draggable({revert: true});
		
		$(".chart-body:not('#time')").hide();
		$('.chart-cat').click(function(){
			
			if($(this).attr("id") == "help"){
				$("#css-form-box").hide();
				$("#ccss-help-box").show();
			}
			if($(".chart-cat-active").attr("id") == "help"){
				$("#css-form-box").show();
				$("#ccss-help-box").hide();
			}
			
			$('.chart-cat').removeClass('chart-cat-active');
			$(this).addClass('chart-cat-active');
			
			$('.chart-body').hide();
			$("div[class='chart-body'][id='" + $(this).attr('id') + "']").show();
			
		});
	   
		$('#add-css').click(function(){
			var siteurl = "<?php bloginfo('wpurl'); ?>";
			var css_desc = $(":input#css_desc").attr('value');
			var css_path = $('span#style_sheet_path').html() + $(":input#css_filename").attr('value');
			$(".notify").hide();
			$("#loader").show();
			$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"add_css", 'cookie': encodeURIComponent(document.cookie), 'css_desc': css_desc, 'css_path': css_path},
			function(data, textStatus)
			{
				if(textStatus == 'success')
				{

					if(data.msg_type != 'error')
					{
						$('#ccss-list-table').empty().html(data.msg);
						$("#loader").hide();
					}
					else
					{
						$("#loader").hide();
						$("#caution").html('Error msg : ' + data.msg).show();
					}
				}
				else
				{
					$("#loader").hide();
					$("#caution").html('Error msg : ' + textStatus).show();
				}
			}, "json");
		});
		
		

	});        
</script> 

<div class="wrap ccss">
	<div class="ccss-header">
		<h2>Chameleon CSS <small>(v.1.2)</small></h2>
	</div>
	
	<div id="chart">
		<div class="chart-menu">
		
			<div class="chart-cat" id="setting"><span>S</span></div>
			<div class="chart-cat" id="help"><span>H</span></div>
		
			<div class="clear"></div>
		
			<div class="chart-cat chart-cat-active" id="time"><span>T</span></div>
			<div class="chart-cat" id="day"><span>D</span></div>
			<div class="chart-cat" id="month"><span>M</span></div>
			<div class="chart-cat" id="date"><span>D</span></div>
			
			<div class="clear"></div>
			
		</div>
		<div class="chart-body" id="time">
			<?php ccss_admin_time_chart($ccss_css_time); ?>
		</div>
		<div class="chart-body" id="day">
			<?php ccss_admin_day_chart($ccss_css_day); ?>
		</div>
		<div class="chart-body" id="month">
			<?php ccss_admin_month_chart($ccss_css_month); ?>
		</div>
		<div class="chart-body" id="date">
			<?php ccss_admin_date_chart($ccss_css_date); ?>
		</div>
		<div class="chart-body" id="setting">
			<?php ccss_admin_setting_chart(); ?>
		</div>
		<div class="chart-body" id="help">
			<?php ccss_admin_help_chart(); ?>
		</div>
	</div>
	
	<div id="css-form-box">
		
		<div id="css-list-box">
			<?php ccss_admin_css_list($ccss_css_info_set); ?>
		</div>
		
		<br class="clear" />
		
		<table class="widefat" style="margin-top:30px">
		<tbody>
		<tr>
		<td scope="col">
			<form name="ccss_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" onsubmit="return false;">
				<input type="hidden" name="oscimp_hidden" value="Y">
				<h3>CSS information</h3>
				<p>Nice Name: <input type="text" id="css_desc" name="css_desc" value="<?php echo $dbhost; ?>" size="14" maxlength="12"><br /><br /></p>
				<p>CSS File Path: <br /><span id="style_sheet_path"><?php echo bloginfo('stylesheet_directory'); ?>/</span><input type="text" id="css_filename" name="css_filename" value="<?php echo $dbhost; ?>" size="18" ></p>

				<p class="submit">
				<input type="submit" name="Submit" value="Add" id="add-css" />
				<span id="loader" class="notify">Loading</span>
				<span id="caution" class="notify">Loading</span>
				</p>
			</form>
		</td>
		</tr>
		</tbody>
		</table>
		
		<br />
		<br />
		
	</div>
	
	<div id="ccss-help-box">
	
		<div class="help-img" id="help-1"></div>
		<div class="help-img" id="help-2"></div>
		<div class="help-img" id="help-3"></div>
	
	</div>
	
	
</div>