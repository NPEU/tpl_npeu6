<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.6
 */

defined('_JEXEC') or die;

?>

<section class="profile-set  atoll  atoll--npeu  one-whole">
	<h2>
		<?php echo JText::_('COM_USERS_PROFILE_CORE_LEGEND'); ?>
	</h2>
	<dl class="gw2"><!--
		--><dt class="g2  one-quarter">
			<?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_NAME_LABEL')); ?>
		</dt><!--
		--><dd class="g2  three-quarters">
			<?php echo $this->data->name; ?>
		</dd><!--
		--><dt class="g2  one-quarter">
			<?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_USERNAME_LABEL')); ?>
		</dt><!--
		--><dd class="g2  three-quarters">
			<?php echo htmlspecialchars($this->data->username); ?>
		</dd><!--
		--><dt class="g2  one-quarter">
			<?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_REGISTERED_DATE_LABEL')); ?>
		</dt><!--
		--><dd class="g2  three-quarters">
			<?php echo JHtml::_('date', $this->data->registerDate); ?>
		</dd><!--
		--><dt class="g2  one-quarter">
			<?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_LAST_VISITED_DATE_LABEL')); ?>
		</dt><!--
		<?php if ($this->data->lastvisitDate != '0000-00-00 00:00:00'): ?>
		--><dd class="g2  three-quarters">
			<?php echo JHtml::_('date', $this->data->lastvisitDate); ?>
		</dd><!--
		<?php else: ?>
		--><dd class="g2  three-quarters">
			<?php echo preg_replace('#<br>.*#', '', JText::_('COM_USERS_PROFILE_NEVER_VISITED')); ?>
		</dd><!--
		<?php endif; ?>
	--></dl>
</section>
