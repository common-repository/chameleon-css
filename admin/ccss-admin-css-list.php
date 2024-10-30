<?php

function ccss_admin_css_list($ccss_css_info_set)
{
	?>
		<script type="text/javascript">                                         
			$(document).ready(function() {
				// do stuff when DOM is ready
				$("div.handle").draggable({revert: true });
				$("li.body:odd").addClass('gray');
				$("li.body:even").addClass('white');
				
				$(".del-css").click(function(){
					
					var siteurl = "<?php bloginfo('wpurl'); ?>";
					var css_id = $(this).attr('id');
					$.post(siteurl+"/wp-admin/admin-ajax.php", {action:"remove_css", 'cookie': encodeURIComponent(document.cookie), 'css_id': css_id},
					function(str)
					{
						  $('#css-list-box').empty().html(str);
					});
				});

			});        
		</script> 
	
		<table class="widefat ccssfat" id="ccss-list-table">
			<thead>
				<tr>
					<th class="handle"></th>
					<th class="id">ID</th>
					<th class="name">Nice Name</th>
					<th class="path">Path</th>
					<th class="modify">Modify</th>
				</tr>
			</thead>
	
			<tfoot>
				<tr>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</tfoot>
	
			<tbody>
	
				<?php foreach($ccss_css_info_set as $ccss_css_info): ?>
				
				<tr>
					<td><div class="handle" id="<?php echo $ccss_css_info->css_id; ?>"></div></td>
					<td><?php echo $ccss_css_info->css_id; ?></td>
					<td class="desc" id="<?php echo $ccss_css_info->css_id; ?>"><?php echo $ccss_css_info->css_desc; ?></td>
					<td><?php echo $ccss_css_info->css_path; ?></td>
					<td><a class="del-css" id="<?php echo $ccss_css_info->css_id; ?>" href="#" onclick="return false;"><div class="bin"></div></a></td>
				</tr>
				
				<?php endforeach; ?>
				
			</tbody>
			
		</table>
	

		
<?php } ?>