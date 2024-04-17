<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');
$page_brand = TplNPEU6Helper::get_brand();
$theme = 't-' . $page_brand->alias;


// Create a shortcut for params.
$params = $this->item->params;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));

// Maybe need to make this configurable?
$date_format = 'd M Y';

// Get the custom fields for the article:
$fields = FieldsHelper::getFields('com_content.article', $this->item, true);
$headline_image = array();
foreach ($fields as $field) {
    switch ($field->name) {
        case 'headline-image':
            $headline_image['headline-image'] = $field->rawvalue;
            break;
        case 'headline-image-alt-text':
            $headline_image['headline-image-alt-text'] = $field->rawvalue;
            break;
        case 'headline-image-caption':
            $headline_image['headline-image-caption'] = $field->rawvalue;
            break;
        case 'headline-image-credit-line':
            $headline_image['headline-image-credit-line'] = $field->rawvalue;
            break;
    }
}

// OK, so generated article stubs don't explicitly record their progenitor, but the URL field does
// record the generated link to the originating article. Since the URL field isn't used for anything
// else (and is in fact disabled for display to users, it's _reasonable_ safe to assume that if the
// `url_a` property is not empty, this article is a stub, so lets get the id of that article so we
// can then in turn get the data for that article, and use it to set things like headline images
// for _this_ article if they haven't been locally specified:
$urls = $this->item->urls;
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
            if (empty($headline_image['headline-image']) && !empty($customFieldValues[1])) {
                $headline_image['headline-image'] = $customFieldValues[1];

                if (!empty($customFieldValues[2])) {
                    $headline_image['headline-image-alt-text'] = $customFieldValues[2];
                }

                if (!empty($customFieldValues[3])) {
                    $headline_image['headline-image-caption'] = $customFieldValues[3];
                }

                if (!empty($customFieldValues[4])) {
                    $headline_image['headline-image-credit-line'] = $customFieldValues[4];
                }
            }
        }
    }
}



?>

<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
<?php echo $this->item->event->afterDisplayTitle; ?>

<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
<?php echo $this->item->event->beforeDisplayContent; ?>


<?php
/*
$card_data = array();

$card_data['theme']        = $theme;
$card_data['full_link']    = true;
$card_data['link']         = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
$card_data['image']        = $headline_image['headline-image'];
$card_data['image_alt']    = $headline_image['headline-image-alt-text'];
$card_data['title']        = $this->item->title;
$card_data['publish_date'] = $this->item->publish_up;
$card_data['date_format']  = $date_format;
$card_data['state']        = (int) $this->item->state;


$wrapper_classes = ['l-box'];

include(dirname(dirname(dirname(__DIR__))) . '/layouts/partial-card.php');

*/

#$fields = FieldsHelper::getFields('com_content.article', $item, true);

    $i = isset($i) ? $i : 0;

    $card_data = array();

    $card_data['theme_classes']    = 'd-border'; //empty($theme) ? 'd-background' : $theme;

    //$card_data['full_link']       = $i == 1 ? false : true;
    $card_data['full_link']        = true;
    $card_data['link']             = JRoute::_(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
    $card_data['link_text']        = 'View this project';
    $card_data['header_image']     = $headline_image['headline-image'];
    $card_data['header_image_alt'] = $headline_image['headline-image-alt-text'];
    $card_data['title']            = $this->item->title;
    //$card_data['body']             = $i == 1 ? $item->introtext : '';
    //$card_data['publish_date']     = $this->item->publish_up;
    //$card_data['footer_extra']     = date($date_format, strtotime($this->item->publish_up));
    //$card_data['date_format']      = $date_format;
    $card_data['state']            = (int) $this->item->state;
    //$card_data['wrapper_classes'] = array('u-fill-height');

    include(dirname(dirname(dirname(__DIR__))) . '/layouts/partial-card.php');

?>

<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
<?php echo $this->item->event->afterDisplayContent; ?>