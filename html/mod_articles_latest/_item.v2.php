<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
/* <pre><?php var_dump($item); ?></pre> */
$fields = FieldsHelper::getFields('com_content.article', $item, true);

$i = isset($i) ? $i : 0;

$card_data = array();

$card_data['theme_classes'] = empty($theme) ? 'd-background' : $theme;

//$card_data['full_link']       = $i == 1 ? false : true;
$card_data['link']             = $item->link;
$card_data['link_text']        = 'Read more';
$card_data['full_link']        = true;
$card_data['header_image']     = !empty($item->skip_image) ? false : $fields[0]->rawvalue;
$card_data['header_image_alt'] = $fields[1]->rawvalue;
$card_data['title']            = $item->title;
$card_data['body']             = $i == 1 ? $item->introtext : '';
$card_data['publish_date']     = $item->publish_up;
$card_data['footer_extra']     = date($date_format, strtotime($item->publish_up));
$card_data['date_format']      = $date_format;
$card_data['state']            = (int) $item->state;
//$card_data['wrapper_classes'] = array('u-fill-height');

include(dirname(dirname(__DIR__)) . '/layouts/partial-card.php');
?>