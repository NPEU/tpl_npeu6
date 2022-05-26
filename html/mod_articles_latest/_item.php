<?php
if (!empty($_SERVER['JTV2'])) {
    include(str_replace('.php', '.v2.php', __FILE__));
    return;
}
?><?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_latest
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
/* <pre><?php var_dump($item); ?></pre> */


// OK, so generated article stubs don't explicitly record their progenitor, but the URL field does
// record the generated link to the originating article. Since the URL field isn't used for anything
// else (and is in fact disabled for display to users, it's _reasonable_ safe to assume that if the
// `url_a` property is not empty, this article is a stub, so lets get the id of that article so we
// can then in turn get the data for that article, and use it to set things like headline images
// for _this_ article if they haven't been locally specified:
$urls = $item->urls;
$progenitor_headline_image = [];
if (!empty($urls)) {
    $urls = json_decode($urls);

    if (!empty($urls->urla)) {
        preg_match('#npeu.ox.ac.uk/news/(\d+)-.*#', $urls->urla, $matches);

        if (!empty($matches[1])) {
            // Pretty certain this is the ID of the progenitor article, so lets get that data:
            $progenitor_article = JTable::getInstance("content");
            $progenitor_article->load($matches[1]);

            JLoader::register('FieldsHelper', JPATH_ADMINISTRATOR . '/components/com_fields/helpers/fields.php'); //load fields helper
            $customFieldnames = FieldsHelper::getFields('com_content.article', $matches[1], true); // get custom field names by article id
            $customFieldIds = array_column($customFieldnames, 'id');
            $model = JModelLegacy::getInstance('Field', 'FieldsModel', array('ignore_request' => true)); //load fields model
            $customFieldValues = $model->getFieldValues($customFieldIds, $matches[1]); //Fetch values for custom field Ids

            // If the headline images URL for this article is empty, and the progenitor has one,
            // use that:
            if (empty($item->headline_image['headline-image']) && !empty($customFieldValues[1])) {
                $progenitor_headline_image['headline-image'] = $customFieldValues[1];

                if (!empty($customFieldValues[2])) {
                    $progenitor_headline_image['headline-image-alt-text'] = $customFieldValues[2];
                } else {
                    $progenitor_headline_image['headline-image-alt-text'] = false;
                }


                if (!empty($customFieldValues[3])) {
                    $progenitor_headline_image['headline-image-caption'] = $customFieldValues[3];
                } else {
                    $progenitor_headline_image['headline-image-caption'] = false;
                }

                if (!empty($customFieldValues[4])) {
                    $progenitor_headline_image['headline-image-credit-line'] = $customFieldValues[4];
                } else {
                    $progenitor_headline_image['headline-image-credit-line'] = false;
                }
            }
        }
    }
}



$fields = FieldsHelper::getFields('com_content.article', $item, true);
$image = false;
$image_alt = false;
if (empty($item->skip_image)) {
    $image     = $fields[0]->rawvalue;
    $image_alt = $fields[1]->rawvalue;
    
    if (empty($image) && !empty($progenitor_headline_image)) {
        $image     = $progenitor_headline_image['headline-image'];
        $image_alt = $progenitor_headline_image['headline-image-alt-text'];
    }
}

$i = isset($i) ? $i : 0;

$card_data = array();

$card_data['theme']           = $theme;
$card_data['full_link']       = $i == 1 ? false : true;
$card_data['link']            = $item->link;
$card_data['image']           = $image;
$card_data['image_alt']       = $image_alt;
$card_data['title']           = $item->title;
$card_data['body']            = $i == 1 ? $item->introtext : '';
$card_data['publish_date']    = $item->publish_up;
$card_data['date_format']     = $date_format;
$card_data['state']           = (int) $item->state;
$card_data['wrapper_classes'] = array('u-fill-height');

include(dirname(dirname(__DIR__)) . '/layouts/partial-card.php');
?>