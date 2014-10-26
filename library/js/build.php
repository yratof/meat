<?php
// A php script to concat javascript files and include
// it inline in the footer to save http requests
function meat_build_js() {
  $path = dirname(__FILE__);
  $files = array(
    'libs/modernizr.custom.min.js',
    'meat.js',
    'scripts.js',
    'custom.js'
  );

  $cache = 'cache.js';
  $cache_path = $path . '/' . $cache;
  $cache_uri = get_template_directory_uri() . '/library/js/' . $cache;
  $cache_exists = file_exists($cache_path);
  $script = FALSE;

  // Use cache if available and up to date
  if ($cache_exists) {
    $cache_time = filemtime($cache_path);
    $update = FALSE;
    foreach ($files as $file) {
      $file_path = $path . '/' . $file;
      // Check if the file exists and if the timestamp of the
      // file has changed since the timestamp of the cached file
      if (file_exists($file_path) && filemtime($file_path) > $cache_time) {
        $update = TRUE;
        break;
      }
    }

    if (!$update) {
      $script = file_get_contents($cache_path);
      // Update the cached file if it is empty
      $update = ($script === '');
    }
  }
  else {
    $update = TRUE;
  }

  if ($update) {
    $script = '';
    foreach ($files as $file) {
      $file_path = $path . '/' . $file;
      if (file_exists($file_path)) {
        $script .= file_get_contents($file_path) . "\n";
      }
    }

    $save_cache = @file_put_contents($cache_path, $script);
    if (!$save_cache && current_user_can('edit_others_posts')) {
      // Give a warning to admins that the build system could not
      // save the cache to disk.
      $message = "The javascript build system was not able to save cache.js";
      $message.= "<br>Is cache.js given write permission?";
      echo sprintf('<div class="meat-warning">%s</div>', $message);
    }
  }

  if ($script !== FALSE) {
    if ($cache_exists) {
      $html = '<script type="text/javascript" src="' . $cache_uri . '"></script>';
    }
    else {
      $html = '<script type="text/javascript">%s</script>';
      $html = sprintf($html, $script);
    }
  }

  return $html;
}