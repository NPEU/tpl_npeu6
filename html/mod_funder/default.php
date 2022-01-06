<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_funder
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

require_once dirname(dirname(dirname(dirname(__DIR__)))) . '/administrator/components/com_brands/vendor/autoload.php';

use SVG\SVG;

$db = JFactory::getDBO();

$query = $db->getQuery(true);
$query->select('*');
$query->from('#__brands');
$query->where('id = ' . $params->get('brand_id'));
$db->setQuery($query);
$brand = $db->loadObject();

JLoader::register('TplNPEU6Helper', dirname(dirname(__DIR__)) . '/helper.php');
$page_brand = TplNPEU6Helper::get_brand();
$theme = 't-' . $page_brand->alias;

// This would probably be best done at the Brand component level, but that is more work.
// The NEXT time I find I need to use this, I should add a column to the BRand table via SQL update
// and add the already-extracted title to the data before saving in the controller.
$logo_image = @SVG::fromString($brand->logo_svg);
$logo_svg_doc = $logo_image->getDocument();
$logo_title = $logo_svg_doc->getElementsByTagName('title')[0]->getValue();
?>
<div class="u-fill-height  d-bands--bottomX  <?php echo $theme; ?>  mod_funder">
    <div class="u-fill-height  l-layout  l-row">
        <div class="l-layout__inner">
            <?php if (!empty($params->get('image'))): ?>
            <div class="l-box  ff-width-100--40--50">
                <div class="u-image-cover  u-image-cover--min-20  js-image-cover">
                    <div class="u-image-cover__inner">
                        <img class="u-image-cover__image" src="<?php echo $params->get('image'); ?>" width="150" alt="">
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <div class="l-box  ff-width-100--40--50">
                <div class="c-panel  u-fill-height  u-max-measure">

                    <div class="u-text-align--center u-fill-width u-space--below">
                        <div>
                            <a href="<?php echo $params->get('brand_url'); ?>" class="c-badge  c-badge--limit-height  l-center" rel="external noopener noreferrer" target="_blank">
                                <img src="/assets/images/brand-logos/funder/<?php echo $brand->alias; ?>-logo.svg" onerror="this.src='/assets/images/brand-logos/affiliate/<?php echo $brand->alias; ?>-logo.png'; this.onerror=null;" alt="Logo: <?php echo $logo_title; ?>" height="80">
                            </a>
                        </div>
                    </div>
                    <div class="c-user-content">
                        <?php echo $params->get('statement'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
