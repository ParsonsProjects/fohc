<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php if(is_home()) bloginfo('name'); else wp_title(''); ?></title>

    <meta name="viewport" content="width=device-width">

    <link rel="stylesheet" href=<?php bloginfo('stylesheet_url'); ?>>

    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="Atom 1.0" href="<?php bloginfo('atom_url'); ?>" />
    
    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="<?php echo get_template_directory_uri(); ?>/images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        
    <?php
    wp_get_archives('type=monthly&format=link');
    wp_head();
    ?>
</head>
<body>
	
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
    <![endif]-->

    <div id="cookies">
        <div class="container">
            <a href="" title="close" class="close">x</a>
            <span class="heading">Cookies:</span>
            <span class="content">By continuing to use this site you consent to the use of cookies on your device unless you have disabled them. You can change your cookie settings at any time but parts of our site will not function correctly without them. <span class="close">Use cookies</span>.</span>
        </div>
    </div>

    <?php if(of_get_option('scolling_news', '' ) != ''){?>
    <div id="news">
        <div class="container clearfix">
            <a href="" title="close" class="close">x</a>
            <span class="heading">Flash News:</span>
            <span class="content"><?php echo of_get_option('scolling_news', '' ); ?></span>
        </div>
    </div>
    <?php } ?>

    <ul class="skip hidden">
        <li><a href="#primary-nav">Skip to navigation</a></li>
        <li><a href="#wrap">Skip to main content</a></li>
        <li><a href="#footer">Skip to footer</a></li>
    </ul>

    <header id="header">
        <div class="container clearfix">
            <div id="logo">
                <a href="<?php echo get_option('home'); ?>/" title="<?php if( !is_front_page()){ print'Back to homepage'; } else { bloginfo('name'); }; ?>">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.gif" alt="<?php bloginfo('name'); ?>" />
                </a>
            </div>
            <div id="search" class="clearfix">
                <form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" method="get" role="search">
                    <label for="s" class="screen-reader-text">Search for:</label>
                    <div class="input">
                        <input type="text" placeholder="Search the Site..." id="s" name="s" value="" class="">
                    </div>
                    <input type="submit" value="Search" id="searchsubmit">
                </form>
            </div>
            <div id="social-platforms" class="clearfix">
                <a class="twitter" href="<?php echo of_get_option('twitter_url', '' ); ?>" title="Join Us On Twitter">Twitter</a>
                <a class="facebook" href="<?php echo of_get_option('facebook_url', '' ); ?>" title="Join Us On Facebook">Facebook</a>
            </div>
            <?php 
            if (is_user_logged_in()) { 
                $concat = wpu_concat_single();
                $user_id = get_current_user_id();
                echo "<a class=\"btn\" href=\"" . get_option('home') . "/members" . $concat . "uid=$user_id\" title=\"View Profile\">View Profile</a>";
            }
            ?>
        </div>
    </header>

    <div id="primary-nav">
        <div class="container">
            <div class="toggle-nav">Navigation</div>
            <?php sceletus_primary_nav(); ?>
        </div>
    </div>

    <div id="wrap">

        <div class="container">