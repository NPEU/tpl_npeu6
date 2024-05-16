<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_social
 *
 * @copyright   Copyright (C) NPEU 2021.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$doc = Factory::getDocument();

$layout_classes = ['l-layout', 'l-row'];


$layout_classes[] = 'l-gutter';
$layout_classes[] = 'l-flush-edge-gutter';
$layout_classes[] = 'l-row--' . $params->get('align', 'start');

/*
if (!empty($params->get('list_layout'))) {
    $layout_classes[] = 'l-' . $params->get('list_layout');
}

if (!empty($params->get('list_gutter'))) {
    $layout_classes[] = 'l-gutter--' . $params->get('list_gutter');
}

if (!empty($params->get('flush_gutter'))) {
    $layout_classes[] = 'l-flush-edge-gutter';
}

if (!empty($params->get('list_basis'))) {
    $layout_classes[] = 'l-basis--' . $params->get('list_basis');
}
*/
?>
<div class="<?php echo implode("  ", $layout_classes); ?>  mod_social" data-fs-text="center">
    <p class="l-layout__inner">

        <?php if ($show_twitter) : ?>
        <span class="l-box">
            <a class="c-badge  c-badge--limit-height--6  twitter" href="https://twitter.com/<?php echo $params->get('twitter'); ?>" rel="external noopener noreferrer" target="_blank"><img alt="Twitter" width="60" height="60" onerror="this.src='/assets/images/brand-logos/social/twitter.png'; this.onerror=null;" src="/assets/images/brand-logos/social/twitter.svg"></a>
        </span>
        <?php endif; ?>
        <?php if ($show_youtube) : ?>
        <span class="l-box">
            <a class="c-badge c-badge--limit-height--6 youtube" href="https://www.youtube.com/user/<?php echo $params->get('youtube'); ?>" rel="external noopener noreferrer" target="_blank"><img alt="YouTube" width="60" height="60" onerror="this.src='/assets/images/brand-logos/social/youtube.png'; this.onerror=null;" src="/assets/images/brand-logos/social/youtube.svg"></a>
        </span>
        <?php endif; ?>

    </p>
</div>