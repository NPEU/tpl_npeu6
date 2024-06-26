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

use NPEU\Template\Npeu6\Site\Helper\Npeu6Helper as TplNPEU6Helper;

$page_brand = TplNPEU6Helper::get_brand();
$theme = 't-' . $page_brand->alias;

$db = Factory::getDBO();
$page_search_area = '';
if ($page_brand->alias != 'npeu') {

        $query = '
            SELECT id
            FROM #__finder_taxonomy
            WHERE title = "' . $page_brand->name . '";
        ';
        $db->setQuery($query);
        $page_search_area = $db->loadResult();
}




if ($this->params->get('show_advanced', 1) || $this->params->get('show_autosuggest', 1))
{
    HTMLHelper::_('jquery.framework');

    $script = "
jQuery(function() {";

    if ($this->params->get('show_advanced', 1))
    {
        /*
        * This segment of code disables select boxes that have no value when the
        * form is submitted so that the URL doesn't get blown up with null values.
        */
        $script .= "
    jQuery('#finder-search').on('submit', function(e){
        e.stopPropagation();
        // Disable select boxes with no value selected.
        jQuery('#advancedSearch').find('select').each(function(index, el) {
            var el = jQuery(el);
            if(!el.val()){
                el.attr('disabled', 'disabled');
            }
        });
    });";
    }

    /*
    * This segment of code sets up the autocompleter.
    */
    if ($this->params->get('show_autosuggest', 1))
    {
        HTMLHelper::_('script', 'jui/jquery.autocomplete.min.js', array('version' => 'auto', 'relative' => true));

        $script .= "
    var suggest = jQuery('#q').autocomplete({
        serviceUrl: '" . Route::_('index.php?option=com_finder&task=suggestions.suggest&format=json&tmpl=component') . "',
        paramName: 'q',
        minChars: 1,
        maxHeight: 400,
        width: 300,
        zIndex: 9999,
        deferRequestBy: 500
    });";
    }

    $script .= "
});";

    Factory::getDocument()->addScriptDeclaration($script);
}

?>
<div class="l-box  l-box--space--block-end  longform-content">
    <form id="finder-search" action="<?php echo Route::_($this->query->toUri()); ?>" method="get" class="form-inline  u-space--below">
        <?php if ($page_search_area != ''): ?>
        <input type="hidden" value="<?php echo $page_search_area; ?>" name="t[]">
        <?php endif; ?>
        <?php echo $this->getFields(); ?>
        <?php // DISABLED UNTIL WEIRD VALUES CAN BE TRACKED DOWN. ?>
        <?php if (false && $this->state->get('list.ordering') !== 'relevance_dsc') : ?>
            <input type="hidden" name="o" value="<?php echo $this->escape($this->state->get('list.ordering')); ?>" />
        <?php endif; ?>
        <fieldset>
        <div class="l-layout  l-row  l-row--start">
                <div class="l-layout__inner">
                    <div class="l-box  l-box--space--inline-end--xs  ff-width-100--25--25">
                        <label for="q">
                            <?php echo Text::_('COM_FINDER_SEARCH_TERMS'); ?>
                        </label>
                    </div>
                    <div class="l-box  ff-width-100--25--75">
                        <span class="c-composite  u-fill-width">
                            <input type="text" name="q" id="q" size="30" value="<?php echo $this->escape($this->query->input); ?>" class="inputbox" />
                            <?php if ($this->escape($this->query->input) != '' || $this->params->get('allow_empty_query')) : ?>
                            <button type="submit" class="<?php echo $theme; ?>">
                                <svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-search"></use></svg>
                                <?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
                            </button>
                            <?php else : ?>
                            <button type="submit" class="<?php echo $theme; ?> disabled">
                                <svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-search"></use></svg>
                                <?php echo Text::_('JSEARCH_FILTER_SUBMIT'); ?>
                            </button>
                            <?php endif; ?>
                        </span>
                        <?php if ($this->params->get('show_advanced', 1)) : ?>
                        <a href="#advancedSearch" data-toggle="collapse" class="btn">
                            <span class="icon-list" aria-hidden="true"></span>
                            <?php echo Text::_('COM_FINDER_ADVANCED_SEARCH_TOGGLE'); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </fieldset>
        <?php if ($this->params->get('show_advanced', 1)) : ?>
            <div id="advancedSearch" class="collapse<?php if ($this->params->get('expand_advanced', 0)) echo ' in'; ?>">
                <hr />
                <?php if ($this->params->get('show_advanced_tips', 1)) : ?>
                    <div id="search-query-explained">
                        <div class="advanced-search-tip">
                            <?php echo Text::_('COM_FINDER_ADVANCED_TIPS'); ?>
                        </div>
                        <hr />
                    </div>
                <?php endif; ?>
                <div id="finder-filter-window">
                    <?php echo HTMLHelper::_('filter.select', $this->query, $this->params); ?>
                </div>
            </div>
        <?php endif; ?>
    </form>
</div>