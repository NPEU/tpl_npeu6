<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

$msgList = $displayData['msgList'];

?>

<?php if (is_array($msgList) && !empty($msgList)) : ?>
<div id="system-messages">
    <?php foreach ($msgList as $type => $msgs) : ?>
    <?php $dismiss = ($type == 'message' || $type == 'notice') ? ' data-js="close-button"' : ''; ?>
    <fieldset role="presentation" class="c-system-message  d-background--sloped  t-<?php echo $type == 'message' ? 'success' : $type; ?>"<?php echo $dismiss; ?>>
        <?php // This requires JS so we should add it trough JS. Progressive enhancement and stuff. ?>
        <?php /*<a class="close" data-dismiss="alert">×</a>*/?>
        <p><strong><?php echo Text::_($type); ?></strong></p>
        <?php foreach ($msgs as $msg) : ?>
        <p><?php echo $msg; ?></p>
        <?php endforeach; ?>
    </fieldset>

    <?php endforeach; ?>
</div>
<?php endif; ?>

