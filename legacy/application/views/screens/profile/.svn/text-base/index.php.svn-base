<?php $user = page_info('item');?>
<table class="profile">
<tr><th colspan="2">Account Information</th></tr>
<tr>
	<td>Pic</td>
	<td><img class="profile-pic" src="" alt="" /></td>
</tr>
<tr>
	<td>Name</td>
    <td>
    <?php echo $user->first_name;?> <?php echo $user->middle_name;?> <?php echo $user->last_name;?></td>
</tr>
<tr>
	<td>Email</td>
    <td><?php echo $user->email; ?></td>
</tr>
<tr>
    <td>Role</td>
    <td><?php echo $user->role_name;?></td>
</tr>
<?php if (is_self() || is_super_admin()) : ?>
<tr><th colspan="2">Contact Information</th></tr>
<tr>
	<td>Address</td>
    <td>
    	<?php if (!empty($user->address_1)) echo $user->address_1 . '<br />';?>
    	<?php if (!empty($user->address_2)) echo $user->address_2 . '<br />';?>
    	<?php echo $user->city;?>, <?php echo $user->state;?> <?php echo $user->zip_code;?>
    </td>
</tr>
<?php endif; ?>
<?php if ($phone_number = $user->phone_number) : ?>
<tr>
	<td>Phone Number</td>
    <td><?php echo $phone_number; ?></td>
</tr>
<?php endif; ?>
<tr><th colspan="2">Details</th></tr>
<tr>
    <td>Sex</td>
    <td><?php echo $user->sex;?></td>
</tr>
<tr>
    <td><?php echo ucwords(config_info('group_alias'));?></td>
    <td><?php echo $user->group_name;?></td>
</tr>
<?php if (is_super_admin()):?>
<tr><th colspan="2">Account Activity</th></tr>
<tr>
	<td>Notes</td>
	<td><?php echo $user->notes; ?></td>
</tr>
<?php endif; ?>
</table>
