<?php
global $themename;
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
	
	$(".accordion h3:first").addClass("active");
	$(".accordion div:not(:first)").hide();
	$(".accordion h3").click(function(){
		$(this).next("div").slideToggle(500)
		.siblings("div:visible").slideUp(500);
		$(this).toggleClass("active");
		$(this).siblings("h3").removeClass("active");
	});
});
</script>
<link rel="stylesheet" type="text/css" href="<?php echo bloginfo('template_url'); ?>/functions/css/admin.css" />
<div class="wrap">
  <h2><?php echo $themename; ?> Settings</h2>
  <?php
if (isset($_POST['theme'])) :
	foreach ($options as $value) {     
		update_option($value['id'], $_POST[$value['id']]);
	}
			
	echo '<div id="message" class="updated fade"><p><strong>Updated Successfully</strong></p></div>';
	endif;
?>
  <form id="options_form" method="post" action="<?php echo attribute_escape($_SERVER['REQUEST_URI']); ?>">
    <div class="qpanel">
      <div class="panelbgright">
        <div class="accordion">
          <?php foreach ($options as $value) { 
	  switch ( $value['type'] ) {
		case "open":
		?>
          <div>
          <table  class="admintable" cellpadding="0" cellspacing="0">
            <?php break;
case "close":
?>
              </div>
            
          </table>
          <?php break;
case "title":
?>
          <h3><?php echo $value['name']; ?></h3>
          <?php break;
case 'select':
?>
          <tr>
            <td width="35%" valign="middle"><h2><?php echo $value['name']; ?></h2></td>
            <td width="65%"><select style="width:350px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                <?php foreach ($value['options'] as $option) { ?>
                <option <?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>> <?php echo $option; ?> </option>
                <?php } ?>
              </select>
              <br />
              <span class="info"><?php echo $value['desc']; ?></span></td>
          </tr>
          <?php break;         
case 'text':
?>
          <tr>
            <td width="35%" valign="middle"><h2><?php echo $value['name']; ?></h2></td>
            <td width="65%"><input style="width:350px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" />
              <br />
              <span class="info"><?php echo $value['desc']; ?></span></td>
          </tr>
          <?php 
break;
case 'textarea':
?>
          <tr>
            <td width="35%" valign="middle"><h2><?php echo $value['name']; ?></h2></td>
            <td width="65%"><textarea cols="" rows="" name="<?php echo $value['id']; ?>" style="width:350px; height:100px;" type="<?php echo $value['type']; ?>">
<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo $value['std']; } ?>
</textarea>
              <br />
              <span class="info"><?php echo $value['desc']; ?></span></td>
          </tr>
          <?php 
break;
case "checkbox":
?>
          <tr>
            <td width="35%" valign="middle"><h2><?php echo $value['name']; ?></h2></td>
            <td width="65%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
              <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
              <br />
              <span class="info"><?php echo $value['desc']; ?></span></td>
          </tr>
          <?php 		
break;
case "radio":
?>
          <tr>
            <td width="35%" valign="middle"><h2><?php echo $value['name']; ?></h2></td>
            <td width="65%"><?php
						foreach ($value['options'] as $key=>$option) { 
							if(get_settings($value['id'])){
								if ($key == get_settings($value['id']) ) {
									$checked = " checked=\"checked\"";
								} else {
									$checked = "";
								}
							} else {
								if($key == $value['std']) {
									$checked = " checked=\"checked\"";
								} else {
									$checked = "";
								}
							} ?>
              <label for="radio<?php echo $key; ?>" class="radio">
                <input type="radio" name="<?php echo $value['id']; ?>" id="radio<?php echo $key; ?>" value="<?php echo $key; ?>"<?php echo $checked; ?> />
                <?php echo '&nbsp;'.$option; ?></label>
              <?php 
						}?>
              <br />
              <span class="info"><?php echo $value['desc']; ?></span></td>
          </tr>
          <?php
break;

	}
}
?>
          </table>
        </div>
      </div>
    </div>
    <div style="clear:both"></div>
    <div class="foot">
      <p class="submit">
        <input type="submit" name="theme" value="Save Changes" />
      </p>
    </div>
  </form>
</div>
</div>
</div>
