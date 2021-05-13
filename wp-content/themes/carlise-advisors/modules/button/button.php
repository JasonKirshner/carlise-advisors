<?php
$tag = $use_button_tag ? "button" : "a";
$class = $class ? " $class" : "";

if ($tag == 'a' && empty($link)) return;
?>
<?php if (!empty($value)) : ?>
  <<?= $tag; ?> class="button button--<?= $tag; ?><?= $class; ?>" <?= $link && $tag == 'a' ? "href='$link'" : ''; ?> <?= $target ? "target=\"$target\"" : ''; ?> <?= $data ? $data : ""; ?>>
    <span class="button__value"><?= $value; ?></span>
  </<?= $tag; ?>>
<?php endif; ?>
