<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');

?>

<h2>
    <?php echo JText::_('COM_USERS_PROFILE_CORE_LEGEND'); ?>
</h2>
<div class="l-col-to-row--flush-edge-gutters  u-space--below">
    <dl class="l-col-to-row  user-profile">
        <dt class="ff-width-100--25--25 l-col-to-row__item">
            <?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_NAME_LABEL')); ?>
        </dt>
        <dd class="ff-width-100--25--75 l-col-to-row__item">
            <?php echo $this->data->name; ?>
        </dd>
        <dt class="ff-width-100--25--25 l-col-to-row__item">
            <?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_USERNAME_LABEL')); ?>
        </dt>
        <dd class="ff-width-100--25--75 l-col-to-row__item">
            <?php echo htmlspecialchars($this->data->username); ?>
        </dd>
        <dt class="ff-width-100--25--25 l-col-to-row__item">
            <?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_REGISTERED_DATE_LABEL')); ?>
        </dt>
        <dd class="ff-width-100--25--75 l-col-to-row__item">
            <?php echo JHtml::_('date', $this->data->registerDate); ?>
        </dd>
        <dt class="ff-width-100--25--25 l-col-to-row__item">
            <?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_LAST_VISITED_DATE_LABEL')); ?>
        </dt>
        <?php if ($this->data->lastvisitDate != '0000-00-00 00:00:00'): ?>
        <dd class="ff-width-100--25--75 l-col-to-row__item">
            <?php echo JHtml::_('date', $this->data->lastvisitDate); ?>
        </dd>
        <?php else: ?>
        <dd class="ff-width-100--25--75 l-col-to-row__item">
            <?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_NEVER_VISITED')); ?>
        </dd>
        <?php endif; ?>
    </dl>
</div>