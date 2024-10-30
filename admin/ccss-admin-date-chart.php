<?php

function ccss_admin_date_chart($ccss_css_date)
{
?>

<script type="text/javascript">                                         
			$(document).ready(function() {
				$('.date-socketed').draggable({revert: true, stop: function(event, ui) {$('.date-dummy-socket').draggable('destroy');} }); 
				
				$("#datee").datepicker({dateFormat: 'yy-mm-dd',
				onSelect: function(dateText, inst) { 
					$('.date-dummy-socket').html('<span id="socket-loader">Loading ... </span>');
					
					var siteurl = "<?php bloginfo('wpurl'); ?>";
					$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"get_css_date", 'cookie': encodeURIComponent(document.cookie), 'date': dateText},
					function(data, textStatus)
					{
						if(data.msg_type == 'found')
						{
							$('.date-dummy-socket').html(data.msg).removeClass('date-socket').addClass('date-socketed'); 
							$('.date-dummy-socket').draggable({revert: true, stop: function(event, ui) {$('.date-dummy-socket').draggable('destroy');} }); 
							
						}
						else
						{
							$('.date-dummy-socket').html('Drop Here').removeClass('date-socketed').addClass('date-socket').draggable('destroy');
							set_drop_date_socket();
						}
						
						
					}, "json");
						
					}
				});
				
				
				set_drop_date_socket();
				set_drop_date_chart();
				
				
			});

		function set_drop_date_socket()
		{
			$(".date-socket").droppable({hoverClass: 'socket-over', 
										accept: 'div.handle',
										drop: function(event, ui) {
											$(this).html('<span id="socket-loader">Loading ... </span>');
											
											var css_id = ui.draggable.attr('id');
											var date = $('#datee').datepicker( 'getDate' );
											date = dateFormat(date, "yyyy-mm-dd");
											var siteurl = "<?php bloginfo('wpurl'); ?>";
											$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"link_css_date", 'cookie': encodeURIComponent(document.cookie), 'css_id': css_id, 'date': date},
											function(str)
											{
												var css_desc = $("td[class='desc'][id='" + ui.draggable.attr('id') + "']").html();
												$('.date-dummy-socket').empty().html(css_desc);
												$('.date-dummy-socket').removeClass('date-socket').addClass('date-socketed');
												$('.date-dummy-socket').draggable({revert: true, stop: function(event, ui) {$('.date-dummy-socket').draggable('destroy');} });
											});
											
											
										}
				});
		}
		
		function set_drop_date_chart()
		{
			$('.date-chart').droppable({	accept: '.date-socketed',
									drop: 	function(event, ui) {
												ui.draggable.html('<span id="socket-loader">Loading ... </span>');
												
												var date = $('#datee').datepicker( 'getDate' );
												date = dateFormat(date, "yyyy-mm-dd");
												var siteurl = "<?php bloginfo('wpurl'); ?>";
												$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"unlink_css_date", 'cookie': encodeURIComponent(document.cookie), 'date': date},
												function(str)
												{
													ui.draggable.empty().removeClass('date-socketed').addClass('date-socket').html('Drop Here');
													set_drop_date_socket();
												});
											}
			});
		}
</script> 

<div class="date-chart">
	

	
	<?php 

		if($ccss_css_date->css_id != null)
		{
			$class = "date-socketed";
			$css_desc = $ccss_css_date->css_desc;
		}
		else
		{
			$class = "date-socket";
			$css_desc = "Drop Here";
		}
	?>
	<br />
	<div class="date-dummy-socket <?php echo $class; ?>" id="date-socket"><?php echo $css_desc; ?></div>
	
	<br />
	<div id="datee"></div>
	
</div>


<?php } ?>