<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_bespoke
 *
 * @copyright   Copyright (C) NPEU 2018.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');

// May need to sort out containers.
// See Trello note.

$page_brand = TplNPEU6Helper::get_brand();
$theme = 't-' . $page_brand->alias;

?>
<?php foreach ($this->blocks as $name => $block):
$block_theme   = $theme;
$block_classes = '';
if (!empty($block['block_classes'])) {
    $block_classes = $block['block_classes'];
    
    // Check to see if a theme has already been added:
    if (preg_match('#t-[a-z]+#', $block_classes)) {
        $block_theme = '';
    }
}

$block_classes .= '  ' . $block_theme;
?>
<?php if (!empty($block['leftpane'])): ?>
<div class="l-blockrow  c-bespoke">
    <div<?php if ($block_classes) { echo ' class="' . $block_classes . '"'; } ?>>
        <?php if (!empty($block['rightpane'])): ?>
        <?php
            if ($block['panebalance'] == '33--66') {
                $l_balance = '33-333';
                $r_balance = '66-666';    
            } elseif ($block['panebalance'] == '66--33') {
                $l_balance = '66-666';
                $r_balance = '33-333';
            } else {
                $l_balance = '50';
                $r_balance = '50';
            }
            
            $l_ff_class = 'ff-width-100--' . $block['breakpoint'] . '--' . $l_balance;
            $r_ff_class = 'ff-width-100--' . $block['breakpoint'] . '--' . $r_balance;
        ?>
        <div class="l-col-to-row">
            <div class="l-col-to-row__item  <?php echo $l_ff_class; ?><?php if (!empty($block['left_pane_classes'])) { echo '  ' . $block['left_pane_classes']; } ?>">
                <?php echo JHtml::_('content.prepare', '{loadmoduleid ' . $block['leftpane'] . '}'); ?>
            </div>
            
            <div class="l-col-to-row__item  <?php echo $r_ff_class; ?><?php if (!empty($block['right_pane_classes'])) { echo '  ' . $block['right_pane_classes']; } ?>">
                <?php echo JHtml::_('content.prepare', '{loadmoduleid ' . $block['rightpane'] . '}'); ?>
            </div>
            
        </div>
        <?php else: ?>
            <?php echo JHtml::_('content.prepare', '{loadmoduleid ' . $block['leftpane'] . '}'); ?>
        <?php endif; ?>
        
    </div>
</div>
<?php endif; ?>
<?php endforeach; ?>
