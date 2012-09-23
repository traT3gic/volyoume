<?php $item = page_info('item'); ?>
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
		<td><?php echo form_input('first_name', set_value('first_name', $item->first_name));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Middle Name', 'middle_name')?></td>
		<td><?php echo form_input('middle_name', set_value('middle_name', $item->middle_name));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Last Name', 'last_name')?></td>
		<td><?php echo form_input('last_name', set_value('last_name', $item->last_name));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Sex', 'sex')?></td>
		<td><?php echo form_dropdown('sex', array('M', 'F'), isset($item->sex) ? $item->sex : $this->input->post('sex'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Address 1', 'address_1')?></td>
		<td><?php echo form_input('address_1', set_value('address_1', $item->address_1));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Address 2', 'address_2')?></td>
		<td><?php echo form_input('address_2', set_value('address_2', $item->address_2));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('City', 'city')?></td>
		<td><?php echo form_input('city', set_value('city', $item->city));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('State', 'state')?></td>
		<td><?php echo form_input('state', set_value('state', $item->state));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('ZIP', 'zip_code')?></td>
		<td><?php echo form_input('zip_code', set_value('zip_code', $item->zip_code));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Phone number', 'phone_number')?></td>
		<td><?php echo form_input('phone_number', set_value('phone_number', $item->phone_number));?></td>
	</tr>
	<?php $this->load->view('common/buttons'); ?>
</table>
<?php echo form_close(); ?>