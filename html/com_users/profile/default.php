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

$doc   = JFactory::getDocument();
$doc->header_cta = array('text' => JText::_('COM_USERS_Edit_Profile'), 'url' => '/user-profile/edit/'.  $this->data->id);
?>
<?php echo TplNPEU6Helper::get_messages(); ?>

<?php echo $this->loadTemplate('core'); ?>

<?php #echo $this->loadTemplate('params'); ?>

<?php echo $this->loadTemplate('custom'); ?>

<?php if (JFactory::getUser()->id == $this->data->id) : ?>

<?php endif; ?>
