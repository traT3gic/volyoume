<?php echo form_open($this->uri->uri_string());?>
<table class="message">
	<tr>
		<td><?php echo form_label('To', '_tmp_name')?></td>
		<td>
			<?php echo form_input('_tmp_name', set_value('_tmp_name', $this->session->flashdata('recipient_name')));?>
			<p class="note">Begin typing the name of a user and suggestions will appear for you.</p>
		</td>
	</tr>
	<tr>
		<td><?php echo form_label('Subject', 'subject')?></td>
		<td><?php echo form_input('subject', set_value('subject'));?></td>
	</tr>
	<tr>
		<td><?php echo form_label('Message', 'body')?></td>
		<td><?php echo form_textarea(array('name' => 'body', 'value' => set_value('body')));?></td>
	</tr>
	<?php $this->load->view('common/buttons'); ?>
</table>
<?php echo form_hidden('recipient_id', set_value('recipient_id', $this->session->flashdata('recipient_id'))); ?>
<?php echo form_hidden('author_id', session_info('user_id')); ?>
<?php form_close(); ?>