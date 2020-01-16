<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_users
 * @copyright	Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 * @since		1.5
 */

defined('_JEXEC') or die;

JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');


$doc   = JFactory::getDocument();
$doc->header_cta = array('text' => JText::_('COM_USERS_Edit_Profile'), 'url' => '/user-profile/edit/'.  $this->data->id);
?>
<?php echo TplNPEU6Helper::get_messages(); ?>

<p class="u-text-align--right">
    <a href="/user-profile/edit/<?php echo  $this->data->id; ?>" class="c-cta"><?php echo JText::_('COM_USERS_Edit_Profile'); ?></a>
</p>
<div class="">
<?php echo $this->loadTemplate('core'); ?>

<?php #echo $this->loadTemplate('params'); ?>

<?php echo $this->loadTemplate('custom'); ?>
</div>
<?php if (JFactory::getUser()->id == $this->data->id) : ?>
<p class="text--right">
    <a href="/user-profile-edit/<?php echo  $this->data->id; ?>" class="btn  btn--primary"><?php echo JText::_('COM_USERS_Edit_Profile'); ?></a>
</p>
<?php endif; ?>
</section>