    <?php if (!is_logged_in()) return; ?>
    <div id="sidebar">
        <div id="reminder">
    		<h3><img src="<?php echo site_url('/assets/img/icons/coquette/16/user.png'); ?>" alt="" /> Update your profile</h3>
    		<p><?php echo auto_typography(config_item('org') .' will use the contact information in your profile to keep in touch with you, so be sure to ' . anchor('profile/edit', 'keep it up-to-date') . '!'); ?></p>
        </div>
       	<?php if ($feed = page_info('feed')): ?>
        <div id="feed">
        	<h3><a href="<?php echo $feed->url; ?>"><img src="<?php echo site_url('/assets/img/icons/coquette/16/rss.png'); ?>" alt="" /></a> <?php echo $feed->title; ?></h3>
        	<ul>
        	<?php foreach ($feed->entries as $entry) : ?>
        	<li><a href="<?php echo $entry->url; ?>"><?php echo ellipsize($entry->title, 20); ?></a></li>
        	<?php endforeach; ?>
        	</ul>
        </div>
        <?php endif; ?>
        <div>
        	<h3><img src="<?php echo site_url('/assets/img/icons/coquette/16/help.png'); ?>" alt="" /> We can help</h3>
        	<p><?php echo auto_typography('Send your questions and concerns to ' . mailto(config_item('admin_email'), 'the support team') . ' and someone will get back to you as soon as possible.'); ?></p>
        </div>
    </div>
