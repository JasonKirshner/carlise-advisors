<section class='image-copy section-padding <?= $background ?>' data-module='image-copy'>
  <container class='container image-copy-container'>
    <div class="image-copy-icon">
      <?php
      if (setted($icon)) :
        the_module('image', array('class' => 'image--relative', 'image' => $icon));
      endif;
      ?>
    </div>
    <div class="module-name h2"><?= $title ?></div>
    <div class='image-copy-sub-container <?= $direction ?>'>
      <div class='image-copy__image'>
        <?php the_module('image', array('class' => 'image--relative', 'image' => $image)); ?>
      </div>
      <?php the_module('wysiwyg', array('content' => $wysiwyg)); ?>
    </div>
  </container>
</section>