<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2020 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use oomla\CMS\Layout\LayoutHelper;

$app  = Factory::getApplication();

#use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$lang = Factory::getLanguage();
$lang->load( 'com_content', JPATH_ADMINISTRATOR );

$doc = Factory::getDocument();
$doc->include_script = true;
$doc->_script['text/javascript'] = '';
#echo '<pre>'; var_dump($doc); echo '</pre>'; exit;


$this->form->setFieldAttribute('title', 'class', false);
$this->form->setFieldAttribute('title', 'hint', false);

$this->form->setFieldAttribute('articletext', 'label', Text::_('COM_CONTENT_FIELD_ARTICLETEXT_LABEL'));
$this->form->setFieldAttribute('articletext', 'class', false);
$this->form->setFieldAttribute('articletext', 'hint', false);
$this->form->setFieldAttribute('articletext', 'buttons', false);

$this->form->setFieldAttribute('catid', 'type', 'hidden');




$is_new = true;
$title = false;
if ($this->item->id) {
    $is_new = false;
    $title = $this->form->getValue('title');
}

$menu = Factory::getApplication()->getMenu();
if ($is_new) {
    $menu_item = $menu->getItem($menu->getActive()->parent_id);
} else {
    $menu_item = $menu->getActive();
}

$return_uri = Uri::root() . $menu_item->route;
$return = base64_encode($return_uri);

#echo '<pre>'; var_dump($return_uri); echo '</pre>'; #exit;
?>
<?php if ($title) : ?>
<h2>Editing: <?php echo $title; ?></h2>
<?php endif; ?>
<form action="<?php echo Route::_('index.php?option=com_content&a_id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" enctype="multipart/form-data">

    <p>
        <?php echo preg_replace('# (title|class)="([^"])*"#', '', $this->form->getLabel('title')); ?>
        <br>
        <?php echo $this->form->getInput('title'); ?>
    </p>

    <div>
        <?php echo preg_replace('# (title|class)="([^"])*"#', '', $this->form->getLabel('articletext')); ?>
    <br>
        <?php echo $this->form->getInput('articletext'); ?>
    </div>
    <p>
        <button type="submit" name="task" value="article.save"><?php echo Text::_('JSAVE') ?></button>
        <?php if ($is_new) : ?>
        <a href="<?php echo $return_uri;?>" class="c-cta"><?php echo Text::_('JCANCEL') ?></a>
        <?php else: ?>
        <button type="submit" name="task" value="article.cancel" class="c-cta"><?php echo Text::_('JCANCEL') ?></button>
        <?php endif; ?>
    </p>
    <?php echo $this->form->getInput('catid'); ?>
    <input type="hidden" name="jform[state]" value="1" />
    <input type="hidden" name="return" value="<?php echo $return; ?>" />
    <?php echo HTMLHelper::_('form.token'); ?>
</form>
<?php


return;

HTMLHelper::_('behavior.tabstate');
HTMLHelper::_('behavior.keepalive');
HTMLHelper::_('behavior.formvalidator');
HTMLHelper::_('formbehavior.chosen', '#jform_catid', null, array('disable_search_threshold' => 0));
HTMLHelper::_('formbehavior.chosen', '#jform_tags', null, array('placeholder_text_multiple' => Text::_('JGLOBAL_TYPE_OR_SELECT_SOME_TAGS')));
HTMLHelper::_('formbehavior.chosen', 'select');
$this->tab_name = 'com-content-form';
$this->ignore_fieldsets = array('image-intro', 'image-full', 'jmetadata', 'item_associations');

// Create shortcut to parameters.
$params = $this->state->get('params');

// This checks if the editor config options have ever been saved. If they haven't they will fall back to the original settings.
$editoroptions = isset($params->show_publishing_options);

if (!$editoroptions)
{
    $params->show_urls_images_frontend = '0';
}

Factory::getDocument()->addScriptDeclaration("
    Joomla.submitbutton = function(task)
    {
        if (task == 'article.cancel' || document.formvalidator.isValid(document.getElementById('adminForm')))
        {
            " . $this->form->getField('articletext')->save() . "
            Joomla.submitform(task);
        }
    }
");
?>
<div class="edit item-page<?php echo $this->pageclass_sfx; ?>">
    <?php if ($params->get('show_page_heading')) : ?>
    <div class="page-header">
        <h1>
            <?php echo $this->escape($params->get('page_heading')); ?>
        </h1>
    </div>
    <?php endif; ?>

    <form action="<?php echo Route::_('index.php?option=com_content&a_id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm" class="form-validate form-vertical">
        <fieldset>
            <?php echo HTMLHelper::_('bootstrap.startTabSet', $this->tab_name, array('active' => 'editor')); ?>

            <?php echo HTMLHelper::_('bootstrap.addTab', $this->tab_name, 'editor', Text::_('COM_CONTENT_ARTICLE_CONTENT')); ?>
                <?php echo $this->form->renderField('title'); ?>

                <?php if (is_null($this->item->id)) : ?>
                    <?php echo $this->form->renderField('alias'); ?>
                <?php endif; ?>

                <?php echo $this->form->getInput('articletext'); ?>

                <?php if ($this->captchaEnabled) : ?>
                    <?php echo $this->form->renderField('captcha'); ?>
                <?php endif; ?>
            <?php echo HTMLHelper::_('bootstrap.endTab'); ?>

            <?php if ($params->get('show_urls_images_frontend')) : ?>
            <?php echo HTMLHelper::_('bootstrap.addTab', $this->tab_name, 'images', Text::_('COM_CONTENT_IMAGES_AND_URLS')); ?>
                <?php echo $this->form->renderField('image_intro', 'images'); ?>
                <?php echo $this->form->renderField('image_intro_alt', 'images'); ?>
                <?php echo $this->form->renderField('image_intro_caption', 'images'); ?>
                <?php echo $this->form->renderField('float_intro', 'images'); ?>
                <?php echo $this->form->renderField('image_fulltext', 'images'); ?>
                <?php echo $this->form->renderField('image_fulltext_alt', 'images'); ?>
                <?php echo $this->form->renderField('image_fulltext_caption', 'images'); ?>
                <?php echo $this->form->renderField('float_fulltext', 'images'); ?>
                <?php echo $this->form->renderField('urla', 'urls'); ?>
                <?php echo $this->form->renderField('urlatext', 'urls'); ?>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $this->form->getInput('targeta', 'urls'); ?>
                    </div>
                </div>
                <?php echo $this->form->renderField('urlb', 'urls'); ?>
                <?php echo $this->form->renderField('urlbtext', 'urls'); ?>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $this->form->getInput('targetb', 'urls'); ?>
                    </div>
                </div>
                <?php echo $this->form->renderField('urlc', 'urls'); ?>
                <?php echo $this->form->renderField('urlctext', 'urls'); ?>
                <div class="control-group">
                    <div class="controls">
                        <?php echo $this->form->getInput('targetc', 'urls'); ?>
                    </div>
                </div>
            <?php echo HTMLHelper::_('bootstrap.endTab'); ?>
            <?php endif; ?>

            <?php echo LayoutHelper::render('joomla.edit.params', $this); ?>

            <?php echo HTMLHelper::_('bootstrap.addTab', $this->tab_name, 'publishing', Text::_('COM_CONTENT_PUBLISHING')); ?>
                <?php echo $this->form->renderField('catid'); ?>
                <?php echo $this->form->renderField('tags'); ?>
                <?php echo $this->form->renderField('note'); ?>
                <?php if ($params->get('save_history', 0)) : ?>
                    <?php echo $this->form->renderField('version_note'); ?>
                <?php endif; ?>
                <?php if ($params->get('show_publishing_options', 1) == 1) : ?>
                    <?php echo $this->form->renderField('created_by_alias'); ?>
                <?php endif; ?>
                <?php if ($this->item->params->get('access-change')) : ?>
                    <?php echo $this->form->renderField('state'); ?>
                    <?php echo $this->form->renderField('featured'); ?>
                    <?php if ($params->get('show_publishing_options', 1) == 1) : ?>
                        <?php echo $this->form->renderField('publish_up'); ?>
                        <?php echo $this->form->renderField('publish_down'); ?>
                    <?php endif; ?>
                <?php endif; ?>
                <?php echo $this->form->renderField('access'); ?>
                <?php if (is_null($this->item->id)) : ?>
                    <div class="control-group">
                        <div class="control-label">
                        </div>
                        <div class="controls">
                            <?php echo Text::_('COM_CONTENT_ORDERING'); ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php echo HTMLHelper::_('bootstrap.endTab'); ?>

            <?php echo HTMLHelper::_('bootstrap.addTab', $this->tab_name, 'language', Text::_('JFIELD_LANGUAGE_LABEL')); ?>
                <?php echo $this->form->renderField('language'); ?>
            <?php echo HTMLHelper::_('bootstrap.endTab'); ?>

            <?php if ($params->get('show_publishing_options', 1) == 1) : ?>
                <?php echo HTMLHelper::_('bootstrap.addTab', $this->tab_name, 'metadata', Text::_('COM_CONTENT_METADATA')); ?>
                    <?php echo $this->form->renderField('metadesc'); ?>
                    <?php echo $this->form->renderField('metakey'); ?>
                <?php echo HTMLHelper::_('bootstrap.endTab'); ?>
            <?php endif; ?>

            <?php echo HTMLHelper::_('bootstrap.endTabSet'); ?>

            <input type="hidden" name="task" value="" />
            <input type="hidden" name="return" value="<?php echo $this->return_page; ?>" />
            <?php echo HTMLHelper::_('form.token'); ?>
        </fieldset>
        <div class="btn-toolbar">
            <div class="btn-group">
                <button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('article.save')">
                    <span class="icon-ok"></span><?php echo Text::_('JSAVE') ?>
                </button>
            </div>
            <div class="btn-group">
                <button type="button" class="btn" onclick="Joomla.submitbutton('article.cancel')">
                    <span class="icon-cancel"></span><?php echo Text::_('JCANCEL') ?>
                </button>
            </div>
            <?php if ($params->get('save_history', 0) && $this->item->id) : ?>
            <div class="btn-group">
                <?php echo $this->form->getInput('contenthistory'); ?>
            </div>
            <?php endif; ?>
        </div>
    </form>
</div>
