<section class='image-copy section-padding <?= $background ?>' data-module='image-copy'>
  <container class='container image-copy-container'>
    <img src=<?= get_image_data($icon)[0] ?> alt="<?= get_image_data($icon)[1]; ?>">
    <div class="module-name h2"><?= $title ?></div>
    <div class='image-copy-sub-container <?= $direction ?>'>
      <div class='image-copy__image'>
        <?php the_module('image', array('image' => $image)); ?>
      </div>
      <?php the_module('wysiwyg', array('content' => $wysiwyg)); ?>
    </div>
  </container>
</section>