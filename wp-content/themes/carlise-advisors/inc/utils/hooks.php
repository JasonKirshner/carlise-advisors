<?php
// function add_nav_visibility_class($classes, $item, $args, $depth)
// {
//   $visiblity_class = get_field('show_on', $item);
//   if (setted($visiblity_class)) {
//     array_push($classes, "menu-item--show-$visiblity_class");
//   }
//   return $classes;
// }
// add_filter('nav_menu_css_class', 'add_nav_visibility_class', 10, 4);

add_filter('gform_enable_field_label_visibility_settings', '__return_true');

/*
** Gravity Forms - Disable Autocomplete
*/
add_filter('gform_form_tag', 'gform_form_tag_autocomplete', 11, 2);
function gform_form_tag_autocomplete($form_tag, $form)
{
  if (is_admin()) return $form_tag;
  if (GFFormsModel::is_html5_enabled()) {
    $form_tag = str_replace('>', ' autocomplete="off">', $form_tag);
  }
  return $form_tag;
}
add_filter('gform_field_content', 'gform_form_input_autocomplete', 11, 5);
function gform_form_input_autocomplete($input, $field, $value, $lead_id, $form_id)
{
  if (is_admin()) return $input;
  $input = preg_replace('/<(input|textarea)/', '<${1} autocomplete="off" ', $input);
  return $input;
}

add_theme_support('post-thumbnails');

add_filter('gform_field_content', 'add_svg_select_field', 10, 5);
function add_svg_select_field($content, $field, $value, $lead_id, $form_id)
{
  $display = is_admin() ? ' style="display: none;" ' : '';
  if ($field->type == 'select') {
    $icon = '<svg xmlns="http://www.w3.org/2000/svg"' . $display . 'class="gfield_select_arrow" viewBox="0 0 448 512"><path d="M441.9 167.3l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L224 328.2 42.9 147.5c-4.7-4.7-12.3-4.7-17 0L6.1 167.3c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z" fill="currentColor"/></svg></div>';
    $content = str_replace('</div>', $icon, $content);
  }

  return $content;
}

// add_filter('gform_field_container', 'add_class_select_container', 10, 6);
// function add_class_select_container($field_container, $field, $form, $css_class, $style, $field_content)
// {
//   if ($field->type == 'select') {
//     $dom = new DOMDocument();
//     $dom->loadHTML($field_container);

//     $field = $dom->getElementsByTagName('li')[0];
//     $attrs = $field->attributes;

//     $newField = $dom->createElement('li');

//     foreach ($attrs as $attr) {
//       $newAttr = $dom->createAttribute($attr->name);

//       if ($attr->name == 'class') {
//         $classes = $attr->value . ' gselect_container';
//         $newAttr->value = $classes;
//       } else {
//         $newAttr->value = $attr->value;
//       }

//       $newField->appendChild($newAttr);
//     }
//     $newField->appendChild($newAttr);

//     $content = new DOMDocument();
//     @$content->loadHTML($field_content);

//     $newField->appendChild($dom->importNode($content->documentElement, true));

//     $field->parentNode->replaceChild($newField, $field);

//     return $dom->saveHTML();
//   }

//   return $field_container;
// }

/**
 * Hook to adjust og:image settings from Yoast
 * so that we can designate a featured photo for offerings posts
 */
add_filter('wpseo_opengraph_image', 'change_opengraph_image_url');
function change_opengraph_image_url($url)
{
  global $post;
  if (get_field('hero_image')) :
    $og_image_ob = get_field('featured_image');
    $url = $og_image_ob['sizes']['large'];
  elseif (get_the_post_thumbnail_url('large') !== null) :
    $url = get_the_post_thumbnail_url($post->ID, 'large');
  else :
    // Fallback image in case no freatured image is set
    $home_id = get_option('page_on_front');
    $url = get_the_post_thumbnail_url($home_id, 'large');
  endif;
  return $url;
}

/**
 * Move inline jquery calls from form elemnts to the footer of the page
 * @see https://docs.gravityforms.com/gform_init_scripts_footer/
 */

add_filter('gform_init_scripts_footer', '__return_true');

/**
 * Appending class to hide admin bar for subscribers
 * @see https://developer.wordpress.org/reference/hooks/body_class/
 */
// add_filter('body_class', function ($classes) {
//   if (in_array('subscriber', wp_get_current_user()->roles)) {
//     return array_merge($classes, array('hide-admin-bar'));
//   }
//   return $classes;
// });


/**
 * Remove the admin bar margin bump
 */
add_action('get_header', 'my_filter_head');

function my_filter_head()
{
  remove_action('wp_head', '_admin_bar_bump_cb');
}

/**
 * File Upload proxy button for styling capability
 */
add_filter('gform_field_content_1', 'fileupload_proxy_btn', 12, 5);
function fileupload_proxy_btn($content, $field, $value, $lead_id, $form_id)
{
  if ($field->type == 'fileupload' && $field->id == 5) {
    $content .= '<button class="ginput__fileupload-proxy__btn b5" type="button" onclick="document.querySelector(\'.gfield:nth-child(5) input[type=file]\').click()">Upload</button>';
  } elseif ($field->type == 'fileupload' && $field->id == 6) {
    $content .= '<button class="ginput__fileupload-proxy__btn b5" type="button" onclick="document.querySelector(\'.gfield:nth-child(6) input[type=file]\').click()">Upload</button>';
  }

  return $content;
}

/**
 * Redirects all users to custom login template at /login/ url
 */
// function redirect_login_page()
// {
//   $login_page = home_url('/login/');
//   $page_viewed = basename($_SERVER['REQUEST_URI']);

//   if ($page_viewed == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
//     wp_redirect($login_page);
//     exit;
//   }
// }
// add_action('init', 'redirect_login_page');

/**
 * Redirects failed logins back to custom login template
 */
// function login_failed()
// {
//   $login_page = home_url('/login/');
//   wp_redirect($login_page . '?login=failed');
//   exit;
// }
// add_action('wp_login_failed', 'login_failed');

/**
 * Redirects empty logins back to custom login template
 */
// function verify_username_password($user, $username, $password)
// {
//   $login_page = home_url('/login/');
//   if ($username == "" || $password == "") {
//     wp_redirect($login_page . "?login=empty");
//     exit;
//   }
// }
// add_filter('authenticate', 'verify_username_password', 1, 3);

/**
 * Redirect user to backend or account dashboard based on role
 */
// function my_login_redirect($redirect_to, $user)
// {
//   global $user;
//   if (setted($user->roles) && is_array($user->roles)) {
//     if (in_array('subscriber', $user->roles)) {
//       return $redirect_to;
//     } elseif (in_array('administrator', $user->roles)) {
//       return admin_url();
//     }
//   } else {
//     return home_url();
//   }
// }
// add_filter('login_redirect', 'my_login_redirect', 10, 2);


/** 
 * Hook responsible for validating and updating user data
 * @see https://developer.wordpress.org/reference/hooks/edit_user_profile_update/
 */
// add_action('edit_user_profile_update', 'profile_update');
// add_action('personal_options_update', 'profile_update');
// function profile_update($user_id)
// {
//   $user_pass = get_user_by('ID', $user_id)->user_pass;

//   $error = array();

//   if ('POST' == $_SERVER['REQUEST_METHOD'] && wp_verify_nonce($_POST['_wpnonce'], 'update-user')) {

//     /* Update user password. */
//     if (setted($_POST['updatepassword'])) {
//       $current_pass = esc_attr($_POST['current-pass']);
//       $new_pass = esc_attr($_POST['new-pass']);
//       $new_pass_conf = esc_attr($_POST['new-pass-conf']);

//       if (setted($current_pass)) {
//         if (wp_check_password($current_pass, $user_pass, $user_id)) {
//           if (setted($new_pass) && setted($new_pass_conf)) {
//             if ($new_pass == $new_pass_conf)
//               wp_update_user(array('ID' => $user_id, 'user_pass' => $new_pass));
//             else
//               $error += ['newpass' => 'The passwords you entered do not match. Please try again'];
//           }
//         } else {
//           $error += ['currentpass' => 'The password you entered does not match your current password. Please try again'];
//         }
//       }
//     }

//     /* Update User */
//     if (setted($_POST['updateinfo'])) {
//       /* Update user email. */
//       $email = esc_attr($_POST['email']);
//       if (setted($email)) {
//         if (!is_email($email))
//           $error += ['email' => 'The Email you entered is not valid.  please try again.'];
//         elseif (email_exists($email) != $user_id)
//           $error += ['email' => 'This email is already used by another user.  try a different one.'];
//         else {
//           wp_update_user(array('ID' => $user_id, 'user_email' => $email));
//         }
//       }


//       $first_name = esc_attr($_POST['first-name']);
//       if (setted($first_name))
//         update_user_meta($user_id, 'first_name', $first_name);

//       $last_name = esc_attr($_POST['last-name']);
//       if (setted($last_name))
//         update_user_meta($user_id, 'last_name', $last_name);

//       $acf_fields = $_POST['acf'];

//       if (setted($acf_fields)) {
//         foreach ($acf_fields as $key => $field) {
//           $field_name = get_field_object($key)['name'];
//           if ($field_name == 'phone') {
//             if (strlen($field) == 14)
//               update_field($key, $field);
//             else
//               $error += ['phone' => 'The phone number you entered is invalid. Please try again'];
//           } else
//             update_field($key, $field);
//         }
//       }
//     }

//     /* Redirect so the page will show updated info.*/
//     if (count($error) == 0) {
//       //action hook for plugins and extra fields saving
//       // do_action('personal_options_update', $user_id);
//       exit(wp_redirect(get_permalink()));
//     }
//   }
// }

/**
 * Handle forgot password email
 */
// add_action('login_form_lostpassword', function () {
//   if ('POST' == $_SERVER['REQUEST_METHOD']) {
//     $errors = retrieve_password();

//     if (is_wp_error($errors)) {
//       // Errors found
//       $redirect_url = home_url('forgot-password');
//       $redirect_url = add_query_arg('errors', join(',', $errors->get_error_codes()), $redirect_url);
//     } else {
//       // Email sent
//       $redirect_url = home_url('login');
//       $redirect_url = add_query_arg('checkemail', 'confirm', $redirect_url);
//     }

//     exit(wp_redirect($redirect_url));
//   }
// });


/**
 * Edit WP email password reset email message
 */
// add_filter('retrieve_password_message', 'replace_retrieve_password_message', 10, 4);
// function replace_retrieve_password_message($message, $key, $user_login, $user_data)
// {
//   // Create new message
//   $msg  = __('Hello!', 'personalize-login') . "\r\n\r\n";
//   $msg .= sprintf(__('You asked us to reset your password for your account using the email address %s.', 'personalize-login'), $user_login) . "\r\n\r\n";
//   $msg .= __("If this was a mistake, or you didn't ask for a password reset, just ignore this email and nothing will happen.", 'personalize-login') . "\r\n\r\n";
//   $msg .= __('To reset your password, visit the following address:', 'personalize-login') . "\r\n\r\n";
//   $msg .= site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n\r\n";
//   $msg .= __('Thanks!', 'personalize-login') . "\r\n";

//   return $msg;
// }

/**
 * Redirecting user back to reset password form after reset password link clicked from email.
 */
// add_action('login_form_rp', 'redirect_to_custom_password_reset');
// add_action('login_form_resetpass', 'redirect_to_custom_password_reset');
// function redirect_to_custom_password_reset()
// {
//   if ('GET' == $_SERVER['REQUEST_METHOD']) {
//     // Verify key / login combo
//     $user = check_password_reset_key($_REQUEST['key'], $_REQUEST['login']);
//     if (!$user || is_wp_error($user)) {
//       if ($user && $user->get_error_code() === 'expired_key') {
//         exit(wp_redirect(home_url('login?login=expiredkey')));
//       } else {
//         exit(wp_redirect(home_url('login?login=invalidkey')));
//       }
//     }

//     $redirect_url = home_url('reset-password');
//     $redirect_url = add_query_arg('login', esc_attr($_REQUEST['login']), $redirect_url);
//     $redirect_url = add_query_arg('key', esc_attr($_REQUEST['key']), $redirect_url);

//     exit(wp_redirect($redirect_url));
//   }
// }

/**
 * Resets the user's password if the password reset form was submitted.
 */

// add_action('login_form_rp', 'do_password_reset');
// add_action('login_form_resetpass', 'do_password_reset');
// function do_password_reset()
// {
//   if ('POST' == $_SERVER['REQUEST_METHOD']) {
//     $rp_key = $_REQUEST['rp_key'];
//     $rp_login = $_REQUEST['rp_login'];

//     $user = check_password_reset_key($rp_key, $rp_login);

//     if (!$user || is_wp_error($user)) {
//       if ($user && $user->get_error_code() === 'expired_key') {
//         exit(wp_redirect(home_url('login?login=expiredkey')));
//       } else {
//         exit(wp_redirect(home_url('login?login=invalidkey')));
//       }
//     }

//     if (setted($_POST['new-pass'])) {
//       if ($_POST['new-pass'] != $_POST['new-pass-conf']) {
//         // Passwords don't match
//         $redirect_url = home_url('reset-password');
//         $redirect_url = add_query_arg('key', $rp_key, $redirect_url);
//         $redirect_url = add_query_arg('login', $rp_login, $redirect_url);
//         $redirect_url = add_query_arg('error', 'password_reset_mismatch', $redirect_url);

//         exit(wp_redirect($redirect_url));
//       }

//       if (empty($_POST['new-pass'])) {
//         // Password is empty
//         $redirect_url = home_url('reset-password');
//         $redirect_url = add_query_arg('key', $rp_key, $redirect_url);
//         $redirect_url = add_query_arg('login', $rp_login, $redirect_url);
//         $redirect_url = add_query_arg('error', 'password_reset_empty', $redirect_url);

//         exit(wp_redirect($redirect_url));
//       }

//       // Parameter checks OK, reset password
//       reset_password($user, $_POST['new-pass']);
//       wp_redirect(home_url('login?password=changed'));
//     } else {
//       echo "Invalid request.";
//     }

//     exit;
//   }
// }

/**
 * Blocks non admin users from accessing wp-admin
 */
// add_action('init', 'blockusers_init');
// function blockusers_init()
// {
//   if (is_admin() && !current_user_can('administrator') && !(defined('DOING_AJAX') && DOING_AJAX)) {
//     exit(wp_redirect(home_url()));
//   }
// }

/**
 * Add read_private_posts capability to subscriber
 * Note this is saves capability to the database on admin_init, so consider doing this once on theme/plugin activation
 */
// add_action('init', 'add_sub_caps');

// function add_sub_caps()
// {
//   $role = get_role('subscriber');

//   if (!$role->has_cap('read_private_pages') && !$role->has_cap('read_private_posts')) {
//     $role->add_cap('read_private_posts');
//     $role->add_cap('read_private_pages');
//   }
// }

/**
 * Redirects non logged in clients to login page instead of 404
 */
// add_action('wp', 'redirect_private_page_to_login');
// function redirect_private_page_to_login()
// {
//   $queried_object = get_queried_object();

//   if ($queried_object->post_status == "private" && !is_user_logged_in()) {

//     exit(wp_redirect(home_url('/login')));
//   }
// }

/**
 * Redirect non logged in users to login when accessing resources pages
 */
// function my_page_template_redirect()
// {
//   if ((is_tax('types') || is_singular('resources')) && !is_user_logged_in()) {
//     exit(wp_redirect(home_url('/login')));
//   }
// }
// add_action('template_redirect', 'my_page_template_redirect');

/**
 * Add query argument for selecting pages to add to a menu
 */
// function show_private_pages_menu_selection($args)
// {
//   if ($args->name == 'page') {
//     $args->_default_query['post_status'] = array('publish', 'private');
//   }
//   return $args;
// }
// add_filter('nav_menu_meta_box_object', 'show_private_pages_menu_selection');


// // remove "Private: " from titles
// function remove_private_prefix($title)
// {
//   $title = str_replace('Private: ', '', $title);
//   return $title;
// }
// add_filter('the_title', 'remove_private_prefix');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function carlise_advisors_content_width()
{
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters('carlise_advisors_content_width', 640);
}
add_action('after_setup_theme', 'carlise_advisors_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function carlise_advisors_scripts()
{
  wp_enqueue_style('carlise-advisors-style', get_template_directory_uri() . '/assets/main.min.css');
  wp_enqueue_script('carlise-advisors-js', get_template_directory_uri() . '/assets/main.min.js', null, 1, true);
}
add_action('wp_enqueue_scripts', 'carlise_advisors_scripts');

function svg_enqueue_scripts($hook)
{
  wp_enqueue_style('svg-style', get_theme_file_uri('/src/css/lib/svg.css'));
  wp_enqueue_script('svg-script', get_theme_file_uri('/src/js/lib/svg.js'), 'jquery');
  wp_localize_script(
    'svg-script',
    'script_vars',
    array('AJAXurl' => admin_url('admin-ajax.php'))
  );
}

add_action('admin_enqueue_scripts', 'svg_enqueue_scripts');

/**
 * Map any urls for the Uploads to a remote domain/server if we're in a local environment.
 * This function allows us to not download the /uploads directory and avoid copious 404 errors
 */
function rewrite_uploads($upload_url_path)
{
  if (!isset($_SERVER['LANDO']))
    return;
  if (class_exists('ACF'))
    $enable_proxy = get_field('proxy_images', 'option');
  if (!$enable_proxy)
    return;

  $site_name = $_SERVER['PANTHEON_SITE_NAME'] ?? 'carlise-advisors';
  $proxy_env = get_field('proxy_environment') ?? "develop-$site_name.pantheonsite.io/wp-content/uploads";
  $removals = array(
    'https://',
    'http://'
  );

  foreach ($removals as $removal) {
    if (strpos($removal, $proxy_env) !== false) {
      $proxy_env = str_replace($removal, '', $proxy_env);
    }
  }

  if ($_SERVER['LANDO'] == 'ON' && $_SERVER['PANTHEON_ENVIRONMENT'] == 'dev') {
    return "//$proxy_env";
  }
}
add_filter('pre_option_upload_url_path', 'rewrite_uploads');

/**
 * Add support to upload SVG icons
 */
function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/**
 * Support for 'text/plain' as the secondary mime type of .vtt files,
 * in addition to the default 'text/vtt' support.
 */
add_filter('wp_check_filetype_and_ext', 'wpse323750_secondary_mime', 99, 4);

function wpse323750_secondary_mime($check, $file, $filename, $mimes)
{
  if (empty($check['ext']) && empty($check['type'])) {
    // Adjust to your needs!
    $secondary_mime = ['svg' => 'image/svg+xml'];

    // Run another check, but only for our secondary mime and not on core mime types.
    remove_filter('wp_check_filetype_and_ext', 'wpse323750_secondary_mime', 99, 4);
    $check = wp_check_filetype_and_ext($file, $filename, $secondary_mime);
    add_filter('wp_check_filetype_and_ext', 'wpse323750_secondary_mime', 99, 4);
  }
  return $check;
}

//call our function when initiated from JavaScript
add_action('wp_AJAX_svg_get_attachment_url', 'get_attachment_url_media_library');

/**
 * Ajax get_attachment_url_media_library
 * @author fadupla
 */
function get_attachment_url_media_library()
{
  $url = '';
  $attachmentID = isset($_REQUEST['attachmentID']) ? $_REQUEST['attachmentID'] : '';
  if ($attachmentID) {
    $url = wp_get_attachment_url($attachmentID);
  }

  echo $url;

  die();
}

add_action('wp_ajax_svg_get_attachment_url', 'get_attachment_url_media_library');
