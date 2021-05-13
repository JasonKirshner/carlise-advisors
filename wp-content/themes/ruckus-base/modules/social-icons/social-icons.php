<?php
$socials = setted($socials) ? $socials : null;
?>

<?php if ($socials) : ?>
  <section class="social-icons<?= setted($class) ? " $class" : ""; ?>" data-module="social-icons">
    <?php foreach ($socials as $social) :
      $symbol = $social['social_media'];
      $link = $social['social_media_link']; ?>
      <a href="<?= $link; ?>" target="_blank" class="social-icons__social">
        <?= get_svg($symbol, 'social-icons__svg'); ?>
      </a>
    <?php endforeach; ?>
  </section>
<?php endif; ?>
