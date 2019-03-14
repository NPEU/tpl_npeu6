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
<div id="system-message-container">
    <?php if (is_array($msgList) && !empty($msgList)) : ?>
    <div id="system-message">
        <?php foreach ($msgList as $type => $msgs) : ?>
        <div class="alert alert-<?php echo $type; ?>">
            <?php // This requires JS so we should add it trough JS. Progressive enhancement and stuff. ?>
            <a class="close" data-dismiss="alert">×</a>

            <?php if (!empty($msgs)) : ?>
            <h4 class="alert-heading"><?php echo JText::_($type); ?></h4>
            <div>
                <?php foreach ($msgs as $msg) : ?>
                <div><?php echo $msg; ?></div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
