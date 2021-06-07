<section class="hero<?= setted($class) ? " $class" : ""; ?>" data-module="hero">
  <?php the_module('image', array('image' => $hero_image, 'class' => 'hero-image')) ?>
  <div class="hero-container container">
    <h1 class="hero-title h1"><?= $hero_title ?></h1>
    <div class="hero-form">
      <?= do_shortcode('[CP_CALCULATED_FIELDS id="5"]'); ?>
    </div>
  </div>
</section>
