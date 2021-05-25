<section class="image-copy<?= setted($class) ? " $class" : ""; ?> placeholder" data-module="image-copy">
  <h2 class="module-name">image-copy</h2>
  <?php if ($project_title) : ?>
    <h1><?= $project_title ?></h1>
  <?php endif; ?>
  <?php if ($project_icon) : ?>
    <div class="image-copy__project_icon"> 
      <?php the_module('image', array('image' => $project_icon)) ?>
    </div>
  <?php endif; ?>
  <?php if ($project_image) : ?>
    <div class="image-copy__project">
      <?php the_module('image', array('image' => $project_image)) ?>
    </div>
  <?php endif; ?>
  <?php if ($project_subtitle_1) : ?>
    <h3><?= $project_subtitle_1 ?></h3>
  <?php endif; ?>
  <?php if ($project_blurb_1) : ?>
    <p><?= $project_blurb_1 ?></p>
  <?php endif; ?>
  <?php if ($project_subtitle_2) : ?>
    <h3><?= $project_subtitle_2 ?></h3>
  <?php endif; ?>
  <?php if ($project_blurb_2) : ?>
    <p><?= $project_blurb_2 ?></p>
  <?php endif; ?>
  <?php if ($prepare_title) : ?>
    <h3><?= $prepare_title ?></h3>
  <?php endif; ?>
  <?php if ($prepare_icon) : ?>
    <div class="image-copy__prepare_icon">
      <?php the_module('image', array('image' => $prepare_icon)) ?>
  </div>
  <?php endif; ?>
  <?php if ($prepare_image) : ?>
    <div class="image-copy__prepare">
      <?php the_module('image', array('image' => $prepare_image)) ?>
    </div>
  <?php endif; ?>
  <?php if ($prepare_subtitle) : ?>
    <h3><?= $prepare_subtitle ?></h3>
  <?php endif; ?>
  <?php if ($prepare_blurb) : ?>
    <p><?= $prepare_blurb ?></p>
  <?php endif; ?>
  <?php if ($call_center_title) : ?>
    <h3><?= $call_center_title ?></h3>
  <?php endif; ?>
  <?php if ($call_center_icon) : ?>
    <div class="image-copy__call_center_icon">
      <?php the_module('image', array('image' => $call_center_icon)) ?>
    </div>
  <?php endif; ?>
  <?php if ($call_center_image) : ?>
    <div class="image-copy__call_center">
      <?php the_module('image', array('image' => $call_center_image)) ?>
    </div>
  <?php endif; ?>
  <?php if ($call_center_subtitle) : ?>
    <h3><?= $call_center_subtitle ?></h3>
  <?php endif; ?>
  <?php if ($call_center_blurb) : ?>
    <p><?= $call_center_blurb ?></p>
  <?php endif; ?>
</section>
