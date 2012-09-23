<!DOCTYPE html>
<head>
<meta charset="UTF-8" />
<meta name="description" content="Volunteer Management Tool" />
<title><?php echo page_info('title');?> | Volunteer Management</title>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Arvo:regular,bold,italic&v1" />
<link rel="stylesheet" type="text/css" href="<?php echo site_url('assets/css/css.php?' . page_info('controller'));?>" />
</head>
<body class="<?php echo page_info('body_class'); ?>">
<?php 
/**
 * If we're logged in, show the header... that includes alerts, primary 
 * navigation, the search form, and account management navigation. There's no
 * header on the publicly accessible pages, just body.
 */
if (is_logged_in()) : ?>
<?php if (page_info('alert')) : ?><div id="alert"><strong>ALERT &rarr; </strong><?php echo page_info('alert');?></div><?php endif; ?>
<div id="header">
    <div id="title">
    	<?php echo config_info('org');?> <strong>Volunteer Management <span class="beta">beta</span></strong>
    	<p><?php echo config_item('greeting');?>, <strong><?php echo session_info('full_name'); ?></strong>! Be sure to <?php echo anchor('account/logout', 'logout');?> when you&rsquo;re done.</p>
    </div>
    <div id="account-navigation">
        <ul>
        	<li><?php echo anchor('/settings', 'Settings');?> | <?php echo anchor('/account/logout', 'Logout');?></li>
            <li id="search">
		        <?php echo form_open('search');?>
		        <?php echo form_input('term');?>
		        <?php echo form_submit('submit', 'Search');?>
		        <?php echo form_close();?>
            </li>
        </ul>
    </div>
    <div id="primary-navigation">
    	<ul>
			<li><?php echo nav_anchor('/', 'Dashboard');?></li>
    		<li><?php echo nav_anchor('/messages', 'Inbox' . (page_info('num_new_messages') ? ' (' . page_info('num_new_messages') . ')' : ''));?></li>
   			<li><?php echo nav_anchor('/groups', ucwords(plural(config_item('group_alias'))));?></li>
			<?php if (is_leader() || is_super_admin()): ?>
				<li><?php echo nav_anchor('/users', 'Volunteers');?></li>
			<?php endif; ?>
    		<?php if (is_super_admin()): ?>
				<li><?php echo nav_anchor('/requests', 'Fulfillment Requests');?></li>
			<?php endif; ?>
			<li><?php echo nav_anchor('/profile/edit', 'My Account', array('id' => 'profile-tab'));?></li>
    	</ul>
    </div>
</div>
<?php endif; ?>

<div id="body">
    <?php $this->load->view('common/sidebar'); ?>
    <div id="container">
	    <h1><?php echo page_info('title');?></h1>
	    <div id="content">
	    	<?php if ($status = $this->session->flashdata('status')) : ?>
	    	<div id="status"><?php echo $status; ?></div>
	    	<?php endif; ?>
			<?php echo validation_errors(); ?>
	        <?php if ($item = page_info('item_type')) $this->load->view(page_info('actions')); ?>
	        <?php $this->load->view('screens/' . page_info('screen', 'empty')); ?>
	        <?php if ($item = page_info('item_type')) $this->load->view(page_info('actions')); ?>
	    </div>
	</div>
</div>

<div id="footer">
	Volyoume is a Gria Solution.<br />
	Copyright &copy; 2011-<?php echo date('Y'); ?> <a href="http://www.griasolutions.com">Gria Solutions, LLC</a>. All rights reserved.
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>
<script src="<?php echo site_url('assets/js/vmt.js');?>"></script>
</body>
</html>