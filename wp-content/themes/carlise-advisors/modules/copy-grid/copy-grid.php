<section class="copy-grid<?= setted($class) ? " $class" : ""; ?> placeholder" data-module="copy-grid">
  <h2 class="module-name">copy-grid</h2>
  <?php the_module('image', array('image' => $services_icon)) ?>
  <?php if(have_rows('service')): ?>
    <?php while(have_rows('service')): the_row(); ?>
      <?php the_sub_field('service_sub_heading') ?>
      <?php the_sub_field('service_blurb') ?>
    <?php endwhile; ?>
  <?php endif; ?>
</section>
