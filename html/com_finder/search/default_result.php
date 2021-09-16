<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\String\StringHelper;

// Get the mime type class.
$mime = !empty($this->result->mime) ? 'mime-' . $this->result->mime : null;

$show_description = $this->params->get('show_description', 1);

if ($show_description)
{
	// Calculate number of characters to display around the result
	$term_length = StringHelper::strlen($this->query->input);
	$desc_length = $this->params->get('description_length', 255);
	$pad_length  = $term_length < $desc_length ? (int) floor(($desc_length - $term_length) / 2) : 0;

	// Make sure we highlight term both in introtext and fulltext
	if (!empty($this->result->summary) && !empty($this->result->body))
	{
		$full_description = FinderIndexerHelper::parse($this->result->summary . $this->result->body);
	}
	else
	{
		$full_description = $this->result->description;
	}

	// Find the position of the search term
	$pos = $term_length ? StringHelper::strpos(StringHelper::strtolower($full_description), StringHelper::strtolower($this->query->input)) : false;

	// Find a potential start point
	$start = ($pos && $pos > $pad_length) ? $pos - $pad_length : 0;

	// Find a space between $start and $pos, start right after it.
	$space = StringHelper::strpos($full_description, ' ', $start > 0 ? $start - 1 : 0);
	$start = ($space && $space < $pos) ? $space + 1 : $start;

	$description = JHtml::_('string.truncate', StringHelper::substr($full_description, $start), $desc_length, true);
}

$route = $this->result->route;
#echo '<pre>'; var_dump($this->result); echo '</pre>'; #exit;
// Get the route with highlighting information.
if (!empty($this->query->highlight)
	&& empty($this->result->mime)
	&& $this->params->get('highlight_terms', 1)
	&& JPluginHelper::isEnabled('system', 'highlight'))
{
    if (strpos($route, '?') === false) {
        $route .= '?';
    } else {
        $route .= '&';
    }
	$route .= 'highlight=' . base64_encode(json_encode($this->query->highlight));
}

?>
<li class="n-search-results__result  u-space--below">
	<h2 class="n-search-results__heading">
		<a href="<?php echo JRoute::_($route); ?>">
			<?php echo $this->result->title; ?>
		</a>
	</h2>
	<?php if ($show_description && $description !== '') : ?>
    <p class="n-search-results__description">
        <?php echo $description; ?>
    </p>
	<?php endif; ?>
</li>
