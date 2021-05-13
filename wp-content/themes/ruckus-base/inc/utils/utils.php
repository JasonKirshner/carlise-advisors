<?php

/**
 * Gets svg markup from the /assets/svg directory and returns it as a string
 *
 * @param string $arg | The filename minus the .svg or an ACF image array of the requested svg
 * @param string $class | Any class(es) that should be added to the svg parent container
 */
function get_svg($arg, $class = null)
{
  if ($arg) {
    if (is_array($arg)) {
      $name = $arg['title'];
      $file = $arg['filename'];
      $uploadsDir = dirname(__DIR__, 4) . '/uploads';
      $svg = file_get_contents(glob("$uploadsDir/*/*/$file")[0]);
      $classes = "svg svg--$name";
    } else {
      $assetsDir  = dirname(__DIR__, 2) . '/assets/svg/';
      $assetsPath = $assetsDir . $arg . '.svg';
      $svg = file_get_contents($assetsPath);
      $classes = "svg svg--$arg";
    }
    $classes .= $class ? " $class" : "";
    return "<div class=\"$classes\">$svg</div>";
  }
  return '';
}


/**
 * Function to check whether or not a variable is set
 *
 * @param Any $item The item to check against
 */
function setted($item)
{
  return (isset($item) && !empty($item));
}

/**
 * Formats an array of posts from a WP_Query into an array suitable for the
 * `grid` module.
 *
 * @param Array $posts An array of objects from a wp_query response
 */
function format_posts_for_grid($posts)
{
  $items = array();
  foreach ($posts as $format_item) {
    /**
     * These arrays follow the key => value structure that the
     * post-card module expects
     */
    $item_info = array(
      'title' => $format_item->post_title,
      'link_url' => get_the_permalink($format_item->ID),
      'link_label' => 'READ MORE',
      'image' => get_the_post_thumbnail_url($format_item->ID),
      'image_alt' => $format_item->post_title // this needs to be refactored to grab the actual alt field from the image object
    );
    array_push($items, $item_info);
  }
  return $items;
}

/**
 * Gets the privacy policy type links from theme options and returns 
 * a string of HTML to be used for the theme's footer and mobile menu
 */
function render_privacy_links()
{
  $legal_links = get_field('legal_pages', 'theme-options');
  if (setted($legal_links)) :
    $link_count = count($legal_links);
    foreach ($legal_links as $key => $link) :
      $link_url = $link['link']['url'];
      $link_title = $link['link']['title'];
      $link_target = $link['link']['target'] ? $link['link']['target'] : '_self';
?>
      <span class="footer-terms-text__span">
        <a class="footer-terms-text__link" href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
        <?= ($key < ($link_count - 1)) ? " | " : ""; ?>
      </span>
<?php
    endforeach;
  endif;
}
/**
 * Gets the image srcset, and alt text based on what type of entity is provided.
 * @param Obj|Array|String|Int $image
 * 
 * @return Array $srcset, $alt
 */
function get_image_data($image)
{
  global $post;
  $image_id = null;
  if (is_array($image)) {
    // assuming it's an ACF object
    $image_id = $image['id'];
  } elseif (is_object($image)) {
    // not sure what we need to do here - update this once we have a use-case
    $image_id = null;
  } elseif (is_string(($image))) {
    if (intval($image) !== 0) {
      // sometimes image IDs come through as strings
      $image_id = $image;
    } else {
      // if parseint doesn't work out, we'll assume it's an image url
      $image_id = attachment_url_to_postid($image);
    }
  } elseif (is_int($image)) {
    // assuming it's an ID
    $image_id = $image;
  } else {
    $image_id = get_post_thumbnail_id($post);
  }

  $mime_type = get_post_mime_type($image_id);

  if ($mime_type == 'image/gif') {
    // resized gifs dont appear to auto-play
    return wp_get_attachment_image_url($image_id, 'full') . ' 768w';
  }
  $alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
  $srcset = wp_get_attachment_image_srcset($image_id);
  if (!setted($srcset)) {
    // fallback specifically needed for featured client logos
    $srcset =  wp_get_attachment_image_url($image_id, 'large') . ' 768w';
  }
  return [$srcset, $alt];
}

/**
 * Used to translate a mm:ss string to seconds
 * @param STRING $str - mm:ss timecode
 * @return INT - seconds
 */
function to_seconds($str)
{
  $time = "00:$str";
  $parsed = date_parse($time);
  return ($parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second']);
}

/**
 * Send a string with a replaced string to lower case string
 * @param STRING $needle - string sequence to be replaced with $replace
 * @param STRING $replace - string sequence to replace $needle with
 * @param STRING $haystack - provided original string
 */
function lower_replace($needle, $replace, $haystack)
{
  return strtolower(str_replace($needle, $replace, $haystack));
}
