<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Folkestone Optimists: <?php the_title_attribute(); ?></title>
</head>
    <body style="padding: 0px; margin: 0px; background: #fff;">
    	<table width="716" cellpadding="0" align="center" cellspacing="0" style="width:716px; background:#fff;">
    		<tr>
		    	<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;">Hi <?php echo $team_member->user_email; ?></td>
		    </tr>
		    <tr>
	    		<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;"><?php echo $author->display_name; ?> has sent you a notification from FOHC about an upcoming event. <?php the_title_attribute(); ?>.</td>
	    	</tr>
		    <tr>
				<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;">Let <?php echo $author->display_name; ?> know if you are attending by clicking below and leaving your availability.</td>
			</tr>
		    <tr>
	        	<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; background:#467fde; color:#fff; padding:5px;"><a style="color:#fff; font-size:12px; font-family:Arial, Helvetica, sans-serif;" href="<?php echo get_permalink($post->ID); ?>">Click here to leave your availability!</a></td>
	        </tr>
		    <tr>
	        	<td style="font-size:12px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;"><?php echo the_content_by_id($post->ID); ?></td>
	        </tr>
	        <tr>
	    		<td style="font-size:10px; font-family:Arial, Helvetica, sans-serif; color:#000; padding:5px 0;">
	    			<a style="font-size:12px; font-family:Arial, Helvetica, sans-serif;" href="http://www.folkestone-optimists.co.uk/">http://www.folkestone-optimists.co.uk/</a>
	    		</td>
	    	</tr>
	    </table>
    </body>
</html>