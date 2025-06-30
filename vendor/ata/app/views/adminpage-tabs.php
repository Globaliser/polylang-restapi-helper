<?php

namespace PolylangRestapiHelper\ATA;

global $ata;
$tab = current_tab();
?>

<?php if (count($ata->tabs)) : ?>
    <!-- Tab Level 1 -->
    <nav class="nav-tab-wrapper">
        <?php foreach ($ata->tabs as $ata_tab) :
            if (!isset($ata_tab['sub_tabs'])) : ?>
                <a href="?page=<?= $ata_tab['menu_slug']; ?><?php if ($ata_tab['tab_slug']) { ?>&tab=<?= $ata_tab['tab_slug']; ?><?php } ?>" class="nav-tab <?php if ($tab === $ata_tab['tab_slug']) { ?>nav-tab-active<?php } ?>"><?= $ata_tab['title'] ?></a>
            <?php else : ?>
                <a href="?page=<?= $ata_tab['menu_slug'] ?><?php if ($ata_tab['tab_slug']) { ?>&tab=<?= $ata_tab['tab_slug'] ?><?php } ?>" class="nav-tab <?php if ($tab === $ata_tab['tab_slug'] || in_array($tab, $ata_tab['sub_tab_slugs'])) : ?>nav-tab-active<?php endif; ?>"><?= $ata_tab['title'] ?></a>
        <?php endif;
        endforeach; ?>
    </nav>

    <?php foreach ($ata->tabs as $ata_tab) :
        if (($ata_tab['tab_slug'] === $tab || (isset($ata_tab['sub_tab_slugs']) && in_array($tab, $ata_tab['sub_tab_slugs']))) && isset($ata_tab['sub_tabs'])) : ?>
            <!-- Tab Level 2 -->
            <nav class="nav-tab-wrapper">
                <?php foreach ($ata_tab['sub_tabs'] as $sub_tab) : ?>
                    <a href="?page=<?= $ata_tab['menu_slug']; ?><?php if ($sub_tab['tab_slug']) { ?>&tab=<?= $sub_tab['tab_slug']; ?><?php } ?>" class="nav-tab <?php if ($tab === $sub_tab['tab_slug']) : ?>nav-tab-active<?php endif; ?>"><?= $sub_tab['title'] ?></a>
                <?php endforeach; ?>
            </nav>

    <?php
        endif;
    endforeach;
    ?>

    <!-- Tab Content -->
    <div class="globaliser-tab-content">
        <?php include $ata->tab_view; ?>
    </div>
<?php endif; ?>