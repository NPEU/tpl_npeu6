<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;








function get_menu_item()
{
	$app = JFactory::getApplication();
	return $app->getMenu()->getActive();
}