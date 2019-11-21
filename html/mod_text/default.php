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

<?php echo $module->content; ?>

<?php /*
$hx = $params->get('header_tag') ? $params->get('header_tag') : 'h2';
// This is a bit of a hack but it works well enough for now:
JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');
if ($hx == 'h1') {
    $module->content = '<h1 id="' . TplNPEU6Helper::html_id($module->title) . '">'. $module->title . '</h1>' . $module->content;
}
?>
<div class="c-panel  u-fill-height  u-padding--sides--l">
    <div class="c-longform-content">
        <?php echo $module->content; ?>
        <?php if (!empty($params->get('cta_url')) && !empty($params->get('cta_text'))): ?>
        <p>
            <a href="<?php echo $params->get('cta_url'); ?>" class="cta  cta--has-icon"><?php echo $params->get('cta_text'); ?><svg display="none" class="icon" aria-hidden="true"><use xlink:href="#icon-chevron-right"></use></svg></a>
        </p>
        <?php endif; ?>
    </div>
</div>
*/ ?>