<?php

define('MANAGER_URI', get_bloginfo('stylesheet_directory') . '/slider_manager');

add_action('admin_menu', 'manager_admin_menu');
add_action('admin_init', 'manager_init');

global $slides;

if(get_option('slides')) {
	$slides = get_option('slides');
} else {
	$slides = false;	
}

add_filter("attribute_escape", "myfunction", 10, 2);
function myfunction($safe_text, $text) {
    return str_replace(__('Insert into Post'), __('Use this image'), $text);
}

// admin menu
function manager_admin_menu() {
	
	if(isset($_GET['page']) && $_GET['page'] == 'slidermanager') {
		
		if(isset($_POST['action']) && $_POST['action'] == 'save') {
			
			$slides = array();
			
			foreach($_POST['src'] as $k => $v) {
				$slides[] = array(
					'src' => $v,
					'link' => $_POST['link'][$k],
					'caption' => $_POST['caption'][$k],
					'id' => $_POST['id'][$k],
					'alt' => $_POST['alt'][$k],
					'title' => $_POST['title'][$k]
				);
			}
			
			update_option('slides', $slides);
			
		}
		
	}
	
	add_theme_page('Banner Slides', 'Banner Slides', 'edit_themes', 'slidermanager', 'manager_wrap');
	
}


// slider manager wrapper
function manager_wrap() {
	$slides = get_option('slides');
	global $slides;
	
?>

	<div class="wrap" id="manager_wrap">
	
		<h2>Banner Slides</h2>
        		
		<form action="" id="manager_form" method="post">
		
			<ul id="manager_form_wrap" class="metabox-holder">
			
             <?php if(get_option('slides')) : $slides = get_option('slides'); ?>
				
				<?php foreach($slides as $k => $slide) : ?>
			
				
				<li class="slide postbox">
                	
                    <h3 class="hndle"><span><?php if($slide['title']) { echo $slide['title']; } else { echo 'No Title'; } ?></span></h3>
					
                    <div class="inside-slide">
                        <div class="toggle">
                            <div class="preview">
                            <input type="text" name="id[]" class="hidden slide_id" value="<?php echo $slide['id'] ?>">
                            <input type="text" name="src[]" class="slide_src hidden" value="<?php echo $slide['src'] ?>">
                                <?php $image_thumb = wp_get_attachment_image_src($slide['id'], 'thumbnail'); ?>
                                <small>Image not to scale</small><br/><br/>
                                <img class="custom_preview_image" src="<?php echo $image_thumb[0] ?>" alt="" /><br/>
                                <a href="#" class="custom_upload_image_button button-primary"><?php if($slide['id']) { echo 'Change Image'; } else { echo 'Choose Image'; }?></a>
                                <!-- <a href="#" class="custom_clear_image_button button">Remove Image</a> -->
                            </div>
                            
                            <div class="inputs">
                            
                                <label for="slide_title">Image Title</label>
                                <input type="text" name="title[]" class="slide_title" value="<?php echo $slide['title'] ?>">
                            
                                <label for="slide_link">Image Link</label>
                                <input type="text" name="link[]" class="slide_link" value="<?php echo $slide['link'] ?>">
                                
                                <label for="slide_alt">Image Alt Text</label>
                                <input type="text" name="alt[]" class="slide_alt" value="<?php echo $slide['alt'] ?>">
                            
                            </div>
                            
                            <div class="clear"></div>
                            
                            <label for="slide_caption">Image Caption</label>
                            <textarea name="caption[]" cols="20" rows="2" class="slide_caption"><?php echo $slide['caption'] ?></textarea>
                        </div>
                        
                        <a href="#" class="edit_slide alignleft button-secondary">Edit Slide</a>
                        <div class="widget-control-actions alignright">
                            <a href="#" class="widget-control-remove remove_slide">Remove Slide</a>
                        </div>
                        <br class="clear"/>
                    </div>
					
				</li>
				
				<?php endforeach; ?>
				
			<?php else : ?>
			
				<li class="slide postbox">
                
                	<h3 class="hndle"><span></span></h3>
					
                    <div class="inside-slide">
                        <div class="toggle">
                            <div class="preview">
                            <input type="text" name="id[]" class="hidden slide_id" value="">
                            <input type="text" name="src[]" class="slide_src hidden" value="">
                                <small>Image not to scale</small><br/>
                                <img class="custom_preview_image" src="" alt="" /><br/>
                                <a href="#" class="custom_upload_image_button button-primary">Choose Image</a>
                                <!-- <a href="#" class="custom_clear_image_button button">Remove Image</a> -->
                            </div>
                            
                            <div class="inputs">
                            
                                <label for="slide_title">Image Title</label>
                                <input type="text" name="title[]" class="slide_title" value="">
                            
                                <label for="slide_link">Image Link</label>
                                <input type="text" name="link[]" class="slide_link" value="">
                                
                                <label for="slide_alt">Image Alt Text</label>
                                <input type="text" name="alt[]" class="slide_alt" value="">
                            
                            </div>
                            
                            <div class="clear"></div>
                            
                            <label for="slide_caption">Image Caption</label>
                            <textarea name="caption[]" cols="20" rows="2" class="slide_caption"></textarea>
                        </div>
                            
                        <a href="#" class="edit_slide alignleft button-secondary">Edit Slide</a>
                        <div class="widget-control-actions alignright">
                            <a href="#" class="widget-control-remove remove_slide">Remove Slide</a>
                        </div>
                        <br class="clear"/>
                    </div>
					
				</li>
				
			<?php endif; ?>
			
			</ul>
			
            <div class="clear"></div>
			<input type="submit" value="Save Changes" id="manager_submit" class="button-primary">
            <a id="add-li" class="button-secondary alignright">Add New Slide</a>
			<input type="hidden" name="action" value="save">
			
		</form>
		
	</div>

<?php
	
}


// slider manager init
function manager_init() {
	
	if(isset($_GET['page']) && $_GET['page'] == 'slidermanager') {
	
		// scripts
		wp_enqueue_script('jquery-ui-core');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_script('slider-manager', MANAGER_URI . '/js/manager.js', false, '1.0', false);
		
		// styles
		wp_enqueue_style('slider-manager', MANAGER_URI . '/css/manager.css', false, '1.0', 'all');
		wp_enqueue_style('thickbox');
		
	}

}

?>