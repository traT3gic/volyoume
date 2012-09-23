<?php echo validation_errors(); ?>
<?php echo form_open_multipart();?>

<?php echo form_fieldset('Account Information');?>
<div class="form-item">
<?php echo form_label('E-mail Address', 'email');?>
<?php echo form_input('email', set_value('email'));?>
</div>
<div class="form-item">
<?php echo form_label('Password', 'password');?>
<?php echo form_password('password', set_value('password'));?>
</div>
<?php echo form_fieldset_close();?>

<?php echo form_fieldset('Profile Information');?>
<div class="form-item">
<?php echo form_label('Profile Image', 'profile_image');?>
<?php echo form_upload('profile_image', set_value('profile_image'));?>
</div>
<div class="form-item">
<?php echo form_label('First Name', 'first_name');?>
<?php echo form_input('first_name', set_value('first_name'));?>
</div>
<div class="form-item">
<?php echo form_label('Middle Name', 'middle_name');?>
<?php echo form_input('middle_name', set_value('middle_name'));?>
</div>
<div class="form-item">
<?php echo form_label('Last Name', 'last_name');?>
<?php echo form_input('last_name', set_value('last_name'));?>
</div>
<div class="form-item">
<?php echo form_label('Address', 'address_1');?>
<?php echo form_input('address_1', set_value('address_1'));?>
</div>
<div class="form-item">
<?php echo form_label('Address', 'address_2');?>
<?php echo form_input('address_2', set_value('address_2'));?>
</div>
<div class="form-item">
<?php echo form_label('City', 'city');?>
<?php echo form_input('city', set_value('city'));?>
</div>
<div class="form-item">
<?php echo form_label('State', 'state');?>
<?php echo form_state_dropdown('state', set_value('state'));?>
</div>
<div class="form-item">
<?php echo form_label('ZIP Code', 'zip_code');?>
<?php echo form_input('zip_code', set_value('zip_code'));?>
</div>
<div class="form-item">
<?php echo form_label('Phone Number', 'phone');?>
<?php echo form_input('phone', set_value('phone'));?>
</div>
<?php echo form_fieldset_close();?>

<?php echo form_fieldset('Ministry Information');?>
<div class="form-item">
<?php echo form_label('Ministry', 'ministry_id');?>
<?php echo form_dropdown('ministry_id', set_value('ministry_id'));?>
</div>
<div class="form-item">
<?php echo form_label('Ministry Admin', 'is_admin');?>
<?php echo form_checkbox('is_admin', set_value('is_admin'));?>
</div>
<div class="form-item">
<?php echo form_label('Ministry Leader', 'is_leader');?>
<?php echo form_checkbox('is_leader', set_value('is_leader'));?>
</div>
<?php echo form_fieldset_close();?>

<?php echo form_hidden('form_type', 'create_user');?>

<?php echo form_close();?>