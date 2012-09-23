<?php $item = page_info('item');?>
<?php echo form_open($this->uri->uri_string());?>
<table class="profile">
	<tr><th colspan="2">Account Credentials</th></tr>
	<tr>
		<td><?php echo form_label('E-mail address', 'email')?></td>
		<td><?php echo $item->email;?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Password', 'password')?></td>
		<td><?php echo form_input('password', '');?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Password confirmation', 'password_confirmation')?></td>
		<td><?php echo form_input('password_confirmation', '');?></td>
	</tr>	
	<tr><th colspan="2">General Information</th></tr>	
	<tr>
		<td><?php echo form_label('First Name', 'first_name')?></td>
		<td><?php echo form_input('first_name', set_item_value('first_name'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Middle Name', 'middle_name')?></td>
		<td><?php echo form_input('middle_name', set_item_value('middle_name'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Last Name', 'last_name')?></td>
		<td><?php echo form_input('last_name', set_item_value('last_name'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Sex', 'sex')?></td>
		<td><?php echo form_dropdown('sex', array('M', 'F'), isset($item->sex) ? $item->sex : $this->input->post('sex'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Address 1', 'address_1')?></td>
		<td><?php echo form_input('address_1', set_item_value('address_1'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Address 2', 'address_2')?></td>
		<td><?php echo form_input('address_2', set_item_value('address_2'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('City', 'city')?></td>
		<td><?php echo form_input('city', set_item_value('city'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('State', 'state')?></td>
		<td><?php echo form_input('state', set_item_value('state'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('ZIP', 'zip_code')?></td>
		<td><?php echo form_input('zip_code', set_item_value('zip_code'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Phone number', 'phone_number')?></td>
		<td><?php echo form_input('phone_number', set_item_value('phone_number'));?></td>
	</tr>
	<?php $this->load->view('parts/buttons'); ?>
</table>
<?php echo form_close(); ?>