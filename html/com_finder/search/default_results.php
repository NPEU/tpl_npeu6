<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;


use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$db = Factory::getDBO();

?>
<div class="longform-content">
    <?php // Display the suggested search if it is different from the current search. ?>
    <?php if (($this->suggested && $this->params->get('show_suggested_query', 1)) || ($this->explained && $this->params->get('show_explained_query', 1))) : ?>
        <div id="search-query-explained">
            <?php // Display the suggested search query. ?>
            <?php if ($this->suggested && $this->params->get('show_suggested_query', 1)) : ?>
                <?php // Replace the base query string with the suggested query string. ?>
                <?php $uri = Uri::getInstance($this->query->toUri()); ?>
                <?php $uri->setVar('q', $this->suggested); ?>
                <?php // Compile the suggested query link. ?>
                <?php $linkUrl = Route::_($uri->toString(array('path', 'query'))); ?>
                <?php $link = '<a href="' . $linkUrl . '">' . $this->escape($this->suggested) . '</a>'; ?>
                <?php echo Text::sprintf('COM_FINDER_SEARCH_SIMILAR', $link); ?>
            <?php elseif ($this->explained && $this->params->get('show_explained_query', 1)) : ?>
                <?php // Display the explained search query. ?>
                <?php echo $this->explained; ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <?php // Display the 'no results' message and exit the template. ?>
    <?php if (($this->total === 0) || ($this->total === null)) : ?>
        <div id="search-result-empty">
            <h2><?php echo Text::_('COM_FINDER_SEARCH_NO_RESULTS_HEADING'); ?></h2>
            <?php $multilang = Factory::getApplication()->getLanguageFilter() ? '_MULTILANG' : ''; ?>
            <p><?php echo Text::sprintf('COM_FINDER_SEARCH_NO_RESULTS_BODY' . $multilang, $this->escape($this->query->input)); ?></p>
        </div>
        <?php // Exit this template. ?>
        <?php return; ?>
    <?php endif; ?>
    <?php // Activate the highlighter if enabled. ?>
    <?php if (!empty($this->query->highlight) && $this->params->get('highlight_terms', 1)) : ?>
        <?php HTMLHelper::_('behavior.highlighter', $this->query->highlight); ?>
    <?php endif; ?>
    <?php // Display a list of results ?>
    <br id="highlighter-start" />
    <ul class="n-search-results">
        <?php $this->baseUrl = Uri::getInstance()->toString(array('scheme', 'host', 'port')); ?>
        <?php foreach ($this->results as $result) : ?>
            <?php $this->result = &$result; ?>
            <?php $layout = $this->getLayoutFile($this->result->layout); ?>
            <?php echo $this->loadTemplate($layout); ?>
        <?php endforeach; ?>
    </ul>
    <br id="highlighter-end" />
</div>
<?php // Display the pagination FIX THIS!!!!
/*
<div class="l-layout  l-gutter">
    <div class="l-layout__inner  dX-background--very-lightX  t-neutral  search-pagination"  data-fs-text="center">
        <div class="l-box  n-pagination">
            <?php echo $this->pagination->getPagesLinks(); ?>
        </div>
        <div class="l-box  l-center  u-text-align--centerx">
            <p>
                <?php // Prepare the pagination string.  Results X - Y of Z ?>
                <?php $start = (int) $this->pagination->get('limitstart') + 1; ?>
                <?php $total = (int) $this->pagination->get('total'); ?>
                <?php $limit = (int) $this->pagination->get('limit') * $this->pagination->get('pages.current'); ?>
                <?php $limit = (int) ($limit > $total ? $total : $limit); ?>
                <?php echo Text::sprintf('COM_FINDER_SEARCH_RESULTS_OF', $start, $limit, $total); ?>
            </p>
        </div>
    </div>
</div>

*/ ?>