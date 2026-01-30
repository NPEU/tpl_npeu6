<?php
/*

NOTE this field isn't currently used, but KEEP FOR REFERENCE.

The form definition should be:

<field
    name="secondary_brand_id"
    type="brand"
    label="TPL_NPEU6_SECOND_BRAND_LABEL"
    description="TPL_NPEU6_SECOND_BRAND_DESC"
    default=""
>
    <option value="">TPL_NPEU6_SECOND_BRAND_SELECT_DEFAULT</option>
</field>

And these are the language strings:

TPL_NPEU6_SECOND_BRAND_LABEL              = "Secondary brand"
TPL_NPEU6_SECOND_BRAND_DESC               = ""
TPL_NPEU6_SECOND_BRAND_SELECT_DEFAULT     = "Please select:"
TPL_NPEU6_SECOND_BRAND_DEFAULT_NO_BRANDS  = "No brands found."

*/
namespace NPEU\Template\Npeu6\Site\Field;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\Database\DatabaseInterface;

defined('_JEXEC') or die;

/**
 * Form field for a list of brands.
 */
class BrandField extends ListField
{
    /**
     * The form field type.
     *
     * @var     string
     */
    protected $type = 'Brand';

    /**
     * Method to get the field options.
     *
     * @return  array  The field option objects.
     */
    protected function getOptions()
    {
        #$params  = clone ComponentHelper::getParams('com_siteareas');
        $options = [];


        $db = Factory::getContainer()->get(\Joomla\Database\DatabaseInterface::class);

        // @TODO this needs altering to select modules flagged in some other way but I'm not sure
        // what way that is going to be yet.
        $query = $db->getQuery(true);
        $query->select($db->quoteName['id']);
        $query->from($db->quoteName('#__brands'));
        $query->where([
            $db->quoteName('catid') . ' =  171',
            $db->quoteName('state') . '  = 1'
        ]);
        $q->order('name');

        $db->setQuery($query);
        $brands = $db->loadAssocList();

        $i = 0;
        foreach ($brands as $brand) {
            $options[] = HTMLHelper::_('select.option', $brand['id'], $brand['name']);
            $i++;
        }
        if ($i > 0) {
            // Merge any additional options in the XML definition.
            $options = array_merge(parent::getOptions(), $options);
        } else {
            $options = parent::getOptions();
            $options[0]->text = Text::_('TPL_NPEU6_SECOND_BRAND_DEFAULT_NO_BRANDS');
        }

        // If an ID is already selected, we don't want the auto-generate option:
        if (!empty($this->value)) {
            unset($options[1]);
        }

        return $options;
    }

    /**
     * Method to get the field input markup.
     *
     * @return  string  The field input markup.
     */
    /*protected function getInput()
    {
        $return   = [];
        $return[] = parent::getInput();

        if (!empty($this->value)) {
            $return[] = '<div style="margin: 1em 0 0 0;">';
            $return[] = '    <a href="/administrator/index.php?option=com_brands&task=brand.edit&id=' . $this->value . '" target="_blank" class="btn  btn-primary">' . Text::_('COM_SITEAREAS_BRAND_EDIT_LINK') . ' <span class="icon-out-2" aria-hidden="true"></span></a>';
            $return[] = '</div>';
        }

        return implode("\n", $return);
    }*/
}