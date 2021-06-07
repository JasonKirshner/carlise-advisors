<section class='image-copy<?= setted($class) ? ' $class' : ''; ?>' data-module='image-copy'>
    <div class="image-copy-container">
      <div class="image-copy__icon">
        <?php the_module('image', array('image' => $icon)); ?>
      </div>
        <h2><?php the_field($title) ?></h2>
      <div class="image-copy-sub-container">
        <div class="image-copy__image">
          <?php the_module('image', array('image' => $image)); ?>
        </div>
        <div>
          <?= $wysiwyg ?>
        </div>
      </div>
    </div>
</section>
