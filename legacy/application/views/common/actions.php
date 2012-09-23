<?php $controller = $this->uri->segment(1); ?>

<?php if (!$this->uri->segment(2) && (has_permission('create') || has_permission('delete'))) : ?>
<div class="quick-actions">
	<?php if (has_permission('create')): ?>
		<a class="button primary" href="<?php echo site_url('/' . $controller . '/new');?>">Create a New <?php echo ucwords(page_info('item_type')); ?></a> &nbsp; 
	<?php endif; ?>
	<?php if (has_permission('delete')): ?>
		<button class="button delete" name="submit">Delete Selected</button>
	<?php endif; ?>
</div>
<?php endif; ?>

<?php if ($item = page_info('item') && !$this->uri->segment(3)) : ?>
<div class="quick-actions">
	<a class="button nav" href="<?php echo site_url('/' . $controller);?>">&larr; Go Back</a> &nbsp;
	<?php if (has_permission('edit')): ?>
		<a class="button primary edit" href="<?php echo site_url('/' . $controller . '/' . $this->uri->segment(2) . '/edit');?>">Edit</a> &nbsp;
	<?php endif; ?>
	<?php if (has_permission('delete')): ?>
		<button class="button delete" name="submit">Delete Selected</button>
	<?php endif; ?>
</div>
<?php endif; ?>