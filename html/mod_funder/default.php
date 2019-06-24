<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_funder
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

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

?>
<div class="d-bands--bottom  <?php echo $theme; ?>">
    <div class="l-col-to-row-wrap">
        <div class="l-col-to-row">            
            <?php if (!empty($params->get('image'))): ?>
            <div class="l-col-to-row__item  ff-width-100--40--50">
                <div class="u-image-cover  u-image-cover--min-30  js-image-cover">
                    <div class="u-image-cover__inner">
                        <img class="u-image-cover__image" src="<?php echo $params->get('image'); ?>" width="150" alt="">
                    </div>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="l-col-to-row__item  ff-width-100--40--50">
                <div class="c-panel  u-fill-heightX  u-max-measure">
                    
                <div class="u-text-align--center u-fill-width u-space--below">
                        <div>
                            <a href="<?php echo $params->get('brand_url'); ?>" class="c-badge  l-center" rel="external noopener noreferrer" target="_blank">
                                <img src="/img/affiliate-logos/<?php echo $brand->alias; ?>-logo.svg" onerror="this.src='/img/affiliate-logos/<?php echo $brand->alias; ?>-logo.png'; this.onerror=null;" alt="Logo: NIHR - National Institute of Health Research" height="80">
                            </a>
                        </div>
                    </div>	
                    <?php echo $params->get('statement'); ?>
                </div>
            </div>
        </div>
    </div>
</div>
