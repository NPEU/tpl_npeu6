<?php

function pagination_item_active(&$item) {
    if ($item->text == 'Start' || $item->text == 'Prev') {
        return before_link($item);
    } elseif ($item->text == 'Next' || $item->text == 'End') {
        return after_link($item);
    } else {
        return '<a href="' . $item->link . '"><span data-hidden="visually">Page&nbsp;</span>' . $item->text . '</a>';
    }
}


function pagination_item_inactive(&$item) {
    if ($item->text == 'Start' || $item->text == 'Prev') {
        return before_link($item);
    } elseif ($item->text == 'Next' || $item->text == 'End') {
        return after_link($item);
    } else {
        return '<a aria-current="page" class="d-background--light   t-neutral">' . $item->text . '</a>';
    }
}


function before_link(&$item) {


    if (!is_null($item->base)) {
        $a = 'href="' . $item->link .'"';
    } else {
        $a = 'aria-hidden="true"';
    }

    if ($item->text == 'Start') {
        $s = 's';
    } else {
        $s = '';
    }

    return '<a ' . $a . '><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron' . $s . '-left"></use></svg><span>' . $item->text . '<span data-hidden="visually">&nbsp;page.</span></span></a>';
}

function after_link(&$item) {

    if (!is_null($item->base)) {
        $a = 'href="' . $item->link .'"';
    } else {
        $a = 'aria-hidden="true"';
    }

    if ($item->text == 'End') {
        $s = 's';
    } else {
        $s = '';
    }

    return '<a ' . $a . '><span>' . $item->text . '<span data-hidden="visually">&nbsp;page.</span></span><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none"><use xlink:href="#icon-chevron' . $s . '-right"></use></svg></a>';
}
?>