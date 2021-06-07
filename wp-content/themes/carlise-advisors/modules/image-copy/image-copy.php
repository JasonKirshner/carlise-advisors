<section class='image-copy<?= setted($class) ? ' $class' : ''; ?>' data-module='image-copy'>
    <div class='image-copy-container'>
      <div class='image-copy__icon'>
        <?php the_module('image', array('image' => $icon)); ?>
      </div>
        <h2><?= $title ?></h2>
      <div class='image-copy-sub-container'>
        <div class='image-copy__image'>
          <?php the_module('image', array('image' => $image)); ?>
        </div>
        <div class='wysiwyg'>
          <?= $wysiwyg ?>
        </div>
      </div>
    </div>
</section>
