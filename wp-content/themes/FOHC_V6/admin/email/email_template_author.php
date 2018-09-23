<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Folkestone Optimists</title>
</head>
    <body style="padding: 0px; margin: 0px; background: #fff;">
    	<table width="716" cellpadding="0" align="center" cellspacing="0" style="width:716px; background:#fff;">
    		<tr>
		    	<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;">Hi <?php echo $author->display_name; ?></td>
		    </tr>
		    <tr>
	    		<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;"><?php echo $user->display_name; ?> has <?php echo $attendance; ?> your event. <a style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" href="<?php echo get_permalink($post->ID); ?>"><?php echo $post->post_title; ?></a></td>
	    	</tr>
	    	<?php if($attendance == 'declined') {  ?>
		    <tr>
		    	<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;">
	    		 <?php echo $declined_reason; ?>
	    		</td>
	    	</tr>
	    	<?php } ?>
		    <tr>
	    		<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;"><?php echo $user->display_name; ?> will be meeting at <?php $meet_location ?></td>
	    	</tr>
	    	<tr>
	    		<td style="font-size:10px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;">
	    			<a style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" href="http://www.folkestone-optimists.co.uk/">http://www.folkestone-optimists.co.uk/</a>
	    		</td>
	    	</tr>
	    </table>
    </body>
</html>