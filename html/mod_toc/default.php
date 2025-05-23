<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_toc
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$hx          = $params->get('header_tag', 'h2');
$min_h_count = (int) $params->get('min_heading_count', '3');
$doc         = Factory::getDocument();

// If there's no article we won't be able to output anything:
if (empty($doc->article)) {
    return '';
}

$min_h_count = 3;

// Since we're ignoring headings in intro text, we need to check there is BOTH intro text and fulltext.
// otherwise there's ONLY intro text, so lots of articles would get missed out otherwise:
$tmp_content = empty($doc->article->fulltext) ? $doc->article->introtext : $doc->article->fulltext;
// ToC requires id's on headers, so add them if not already present.
// Note this is a back-up, ideally the editor will create them so they're saved into the article.
preg_match_all('#<h2[^>]*>([^<]+)</h2>#', $tmp_content, $matches, PREG_SET_ORDER);

if (count($matches) < $min_h_count) {
    return;
}

?>
<div class="c-panel  c-panel--rounded  d-background--very-light  t-neutral  mod_toc">
    <nav class="c-panel__module" aria-label="table of contents">
        <div class="n-menu">
            <?php if ($module->showtitle): ?>
            <<?php echo $hx; ?> class=""><?php echo $module->title; ?></<?php echo $hx; ?>>
            <?php endif; ?>
            <ul class="n-menu__links">
                <?php foreach ($matches as $match): ?>
                <?php preg_match('#id="([^"]+)"#', $match[0], $id_match);
                if(!isset($id_match[0])) {
                    $h2_id = TplNPEU6Helper::html_id($match[1]);
                    $new_h2 = str_replace('<h2', '<h2 id="' . $h2_id . '"', $match[0]);

                    if (empty($doc->article->fulltext)) {
                        $doc->article->introtext  = str_replace($match[0], $new_h2, $doc->article->introtext);
                    } else {
                        $doc->article->fulltext  = str_replace($match[0], $new_h2, $doc->article->fulltext);
                    }
                } else {
                    $h2_id = $id_match[1];
                } ?>
                <li><a href="#<?php echo $h2_id; ?>"><?php echo $match[1]; ?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </nav>
</div>