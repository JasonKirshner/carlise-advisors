<?php
$mod_class = setted($mod_class) ? $mod_class : 'pos-center';
$src = setted($src) ? $src : null;
$src_mobile = setted($src_mobile) ? $src_mobile : $src;
$img_fallback = setted($img_fallback) ? $img_fallback : false;
$poster = setted($poster) || $poster == false ? $poster : $img_fallback['url'];
$autoplay = !setted($autoplay) ? $autoplay : true;
$player = setted($use_player) ? "player" : "";
$mod_css = "video $mod_class $player";
?>
<div class="<?= $mod_css; ?>" data-module="video">
  <video class="video__el js-video z2" data-src="<?= $src; ?>" data-src-mobile="<?= $src_mobile; ?>" <?= ($autoplay && !setted($player)) ? " autoplay loop muted playsinline" : ""; ?><?= (!setted($autoplay)) ? " poster=\"$poster\"" : ""; ?>></video>
  <?php
  if ($img_fallback) {
    the_module('image', array(
      'class' => 'video__fallback z1',
      'image' => $img_fallback
    ));
  }
  ?>
</div>
