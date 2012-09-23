<?php $item = page_info('item'); ?>
<table class="profile">
	<tr>
		<td>Name</td>
		<td><?php echo $item->name;?></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><?php echo $item->description;?></td>
	</tr>
	<tr>
		<td>Leader</td>
		<?php $user_name = $item->user->full_name; $user_id = $item->user->user_id; ?>
		<td><?php echo anchor('/messages/new', $user_name);?></td>
	</tr>	
</table>