<?php echo form_open($this->uri->uri_string());?>
<table class="profile">
	<tr><th colspan="2">Account Credentials</th></tr>
	<tr>
		<td><?php echo form_label('E-mail address', 'email')?></td>
		<td><?php echo form_input('email');?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Password', 'password')?></td>
		<td><?php echo form_input('password');?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Password confirmation', 'password_confirmation')?></td>
		<td><?php echo form_input('password_confirmation');?></td>
	</tr>	
	<tr><th colspan="2">General Information</th></tr>	
	<tr>
		<td><?php echo form_label('First Name', 'first_name')?></td>
		<td><?php echo form_input('first_name');?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Middle Name', 'middle_name')?></td>
		<td><?php echo form_input('middle_name');?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Last Name', 'last_name')?></td>
		<td><?php echo form_input('last_name');?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Sex', 'sex')?></td>
		<td><?php echo form_dropdown('sex', array('M', 'F'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Phone number', 'phone_number')?></td>
		<td><?php echo form_input('phone_number');?></td>
	</tr>
	<?php $this->load->view('parts/buttons'); ?>
</table>
<?php echo form_close(); ?>