<?php
$navigation_icons = setted($navigation_icons) ? $navigation_icons : null;
$navigation_left = $navigation_icons && setted($navigation_icons['left']) ? $navigation_icons['left'] : 'arrow-left-duotone';
$navigation_right = $navigation_icons && setted($navigation_icons['right']) ? $navigation_icons['right'] : 'arrow-right-duotone';
$navigation_class = setted($navigation_class) ? $navigation_class : '';
$pagination_class = setted($pagination_class) ? $pagination_class : '';

if (setted($args)) {
  $params = '';
  foreach (array_keys($args) as $key) {
    if ($key !== 'cards' && $key !== 'title' && $key !== 'copy' && $key !== 'class' && setted($args[$key])) {
      $attr = str_replace('_', '-', $key);
      $params .= " data-" . $attr . "='$args[$key]'";
    }
  }
}

$init_at_bp_class = setted($init_at_breakpoint) ? " carousel-bp carousel-bp--$init_at_breakpoint" : ''; ?>
<div class="carousel container section-padding<?= $init_at_bp_class; ?><?= setted($class) ? " $class" : ''; ?>" data-module="carousel">
  <!-- <div class="carousel-containercontainer"> -->
  <div class="carousel-container swiper-container<?= setted($class) ? " $class" : ""; ?>" <?= setted($params) ? $params : ''; ?>>
    <?php if ($title || $tagline || $copy) :
      the_module('title-copy', array(
        'tagline' => $tagline,
        'title' => $title,
        'copy' => $copy,
        'title_class' => $title_class,
        'class' => $title_copy_class,
      ));
    endif; ?>
    <div class="carousel-wrapper<?= $title || $tagline || $copy ? ' carousel-wrapper--margin-top' : ''; ?> swiper-wrapper">
      <?php if (setted($cards)) :
        foreach ($cards as $card) : ?>
          <div class="carousel-slide swiper-slide">
            <?= $card; ?>
          </div>
      <?php endforeach;
      endif; ?>
    </div>
    <?php if (setted($navigation)) : ?>
      <?= get_svg($navigation_right, "carousel-next swiper-button-next$init_at_bp_class $navigation_class $navigation_class--next"); ?>
      <?= get_svg($navigation_left, "carousel-prev swiper-button-prev$init_at_bp_class $navigation_class $navigation_class--prev"); ?>
    <?php endif; ?>
    <?php if (setted($pagination)) : ?>
      <div class="carousel-pagination swiper-pagination<?= $init_at_bp_class; ?><?= " $pagination_class"; ?>"></div>
    <?php endif; ?>
  </div>
  <!-- </div> -->
  <?php if (setted($cta)) : ?>
    <div class="carousel__cta-container">
      <?php the_module('button', array(
        'value' => $cta['title'],
        'link' => $cta['url'],
        'class' => 'carousel__cta'
      )); ?>
    <?php endif; ?>
    </div>
</div>
