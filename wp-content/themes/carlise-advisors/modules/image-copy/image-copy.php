<section class='image-copy<?= setted($class) ? ' $class' : ''; ?>' data-module='image-copy'>
  <?php if ($project_icon) : ?>
    <div class='image-copy-container'>
      <div class='image-copy__project_icon'> 
        <?php the_module('image', array('image' => $project_icon)) ?>
      </div>
      <h2><?= $project_title ?></h2>
      <div class='image-copy__project'>
        <?php the_module('image', array('image' => $project_image)) ?>
      </div>
      <div class='project-text'>
        <h1><?= $project_subtitle ?></h1>
        <h3><?= $project_subtitle_1 ?></h3>
        <p><?= $project_blurb_1 ?></p>
        <h3><?= $project_subtitle_2 ?></h3>
        <p><?= $project_blurb_2 ?></p>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($prepare_icon) : ?>
    <div class='image-copy-container'>
      <div class='image-copy__prepare_icon'>
        <?php the_module('image', array('image' => $prepare_icon)) ?>
      </div>
      <h2><?= $prepare_title ?></h2>
      <div class='image-copy__prepare'>
        <?php the_module('image', array('image' => $prepare_image)) ?>
      </div>
      <div class='prepare-text'>
        <h3><?= $prepare_subtitle ?></h3>
        <p><?= $prepare_blurb ?></p>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($call_center_icon) : ?>
    <div class='image-copy-container call-center'>
      <div class='image-copy__call_center_icon'>
        <?php the_module('image', array('image' => $call_center_icon)) ?>
      </div>
      <h2><?= $call_center_title ?></h2>
      <div class='image-copy__call_center'>
        <?php the_module('image', array('image' => $call_center_image)) ?>
      </div>
      <div class='call-center-text'>
        <h3><?= $call_center_subtitle ?></h3>
        <p><?= $call_center_blurb ?></p>
      </div>
    </div>
  <?php endif; ?>
</section>
