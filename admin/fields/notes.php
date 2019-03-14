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
class JFormFieldNotes extends JFormField
{
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
    protected $type = 'Notes';

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */
    protected function getInput()
    {
        $doc = JFactory::getDocument();
        $doc->addStylesheet('/templates/npeu6/admin/css/notes.css');
        
        $help[] = '</div>';
        $help[] = '<div class="tpl-notes-body">';
        $help[] = JText::_($this->description);
        $help[] = '</div>';
        $help[] = '<div>';
        
        $return = implode("\n", $help);
        
        return $return;
    }
    
    /**
     * Method to get the field label markup.
     *
     * @return  string  The field label markup.
     */
    protected function getLabel()
    {
        return '<b>Notes:</b>';
        /*
        return parent::getLabel();

        // This field type now uses jasny bootstrap to present a better looking field
        // As such the way an existing file is presented is handled by the input
        // so we don't need a special label any more, but keep for reference
        // in case other inputs do.

        $label = parent::getLabel();

        // Initialize some field attributes.
        $current_class = $this->element['currentclass'] ? ' class="' . (string) $this->element['currentclass'] . '"' : '';

        $current_file  = empty($this->value)
                       ? JText::_($this->element['nofile'])
                       : htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8');

        return str_replace(
            '</label>',
            '<br /><span' . $current_class . '>(' . $current_file . ')</span></label>',
            $label);*/
    }
}
