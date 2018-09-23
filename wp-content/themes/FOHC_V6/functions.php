<?php
// Theme Directory and URI
define('THEME_DIR', get_template_directory());
define('THEME_URI', get_template_directory_uri());
// Admin URLS
define('THEME_ADMIN', THEME_DIR . '/admin');
define('THEME_ADMIN_URI', THEME_URI . '/admin');

/************* INCLUDE NEEDED FILES ***************/
/*
1. admin/sceletus.php (a.k.a. skeleton)
  - head cleanup (remove rsd, uri links, junk css, ect)
  - enqueueing scripts & style
  - menus
  - widgets
*/
require_once(THEME_ADMIN.'/sceletus.php'); 
require_once(THEME_ADMIN.'/admin.php'); 

/*
2. admin/users/users.php
  - define users custom fields
*/
require_once(THEME_ADMIN.'/users/users.php'); 
require_once(THEME_ADMIN.'/users/profile.php'); 

/*
3. admin/email/email.php
  - define email to be sent to users
*/
require_once(THEME_ADMIN.'/email/email.php'); 

/*
4. admin/custom/custom_posts.php
  - define custom posts
  - include meta fields
*/
require_once(THEME_ADMIN.'/custom/custom_posts.php'); 
require_once(THEME_ADMIN.'/custom/meta/meta-boxes.php'); 

/*
5. admin/ajax.php
  - ajax calls 
*/
require_once(THEME_ADMIN.'/ajax.php'); 
require_once(THEME_ADMIN.'/assets/aq_resizer.php'); 
// require_once(THEME_ADMIN.'/assets/twitter-rss.php'); 

/*
6. admin/options/options-framework.php
  - options
*/
if ( !function_exists( 'optionsframework_init' ) ) {
    define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/options/' );
    require_once dirname( __FILE__ ) . '/admin/options/options-framework.php';
}

/*
7. admin/slider_manager/loader.php
  - slide control
*/
require_once(THEME_ADMIN.'/slider_manager/loader.php'); 


require THEME_ADMIN.'/shortcodes/buttons.php';

/**
* Check to see if this page will paginate
* 
* @return boolean
*/
function will_paginate() 
{
  global $wp_query;
  
  if ( !is_singular() ) 
  {
    $max_num_pages = $wp_query->max_num_pages;
    
    if ( $max_num_pages > 1 ) 
    {
      return true;
    }
  }
  return false;
}

// Percent calculation
function percent($num_amount, $num_total) {
    $count1 = $num_amount / $num_total;
    $count2 = $count1 * 100;
    $count = number_format($count2, 0);
    echo $count;
}

/**
 * Calculate differences between two dates with precise semantics. Based on PHPs DateTime::diff()
 * implementation by Derick Rethans. Ported to PHP by Emil H, 2011-05-02. No rights reserved.
 * 
 * See here for original code:
 * http://svn.php.net/viewvc/php/php-src/trunk/ext/date/lib/tm2unixtime.c?revision=302890&view=markup
 * http://svn.php.net/viewvc/php/php-src/trunk/ext/date/lib/interval.c?revision=298973&view=markup
 */

function _date_range_limit($start, $end, $adj, $a, $b, &$result)
{
    if ($result[$a] < $start) {
        $result[$b] -= intval(($start - $result[$a] - 1) / $adj) + 1;
        $result[$a] += $adj * intval(($start - $result[$a] - 1) / $adj + 1);
    }

    if ($result[$a] >= $end) {
        $result[$b] += intval($result[$a] / $adj);
        $result[$a] -= $adj * intval($result[$a] / $adj);
    }

    return $result;
}

function _date_range_limit_days(&$base, &$result)
{
    $days_in_month_leap = array(31, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
    $days_in_month = array(31, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

    _date_range_limit(1, 13, 12, "m", "y", $base);

    $year = $base["y"];
    $month = $base["m"];

    if (!$result["invert"]) {
        while ($result["d"] < 0) {
            $month--;
            if ($month < 1) {
                $month += 12;
                $year--;
            }

            $leapyear = $year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0);
            $days = $leapyear ? $days_in_month_leap[$month] : $days_in_month[$month];

            $result["d"] += $days;
            $result["m"]--;
        }
    } else {
        while ($result["d"] < 0) {
            $leapyear = $year % 400 == 0 || ($year % 100 != 0 && $year % 4 == 0);
            $days = $leapyear ? $days_in_month_leap[$month] : $days_in_month[$month];

            $result["d"] += $days;
            $result["m"]--;

            $month++;
            if ($month > 12) {
                $month -= 12;
                $year++;
            }
        }
    }

    return $result;
}

function _date_normalize(&$base, &$result)
{
    $result = _date_range_limit(0, 60, 60, "s", "i", $result);
    $result = _date_range_limit(0, 60, 60, "i", "h", $result);
    $result = _date_range_limit(0, 24, 24, "h", "d", $result);
    $result = _date_range_limit(0, 12, 12, "m", "y", $result);

    $result = _date_range_limit_days($base, $result);

    $result = _date_range_limit(0, 12, 12, "m", "y", $result);

    return $result;
}

/**
 * Accepts two unix timestamps.
 */
function _date_diff($one, $two)
{
    $invert = false;
    if ($one > $two) {
        list($one, $two) = array($two, $one);
        $invert = true;
    }

    $key = array("y", "m", "d", "h", "i", "s");
    $a = array_combine($key, array_map("intval", explode(" ", date("Y m d H i s", $one))));
    $b = array_combine($key, array_map("intval", explode(" ", date("Y m d H i s", $two))));

    $result = array();
    $result["y"] = $b["y"] - $a["y"];
    $result["m"] = $b["m"] - $a["m"];
    $result["d"] = $b["d"] - $a["d"];
    $result["h"] = $b["h"] - $a["h"];
    $result["i"] = $b["i"] - $a["i"];
    $result["s"] = $b["s"] - $a["s"];
    $result["invert"] = $invert ? 1 : 0;
    $result["days"] = intval(abs(($one - $two)/86400));

    if ($invert) {
        _date_normalize($a, $result);
    } else {
        _date_normalize($b, $result);
    }

    return $result;
}

?>