<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

$msgList = $displayData['msgList'];

?>

<?php if (is_array($msgList) && !empty($msgList)) : ?>
<div id="system-messages">
    <?php foreach ($msgList as $type => $msgs) : ?>
    <div class="c-system-message  t-<?php echo $type == 'message' ? 'success' : $type; ?>">
        <?php // This requires JS so we should add it trough JS. Progressive enhancement and stuff. ?>
        <?php /*<a class="close" data-dismiss="alert">×</a>*/?>
        <p><strong><?php echo JText::_($type); ?></strong></p>
        <?php foreach ($msgs as $msg) : ?>
        <p><?php echo $msg; ?></p>
        <?php endforeach; ?>        
    </div>

    <?php endforeach; ?>
</div>
<?php endif; ?>

