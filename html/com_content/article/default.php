<?php
if (!empty($_SERVER['JTV2'])) {
    include(str_replace('.php', '.v2.php', __FILE__));
    return;
}
?><?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

require_once dirname(dirname(dirname(__DIR__))) . '/vendor/autoload.php';

use \Michelf\Markdown;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');

// Create shortcuts to some parameters.
$params  = $this->item->params;
$images  = json_decode($this->item->images);
$urls    = json_decode($this->item->urls);
$canEdit = $params->get('access-edit');
$user    = JFactory::getUser();
$info    = $params->get('info_block_position', 0);

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (JLanguageAssociations::isEnabled() && $params->get('show_associations'));
#JHtml::_('behavior.caption');

// Get the custom fields for the article:
$fields = $this->item->jcfields;
#echo '<pre>'; var_dump($fields); echo '</pre>'; exit;
$headline_image = array();
$tweak_markdown_options = array('trim_paragraph' => true, 'add_link_spans' => true);

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
$image_meta = array();

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
if ($this->item->catid == 63) {#
    $twitter_url  = 'https://twitter.com/intent/tweet';
    #$twitter_url .= '?text='. $this->escape($this->item->title . ' https://www.npeu.ox.ac.uk/' . trim($this->item->readmore_link, '/'));
    $twitter_url .= '?text='. $this->escape($this->item->title);
    $twitter_url .= '&url=' . 'https://www.npeu.ox.ac.uk/' . trim($this->item->readmore_link, '/');
    $twitter_url .= '&via=NPEU_Oxford';

    $twitter  = '<p class="c-utilitext">';
    $twitter .= '    <a href="' . $twitter_url  . '" class="twitter-share-button"><svg display="none" focusable="false" class="icon  u-space--left--xs" aria-hidden="true"><use xlink:href="#icon-twitter"></use></svg> <span>Tweet</span></a>';
    $twitter .= '</p>';

    if (!empty($this->item->fulltext)) {
        $this->item->fulltext .= $twitter;
    } else {
        $this->item->introtext .= $twitter;
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



$doc        = JFactory::getDocument();
$doc->article = $this->item;

return;
?>





<div class="item-page<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Article">
    <meta itemprop="inLanguage" content="<?php echo ($this->item->language === '*') ? JFactory::getConfig()->get('language') : $this->item->language; ?>" />
    <?php if ($this->params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
    </div>
    <?php endif;
    if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && $this->item->paginationrelative)
    {
        echo $this->item->pagination;
    }
    ?>

    <?php // Todo Not that elegant would be nice to group the params ?>
    <?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
    || $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

    <?php if (!$useDefList && $this->print) : ?>
        <div id="pop-print" class="btn hidden-print">
            <?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
        </div>
        <div class="clearfix"> </div>
    <?php endif; ?>
    <?php if ($params->get('show_title') || $params->get('show_author')) : ?>
    <div class="page-header">
        <?php if ($params->get('show_title')) : ?>
            <h2 itemprop="headline">
                <?php echo $this->escape($this->item->title); ?>
            </h2>
        <?php endif; ?>
        <?php if ($this->item->state == 0) : ?>
            <span class="label label-warning"><?php echo JText::_('JUNPUBLISHED'); ?></span>
        <?php endif; ?>
        <?php if (strtotime($this->item->publish_up) > strtotime(JFactory::getDate())) : ?>
            <span class="label label-warning"><?php echo JText::_('JNOTPUBLISHEDYET'); ?></span>
        <?php endif; ?>
        <?php if ((strtotime($this->item->publish_down) < strtotime(JFactory::getDate())) && $this->item->publish_down != JFactory::getDbo()->getNullDate()) : ?>
            <span class="label label-warning"><?php echo JText::_('JEXPIRED'); ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php if (!$this->print) : ?>
        <?php if ($canEdit || $params->get('show_print_icon') || $params->get('show_email_icon')) : ?>
            <?php echo JLayoutHelper::render('joomla.content.icons', array('params' => $params, 'item' => $this->item, 'print' => false)); ?>
        <?php endif; ?>
    <?php else : ?>
        <?php if ($useDefList) : ?>
            <div id="pop-print" class="btn hidden-print">
                <?php echo JHtml::_('icon.print_screen', $this->item, $params); ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php // Content is generated by content plugin event "onContentAfterTitle" ?>
    <?php echo $this->item->event->afterDisplayTitle; ?>

    <?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
        <?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
        <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'above')); ?>
    <?php endif; ?>

    <?php if ($info == 0 && $params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
        <?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>

        <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
    <?php endif; ?>

    <?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
    <?php echo $this->item->event->beforeDisplayContent; ?>

    <?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '0')) || ($params->get('urls_position') == '0' && empty($urls->urls_position)))
        || (empty($urls->urls_position) && (!$params->get('urls_position')))) : ?>
    <?php echo $this->loadTemplate('links'); ?>
    <?php endif; ?>
    <?php if ($params->get('access-view')) : ?>
    <?php echo JLayoutHelper::render('joomla.content.full_image', $this->item); ?>
    <?php
    if (!empty($this->item->pagination) && $this->item->pagination && !$this->item->paginationposition && !$this->item->paginationrelative) :
        echo $this->item->pagination;
    endif;
    ?>
    <?php if (isset ($this->item->toc)) :
        echo $this->item->toc;
    endif; ?>
    <div itemprop="articleBody">
        <?php echo $this->item->text; ?>
    </div>

    <?php if ($info == 1 || $info == 2) : ?>
        <?php if ($useDefList) : ?>
                <?php // Todo: for Joomla4 joomla.content.info_block.block can be changed to joomla.content.info_block ?>
            <?php echo JLayoutHelper::render('joomla.content.info_block.block', array('item' => $this->item, 'params' => $params, 'position' => 'below')); ?>
        <?php endif; ?>
        <?php if ($params->get('show_tags', 1) && !empty($this->item->tags->itemTags)) : ?>
            <?php $this->item->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
            <?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php
    if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && !$this->item->paginationrelative) :
        echo $this->item->pagination;
    ?>
    <?php endif; ?>
    <?php if (isset($urls) && ((!empty($urls->urls_position) && ($urls->urls_position == '1')) || ($params->get('urls_position') == '1'))) : ?>
    <?php echo $this->loadTemplate('links'); ?>
    <?php endif; ?>
    <?php // Optional teaser intro text for guests ?>
    <?php elseif ($params->get('show_noauth') == true && $user->get('guest')) : ?>
    <?php echo JLayoutHelper::render('joomla.content.intro_image', $this->item); ?>
    <?php echo JHtml::_('content.prepare', $this->item->introtext); ?>
    <?php // Optional link to let them register to see the whole article. ?>
    <?php if ($params->get('show_readmore') && $this->item->fulltext != null) : ?>
    <?php $menu = JFactory::getApplication()->getMenu(); ?>
    <?php $active = $menu->getActive(); ?>
    <?php $itemId = $active->id; ?>
    <?php $link = new JUri(JRoute::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false)); ?>
    <?php $link->setVar('return', base64_encode(ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language))); ?>
    <p class="readmore">
        <a href="<?php echo $link; ?>" class="register">
        <?php $attribs = json_decode($this->item->attribs); ?>
        <?php
        if ($attribs->alternative_readmore == null) :
            echo JText::_('COM_CONTENT_REGISTER_TO_READ_MORE');
        elseif ($readmore = $attribs->alternative_readmore) :
            echo $readmore;
            if ($params->get('show_readmore_title', 0) != 0) :
                echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
            endif;
        elseif ($params->get('show_readmore_title', 0) == 0) :
            echo JText::sprintf('COM_CONTENT_READ_MORE_TITLE');
        else :
            echo JText::_('COM_CONTENT_READ_MORE');
            echo JHtml::_('string.truncate', $this->item->title, $params->get('readmore_limit'));
        endif; ?>
        </a>
    </p>
    <?php endif; ?>
    <?php endif; ?>
    <?php
    if (!empty($this->item->pagination) && $this->item->pagination && $this->item->paginationposition && $this->item->paginationrelative) :
        echo $this->item->pagination;
    ?>
    <?php endif; ?>
    <?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
    <?php echo $this->item->event->afterDisplayContent; ?>
</div>
