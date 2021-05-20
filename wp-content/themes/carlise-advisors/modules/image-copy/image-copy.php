<section class="image-copy<?= setted($class) ? " $class" : ""; ?> placeholder" data-module="image-copy">
  <h2 class="module-name">image-copy</h2>
  <h3><?= $project_title ?></h3>
  <?php the_module('image', array('image' => $project_icon)) ?>
  <?php the_module('image', array('image' => $project_image)) ?>
  <h3><?= $project_subtitle_1 ?></h3>
  <h4><?= $project_blurb_1 ?></h4>
  <h3><?= $project_subtitle_2 ?></h3>
  <h4><?= $project_blurb_2 ?></h4>
  <h3><?= $prepare_title ?></h3>
  <?php the_module('image', array('image' => $prepare_icon)) ?>
  <?php the_module('image', array('image' => $prepare_image)) ?>
  <h3><?= $prepare_subtitle ?></h3>
  <h4><?= $prepare_blurb ?></h4>
  <h3><?= $call_center_title ?></h3>
  <?php the_module('image', array('image' => $call_center_icon)) ?>
  <?php the_module('image', array('image' => $call_center_image)) ?>
  <h3><?= $call_center_subtitle ?></h3>
  <h4><?= $call_center_blurb ?></h4>
</section>
