<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_image
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

require_once dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use \Michelf\Markdown;

$hx       = $params->get('header_tag', 'h2');
$images   = $params->get('images', array());
$n_images = is_array($images) ? count($images) : 0;
if ($n_images == 0) {
    return;
}

$wrapper = 'div';
$has_details = false;
if (!empty($images->images0->caption) || !empty($images->images0->credit)) {
    $has_details = true;
    $wrapper = 'figure';
}

?>
<?php if ($module->showtitle): ?>
<<?php echo $hx; ?>><?php echo $module->title; ?></<?php echo $hx; ?>>
<?php endif; ?>
<?php if($n_images > 1) : ?>
<!-- @TOTO -->
<?php else: /* @TODO - need to think about credit lines. */?>
<<?php echo $wrapper; ?> class="u-image-cover  u-image-cover--min-40  js-image-cover">
    <div class="u-image-cover__inner">
        <img class="u-image-cover__image" src="<?php echo JURI::base() . $images->images0->image; ?>" width="600" alt="<?php echo $images->images0->alt; ?>">
    </div>
    <?php if ($has_details): ?>
    <figcaption class="c-longform-content  c-user-content  c-panel  c-panel--very-dark" style="
        position: absolute;
        top: 0;
        background: rgba(0,0,0,0.5);
        padding: 0.5em;
    ">
        <details style="
            padding: 0;
            margin: 0;
            border: 0;
        ">
            <summary style="
                padding: 0;
                margin: 0;
                border: 0;
            ">Info</summary>
            <?php if (!empty($images->images0->caption)) : ?>
            <?php echo Markdown::defaultTransform($images->images0->caption); ?>
            <?php endif; ?>
            <?php if (!empty($images->images0->credit)) : ?>
            <?php echo Markdown::defaultTransform($images->images0->credit); ?>
            <?php endif; ?>
        </details>
    </figcaption>
    <?php endif; ?>
</<?php echo $wrapper; ?>>
<?php endif; ?>
