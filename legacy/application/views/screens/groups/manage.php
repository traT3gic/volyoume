<?php $item = page_info('item');?>
<?php echo form_open($this->uri->uri_string());?>
<table class="profile">
	<tr>
		<td><?php echo form_label('Name', 'name')?></td>
		<td><?php echo form_input('name', set_item_form_value('name'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Parent ' . ucwords(config_item('group_alias')), 'parent_id')?></td>
		<td><?php echo form_dropdown('parent_id', page_info('groups_dropdown_data'), set_item_form_value('parent_id', true));?></td>
	</tr>	
	<tr>
		<td><?php echo form_label('Description', 'description')?></td>
		<td><?php echo form_textarea('description', set_item_form_value('description'));?></td>
	</tr>
	<?php $this->load->view('parts/buttons'); ?>
</table>
<?php echo form_close(); ?>