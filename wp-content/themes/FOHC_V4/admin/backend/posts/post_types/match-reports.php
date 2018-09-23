<?php
/* Bones Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/


// let's create the function for the custom type
function match_report() { 
	// creating (registering) the custom type 
	register_post_type( 'match_report', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
	 	// let's now add all the options for this post type
		array('labels' => array(
			'name' => __('Match Reports', 'bonestheme'), /* This is the Title of the Group */
			'singular_name' => __('Match Reports', 'bonestheme'), /* This is the individual type */
			'all_items' => __('All Match Reports', 'bonestheme'), /* the all items menu item */
			'add_new' => __('Add New Report', 'bonestheme'), /* The add new menu item */
			'add_new_item' => __('Add New Match Report', 'bonestheme'), /* Add New Display Title */
			'edit' => __( 'Edit', 'bonestheme' ), /* Edit Dialog */
			'edit_item' => __('Edit Match Report', 'bonestheme'), /* Edit Display Title */
			'new_item' => __('New Match Report', 'bonestheme'), /* New Display Title */
			'view_item' => __('View Match Report', 'bonestheme'), /* View Display Title */
			'search_items' => __('Search Match Reports', 'bonestheme'), /* Search Custom Type Title */ 
			'not_found' =>  __('Nothing found in the Database.', 'bonestheme'), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __('Nothing found in Trash', 'bonestheme'), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'FOHC Match Reports', 'bonestheme' ), /* Custom Type Description */
			'public' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/admin/assets/images/custom-post-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'match_report', 'with_front' => true ), /* you can specify its url slug */
			'has_archive' => true, /* you can rename the slug here */
			'capability_type' => 'post',
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'custom-fields', 'comments', 'revisions', 'sticky')
	 	) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	register_taxonomy_for_object_type('match-report', 'match_report');
	/* this adds your post tags to your custom post type */
	register_taxonomy_for_object_type('match_tags', 'match_report');
	
} 

	// adding the function to the Wordpress init
	add_action( 'init', 'match_report');
	
	/*
	for more information on taxonomies, go here:
	http://codex.wordpress.org/Function_Reference/register_taxonomy
	*/
	
	// now let's add custom categories (these act like categories)
    register_taxonomy( 'match-report', 
    	array('match_report'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => true,     /* if this is true, it acts like categories */             
    		'labels' => array(
    			'name' => __( 'Teams', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Team', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Teams', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Teams', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Team', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Team:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Team', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Team', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Team', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Team Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    		'rewrite' => array( 'slug' => 'teams' ),
    	)
    );   
    
	// now let's add custom tags (these act like categories)
    register_taxonomy( 'match_tags', 
    	array('custom_type'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
    	array('hierarchical' => false,    /* if this is false, it acts like tags */                
    		'labels' => array(
    			'name' => __( 'Tags', 'bonestheme' ), /* name of the custom taxonomy */
    			'singular_name' => __( 'Tag', 'bonestheme' ), /* single taxonomy name */
    			'search_items' =>  __( 'Search Tags', 'bonestheme' ), /* search title for taxomony */
    			'all_items' => __( 'All Tags', 'bonestheme' ), /* all title for taxonomies */
    			'parent_item' => __( 'Parent Tag', 'bonestheme' ), /* parent title for taxonomy */
    			'parent_item_colon' => __( 'Parent Tag:', 'bonestheme' ), /* parent taxonomy title */
    			'edit_item' => __( 'Edit Tag', 'bonestheme' ), /* edit custom taxonomy title */
    			'update_item' => __( 'Update Tag', 'bonestheme' ), /* update title for taxonomy */
    			'add_new_item' => __( 'Add New Tag', 'bonestheme' ), /* add new title for taxonomy */
    			'new_item_name' => __( 'New Tag Name', 'bonestheme' ) /* name title for taxonomy */
    		),
    		'show_ui' => true,
    		'query_var' => true,
    	)
    ); 
    
    /*
    	looking for custom meta boxes?
    	check out this fantastic tool:
    	https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
    */
	

?>