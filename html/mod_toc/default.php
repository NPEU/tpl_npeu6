<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_toc
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;
JLoader::register('TplNPEU6Helper', dirname(dirname(dirname(__DIR__))) . '/helper.php');

$hx          = $params->get('header_tag', 'h2');
$min_h_count = (int) $params->get('min_heading_count', '3');
$doc         = JFactory::getDocument();

$min_h_count = 3;
    
// ToC requires id's on headers, so add them if not already present.
// Note this is a back-up, ideally the editor will create them so they're saved into the article.
preg_match_all('#<h2[^>]*>([^<]+)</h2>#', $doc->article->fulltext, $matches, PREG_SET_ORDER);

if (count($matches) < $min_h_count) {
    return;
}
?>
<div class="c-panel  c-panel--very-light  t-neutral  u-space--below">
    <nav class="c-panel__module" aria-label="table of contents">
        <div class="">
            <?php if ($module->showtitle): ?>
            <<?php echo $hx; ?> class=""><?php echo $module->title; ?></<?php echo $hx; ?>>
            <?php endif; ?>
            <ul class="n-section-menu__list  u-fill-width">
                <?php foreach ($matches as $match): ?>
                <?php preg_match('#id="([^"]+)"#', $match[0], $id_match);
                if(!isset($id_match[0])) {
                    $h2_id = TplNPEU6Helper::html_id($match[1]);
                    $new_h2 = str_replace('<h2', '<h2 id="' . $h2_id . '"', $match[0]);
                    
                    #$doc->article->text      = str_replace($match[0], $new_h2, $doc->article->text);
                    $doc->article->fulltext  = str_replace($match[0], $new_h2, $doc->article->fulltext);
                    #$doc->article->introtext = str_replace($match[0], $new_h2, $doc->article->introtext);
                } else {
                    $h2_id = $id_match[1];
                } ?>
                <li class="n-section-menu__item"><a href="#<?php echo $h2_id; ?>" class="n-section-menu__link"><?php echo $match[1]; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
</div>