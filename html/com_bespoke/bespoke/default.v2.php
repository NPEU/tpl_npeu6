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
?>
<?php foreach ($this->blocks as $name => $block):
$block_classes = '';
if (!empty($block['block_classes'])) {
    $block_classes = $block['block_classes'];
}

?>
<?php if (!empty($block['leftpane'])): ?>
<div class="com-bespoke">
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
        <div class="l-layout  l-row">
            <div class="l-layout__inner">
                <div class="l-box  <?php echo $l_ff_class; ?><?php if (!empty($block['left_pane_classes'])) { echo '  ' . $block['left_pane_classes']; } ?>">
                    <?php echo JHtml::_('content.prepare', '{loadmoduleid ' . $block['leftpane'] . '}'); ?>
                </div>
                
                <div class="l-box  <?php echo $r_ff_class; ?><?php if (!empty($block['right_pane_classes'])) { echo '  ' . $block['right_pane_classes']; } ?>">
                    <?php echo JHtml::_('content.prepare', '{loadmoduleid ' . $block['rightpane'] . '}'); ?>
                </div>
            
            </div>
        </div>
        <?php else: ?>
            <?php echo JHtml::_('content.prepare', '{loadmoduleid ' . $block['leftpane'] . '}'); ?>
        <?php endif; ?>
        
    </div>
</div>
<?php endif; ?>
<?php endforeach; ?>
