<?php

/**
 * This grid module expects the $grid_items argument to be an array of strings. 
 * Each item in the array should be the markup for an individual "card" elemnt within the grid.
 */
$grid_items = setted($grid_items) ? $grid_items : [];
$tagline = setted($tagline) ? $tagline : '';
$title = setted($title) ? $title : '';
$title_class = setted($title_class) ? $title_class : '';
$title_copy_class = setted($title_copy_class) ? $title_copy_class : '';
$copy = setted($copy) ? $copy : '';
$cta = setted($cta) ? $cta : '';
$class = setted($class) ? $class : '';
$gutter = setted($gutter) ? $gutter : 'md';
$bottom_description = setted($bottom_description) ? $bottom_description : '';
$content_class = setted($content_class) ? $content_class : '';
$use_margin = setted($use_margin) ? true : false;

if ($grid_items || $title || $copy) : ?>
  <section class="grid<?= " $class"; ?> section-padding" data-module="grid">
    <div class="grid-container container">
      <?php if ($title || $tagline || $copy) :
        the_module('title-copy', array(
          'tagline' => $tagline,
          'title' => $title,
          'copy' => $copy,
          'title_class' => $title_class,
          'class' => $title_copy_class,
        ));
      endif;
      if ($grid_items) :
        switch ($gutter) {
          case 'xl':
            $row_count = 5;
            break;
          case 'lg':
            $row_count = 4;
            break;
          case 'md':
            $row_count = 3;
            break;
          case 'sm':
            $row_count = 2;
        }
        if (!$use_margin) {
          while (count($grid_items) % $row_count != 0) {
            array_push($grid_items, '');
          }
        }
      ?>
        <div class="grid-content<?= $title || $tagline || $copy ? ' grid-content--margin-top' : ''; ?><?= " $content_class"; ?><?= $use_margin ? " grid-content--margin-system" : ""; ?>">
          <?php foreach ($grid_items as $item) : ?>
            <div class="grid-item <?= "grid-item--$gutter"; ?>">
              <?= $item; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif;
      if ($bottom_description) : ?>
        <div class="grid-description wysiwyg h4">
          <?= $bottom_description; ?>
        </div>
      <?php endif;
      if ($cta) :
        the_module('button', array(
          'value' => $cta['title'],
          'link' => $cta['url'],
          'class' => "grid-cta"
        ));
      endif; ?>
    </div>
  </section>
<?php endif; ?>
