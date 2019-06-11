<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_text
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

?>
<div class="c-panel  u-fill-height  u-padding--sides--l">
    <div class="c-longform-content">
        <?php echo $module->content; ?>
        <?php if (!empty($params->get('cta_text')) && !empty($params->get('cta_text'))): ?>
        <p>
            <a href="<?php echo $params->get('cta_text'); ?>" class="cta  cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
        </p>
        <?php endif; ?>
    </div>
</div>