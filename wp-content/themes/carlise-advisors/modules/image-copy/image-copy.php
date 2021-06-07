<section class='image-copy<?= setted($class) ? ' $class' : ''; ?>' data-module='image-copy'>
    <div class='image-copy-container <?= $background ?>'>
      <img src=<?=get_image_data($icon)[0]?> alt="<?= get_image_data($icon)[1]; ?>">
      <h2><?= $title ?></h2>
      <div class='image-copy-sub-container <?= $direction ?>'>
        <div class='image-copy__image'>
          <?php the_module('image', array('image' => $image)); ?>
        </div>
        <div class='wysiwyg'>
          <?= $wysiwyg ?>
        </div>
      </div>
    </div>
</section>
