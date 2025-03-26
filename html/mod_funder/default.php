<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_funder
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/administrator/components/com_brands/vendor/autoload.php';

use SVG\SVG;

/*
$db = Factory::getDBO();

$query = $db->getQuery(true);
$query->select('*');
$query->from('#__brands');
$query->where('id = ' . $params->get('brand_id'));
$db->setQuery($query);
$brand = $db->loadObject();
*/
$brand = TplNPEU6Helper::get_brand($params->get('brand_id'));

$page_brand = TplNPEU6Helper::get_brand();
$theme = 't-' . $page_brand->alias;

// This would probably be best done at the Brand component level, but that is more work.
// The NEXT time I find I need to use this, I should add a column to the Brand table via SQL update
// and add the already-extracted title to the data before saving in the controller.
$logo_image = @SVG::fromString($brand->logo_svg);
$logo_svg_doc = $logo_image->getDocument();
$logo_title = $logo_svg_doc->getElementsByTagName('title')[0]->getValue();
?>
<div class="mod_funder">
    <div class="l-layout  l-row">
        <div class="l-layout__inner">
            <?php if (!empty($params->get('image'))) : /* this is the old single-image option, but keep untill all have been migrated. */  ?>
            <div class="l-box  ff-width-100--40--50">
                <div class="u-image-cover  u-image-cover--min-20  js-image-cover">
                    <div class="u-image-cover__inner">
                        <img class="u-image-cover__image" src="<?php echo $params->get('image'); ?>" width="150" alt="">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if (!empty($params->get('images'))) :
                $images = [];
                foreach ((array) $params->get('images') as $image) {
                    $images[] = $image->image;
                }
                shuffle($images);
            ?>
            <div class="l-box  ff-width-100--40--50">
                <div class="u-image-cover  u-image-cover--min-20  js-image-cover">
                    <div class="u-image-cover__inner">
                        <img class="u-image-cover__image" src="<?php echo $images[0]; ?>" width="150" alt="">
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="l-box  ff-width-100--40--50">
                <div class="c-panel  u-fill-height  u-max-measure">

                    <p class="u-text-align--center  u-fill-width  u-space--below">
                        <a href="<?php echo $params->get('brand_url'); ?>" class="c-badge  c-badge--limit-height  l-center" rel="external noopener noreferrer" target="_blank">
                            <img src="/assets/images/brand-logos/funder/<?php echo $brand->alias; ?>-logo.svg" onerror="this.src='/assets/images/brand-logos/affiliate/<?php echo $brand->alias; ?>-logo.png'; this.onerror=null;" alt="Logo: <?php echo $logo_title; ?>" height="80" width="<?php echo $brand->svg_width_at_height_80; ?>">
                        </a>
                    </p>
                    <div class="c-user-content">
                        <?php echo $params->get('statement'); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
