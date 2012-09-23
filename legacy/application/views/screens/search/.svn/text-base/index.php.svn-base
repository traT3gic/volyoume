<?php if (page_info('items')):?>
<h3>Your search yielded <strong><?php echo count(page_info('items'));?></strong> result(s).</h3>
<ul>
<?php foreach(page_info('items') as $item):?>
<li>
<?php echo anchor('profile/view/' . $item->user_id, $item->first_name . ' ' . $item->middle_name . ' ' . $item->last_name);?>
</li>
<?php endforeach;?>
</ul>
<?php else:?>
<p>No users found.</p>
<?php endif;?>
