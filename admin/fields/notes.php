<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/../../vendor/autoload.php';

use \Michelf\Markdown;

#JFormHelper::loadFieldClass('list');

/*
Definition:
<field
    type="notes"
    description="Markdown notes"
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

        $help[] = '<div class="notes-body">';
        $help[] = Markdown::defaultTransform(JText::_($this->description));
        $help[] = '</div>';
        
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
    }
}
