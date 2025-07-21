<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

use Joomla\CMS\Table\Table;
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;

defined('_JEXEC') or die;

$item->headline_image = [];
$item->headline_image['headline-image'] = false;
$item->headline_image['headline-image-alt-text'] = false;

$fields = FieldsHelper::getFields('com_content.article', $item, true);
if (!empty($fields[0]->rawvalue)) {
    $item->headline_image['headline-image']     = $fields[0]->rawvalue;
    $item->headline_image['headline-image-alt-text'] = $fields[1]->rawvalue;
}


// OK, so generated article stubs don't explicitly record their progenitor, but the URL field does
// record the generated link to the originating article. Since the URL field isn't used for anything
// else (and is in fact disabled for display to users, it's _reasonable_ safe to assume that if the
// `url_a` property is not empty, this article is a stub, so lets get the id of that article so we
// can then in turn get the data for that article, and use it to set things like headline images
// for _this_ article if they haven't been locally specified:
$urls = $item->urls;

if (!empty($urls)) {
    $urls = json_decode($urls);

    if (!empty($urls->urla)) {
        preg_match('#npeu.ox.ac.uk/news/(\d+)-.*#', $urls->urla, $matches);

        if (!empty($matches[1])) {
            // Pretty certain this is the ID of the progenitor article, so lets get that data:
            $progenitor_article = Table::getInstance("content");
            $progenitor_article->load($matches[1]);

            // Get custom field names by article id:
            $customFieldnames = FieldsHelper::getFields('com_content.article', $matches[1], true);

            $customFieldIds = array_column($customFieldnames, 'id');
            $fieldModel = $app->bootComponent('com_fields')->getMVCFactory()->createModel('Field', 'Administrator', ['ignore_request' => true]);

            //Fetch values for custom field Ids:
            $customFieldValues = $fieldModel->getFieldValues($customFieldIds, $matches[1]);

            // If the headline images URL for this article is empty, and the progenitor has one,
            // use that:
            if (empty($item->headline_image['headline-image']) && !empty($customFieldValues[1])) {
                $item->headline_image['headline-image'] = $customFieldValues[1];

                if (!empty($customFieldValues[2])) {
                    $item->headline_image['headline-image-alt-text'] = $customFieldValues[2];
                }

                /*if (!empty($customFieldValues[3])) {
                    $item->headline_image['headline-image-caption'] = $customFieldValues[3];
                }

                if (!empty($customFieldValues[4])) {
                    $item->headline_image['headline-image-credit-line'] = $customFieldValues[4];
                }*/
            }
        }
    }
}


$i = isset($i) ? $i : 0;

$card_data = [];

$card_data['theme_classes'] = empty($theme) ? 'd-background' : $theme;

//$card_data['full_link']       = $i == 1 ? false : true;
$card_data['link']             = $item->link;
$card_data['link_text']        = 'Read more';
$card_data['full_link']        = true;
$card_data['header_image']     = !empty($item->skip_image) ? false : $item->headline_image['headline-image'];
$card_data['header_image_alt'] = $item->headline_image['headline-image-alt-text'];
$card_data['title']            = $item->title;
$card_data['body']             = $i == 1 ? $item->introtext : '';
$card_data['publish_date']     = $item->publish_up;
$card_data['footer_extra']     = date($date_format, strtotime($item->publish_up));
$card_data['date_format']      = $date_format;
$card_data['state']            = (int) $item->state;
//$card_data['wrapper_classes'] = array('u-fill-height');

include(dirname(dirname(__DIR__)) . '/layouts/partial-card.php');
?>