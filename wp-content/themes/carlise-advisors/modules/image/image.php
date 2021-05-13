<?php
// defaulting to full size for now, we may want to add sizing options to this module tho
$image_data = setted($image) ? get_image_data($image) : null;
$src = $image_data[0];
$alt = $image_data[1];

$image_data_mobile = setted($image_mobile) ? get_image_data($image_mobile) : $image_data;
$src_mobile = $image_data_mobile[0];

$animation = setted($animation) ? $animation : 'fade'; // supports fade, wipe
$size = setted($size) ? $size : '100w';

if (setted($src)) :
?>
  <div class="image <?= setted($class) ? " $class" : ""; ?><?= " anim--$animation"; ?>" data-module="image">
    <img class="image-src" src="<?= get_stylesheet_directory_uri(); ?>/assets/img/placeholder.gif" data-srcset-mobile="<?= $src_mobile; ?>" data-sizes="<?= $size; ?>" data-srcset="<?= $src; ?>" alt="<?= esc_attr($alt); ?>">
  </div>
<?php endif; ?>
