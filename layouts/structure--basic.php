<?php
if (!empty($_SERVER['JTV2'])) {
    include(str_replace('.php', '.v2.php', __FILE__));
    return;
}
?>
    <div class="sticky-footer-wrap  c-page-wrap">
        <?php echo $page_content; ?>
    </div>