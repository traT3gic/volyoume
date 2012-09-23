<?php $message = page_info('item');?>
<table class="message">
<tr><td class="subject" colspan="2"><?php echo $message->subject; ?></td></tr>
<tr><td class="field">From:</td><td><?php echo $message->author_name; ?></td></tr>
<tr><td class="field">Date:</td><td><?php echo date('l, F d, Y \a\t g:i A', strtotime($message->create_date)); ?></td></tr>
<tr><td class="body" colspan="2"><?php echo auto_typography($message->body); ?></td></tr>
<tr><td colspan="2" class="reply-button"><a class="button reply" href="#">Reply</a></td></tr>
<tr><td class="field">Reply:</td><td class="reply-body"><?php echo form_textarea(); ?></td></tr>
</table>

