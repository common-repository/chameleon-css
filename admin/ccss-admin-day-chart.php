<?php

function ccss_admin_day_chart($ccss_css_day)
{
?>

<script type="text/javascript">                                         
			$(document).ready(function() {
				$('.day-socketed').draggable({revert: true, stop: function(event, ui) {$(this).draggable('destroy');}});
				
				
				set_drop_day();
				set_remove_day();

			});       
			
			function set_drop_day()
			{
				
				$(".day-socket").droppable({hoverClass: 'socket-over', 
										accept: 'div.handle',
										drop: function(event, ui) {
											$(this).html('<span id="socket-loader">Loading ... </span>');
											var dropable = $(this);
											var css_id = ui.draggable.attr('id');
											var day = $(this).attr('id');
											var siteurl = "<?php bloginfo('wpurl'); ?>";
											$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"link_css_day", 'cookie': encodeURIComponent(document.cookie), 'css_id': css_id, 'day': day},
											function(str)
											{
												var css_desc = $("td[class='desc'][id='" + ui.draggable.attr('id') + "']").html();
												$(dropable).empty().html(css_desc);
												$(dropable).removeClass('day-socket').addClass('day-socketed');
												$(dropable).draggable({revert: true, stop: function(event, ui) {$(dropable).draggable('destroy');}});
												 
											});
											
											
											
										}
				});
			}
			
			function set_remove_day()
			{
				$('.day-chart').droppable({	accept: '.day-socketed',
										drop: 	function(event, ui) {
													ui.draggable.html('<span id="socket-loader">Loading ... </span>');
													
													var day = ui.draggable.attr('id');
													var siteurl = "<?php bloginfo('wpurl'); ?>";
													$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"unlink_css_day", 'cookie': encodeURIComponent(document.cookie), 'day': day},
													function(str)
													{
														ui.draggable.empty().removeClass('day-socketed').addClass('day-socket').html('Drop Here');
														set_drop_day();
													});
												}
				});
			}
</script> 

<div class="day-chart">
	
	
	<?php 	foreach($ccss_css_day as $css_day)
			{
				if($css_day->css_id != 0) 
				{
					$class = "day-socketed";
					$css_desc = $css_day->css_desc;
				}
				else 
				{
					$class = "day-socket";
					$css_desc = "Drop Here";
				}
	
	?>
		<div class="socket-cat" id="<?php echo $css_day->day; ?>"><?php echo $css_day->day; ?></div>
		<div class="<?php echo $class; ?>" id="<?php echo $css_day->day; ?>"><?php echo $css_desc; ?></div>
	<?php } ?>
	<div class="clear"></div>
</div>


<?php } ?>