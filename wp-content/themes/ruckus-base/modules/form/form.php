<?php if (isset($form_id) && !empty($form_id)) : ?>
  <div class="form<?= setted($class) ? " $class" : ""; ?>" data-module="form">
    <div class="form-container<?= $contain ? ' container' : ''; ?>">
      <div class="form-wrapper">
        <?php if (setted($title)) : ?>
          <h2 class="form-title h3"><?= $title; ?></h2>
        <?php endif; ?>
        <?= do_shortcode("[gravityform id=\"$form_id\" title=\"false\" description=\"false\" ajax=\"true\"]"); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
