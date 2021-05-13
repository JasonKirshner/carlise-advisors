<?php
$prev = get_adjacent_post(false, '', true);
$next = get_adjacent_post(false, '', false);
?>
<div class="post-navigation<?= setted($class) ? " $class" : ""; ?> section-padding" data-module="post-navigation">
  <div class="post-navigation__container container">
    <?php
    if (setted($prev)) : ?>
      <a href="<?= get_permalink($prev->ID); ?>" class="post-navigation__cta-wrapper post-navigation__cta-wrapper--prev<?= setted($color) ? " post-navigation__cta-wrapper--$color" : ''; ?>">
        <?php if ($arrow) : ?>
          <?= get_svg('arrow-left', 'post-navigation__svg post-navigation__svg--arrow') ?>
        <?php else : ?>
          <?= get_svg('arrow-left', 'post-navigation__svg post-navigation__svg--chevron'); ?>
        <?php endif; ?>
        <span class="post-navigation__cta h5"><?= setted($prev->post_title) && $titles ? $prev->post_title : 'Read Previous Post'; ?></span>
      </a>
    <?php endif;
    if (setted($next)) : ?>
      <a href="<?= get_permalink($next->ID); ?>" class="post-navigation__cta-wrapper post-navigation__cta-wrapper--next<?= setted($color) ? " post-navigation__cta-wrapper--$color" : ''; ?>">
        <span class="h5 post-navigation__cta"><?= setted($next->post_title) && $titles ? $next->post_title : 'Read Next Post'; ?></span>
        <?php if ($arrow) : ?>
          <?= get_svg('arrow-right', 'post-navigation__svg post-navigation__svg--arrow'); ?>
        <?php else : ?>
          <?= get_svg('arrow-right', 'post-navigation__svg post-navigation__svg--chevron'); ?>
        <?php endif; ?>
      </a>
    <?php endif; ?>

  </div>
</div>
