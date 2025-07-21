<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Associations as LanguageAssociations;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Table\Table;
use Joomla\Component\Fields\Administrator\Helper\FieldsHelper;

require_once dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';

use \Michelf\Markdown;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$app   = Factory::getApplication();

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = Factory::getUser();
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (LanguageAssociations::isEnabled() && $params->get('show_associations'));

// Get the custom fields for the article:
$fields = $this->item->jcfields;
#echo '<pre>'; var_dump($this->item->id); echo '</pre>'; exit;
#echo '<pre>'; var_dump($fields); echo '</pre>'; exit;
$headline_image = [];
$tweak_markdown_options = ['trim_paragraph' => true, 'add_link_spans' => true];

foreach ($fields as $field) {
    switch ($field->name) {
        case 'headline-image':
            $headline_image['headline-image'] = $field->rawvalue;
            break;
        case 'headline-image-alt-text':
            $headline_image['headline-image-alt-text']
                = !empty($field->rawvalue)
                ? TplNPEU6Helper::tweak_markdown_output(
                        Markdown::defaultTransform($field->rawvalue),
                        $tweak_markdown_options
                    )
                : '';
            break;
        case 'headline-image-caption':
            $headline_image['headline-image-caption']
                = !empty($field->rawvalue)
                ? TplNPEU6Helper::tweak_markdown_output(
                        Markdown::defaultTransform($field->rawvalue),
                        $tweak_markdown_options
                    )
                : '';
            break;
        /*case 'headline-image-credit-line':
            $headline_image['headline-image-credit-line']
                = !empty($field->rawvalue)
                ? TplNPEU6Helper::tweak_markdown_output(
                        Markdown::defaultTransform($field->rawvalue),
                        $tweak_markdown_options
                    )
                : '';
            break;*/
    }
}

// Check for embedded credit info:
$headline_image['headline-image-credit-line'] = '';
$image_meta = [];

$image_meta_response = json_decode(file_get_contents(
    'https://' . $_SERVER['HTTP_HOST'] . '/plugins/system/imagemeta/ajax/image-meta.php?image=' . base64_encode($headline_image['headline-image'])
), true);

if (isset($image_meta_response['success']) && isset($image_meta_response['data'])) {
    $image_meta = $image_meta_response['data'];
}

if (isset($image_meta['copyright'])) {
    $headline_image['headline-image-credit-line'] = trim(TplNPEU6Helper::tweak_markdown_output(
        Markdown::defaultTransform($image_meta['copyright']),
        $tweak_markdown_options
    ));
}
$this->item->headline_image = $headline_image;

// If it's a news item:
if ($this->item->catid == 63) {
    $twitter_url  = 'https://twitter.com/intent/tweet';
    #$twitter_url .= '?text='. $this->escape($this->item->title . ' https://www.npeu.ox.ac.uk/' . trim($this->item->readmore_link, '/'));
    $twitter_url .= '?text='. $this->escape($this->item->title);
    $twitter_url .= '&url=' . 'https://www.npeu.ox.ac.uk/' . trim($this->item->readmore_link, '/');
    $twitter_url .= '&via=NPEU_Oxford';

    //$twitter  = '<p class="c-utilitext">';
    ////$twitter .= '    <a href="' . $twitter_url  . '" class="c-cta  twitter-share-button" data-size="large"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-twitter"></use></svg> <span>Tweet</span></a>';
    //$twitter .= '    <a href="' . $twitter_url  . '" class="c-cta" target="_blank"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-twitter--inverted"></use></svg> <span>Tweet</span></a>';
    //$twitter .= '</p>';

    $this->item->twitter_url = $twitter_url;

    //if (!empty($this->item->fulltext)) {
    //    $this->item->fulltext .= $twitter;
    //} else {
    //    $this->item->introtext .= $twitter;
    //}
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
            if (empty($this->item->headline_image['headline-image']) && !empty($customFieldValues[1])) {
                $this->item->headline_image['headline-image'] = $customFieldValues[1];

                if (!empty($customFieldValues[2])) {
                    $this->item->headline_image['headline-image-alt-text'] = $customFieldValues[2];
                }

                if (!empty($customFieldValues[3])) {
                    $this->item->headline_image['headline-image-caption'] = $customFieldValues[3];
                }

                if (!empty($customFieldValues[4])) {
                    $this->item->headline_image['headline-image-credit-line'] = $customFieldValues[4];
                }
            }
        }
    }
}

$doc        = Factory::getDocument();
$doc->article = $this->item;

?>