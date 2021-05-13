<?php

/**
 * Get the contents of a module in the /modules directory
 * The $args array will be converted into variables within the $module_name.php file.
 * The key of each array index will be the variable name, it's value will be stored as the variable value.
 * @param string $module_name - the name of the module (lowercase & hyphenated)
 * @param array $args - an array of key-value pairs to be extracted as variables.
 */
function get_module($module_name, $args = null)
{
  if (empty($module_name))
    return;

  ob_start();
  the_module($module_name, $args);
  return ob_get_clean();
}

/**
 * Output a module in the /modules directory
 * The $args array will be converted into variables within the $module_name.php file.
 * The key of each array index will be the variable name, it's value will be stored as the variable value.
 * @param string $module_name - the name of the module (lowercase & hyphenated)
 * @param array $args - an array of key-value pairs to be extracted as variables.
 */
function the_module($module_name, $args = null)
{
  if (empty($module_name))
    return;

  $modules_path = get_template_directory() . "/modules";
  if (!empty($args) && is_array($args)) {
    extract($args, EXTR_SKIP);
  }

  include("$modules_path/$module_name/$module_name.php");
}
