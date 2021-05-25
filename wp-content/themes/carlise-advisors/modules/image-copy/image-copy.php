<section class='image-copy<?= setted($class) ? ' $class' : ''; ?>' data-module='image-copy'>
  <?php if ($project_icon) : ?>
    <div class='image-copy-container'>
      <?php if ($project_icon) : ?>
        <div class='image-copy__project_icon'> 
          <?php the_module('image', array('image' => $project_icon)) ?>
        </div>
      <?php endif; ?>
      <?php if ($project_title) : ?>
        <h2><?= $project_title ?></h2>
      <?php endif; ?>
      <?php if ($project_image) : ?>
        <div class='image-copy__project'>
          <?php the_module('image', array('image' => $project_image)) ?>
        </div>
      <?php endif; ?>
      <div class='project-text'>
        <?php if ($project_subtitle) : ?>
          <h1><?= $project_subtitle ?></h1>
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
      </div>
    </div>
  <?php endif; ?>
  <?php if ($prepare_icon) : ?>
    <div class='image-copy-container'>
      <?php if ($prepare_icon) : ?>
        <div class='image-copy__prepare_icon'>
          <?php the_module('image', array('image' => $prepare_icon)) ?>
        </div>
      <?php endif; ?>
      <?php if ($prepare_title) : ?>
        <h2><?= $prepare_title ?></h2>
      <?php endif; ?>
      <?php if ($prepare_image) : ?>
        <div class='image-copy__prepare'>
          <?php the_module('image', array('image' => $prepare_image)) ?>
        </div>
      <?php endif; ?>
      <div class='prepare-text'>
        <?php if ($prepare_subtitle) : ?>
          <h3><?= $prepare_subtitle ?></h3>
        <?php endif; ?>
        <?php if ($prepare_blurb) : ?>
          <p><?= $prepare_blurb ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
  <?php if ($call_center_icon) : ?>
    <div class='image-copy-container call-center'>
      <?php if ($call_center_icon) : ?>
        <div class='image-copy__call_center_icon'>
          <?php the_module('image', array('image' => $call_center_icon)) ?>
        </div>
      <?php endif; ?>
      <?php if ($call_center_title) : ?>
        <h2><?= $call_center_title ?></h2>
      <?php endif; ?>
      <?php if ($call_center_image) : ?>
        <div class='image-copy__call_center'>
          <?php the_module('image', array('image' => $call_center_image)) ?>
        </div>
      <?php endif; ?>
      <div class='call-center-text'>
        <?php if ($call_center_subtitle) : ?>
          <h3><?= $call_center_subtitle ?></h3>
        <?php endif; ?>
        <?php if ($call_center_blurb) : ?>
          <p><?= $call_center_blurb ?></p>
        <?php endif; ?>
      </div>
    </div>
  <?php endif; ?>
</section>
