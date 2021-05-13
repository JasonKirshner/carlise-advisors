<?php
if (!isset($_COOKIE["STYXKEY_hidebar"]) && !empty($copy) && !$hide_bar) : ?>
  <div class="notification-bar active" data-module="notification-bar">
    <div class="notification-bar__copy container container--menu wysiwyg wysiwyg--p-small wysiwyg--p-small--regular wysiwyg--no-margin">
      <?= $copy ?>
    </div>
    <div class="notification-bar__close">
      <span class="notification-bar__close-btn"></span>
    </div>
  </div>
<?php endif; ?>
