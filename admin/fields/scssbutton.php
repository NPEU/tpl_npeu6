<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

#JFormHelper::loadFieldClass('list');

/*
Definition:

<field
    name="???"
    type="datepicker"
    filter="string"
    label="COM_???_???_LABEL"
    desctiption="COM_???_???_DESC"
    class="form-control"
    required="true"
/>
*/

/**
 * Form Field class for the Joomla Platform.
 * Supports a list of options retrieved from an API call.
 */
class JFormFieldSCSSButton extends JFormField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
    protected $type = 'SCSSButton';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */
    protected function getInput()
    {
        $doc = JFactory::getDocument();
        $doc->addStylesheet('/templates/tpl_npeu6/admin/css/toolbar.css');
        $doc->addScript('/templates/tpl_npeu6/admin/js/scss_compile.js');
        #$input = parent::getInput();
        
        $button[] = '</div>';
        $button[] = '<div class="tpl_fallback__toolbar">';
        $button[] = '   <button id="compile_scss" class="btn btn-success">';
        $button[] = '      Compile SCSS';
        $button[] = '   </button>';
        $button[] = '</div>';
        $button[] = '<div>';
        
        $return = implode("\n", $button);
        
        return $return;
    }
}
