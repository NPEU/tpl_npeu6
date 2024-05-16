<?php

/**
 * @package     Joomla.Site
 * @subpackage  Templates.NPEU6
 *
 * @copyright   Copyright (C) NPEU 2024.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Utilities\ArrayHelper;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$module  = $displayData['module'];
$params  = $displayData['params'];
$attribs = $displayData['attribs'];

/*
if ($module->content === null || $module->content === '') {
    return;
}

$moduleTag              = $params->get('module_tag', 'div');
$moduleAttribs          = [];
$moduleAttribs['class'] = $module->position . ' card ' . htmlspecialchars($params->get('moduleclass_sfx', ''), ENT_QUOTES, 'UTF-8');
$headerTag              = htmlspecialchars($params->get('header_tag', 'h3'), ENT_QUOTES, 'UTF-8');
$headerClass            = htmlspecialchars($params->get('header_class', ''), ENT_QUOTES, 'UTF-8');
$headerAttribs          = [];
$headerAttribs['class'] = $headerClass;

// Only output a header class if it is not card-title
if ($headerClass !== 'card-title') :
    $headerAttribs['class'] = 'card-header ' . $headerClass;
endif;

// Only add aria if the moduleTag is not a div
if ($moduleTag !== 'div') {
    if ($module->showtitle) :
        $moduleAttribs['aria-labelledby'] = 'mod-' . $module->id;
        $headerAttribs['id']              = 'mod-' . $module->id;
    else :
        $moduleAttribs['aria-label'] = $module->title;
    endif;
}

$header = '<' . $headerTag . ' ' . ArrayHelper::toString($headerAttribs) . '>' . $module->title . '</' . $headerTag . '>';
?>
<<?php echo $moduleTag; ?> <?php echo ArrayHelper::toString($moduleAttribs); ?>>
    <?php if ($module->showtitle && $headerClass !== 'card-title') : ?>
        <?php echo $header; ?>
    <?php endif; ?>
    <div class="card-body">
        <?php if ($module->showtitle && $headerClass === 'card-title') : ?>
            <?php echo $header; ?>
        <?php endif; ?>
        <?php echo $module->content; ?>
    </div>
</<?php echo $moduleTag; ?>>
*/

$app = Factory::getApplication();
$template = $app->getTemplate(true);


#echo  '<pre>'; var_dump($template); echo '</pre>';



if (!empty($module->content)): ?>
<div class="u-space--below  l-box  l-box--space--block-end  modstyle_blockspace-below">
    <?php echo $module->content; ?>
</div>
<?php endif; ?>