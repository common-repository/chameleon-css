<?php

function ccss_admin_setting_chart()
{
?>

<script type="text/javascript">                                         
			$(document).ready(function() {
				$('.datetime-source').click(function(){
					$('#date-source-setting-state').show();
					var siteurl = "<?php bloginfo('wpurl'); ?>";
					var source = $(this).attr('id');
					$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"set_datetime_source", 'cookie': encodeURIComponent(document.cookie), 'source': source},
						function(data, textStatus)
						{
							$('#date-source-setting-state').hide();
						}, "json");
				});
				
				$('.status').click(function(){
					$('#status-setting-state').show();
					var siteurl = "<?php bloginfo('wpurl'); ?>";
					var status = $(this).attr('id');
					$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"set_status", 'cookie': encodeURIComponent(document.cookie), 'status': status},
						function(data, textStatus)
						{
							$('#status-setting-state').hide();
						}, "json");
				});
				
				$('.css-remember').click(function(){
					$('#css-remember-setting-state').show();
					var siteurl = "<?php bloginfo('wpurl'); ?>";
					var cssRemember = $(this).attr('id');
					$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"set_css_remember", 'cookie': encodeURIComponent(document.cookie), 'css_remember': cssRemember},
						function(data, textStatus)
						{
							$('#css-remember-setting-state').hide();
						}, "json");
				});
				
				$('.file-check').click(function(){
					$('#file-check-setting-state').show();
					var siteurl = "<?php bloginfo('wpurl'); ?>";
					var fileCheck = $(this).attr('id');
					$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"set_file_check", 'cookie': encodeURIComponent(document.cookie), 'file_check': fileCheck},
						function(data, textStatus)
						{
							$('#file-check-setting-state').hide();
						}, "json");
				});
				
			});        
</script> 

<div class="setting-chart">
	
	
	<div class="setting-head">Chameleon Status</div>
	<?php 
		if(get_option('ccss_status') == 'active') $active = 'checked';
		if(get_option('ccss_status') == 'inactive') $inactive = 'checked';
	?>
	<input type="radio" class="status" id="active" name="status" <?php echo $active; ?>> Active<br />
	<input type="radio" class="status" id="inactive" name="status" <?php echo $inactive; ?>> Inactive<br />
	<div id="status-setting-state" class="notify setting-state">Saving...</div>
	<br />
	
	<div class="setting-head">Date-Time Source</div>
	<?php 
		if(get_option('ccss_datetime_source') == 'server') $server = 'checked';
		if(get_option('ccss_datetime_source') == 'client') $client = 'checked';
	?>
	<input type="radio" class="datetime-source" id="server" name="date-time" <?php echo $server; ?>> server time<br />
	<input type="radio" class="datetime-source" id="client" name="date-time" <?php echo $client; ?>> client time<br />
	<div id="date-source-setting-state" class="notify setting-state">Saving...</div>
	<br />
	
	<div class="setting-head">Remember selected CSS <br /><small>(for CSS manual switch)</small></div>
	<?php 
		if(get_option('ccss_remember') == 'css-remember-enable') $cssRememberEnable = 'checked';
		if(get_option('ccss_remember') == 'css-remember-disable') $cssRememberDisable = 'checked';
	?>
	<input type="radio" class="css-remember" id="css-remember-enable" name="css-remember" <?php echo $cssRememberEnable; ?>> Enable<br />
	<input type="radio" class="css-remember" id="css-remember-disable" name="css-remember" <?php echo $cssRememberDisable; ?>> Disable<br />
	<div id="css-remember-setting-state" class="notify setting-state">Saving...</div>
	<br />
	
	<div class="setting-head">File existing check <br /><small>(disable this feature if you have problem to add new CSS item)</small></div>
	<?php 
		if(get_option('ccss_file_check') == 'file-check-enable') $fileCheckEnable = 'checked';
		if(get_option('ccss_file_check') == 'file-check-disable') $fileCheckDisable = 'checked';
	?>
	<input type="radio" class="file-check" id="file-check-enable" name="file-check" <?php echo $fileCheckEnable; ?>> Enable<br />
	<input type="radio" class="file-check" id="file-check-disable" name="file-check" <?php echo $fileCheckDisable; ?>> Disable<br />
	<div id="file-check-setting-state" class="notify setting-state">Saving...</div>
	
	
</div>


<?php } ?>