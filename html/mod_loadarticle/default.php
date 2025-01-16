<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_loadarticle
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$doc = Factory::getDocument();

?>
<article class="user-content">
    <?php if ($params->get('pagetitle') && !$params->get('hidetitle')): ?>
    <?php /*<h1><?php echo $doc->title; ?></h1> */ ?>
    <header class="c-panel__header  longform-content__companion">
        <h1 id="<?php echo TplNPEU6Helper::html_id($doc->title); ?>" tabindex="-1"><?php echo $doc->title; ?></h1>
    </header>
    <?php elseif (!$params->get('hidetitle')): ?>
    <h2><?php echo $params->get('title') ? $params->get('title') : $article->title; ?></h2>
    <?php endif; ?>
    <?php echo $article->introtext; ?>
    <?php if ($article->fulltext != null): ?>
    <p class="readmore">
    <a href="<?php echo $article->alias; ?>"><?php echo Text::_('COM_CONTENT_READ_MORE'); ?></a>
    </p>
    <?php endif; ?>
</article>
