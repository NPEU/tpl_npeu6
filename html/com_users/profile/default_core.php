<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

?>

<h2>
    <?php echo Text::_('COM_USERS_PROFILE_CORE_LEGEND'); ?>
</h2>
<div class="l-layout  l-row  l-gutter  l-flush-edge-gutter  u-space--below ">
    <dl class="l-layout__inner  user-profile">
        <dt class="ff-width-100--25--25  l-box">
            <?php echo preg_replace('#<br>.*#', '', Text::_('COM_USERS_PROFILE_NAME_LABEL')); ?>
        </dt>
        <dd class="ff-width-100--25--75  l-box">
            <?php echo $this->data->name; ?>
        </dd>
        <dt class="ff-width-100--25--25  l-box">
            <?php echo preg_replace('#<br>.*#', '', Text::_('COM_USERS_PROFILE_USERNAME_LABEL')); ?>
        </dt>
        <dd class="ff-width-100--25--75  l-box">
            <?php echo htmlspecialchars($this->data->username); ?>
        </dd>
        <dt class="ff-width-100--25--25  l-box">
            <?php echo preg_replace('#<br>.*#', '', Text::_('COM_USERS_PROFILE_REGISTERED_DATE_LABEL')); ?>
        </dt>
        <dd class="ff-width-100--25--75  l-box">
            <?php echo HTMLHelper::_('date', $this->data->registerDate); ?>
        </dd>
        <dt class="ff-width-100--25--25  l-box">
            <?php echo preg_replace('#<br>.*#', '', Text::_('COM_USERS_PROFILE_LAST_VISITED_DATE_LABEL')); ?>
        </dt>
        <?php if ($this->data->lastvisitDate != '0000-00-00 00:00:00'): ?>
        <dd class="ff-width-100--25--75  l-box">
            <?php echo HTMLHelper::_('date', $this->data->lastvisitDate); ?>
        </dd>
        <?php else: ?>
        <dd class="ff-width-100--25--75  l-box">
            <?php echo preg_replace('#<br>.*#', '', Text::_('COM_USERS_PROFILE_NEVER_VISITED')); ?>
        </dd>
        <?php endif; ?>
    </dl>
</div>