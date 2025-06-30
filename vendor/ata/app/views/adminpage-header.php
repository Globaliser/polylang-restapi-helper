<?php

namespace PolylangRestapiHelper\ATA;

$namespace = explode('\\', __NAMESPACE__);
?>

<div class="wrap <?= sanitize_title($namespace[0]) ?>">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>