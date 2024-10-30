<?php

function ccss_admin_time_chart($ccss_css_time)
{
?>

<script type="text/javascript">                                         
			$(document).ready(function() {
				$('.time-socketed').draggable({revert: true, stop: function(event, ui) {$(this).draggable('destroy');}});
				
				
				set_drop_time_socket();
				set_drop_time_chart();

			});       
			
			function set_drop_time_socket()
			{
				
				$(".time-socket").droppable({hoverClass: 'socket-over', 
										accept: 'div.handle',
										drop: function(event, ui) {
											$(this).html('<span id="socket-loader">Loading ... </span>');
											var dropable = $(this);
											var css_id = ui.draggable.attr('id');
											var time_block = $(this).attr('id');
											var siteurl = "<?php bloginfo('wpurl'); ?>";
											$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"link_css_time", 'cookie': encodeURIComponent(document.cookie), 'css_id': css_id, 'time_block': time_block},
											function(str)
											{
												var css_desc = $("td[class='desc'][id='" + ui.draggable.attr('id') + "']").html();
												$(dropable).empty().html(css_desc);
												$(dropable).removeClass('time-socket').addClass('time-socketed');
												$(dropable).draggable({revert: true, stop: function(event, ui) {$(dropable).draggable('destroy');}});
												 
											});
											
											
											
										}
				});
			}
			
			function set_drop_time_chart()
			{
				$('.time-chart').droppable({	accept: '.time-socketed',
										drop: 	function(event, ui) {
													ui.draggable.html('<span id="socket-loader">Loading ... </span>');
													
													var time_block = ui.draggable.attr('id');
													var siteurl = "<?php bloginfo('wpurl'); ?>";
													$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"unlink_css_time", 'cookie': encodeURIComponent(document.cookie), 'time_block': time_block},
													function(str)
													{
														ui.draggable.empty().removeClass('time-socketed').addClass('time-socket').html('Drop Here');
														set_drop_time_socket();
													});
												}
				});
			}
</script> 

<div class="time-chart">
	
	
	<?php 	foreach($ccss_css_time as $css_time)
			{
				if($css_time->css_id != 0) 
				{
					$class = "time-socketed";
					$css_desc = $css_time->css_desc;
				}
				else 
				{
					$class = "time-socket";
					$css_desc = "Drop Here";
				}
	
	?>
		<div class="socket-cat" id="<?php echo $css_time->time_block; ?>"><?php echo $css_time->time_block; ?></div>
		<div class="<?php echo $class; ?>" id="<?php echo $css_time->time_block; ?>"><?php echo $css_desc; ?></div>
	<?php } ?>
	<div class="clear"></div>
</div>


<?php } ?>