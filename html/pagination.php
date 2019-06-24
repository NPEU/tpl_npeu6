<?php
/*
function pagination_list_render($list)
{
	$project   = get_project();
	$project_class = '';
	if (!empty($project->alias)) {
		$project_class = '  pagination--' . $project->alias;
	}
	// Reverse output rendering for right-to-left display.
	$html = '<ul class="nav  nav--inline  pagination' . $project_class . '  no-print">';
	$html .= '<li class="nav__item  pagination__first">' . $list['start']['data'] . '</li>';
	$html .= '<li class="nav__item  pagination__prev">' . $list['previous']['data'] . '</li>';
	foreach ($list['pages'] as $page)
	{
		$class = $page['active']
			   ? 'pagination__page'
			   : 'pagination__page  current';
		$html .= '<li class="nav__item  ' . $class . '">' . $page['data'] . '</li>';
	}
	$html .= '<li class="nav__item  pagination__next">' . $list['next']['data'] . '</li>';
	$html .= '<li class="nav__item  pagination__last">' . $list['end']['data'] . '</li>';
	$html .= '</ul>';

	return $html;
}
*/
function pagination_item_active(&$item)
{
	return '<a href="' . $item->link . '" class="n-pagination__link"><span>' . $item->text . '</span></a>';
    
    /*$app = JFactory::getApplication();
	if ($app->isAdmin())
	{
		if ($item->base > 0)
		{
			return "<a title=\"" . $item->text . "\" onclick=\"document.adminForm." . $this->prefix . "limitstart.value=" . $item->base
				. "; Joomla.submitform();return false;\">" . $item->text . "</a>";
		}
		else
		{
			return "<a title=\"" . $item->text . "\" onclick=\"document.adminForm." . $this->prefix
				. "limitstart.value=0; Joomla.submitform();return false;\">" . $item->text . "</a>";
		}
	}
	else
	{
		return "<a title=\"" . $item->text . "\" href=\"" . $item->link . "\" class=\"pagenav\">" . switchSymbol($item->text) . "</a>";
	}*/
}


function pagination_item_inactive(&$item)
{
    return '<span class="n-pagination__link"><span>' . $item->text . '</span></span>';
	/*$app = JFactory::getApplication();
	if ($app->isAdmin())
	{
		return "<span>" . $item->text . "</span>";
	}
	else
	{
		return "<span>" . switchSymbol($item->text) . "</span>";
	}*/
}
/*
function switchSymbol($text)
{
	$symbol = '';
	switch ($text) {
		case 'Start':
			$symbol = '«';
			break;
		case 'Prev':
			$symbol = '‹';
			break;
		case 'Next':
			$symbol = '›';
			break;
		case 'End':
			$symbol = '»';
			break;
		default:
			$symbol = $text;
			break;
	} // switch
	return $symbol;
}*/
?>