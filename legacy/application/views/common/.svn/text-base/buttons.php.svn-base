<?php $controller = $this->uri->segment(1); ?>
<tr class="buttons">
	<td colspan="2">
		<?php echo form_submit(array('class' => 'primary', 'name' => 'submit', 'value' => 'Save Changes'));?> &nbsp; <?php echo form_reset('cancel', 'Cancel');?>
		<?php if ($this->uri->segment('3') != 'new') : ?>
		 &nbsp; <a class="button delete" href="<?php echo site_url('/' . $controller . '/' . $this->uri->segment(2) . '/delete');?>">Delete</a>
		<?php endif; ?>				
	</td>
</tr>	