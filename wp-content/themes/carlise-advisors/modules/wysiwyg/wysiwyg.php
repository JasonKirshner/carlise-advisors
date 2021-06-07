<div class="wysiwyg<?= setted($class) ? " $class" : ""; ?>">
  <?php
  add_filter('wysiwyg_typography', function ($filterMe) {
    $search = array(
      "<h1>",
      "<h2>",
      "<h3>",
      "<h4>",
      "<h5>",
      "<h6>",
      "<p>"
    );
    $replace = array(
      "<div class='h1'>",
      "<div class='h2'>",
      "<div class='h3'>",
      "<div class='p1'>",
      "<div class='p2'>",
      "<div class='p3'>",
      "<div class='p'>",
    );
    $tagClose = array("</h1>", "</h2>", "</h3>", "</h4>", "</h5>", "</h6>", "</p>");
    $filterMe = str_replace($tagClose, "</div>", $filterMe);
    return str_replace($search, $replace, $filterMe);
  });
  echo apply_filters('wysiwyg_typography', $content);
  ?>
</div>