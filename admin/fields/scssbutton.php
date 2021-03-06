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
        //$doc->addStylesheet('/templates/npeu6/admin/css/toolbar.css');
        $doc->addScript('/templates/npeu6/admin/js/scss_compile_brands.js');
        #$input = parent::getInput();
        
        $button[] = '<button id="compile_scss" class="btn btn-success">';
        $button[] = '    ' . JText::_('TPL_NPEU6_SCSS_COMPILE_BUTTON_BUTTON_TEXT');
        $button[] = '</button>';

        
        $return = implode("\n", $button);
        
        return $return;
    }
}
