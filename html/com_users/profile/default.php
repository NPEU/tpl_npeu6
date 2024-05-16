<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$doc   = Factory::getDocument();
#$doc->header_cta = array('text' => Text::_('COM_USERS_Edit_Profile'), 'url' => '/user-profile/edit/'.  $this->data->id);
$doc->header_cta = array('text' => Text::_('COM_USERS_Edit_Profile'), 'url' => '/user-profile/edit/');
?>
<?php #echo TplNPEU6Helper::get_messages(); ?>

<?php echo $this->loadTemplate('core'); ?>

<?php #echo $this->loadTemplate('params'); ?>

<?php echo $this->loadTemplate('custom'); ?>

<?php if (Factory::getUser()->id == $this->data->id) : ?>

<?php endif; ?>
