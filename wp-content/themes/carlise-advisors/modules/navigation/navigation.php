<section class="navigation z9" data-module="navigation">
  <div class="navigation__container z9">
    <div class="header_logo">
      <?php if (is_404()) : ?>
        <a href="<?= home_url(); ?>">
        <?php endif; ?>
        <?php if (setted($header_logo)) :
          the_module('image', array('image' => $header_logo, 'class' => 'image--relative'));
        endif; ?>
        <?php if (is_404()) : ?>
        </a>
      <?php endif; ?>
    </div>
    <?php if (!is_404()) : ?>
      <nav class='links'>
        <?php $field = get_field_object('nav_links', 7);
        while (have_rows('nav_links', 7)) : the_row();
          $value = get_sub_field('section');
          $label = $field['sub_fields'][0]['choices'][$value];
        ?>
          <button class="button-reset link p" value=".<?= $value ?>"><?= $label ?></button>
        <?php endwhile ?>
      </nav>
    <?php endif; ?>
  </div>
</section>
