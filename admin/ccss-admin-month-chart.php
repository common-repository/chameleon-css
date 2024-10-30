<?php

function ccss_admin_month_chart($ccss_css_month)
{
?>

<script type="text/javascript">                                         
			$(document).ready(function() {
				$('.month-socketed').draggable({revert: true, stop: function(event, ui) {$(this).draggable('destroy');}});
				
				
				set_drop_month();
				set_remove_month();

			});       
			
			function set_drop_month()
			{
				
				$(".month-socket").droppable({hoverClass: 'socket-over', 
										accept: 'div.handle',
										drop: function(event, ui) {
											$(this).html('<span id="socket-loader">Loading ... </span>');
											var dropable = $(this);
											var css_id = ui.draggable.attr('id');
											var month = $(this).attr('id');
											var siteurl = "<?php bloginfo('wpurl'); ?>";
											$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"link_css_month", 'cookie': encodeURIComponent(document.cookie), 'css_id': css_id, 'month': month},
											function(str)
											{
												var css_desc = $("td[class='desc'][id='" + ui.draggable.attr('id') + "']").html();
												$(dropable).empty().html(css_desc);
												$(dropable).removeClass('month-socket').addClass('month-socketed');
												$(dropable).draggable({revert: true, stop: function(event, ui) {$(dropable).draggable('destroy');}});
												 
											});
											
											
											
										}
				});
			}
			
			function set_remove_month()
			{
				$('.month-chart').droppable({	accept: '.month-socketed',
										drop: 	function(event, ui) {
													ui.draggable.html('<span id="socket-loader">Loading ... </span>');
													
													var month = ui.draggable.attr('id');
													var siteurl = "<?php bloginfo('wpurl'); ?>";
													$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"unlink_css_month", 'cookie': encodeURIComponent(document.cookie), 'month': month},
													function(str)
													{
														ui.draggable.empty().removeClass('month-socketed').addClass('month-socket').html('Drop Here');
														set_drop_month();
													});
												}
				});
			}
</script> 

<div class="month-chart">
	
	
	<?php 	foreach($ccss_css_month as $css_month)
			{
				if($css_month->css_id != 0) 
				{
					$class = "month-socketed";
					$css_desc = $css_month->css_desc;
				}
				else 
				{
					$class = "month-socket";
					$css_desc = "Drop Here";
				}
	
	?>
		<div class="socket-cat" id="<?php echo $css_month->month; ?>"><?php echo $css_month->month; ?></div>
		<div class="<?php echo $class; ?>" id="<?php echo $css_month->month; ?>"><?php echo $css_desc; ?></div>
	<?php } ?>
	<div class="clear"></div>
</div>


<?php } ?>