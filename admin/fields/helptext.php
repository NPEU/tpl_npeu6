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
class JFormFieldHelpText extends JFormField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
    protected $type = 'HelpText';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */
    protected function getInput()
    {
        $doc = JFactory::getDocument();
        $doc->addStylesheet('/templates/tpl_npeu6/admin/css/help-text.css');
        
        $help[] = '</div>';
        $help[] = '<div class="tpl_fallback__help-text">';
        $help[] = JText::_($this->description);
        $help[] = '</div>';
        $help[] = '<div>';
        
        $return = implode("\n", $help);
        
        return $return;
    }
}
