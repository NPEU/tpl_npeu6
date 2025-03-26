<?php
/**
 * @package     Joomla.Site
 * @subpackage  tpl_npeu6
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;

$app = Factory::getApplication();

#ini_set('display_errors', 0);

if (!isset($this->error)) {
    #$this->error = JError::raiseWarning(404, Text::_('Joffline_ALERTNOAUTHOR'));
    $this->error = new GenericDataException(Text::_('Joffline_ALERTNOAUTHOR'), 404);
    $this->debug = false;
}
#echo "<pre>\n"; var_dump($this->error); echo "</pre>\n"; exit;
$is_offline   = true;

$offline_code = $this->error->getCode();
#echo '<pre>'; var_dump($is_offline); echo '</pre>'; #exit;
#$display_errors = preg_match('/^(1|yes|on|true)$/i', ini_get('display_errors'));

$offline_page_title   = 'Site offline';
$offline_message = false;

if ($app->get('display_offline_message', 1) == 1 && str_replace(' ', '', $app->get('offline_message')) !== '') {
    $offline_message = $app->get('offline_message');
}
elseif ($app->get('display_offline_message', 1) == 2 && str_replace(' ', '', Text::_('JOFFLINE_MESSAGE')) !== '') {
    $offline_message = Text::_('JOFFLINE_MESSAGE');
}

ob_start();
?>
<header aria-label="Page" class="page-header" data-landmark-index="0">
    <div class="l-layout  l-distribute  l-gutter  page-header__brand-banner  npeu">
        <p class="l-layout__inner" data-js="cmr" data-ie-safe-parent-level="1">

            <span class="l-box  primary-logo-wrap" data-min-width="229">
                <a href="/" class="c-badge  c-badge--primary-logo"><svg role="img" focusable="false" aria-labelledby="npeu--title" viewBox="0 0 222.1 100" height="100" width="222" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <title id="npeu--title">Oxford Population Health: NPEU</title>
                        <path d="M202.5 56v44H0V23h46.7V0h94.2v18.7h81.2v21.1h-56.5V56z" fill="#FFF"></path>
                        <g fill="#041E42">
                            <path d="M49.5 10.9c0-4.7 3.6-8.1 8.1-8.1 4.6 0 8.1 3.4 8.1 8.1S62.2 19 57.6 19s-8.1-3.3-8.1-8.1zm12.2 0c0-2.9-2.1-4.5-4.2-4.5-2.2 0-4.2 1.7-4.2 4.5s2 4.5 4.2 4.5c2.2.1 4.2-1.6 4.2-4.5z"></path>
                            <path d="m70.4 10.9-4.9-7.7H70l3 4.9 2.8-4.9h4.4l-4.9 7.7 5 7.7h-4.5l-3-4.9-2.8 5h-4.4l4.8-7.8zM138.1 10.9c0 4.6-3.5 7.7-8.5 7.7h-4.9V3.2h4.9c5.1 0 8.5 3.1 8.5 7.7zm-9.4 4.2h1.1c2.6 0 4.3-1.5 4.3-4.2s-1.7-4.2-4.3-4.2h-1.1v8.4z"></path>
                        </g>
                        <path d="M81.6 3.2h9.9v3.6h-5.9v3.3h5.6v3.3h-5.6v5.3h-4V3.2zM92.7 10.9c0-4.7 3.6-8.1 8.1-8.1 4.6 0 8.1 3.4 8.1 8.1s-3.5 8.1-8.1 8.1c-4.6.1-8.1-3.3-8.1-8.1zm12.2 0c0-2.9-2.1-4.5-4.2-4.5-2.2 0-4.2 1.7-4.2 4.5s2 4.5 4.2 4.5c2.2.1 4.2-1.6 4.2-4.5zM123.2 18.7h-4.6l-3.6-5.1h-.1v5.1h-4V3.2h5.2c3.8 0 6.3 1.8 6.3 5.2 0 1.6-.8 3.8-3.6 4.7l4.4 5.6zm-7.2-8.1c1.5 0 2.5-.7 2.5-1.9s-.9-1.9-2.4-1.9h-1.2v3.8h1.1z" fill="#5D4777"></path>
                        <g fill="#5D4777">
                            <path d="M81.6 21.5h4.8c4.5 0 7 2.2 7 5.6 0 3.1-2.4 5.8-6.8 5.8h-1.1V37h-4l.1-15.5zm7.9 5.8c0-1.4-1.1-2.2-2.6-2.2h-1.3v4.4h1.3c1.5-.1 2.6-.8 2.6-2.2zM94.4 29.2c0-4.7 3.6-8.1 8.1-8.1 4.6 0 8.1 3.4 8.1 8.1s-3.5 8.1-8.1 8.1c-4.5.1-8.1-3.3-8.1-8.1zm12.3 0c0-2.9-2.1-4.5-4.2-4.5-2.2 0-4.2 1.7-4.2 4.5s2 4.5 4.2 4.5c2.1.1 4.2-1.6 4.2-4.5zM112.6 21.5h4.8c4.5 0 7 2.2 7 5.6 0 3.1-2.4 5.8-6.8 5.8h-1.1V37h-4l.1-15.5zm8 5.8c0-1.4-1.1-2.2-2.6-2.2h-1.3v4.4h1.3c1.4-.1 2.6-.8 2.6-2.2zM126.1 30.8v-9.2h4v9.2c0 1.9 1 3 2.6 3 1.7 0 2.7-1 2.7-3v-9.2h4v9.2c0 3.9-2.5 6.6-6.7 6.6-4.1 0-6.6-2.8-6.6-6.6zM142 21.5h4v11.9h6.2V37H142V21.5zM164.3 37l-1.2-3.4h-5.5l-1.1 3.4h-4.1l5.7-15.5h4.5l5.8 15.5h-4.1zm-5.6-6.6h3.4l-1.7-4.8-1.7 4.8zM171.3 25.1h-4.4v-3.6h12.7v3.6h-4.4V37h-4l.1-11.9zM181.3 21.5h4V37h-4V21.5zM187.3 29.2c0-4.7 3.6-8.1 8.1-8.1 4.6 0 8.1 3.4 8.1 8.1s-3.5 8.1-8.1 8.1-8.1-3.3-8.1-8.1zm12.1 0c0-2.9-2.1-4.5-4.2-4.5-2.2 0-4.2 1.7-4.2 4.5s2 4.5 4.2 4.5c2.3.1 4.2-1.6 4.2-4.5zM219.2 37h-3.8l-6.2-9.2V37h-3.8V21.5h3.8l6.2 9.1v-9.1h3.8V37z"></path>
                        </g>
                        <g fill="#5D4777">
                            <path d="M91.1 49.4h-5.6v5.9h-4V39.9h4v5.9h5.6v-5.9h4v15.5h-4v-6zM97.9 39.9h10.2v3.5h-6.2v2.5h5.7v3.2h-5.7v2.7h6.2v3.5H97.9V39.9zM120.9 55.4l-1.2-3.4h-5.5l-1.1 3.4H109l5.7-15.5h4.5l5.8 15.5h-4.1zm-5.6-6.6h3.4L117 44l-1.7 4.8zM126.3 39.9h4v11.9h6.2v3.6h-10.2V39.9zM139.2 43.4h-4.3v-3.6h12.7v3.6h-4.4v11.9h-4V43.4zM158.8 49.4h-5.6v5.9h-4V39.9h4v5.9h5.6v-5.9h4v15.5h-4v-6z"></path>
                        </g>
                        <g>
                            <path d="M2.8 25.8h71.4v71.3H2.8z" fill="#041E42"></path>
                            <defs>
                                <path id="a" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="b">
                                <use xlink:href="#a" overflow="visible"></use>
                            </clipPath>
                            <path d="M12.5 76.4c-.3.3-.7.5-1.2.5s-.8-.2-1.2-.5c-.4-.4-.4-.8-.4-1.3v-2.6h.7v2.7c0 .3 0 .7.3.9.2.2.5.3.8.3s.6-.1.7-.3c.3-.3.3-.7.3-1.3v-2.3h.6v2.2c-.2.8-.2 1.3-.6 1.7" clip-path="url(#b)" fill="#FFF"></path>
                            <defs>
                                <path id="c" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="d">
                                <use xlink:href="#c" overflow="visible"></use>
                            </clipPath>
                            <path d="M17.1 76.8 15 73.4v3.4h-.5v-4.3h.6l2 3.4v-3.4h.5v4.3z" clip-path="url(#d)" fill="#FFF"></path>
                            <defs>
                                <path id="e" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="f">
                                <use xlink:href="#e" overflow="visible"></use>
                            </clipPath>
                            <path d="M19.3 72.5h.6v4.2h-.6z" clip-path="url(#f)" fill="#FFF"></path>
                            <defs>
                                <path id="g" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="h">
                                <use xlink:href="#g" overflow="visible"></use>
                            </clipPath>
                            <path d="M23.1 76.8h-.6L21 72.5h.6l1.2 3.6 1.3-3.6h.5z" clip-path="url(#h)" fill="#FFF"></path>
                            <defs>
                                <path id="i" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="j">
                                <use xlink:href="#i" overflow="visible"></use>
                            </clipPath>
                            <path d="M25.8 76.8v-4.3h2.3v.4h-1.8v1.4H28v.5h-1.7v1.5h1.9v.5z" clip-path="url(#j)" fill="#FFF"></path>
                            <defs>
                                <path id="k" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="l">
                                <use xlink:href="#k" overflow="visible"></use>
                            </clipPath>
                            <path d="m31.9 76.8-.5-1.1c-.3-.7-.5-.8-1-.8h-.3v1.8h-.6v-4.2h.9c.6 0 1 0 1.3.4.2.2.4.5.4.8 0 .3-.1.6-.3.8-.2.2-.4.3-.7.4.1 0 .3.1.4.2.1.1.2.4.4.6l.6 1.2c0-.1-.6-.1-.6-.1zm-.5-3.6c-.2-.2-.6-.2-.8-.2h-.5v1.5h.2c.4 0 .8 0 1.1-.3.1-.1.2-.4.2-.6 0-.1-.1-.3-.2-.4" clip-path="url(#l)" fill="#FFF"></path>
                            <defs>
                                <path id="m" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="n">
                                <use xlink:href="#m" overflow="visible"></use>
                            </clipPath>
                            <path d="M34.7 76.9c-.8 0-1.2-.4-1.3-.5l.3-.4c.1.1.5.4 1 .4s.8-.3.8-.7c0-.5-.6-.7-.9-.9-.6-.3-1-.6-1-1.1 0-.7.6-1.1 1.3-1.1.8 0 1.2.4 1.2.5l-.3.4c-.1 0-.4-.3-.8-.3s-.8.2-.8.7c0 .4.4.6.8.8.4.2 1.2.5 1.2 1.3-.1.3-.6.9-1.5.9" clip-path="url(#n)" fill="#FFF"></path>
                            <defs>
                                <path id="o" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="p">
                                <use xlink:href="#o" overflow="visible"></use>
                            </clipPath>
                            <path d="M37.5 72.5h.6v4.2h-.6z" clip-path="url(#p)" fill="#FFF"></path>
                            <defs>
                                <path id="q" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="r">
                                <use xlink:href="#q" overflow="visible"></use>
                            </clipPath>
                            <path d="M40.9 72.9v3.9h-.5v-3.9h-1.2v-.4h3.1v.4z" clip-path="url(#r)" fill="#FFF"></path>
                            <defs>
                                <path id="s" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="t">
                                <use xlink:href="#s" overflow="visible"></use>
                            </clipPath>
                            <path d="M44.7 75.1v1.7h-.5v-1.7l-1.4-2.6h.6l1 2 1.1-2h.5z" clip-path="url(#t)" fill="#FFF"></path>
                            <defs>
                                <path id="u" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="v">
                                <use xlink:href="#u" overflow="visible"></use>
                            </clipPath>
                            <path d="M50.8 76.9c-1.1 0-2-.9-2-2.3s.8-2.3 2-2.3c1.1 0 2 .9 2 2.2 0 1.4-.7 2.4-2 2.4m0-4c-.8 0-1.3.7-1.3 1.7s.6 1.7 1.4 1.7c.8 0 1.3-.8 1.3-1.8.1-.9-.5-1.6-1.4-1.6" clip-path="url(#v)" fill="#FFF"></path>
                            <defs>
                                <path id="w" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="x">
                                <use xlink:href="#w" overflow="visible"></use>
                            </clipPath>
                            <path d="M54.8 72.9v1.4h1.6v.5h-1.6v2h-.6v-4.3h2.3v.4z" clip-path="url(#x)" fill="#FFF"></path>
                            <defs>
                                <path id="y" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="z">
                                <use xlink:href="#y" overflow="visible"></use>
                            </clipPath>
                            <path d="M18.5 85.2c0 2.7-2.1 4.7-4.7 4.7-2.7 0-4.7-2-4.7-4.6 0-2.7 2.1-4.7 4.7-4.7s4.7 1.9 4.7 4.6m-1.5.1c0-2.5-1.2-4.2-3.2-4.2-2.2 0-3.2 2.1-3.2 4.2 0 2.5 1.2 4.2 3.2 4.2 2.1-.1 3.2-2.1 3.2-4.2" clip-path="url(#z)" fill="#FFF"></path>
                            <defs>
                                <path id="A" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="B">
                                <use xlink:href="#A" overflow="visible"></use>
                            </clipPath>
                            <path d="M47.5 85.2c0 2.7-2.1 4.7-4.7 4.7-2.7 0-4.7-2-4.7-4.6 0-2.7 2.1-4.7 4.7-4.7s4.7 1.9 4.7 4.6m-1.5.1c0-2.5-1.2-4.2-3.2-4.2-2.2 0-3.2 2.1-3.2 4.2 0 2.5 1.2 4.2 3.2 4.2 2.2-.1 3.2-2.1 3.2-4.2" clip-path="url(#B)" fill="#FFF"></path>
                            <defs>
                                <path id="C" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="D">
                                <use xlink:href="#C" overflow="visible"></use>
                            </clipPath>
                            <path d="M51.2 85.3h1.1c1.7 0 2.1-1 2.1-2.1 0-.8-.3-1.4-1.1-1.8-.5-.2-.8-.2-1.4-.2h-.7v4.1zm2.1 1.5c-.6-.8-.8-.9-1.4-.9h-.7v3c0 .3.1.4.4.5l1 .2v.4h-4.1v-.4l.9-.2c.3-.1.4-.2.4-.5v-7.1c0-.3-.1-.4-.4-.5l-.9-.2v-.4h4c.8 0 1.4.1 1.9.3.9.4 1.5 1.3 1.5 2.2 0 1.1-.8 2.1-2.2 2.4v.1c.3.1.5.3 1.4 1.6l1.2 1.6c.2.3.4.5.7.5l.8.2v.4h-2.2c-.3 0-.4-.1-.6-.4l-1.7-2.8z" clip-path="url(#D)" fill="#FFF"></path>
                            <defs>
                                <path id="E" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="F">
                                <use xlink:href="#E" overflow="visible"></use>
                            </clipPath>
                            <path d="M35.6 83.9h.4v3h-.5l-.1-.9c-.1-.3-.3-.5-.6-.5h-2.2v3.3c0 .3.1.4.4.5l1 .2v.4h-4v-.4l.9-.2c.3-.1.4-.2.4-.5v-7.1c0-.3-.1-.4-.4-.5l-.9-.1v-.4h6.8V83h-.5l-.4-1.3c-.1-.4-.3-.5-.6-.5h-2.8V85h2.2c.3 0 .5-.1.6-.5l.3-.6z" clip-path="url(#F)" fill="#FFF"></path>
                            <defs>
                                <path id="G" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="H">
                                <use xlink:href="#G" overflow="visible"></use>
                            </clipPath>
                            <path d="M58.7 89.8v-.4l.9-.2c.3-.1.4-.2.4-.5v-7.1c0-.3-.1-.4-.4-.5l-.9-.1v-.4h4.2c1.1 0 2 .2 2.6.5 1.7.8 2.5 2.5 2.5 4.2 0 1.6-.6 3.1-2.2 4-.7.4-1.7.6-2.9.6h-4.2zm2.6-8.6v7.6c0 .3.1.4.4.4h1.1c1 0 1.8-.1 2.4-.6.9-.7 1.3-1.9 1.3-3.4s-.4-3-1.7-3.7c-.6-.3-1.2-.4-2.3-.4h-1.2z" clip-path="url(#H)" fill="#FFF"></path>
                            <defs>
                                <path id="I" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="J">
                                <use xlink:href="#I" overflow="visible"></use>
                            </clipPath>
                            <path d="M22.1 89.4v.4h-3.2v-.4l.8-.2c.3-.1.6-.2.8-.4l2.7-3.5-2.7-3.7c-.2-.3-.4-.4-.7-.5l-.9-.1v-.4h4v.4l-.9.2c-.3.1-.3.1-.1.3l2 2.8h.1l2.1-2.8c.2-.2.2-.3-.1-.4l-.8-.2v-.4h3.2v.4l-.8.2c-.3.1-.6.2-.7.4l-2.5 3.4 2.9 3.9c.2.3.4.4.7.5l.8.2v.4h-4v-.4l.8-.2c.3-.1.3-.1.1-.4l-2.2-3h-.1L21.1 89c-.2.2-.2.3.1.3l.9.1z" clip-path="url(#J)" fill="#FFF"></path>
                            <defs>
                                <path id="K" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="L">
                                <use xlink:href="#K" overflow="visible"></use>
                            </clipPath>
                            <path d="M53.2 43.5c0-.6-.2-.9-.6-1.2-.3-.2-.6-.2-.9-.2h-2.9V48h3.1c.8 0 1.1.2 1.2.8h.1v-5.3z" clip-path="url(#L)" fill="#FFF"></path>
                            <defs>
                                <path id="M" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="N">
                                <use xlink:href="#M" overflow="visible"></use>
                            </clipPath>
                            <path d="M53.7 43.5c0-.6.2-.9.6-1.2.3-.2.6-.2.9-.2h2.9V48h-3.2c-.8 0-1.1.2-1.2.8h-.1l.1-5.3z" clip-path="url(#N)" fill="#FFF"></path>
                            <defs>
                                <path id="O" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="P">
                                <use xlink:href="#O" overflow="visible"></use>
                            </clipPath>
                            <path d="M58.9 42.5v6.4h-4.6l-.1.2c-.1.2-.2.4-.7.4s-.7-.2-.7-.4l-.1-.2h-4.6v-6.4h-.5v.2l-.5-.1c-.1-.2-.2-.3-.4-.3s-.4.2-.4.4.2.4.4.4c.1 0 .2 0 .3-.1l.5.2v.5l-.4-.1c-.1-.1-.2-.2-.4-.2s-.4.2-.4.4.2.4.4.4c.1 0 .2 0 .3-.1l.5.1v.5h-.4c0-.1-.2-.2-.3-.2-.2 0-.4.2-.4.4s.2.4.4.4c.1 0 .3-.1.3-.2h.4v.6h-.4c-.1-.1-.2-.2-.3-.2-.2 0-.4.2-.4.4s.2.4.4.4c.1 0 .3-.1.3-.2h.4v.5l-.4.3c-.1-.1-.2-.1-.3-.1-.2 0-.4.2-.4.4s.2.4.4.4.3-.1.4-.2l.4-.1v.5l-.5.2c-.1-.1-.2-.1-.3-.1-.2 0-.4.2-.4.4s.2.4.4.4.3-.1.4-.3l.4-.1v.5l-.6.2c-.1 0-.1-.1-.2-.1-.2 0-.4.2-.4.4s.2.4.4.4.4-.1.4-.3l.4-.2v.5h4.8c.2.4.6.5 1 .5.6 0 .8-.2 1-.5h4.8v-6.8h-.3z" clip-path="url(#P)" fill="#FFF"></path>
                            <defs>
                                <path id="Q" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="R">
                                <use xlink:href="#Q" overflow="visible"></use>
                            </clipPath>
                            <path d="M50.3 40.4c-.9 0-1.8.2-1.8.4s.8.4 1.8.4c.9 0 1.8-.2 1.8-.4s-.9-.4-1.8-.4" clip-path="url(#R)" fill="#FFF"></path>
                            <defs>
                                <path id="S" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="T">
                                <use xlink:href="#S" overflow="visible"></use>
                            </clipPath>
                            <path d="m52.7 38.2-1 .8v.1l.3.1c.1 0 .1.1 0 .1l-.7.6h-.1l-.5-.7v-.1l.3-.1v-.1l-.7-1.1h-.1l-.8 1.1v.1l.3.1c.1 0 .1.1 0 .1l-.5.7h-.1l-.6-.6v-.1l.3-.1V39l-1-.8h-.1l.7 1.9c.3-.2 1-.3 1.9-.3.8 0 1.6.1 1.9.3l.5-1.9z" clip-path="url(#T)" fill="#FFF"></path>
                            <defs>
                                <path id="U" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="V">
                                <use xlink:href="#U" overflow="visible"></use>
                            </clipPath>
                            <path d="M53.5 53.1c-.9 0-1.8.2-1.8.4s.8.4 1.8.4c.9 0 1.8-.2 1.8-.4-.1-.2-.9-.4-1.8-.4" clip-path="url(#V)" fill="#FFF"></path>
                            <defs>
                                <path id="W" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="X">
                                <use xlink:href="#W" overflow="visible"></use>
                            </clipPath>
                            <path d="m55.8 50.9-1 .8v.1l.3.1c.1 0 .1.1 0 .1l-.7.6h-.1l-.5-.7v-.1l.3-.1v-.1l-.8-1.1h-.1l-.8 1.1v.1l.3.1c.1 0 .1.1 0 .1l-.5.7h-.1l-.5-.7v-.1l.3-.1v-.1l-1-.7h-.1l.7 1.9c.3-.2 1-.3 1.9-.3.8 0 1.6.1 1.9.3l.5-1.9z" clip-path="url(#X)" fill="#FFF"></path>
                            <defs>
                                <path id="Y" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                            </defs>
                            <clipPath id="Z">
                                <use xlink:href="#Y" overflow="visible"></use>
                            </clipPath>
                            <path d="M56.6 40.4c-.9 0-1.8.2-1.8.4s.8.4 1.8.4c.9 0 1.8-.2 1.8-.4s-.9-.4-1.8-.4" clip-path="url(#Z)" fill="#FFF"></path>
                            <g>
                                <defs>
                                    <path id="aa" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="ab">
                                    <use xlink:href="#aa" overflow="visible"></use>
                                </clipPath>
                                <path d="M59.1 38.2 58 39v.1l.3.1c.1 0 .1.1 0 .1l-.7.6h-.1l-.5-.7v-.1l.3-.1v-.1l-.7-1.1h-.1l-.8 1.1v.1l.3.1c.1 0 .1.1 0 .1l-.5.6h-.1l-.4-.6v-.1l.3-.1v-.1l-1-.8h-.1l.7 1.9c.3-.2 1-.3 1.9-.3.8 0 1.6.1 1.9.3l.4-1.8z" clip-path="url(#ab)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="ac" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="ad">
                                    <use xlink:href="#ac" overflow="visible"></use>
                                </clipPath>
                                <path d="M53.8 33.1c0 .2-.2.4-.4.4s-.4-.2-.4-.4.2-.4.4-.4.4.2.4.4" clip-path="url(#ad)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="ae" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="af">
                                    <use xlink:href="#ae" overflow="visible"></use>
                                </clipPath>
                                <path d="M62.2 36.5c0 .2-.2.4-.4.4s-.4-.2-.4-.4.2-.4.4-.4c.3 0 .5.1.4.4" clip-path="url(#af)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="ag" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="ah">
                                    <use xlink:href="#ag" overflow="visible"></use>
                                </clipPath>
                                <path d="M49.4 43c.2 0 .3 0 .4.1s.1.2.1.3c0 .3-.3.5-.6.5H49v-.1c.1 0 .1 0 .1-.2v-.5c0-.2 0-.2-.1-.2v-.1h.4v.2zm0 .7c0 .1 0 .1 0 0 .2.1.3 0 .3-.3s-.2-.4-.3-.4h-.1v.1l.1.6z" clip-path="url(#ah)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="ai" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aj">
                                    <use xlink:href="#ai" overflow="visible"></use>
                                </clipPath>
                                <path d="M50.9 43.4c0 .3-.2.5-.5.5s-.5-.2-.5-.5c0-.2.2-.5.5-.5.4.1.5.2.5.5m-.6 0c0 .3.1.4.2.4s.2-.1.2-.4c0-.3-.1-.4-.2-.4s-.2.2-.2.4" clip-path="url(#aj)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="ak" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="al">
                                    <use xlink:href="#ak" overflow="visible"></use>
                                </clipPath>
                                <path d="M52.1 43c-.1.1-.1.1-.1.2v.5c0 .2 0 .2.1.2v.1h-.4v-.1c.1 0 .1 0 .1-.2v-.5l-.3.7h-.1l-.3-.6v.5c0 .1 0 .1.1.1v.1h-.3v-.1c.1 0 .1 0 .1-.1v-.5c0-.2 0-.2-.1-.2V43h.3l.2.6.2-.6h.5z" clip-path="url(#al)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="am" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="an">
                                    <use xlink:href="#am" overflow="visible"></use>
                                </clipPath>
                                <path d="M52.5 43.7c0 .2 0 .2.1.2v.1h-.5v-.1c.1 0 .1 0 .1-.2v-.5c0-.2 0-.2-.1-.2v-.1h.5v.1c-.1 0-.1 0-.1.2v.5z" clip-path="url(#an)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="ao" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="ap">
                                    <use xlink:href="#ao" overflow="visible"></use>
                                </clipPath>
                                <path d="m50.5 45.5-.6-.7v.6s0 .1.1.1v.1h-.3v-.1c.1 0 .1 0 .1-.1v-.8h-.1v-.1h.3l.5.6v-.5s0-.1-.1-.1v-.1h.4v.1c-.1 0-.1 0-.1.1V45.5h-.2z" clip-path="url(#ap)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aq" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="ar">
                                    <use xlink:href="#aq" overflow="visible"></use>
                                </clipPath>
                                <path d="M50.9 45.5c-.1-.3-.2-.6-.3-.7 0-.1-.1-.1-.1-.1v-.1h.4v.1c-.1 0-.1 0 0 .1 0 .1.1.4.2.5 0-.1.1-.4.2-.4v-.2h.3v.1c-.1 0-.1 0-.2.1 0 0-.2.4-.3.7l-.2-.1z" clip-path="url(#ar)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="as" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="at">
                                    <use xlink:href="#as" overflow="visible"></use>
                                </clipPath>
                                <path d="M51.5 45.2c0 .1.1.2.2.2s.1 0 .1-.1-.1-.1-.1-.2c-.1-.1-.2-.1-.2-.3 0-.2.1-.3.3-.3h.2v.2h-.1c0-.1-.1-.2-.2-.2s-.1.1-.1.1c0 .1.1.1.1.2.1.1.2.1.2.3 0 .2-.1.3-.4.3H51.2c.3 0 .3-.1.3-.2z" clip-path="url(#at)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="au" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="av">
                                    <use xlink:href="#au" overflow="visible"></use>
                                </clipPath>
                                <path d="M49.8 46.8c0 .1 0 .2.1.2v.1h-.5V47c.1 0 .1 0 .1-.2v-.5c0-.2 0-.2-.1-.2V46h.5v.2c-.1 0-.1 0-.1.2v.4z" clip-path="url(#av)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aw" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="ax">
                                    <use xlink:href="#aw" overflow="visible"></use>
                                </clipPath>
                                <path d="M50.4 46.8c0 .1 0 .1 0 0l.2.1s0-.1.1-.1h.1c0 .1 0 .2-.1.2H50v-.1c.1 0 .1 0 .1-.2v-.5c0-.2 0-.2-.1-.2v-.1h.5v.3c-.1 0-.1 0-.1.2v.4z" clip-path="url(#ax)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="ay" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="az">
                                    <use xlink:href="#ay" overflow="visible"></use>
                                </clipPath>
                                <path d="M51.1 46.8c0 .1 0 .1 0 0l.2.1s0-.1.1-.1h.1v.2h-.7v-.1c.1 0 .1 0 .1-.2v-.5c0-.2 0-.2-.1-.2v-.1h.5v.3c-.1 0-.1 0-.1.2l-.1.4z" clip-path="url(#az)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aA" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aB">
                                    <use xlink:href="#aA" overflow="visible"></use>
                                </clipPath>
                                <path d="M51.7 47c-.1-.3-.2-.6-.3-.7 0-.1-.1-.1-.1-.1v-.1h.4v.1c-.1 0-.1 0 0 .1 0 .1.1.4.2.5 0-.1.1-.4.2-.4v-.2h.3c-.1 0-.1 0-.2.1 0 0-.2.4-.3.7h-.2z" clip-path="url(#aB)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aC" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aD">
                                    <use xlink:href="#aC" overflow="visible"></use>
                                </clipPath>
                                <path d="M55.4 43c-.1.1-.1.1-.1.2v.5c0 .2 0 .2.1.2v.1H55v-.1c.1 0 .1 0 .1-.2v-.5l-.3.7h-.1l-.3-.6v.5c0 .1 0 .1.1.1v.1h-.3v-.1c.1 0 .1 0 .1-.1v-.5c0-.2 0-.2-.1-.2V43h.3l.2.6.2-.6h.5z" clip-path="url(#aD)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aE" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aF">
                                    <use xlink:href="#aE" overflow="visible"></use>
                                </clipPath>
                                <path d="M55.8 43.7c0 .2 0 .2.1.2v.1h-.5v-.1c.1 0 .1 0 .1-.2v-.5c0-.2 0-.2-.1-.2v-.1h.5v.1c-.1 0-.1 0-.1.2v.5z" clip-path="url(#aF)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aG" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aH">
                                    <use xlink:href="#aG" overflow="visible"></use>
                                </clipPath>
                                <path d="M56.8 43.9h-.2l-.5-.7v.6s0 .1.1.1v.1h-.3v-.1c.1 0 .1 0 .1-.1V43h-.1v-.1h.3l.5.6v-.4s0-.1-.1-.1v-.1h.4v.1c-.1 0-.1 0-.1.1v.3l-.1.5z" clip-path="url(#aH)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aI" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aJ">
                                    <use xlink:href="#aI" overflow="visible"></use>
                                </clipPath>
                                <path d="M57.3 43.9c.1-.1.1-.1 0 0v-.2h-.2V44h-.3v-.1c.1 0 .1 0 .1-.1l.3-.7h.1l.1.3c.1.2.1.3.2.5 0 .1.1.1.1.1v.1l-.4-.2zm-.1-.3h.2l-.1-.3-.1.3z" clip-path="url(#aJ)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aK" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aL">
                                    <use xlink:href="#aK" overflow="visible"></use>
                                </clipPath>
                                <path d="M55.4 45.3c0 .1 0 .2.1.2v.1H55v-.1c.1 0 .1 0 .1-.2v-.6h-.2s0 .1-.1.1h-.1v-.3H55.5v.3h-.1c0-.1 0-.1-.1-.1h-.1v.6h.2z" clip-path="url(#aL)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aM" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aN">
                                    <use xlink:href="#aM" overflow="visible"></use>
                                </clipPath>
                                <path d="M56 45.3c0 .1 0 .2.1.2v.1h-.5v-.1c.1 0 .1 0 .1-.2v-.5c0-.2 0-.2-.1-.2v-.1h.5v.1c-.1 0-.1 0-.1.2v.5z" clip-path="url(#aN)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aO" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aP">
                                    <use xlink:href="#aO" overflow="visible"></use>
                                </clipPath>
                                <path d="M57.1 45c0 .3-.2.5-.5.5s-.5-.2-.5-.5c0-.2.1-.5.5-.5.3.1.5.2.5.5m-.6 0c0 .3.1.4.2.4s.2-.1.2-.4c0-.3-.1-.4-.2-.4s-.2.2-.2.4" clip-path="url(#aP)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aQ" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aR">
                                    <use xlink:href="#aQ" overflow="visible"></use>
                                </clipPath>
                                <path d="M55.8 46.1c-.1.1-.1.1-.1.3v.5c0 .2 0 .2.1.2v.1h-.4v-.1c.1 0 .1 0 .1-.2v-.5l-.3.7h-.1l-.3-.6v.5c0 .1 0 .1.1.1v.1h-.3v-.1c.1 0 .1 0 .1-.1v-.5c0-.2 0-.2-.1-.2v-.1h.3l.2.6.2-.6.5-.1z" clip-path="url(#aR)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aS" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aT">
                                    <use xlink:href="#aS" overflow="visible"></use>
                                </clipPath>
                                <path d="M55.9 46.4c0-.2 0-.2-.1-.2v-.1h.7v.2h-.1c0-.1 0-.1-.1-.1h-.2v.3h.1c.1 0 .1 0 .1-.1h.1v.3h-.1c0-.1 0-.1-.1-.1h-.1V46.9h.2s0-.1.1-.1h.1v.2h-.7v-.1c.1 0 .1 0 .1-.2v-.3z" clip-path="url(#aT)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aU" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aV">
                                    <use xlink:href="#aU" overflow="visible"></use>
                                </clipPath>
                                <path d="M57 47c.1 0 .1 0 0 0v-.2h-.2V47.1h-.3V47c.1 0 .1 0 .1-.1l.3-.7h.1l.1.3c.1.2.1.3.2.5 0 .1.1.1.1.1v.1L57 47zm-.2-.3h.2l-.1-.3-.1.3z" clip-path="url(#aV)" fill="#041E42"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aW" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aX">
                                    <use xlink:href="#aW" overflow="visible"></use>
                                </clipPath>
                                <path d="M52.3 57.8c0 .2-.2.4-.4.4s-.4-.2-.4-.4.2-.4.4-.4c.2.1.4.2.4.4" clip-path="url(#aX)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="aY" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="aZ">
                                    <use xlink:href="#aY" overflow="visible"></use>
                                </clipPath>
                                <path d="M55.8 58.4c0 .2-.2.4-.4.4s-.4-.2-.4-.4.2-.4.4-.4.4.2.4.4" clip-path="url(#aZ)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="ba" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bb">
                                    <use xlink:href="#ba" overflow="visible"></use>
                                </clipPath>
                            </g>
                            <g>
                                <defs>
                                    <path id="bc" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bd">
                                    <use xlink:href="#bc" overflow="visible"></use>
                                </clipPath>
                            </g>
                            <g>
                                <defs>
                                    <path id="be" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bf">
                                    <use xlink:href="#be" overflow="visible"></use>
                                </clipPath>
                            </g>
                            <g>
                                <defs>
                                    <path id="bg" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bh">
                                    <use xlink:href="#bg" overflow="visible"></use>
                                </clipPath>
                            </g>
                            <g>
                                <defs>
                                    <path id="bi" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bj">
                                    <use xlink:href="#bi" overflow="visible"></use>
                                </clipPath>
                            </g>
                            <g>
                                <defs>
                                    <path id="bk" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bl">
                                    <use xlink:href="#bk" overflow="visible"></use>
                                </clipPath>
                            </g>
                            <g>
                                <defs>
                                    <path id="bm" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bn">
                                    <use xlink:href="#bm" overflow="visible"></use>
                                </clipPath>
                                <path d="M43.8 51c.1 0 .5 0 .8.5.1.2.2.4.2.6 0 .4-.2.6-.6.8l-1.2.8-.3-.5 1.2-.8c.1-.1.3-.2.3-.4 0-.1 0-.2-.1-.3-.1-.2-.3-.2-.4-.2s-.3.1-.5.3l-1 .7-.2-.4 1.1-.8c.3-.2.5-.3.7-.3" clip-path="url(#bn)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bo" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bp">
                                    <use xlink:href="#bo" overflow="visible"></use>
                                </clipPath>
                                <path d="m41.8 50 1.5-.6.2.5-2.3.9-.2-.5 1.3-1.5-1.5.5-.2-.4 2.2-.8.2.4z" clip-path="url(#bp)" fill="#FFF"></path>
                            </g>
                            <g>
                                <path d="m40.17 46.984 2.472-.376.09.594-2.471.376z" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bq" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="br">
                                    <use xlink:href="#bq" overflow="visible"></use>
                                </clipPath>
                                <path d="m42.5 45-2.4.8v-.5l1.8-.6-1.8-.6.1-.5 2.3.9z" clip-path="url(#br)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bs" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bt">
                                    <use xlink:href="#bs" overflow="visible"></use>
                                </clipPath>
                                <path d="m40.4 42.3.4-1.5.4.1-.3 1 .6.2.2-1 .5.2-.3.9.6.2.2-1 .5.1-.5 1.4z" clip-path="url(#bt)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bu" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bv">
                                    <use xlink:href="#bu" overflow="visible"></use>
                                </clipPath>
                                <path d="m44.2 39.5-.8-.1c-.4 0-.4.1-.5.2v.1l.8.5-.3.5-2.2-1.1.4-.7c.2-.3.3-.6.8-.6.3 0 .7.2.7.7 0 .1 0 .2-.1.2.1-.1.3-.2.5-.2h.3l.7.1-.3.4zm-1.8-.7c-.1 0-.2.1-.3.3l-.1.1.6.3.1-.2c.1-.2.1-.3.1-.4 0-.1-.1-.2-.2-.2-.1.1-.2.1-.2.1" clip-path="url(#bv)" fill="#FFF"></path>
                            </g>
                            <g>
                                <path d="m45.182 34.706.479-.36 1.504 1.996-.48.36z" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bw" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bx">
                                    <use xlink:href="#bw" overflow="visible"></use>
                                </clipPath>
                                <path d="m47.9 33.5 1 1.8-.5.3-.9-1.8-.6.3-.2-.4 1.7-.9.2.4z" clip-path="url(#bx)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="by" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bz">
                                    <use xlink:href="#by" overflow="visible"></use>
                                </clipPath>
                                <path d="m50.8 33.7.2.9-.4.1-.3-.9-1.1-1.3.5-.1.8.8.3-1 .4-.1z" clip-path="url(#bz)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bA" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bB">
                                    <use xlink:href="#bA" overflow="visible"></use>
                                </clipPath>
                                <path d="m59.6 34.5.8.5-.2.4-.8-.5-.5.9-.4-.3 1.2-2.1 1.2.8-.1.3-.9-.4z" clip-path="url(#bB)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bC" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bD">
                                    <use xlink:href="#bC" overflow="visible"></use>
                                </clipPath>
                                <path d="m64.1 42.5.6-.8-1-.2-.1-.6 1.4.4.9-1 .1.5-.5.7.8.2.2.6-1.3-.4-1 1.1z" clip-path="url(#bD)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bE" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bF">
                                    <use xlink:href="#bE" overflow="visible"></use>
                                </clipPath>
                                <path d="M66.3 44.2h-.5v.9l-.3.1-.1-1-1.1.1v-.4l2.4-.2.2 1.4-.5.1z" clip-path="url(#bF)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bG" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bH">
                                    <use xlink:href="#bG" overflow="visible"></use>
                                </clipPath>
                                <path d="M68.1 45.4c.1-8-6.4-14.6-14.5-14.7-3.8 0-7.4 1.3-10.1 4-2.9 2.7-4.6 6.5-4.6 10.6 0 4.8 2.3 9.3 6.2 12.1.4 1.6 1.8 2.7 3.5 2.7.5 0 .9-.1 1.4-.3.5.2.9.3 1.4.4-.2.5-.4.8-.6 1.2l.4.4c.1-.1.2-.1.3-.1.3 0 .6.2.6.5s-.2.6-.6.6c-.2 0-.5-.1-.6-.4 0 0-.1.3-.1.7 0 1.1 1.2 2.3 2.7 2.7 1.6-.5 2.7-1.7 2.7-2.7 0-.4-.1-.7-.1-.7-.2.3-.4.4-.6.4-.4 0-.6-.3-.6-.6 0-.4.3-.5.6-.5.1 0 .2 0 .3.1l.3-.3c-.2-.4-.3-.8-.4-1 2.6-.4 4.8-1.5 6.6-3.3 3.6-3 5.7-7.3 5.8-11.8M48.6 59.5c-1.7 0-3-1.4-3-3.1 0-.6.1-1 .4-1.4l.5.5c-.2.3-.2.7-.2 1 0 .9.5 1.7 1.3 2.2.5.3 1 .6 1.7.8-.3-.1-.5 0-.7 0m4.9-4.5c-.6 0-1.1-.1-1.7-.2-.6-1.2-1.9-2-3.2-2-.4 0-.7.1-1 .2-2.4-1.8-3.9-4.7-3.9-7.7 0-5.4 4.3-9.7 9.7-9.7s9.8 4.3 9.8 9.7-4.4 9.7-9.7 9.7m2.1.3c-.3.4-.4.9-.5 1.5-.8-.2-1.7-.6-2.5-.8.1-.2.3-.4.8-.4h.1c.7-.1 1.3-.2 2.1-.3m-3.1.2c-.1.1-.2.2-.2.3-.3-.1-.9-.4-1.1-.6.2.1.9.2 1.3.3m-3.9-2.2c1 0 2 .6 2.5 1.3-.5-.1-.9-.3-1.4-.5-.3-.2-.7-.2-1-.2-.8 0-1.5.4-2 1l-.6-.3c.5-.7 1.4-1.3 2.5-1.3m6.8 7.7c-.6 0-.9.5-.9.9 0 .7.5 1 1 1h.2c-.2.8-1.1 1.6-2.2 2-1.1-.4-2.1-1.2-2.2-2h.2c.6 0 1-.4 1-1s-.4-.9-.9-.9c.1-.3.3-.6.4-.9.7.1 1.3.2 1.9.2.5 0 .9 0 1.4-.1 0 .3.2.7.1.8.1 0 .1 0 0 0m-1.6-1.2c-2 0-4.3-.7-6-1.6-.5-.3-1.1-.8-1.1-1.8 0-.3 0-.5.1-.7.7.6 1.3 1 1.7 1.2.1.1.2.1.3.1.3 0 .5-.2.5-.5 0-.2-.1-.4-.3-.5-.4-.2-1-.5-1.9-.8.4-.5.9-.8 1.5-.8.3 0 .6.1.8.2l.6.3c1.7 1 6 3.7 11.2 2.3-2 1.8-4.4 2.6-7.4 2.6m8.2-3.3c-2.4.8-4.5.8-6.4.4.1-.8.4-1.7.8-1.8 4.2-1.3 7.3-5.2 7.3-9.8 0-5.7-4.6-10.2-10.3-10.2s-10.3 4.6-10.3 10.2c0 3.1 1.4 6 3.8 7.9-.6.3-1 .7-1.4 1.2-.2-.1-.3-.3-.5-.4l-.1.1.5.5c-.3.6-.5 1.1-.5 1.8v.1c-3.6-2.7-5.7-6.9-5.7-11.4 0-3.9 1.6-7.5 4.4-10.2 2.6-2.5 6.1-3.9 9.7-3.8 7.7.1 14.1 6.4 14 14.2.2 4.5-1.8 8.6-5.3 11.2" clip-path="url(#bH)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bI" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bJ">
                                    <use xlink:href="#bI" overflow="visible"></use>
                                </clipPath>
                                <path d="M45.7 37.4c0 .2-.1.5-.3.7-.4.4-.8.4-.8.4l-.1-.5c.1 0 .4-.1.6-.3.1-.1.1-.2.1-.3 0-.1-.1-.3-.3-.3-.2 0-.6.3-.9.3-.1 0-.3 0-.5-.2s-.2-.3-.2-.5.1-.4.3-.6c.3-.4.7-.4.8-.4l.1.4s-.3.1-.5.3c-.1.1-.1.2-.1.3 0 .1.1.2.2.2.2 0 .7-.3.9-.3.2 0 .3 0 .5.2.1.2.2.4.2.6" clip-path="url(#bJ)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bK" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bL">
                                    <use xlink:href="#bK" overflow="visible"></use>
                                </clipPath>
                                <path d="M56.9 34.9c-.7 0-1.2-.5-1.2-1.2s.5-1.4 1.2-1.4 1.2.5 1.2 1.1-.4 1.5-1.2 1.5m.7-1.4c0-.2 0-.4-.1-.5-.1-.2-.3-.3-.5-.3-.5 0-.8.6-.8 1s.3.7.7.7.7-.6.7-.9" clip-path="url(#bL)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bM" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bN">
                                    <use xlink:href="#bM" overflow="visible"></use>
                                </clipPath>
                                <path d="M63.7 40.1c-.8 0-1.1-.8-1.1-1.2 0-.8.8-1.3 1.4-1.3.7 0 1.1.7 1.1 1.2 0 .7-.8 1.3-1.4 1.3m-.1-.5c.5 0 1-.4 1-.8s-.3-.6-.6-.6c-.4 0-1 .4-1 .8 0 .2.2.6.6.6" clip-path="url(#bN)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bO" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bP">
                                    <use xlink:href="#bO" overflow="visible"></use>
                                </clipPath>
                                <path d="M64.2 47.3c0-.6.4-1.2 1.2-1.2.7 0 1.3.4 1.3 1.1 0 .7-.4 1.2-1.2 1.2-.7.1-1.3-.4-1.3-1.1m1.4.7c.5 0 .8-.3.8-.7 0-.5-.6-.7-.9-.7-.6 0-.8.4-.8.7-.1.5.5.7.9.7" clip-path="url(#bP)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bQ" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bR">
                                    <use xlink:href="#bQ" overflow="visible"></use>
                                </clipPath>
                                <path d="M63.2 50.2h.8c.4 0 .4-.1.5-.3v-.1l-.8-.4.2-.5 2.2 1-.3.7c-.2.5-.4.7-.8.7-.3 0-.7-.2-.7-.7v-.2c-.1.2-.5.2-.7.2h-.7l.3-.4zm1.4.3c0 .2.2.4.4.4s.3-.1.4-.3l.1-.2-.7-.4-.1.2c-.1.1-.1.2-.1.3" clip-path="url(#bR)" fill="#FFF"></path>
                            </g>
                            <g>
                                <defs>
                                    <path id="bS" d="M2.8 25.8h71.4v71.3H2.8z"></path>
                                </defs>
                                <clipPath id="bT">
                                    <use xlink:href="#bS" overflow="visible"></use>
                                </clipPath>
                                <path d="M61.7 52.8c0-.5.2-.8.6-1.1l.3-.4 1.9 1.5-.5.6c-.3.3-.6.7-1 .7-.3 0-.6-.2-.8-.3-.2-.2-.5-.6-.5-1m1.3.8c.3 0 .4-.1.7-.5l.1-.1-1.2-1-.2.2c-.2.2-.2.4-.2.6 0 .2.1.5.4.7.1 0 .2.1.4.1" clip-path="url(#bT)" fill="#FFF"></path>
                            </g>
                        </g>
                        <g fill="#5D4777">
                            <path d="M129.3 69.8h-2.5v8.5h2.6c2.9 0 5.1-1.5 5.1-4.3s-2.1-4.2-5.2-4.2z"></path>
                            <path d="M82 58.9v38.3h117.7V58.9H82zM113.7 93h-7.3L94.2 75.1V93H87V62.9h7.4l12.1 17.6V62.9h7.3c-.1 0-.1 30.1-.1 30.1zm15.4-7.9h-2.3v7.8h-7.6v-30h9.4c8.8 0 13.6 4.2 13.6 10.8 0 6.1-4.6 11.4-13.1 11.4zm36.4-15.4h-12.2v5h11v6.2h-11v5.3h12.2V93h-19.8V62.9h19.8v6.8zm30.1 11.2c0 7.5-4.9 12.8-13 12.8-8 0-12.8-5.3-12.8-12.8v-18h7.6v18c0 3.8 2 5.8 5.2 5.8 3.3 0 5.3-2.1 5.3-5.8v-18h7.6l.1 18z"></path>
                        </g>
                        <image xlink:href="" src="/assets/images/brand-logos/unit/npeu-logo.png" alt="Logo: Oxford Population Health: NPEU" height="100" width="222"></image>
                    </svg></a>
            </span>

        </p>
    </div>

    <div class="d-background" data-fs-block="inverted flush">
        <div class="nav-bar" data-js="cmr" data-ie-safe-parent-level="1">

            <div class="nav-bar__start" data-area="navbar-controls">
                <div class="nav-bar__item">
                    <button class="over-panel-control" hidden="" aria-controls="menu-panel" aria-label="Main menu" aria-expanded="false" data-js="overpanel__control"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-closed">
                        <use xlink:href="#icon-menu"></use>
                        </svg><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-open">
                            <use xlink:href="#icon-cross"></use>
                        </svg></button>
                </div>
                <div class="nav-bar__item">
                    <button class="over-panel-control" hidden="" aria-controls="search-panel" aria-label="Search" aria-expanded="false" data-js="overpanel__control"><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-closed">
                            <use xlink:href="#icon-search"></use>
                        </svg><svg focusable="false" aria-hidden="true" width="1.25em" height="1.25em" display="none" class="icon  icon--is-open">
                            <use xlink:href="#icon-cross"></use>
                        </svg></button>
                </div>
            </div>

        </div>

    </div>


</header>
<div class="l-box  l-box--expand  d-border--bottom--thick">
    <main id="main" aria-labelledby="offline_heading">
        <div class="l-layout  l-row  l-gutter--l  l-flush-edge-gutter">
            <div class="l-layout__inner">
                <div class="l-box  ff-width-100--50--60">
                    <div class="c-panel  l-box--space--inline--l">
                        <header class="c-panel__header">
                            <h1 id="offline_heading" tabindex="-1"><?php echo $offline_page_title; ?></h1>
                        </header>
                        <?php if ($offline_message) : ?>
                        <p><?php echo $offline_message; ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="l-box  ff-width-100--50--40">
                    <div class="c-panel">
                        <form action="<?php echo Route::_('index.php', true); ?>" method="post" id="form-login">
                            <fieldset class="input">
                                <p id="form-login-username">
                                    <label for="username"><?php echo Text::_('JGLOBAL_USERNAME'); ?></label>
                                    <input name="username" id="username" type="text" class="inputbox" alt="<?php echo Text::_('JGLOBAL_USERNAME'); ?>" autocomplete="off" autocapitalize="none" />
                                </p>
                                <p id="form-login-password">
                                    <label for="passwd"><?php echo Text::_('JGLOBAL_PASSWORD'); ?></label>
                                    <input type="password" name="password" class="inputbox" alt="<?php echo Text::_('JGLOBAL_PASSWORD'); ?>" id="passwd" />
                                </p>
                                <p id="submit-button">
                                    <button type="submit" name="Submit" class="button login"><?php echo Text::_('JLOGIN'); ?></button>
                                </p>
                                <input type="hidden" name="option" value="com_users" />
                                <input type="hidden" name="task" value="user.login" />
                                <input type="hidden" name="return" value="<?php echo base64_encode(Uri::base()); ?>" />
                                <?php echo HTMLHelper::_('form.token'); ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>

</div>


<div class="l-box">

    <footer aria-label="Page" data-fs-text="center">
        <div class="d-border--bottom--thick">
            <div class="l-layout  l-row">
                <div class="l-layout__inner">
                    <div class="l-box  ff-width-100--40--50" data-position="6-footer-mid-left">
                        <div class="modstyle_magic--wrapper  t-npeu  l-box  l-box--expand">
                            <div class="c-panel">
                                <div class="u-fill-height  c-panel__module">

                                    <div class="l-layout  l-row  l-row--center  l-gutter  l-flush-edge-gutter  mod_social">
                                        <p class="l-layout__inner">

                                            <span class="l-box">
                                                <a class="c-badge  c-badge--limit-height--6  twitter" href="https://twitter.com/npeu_oxford" rel="external noopener noreferrer" target="_blank"><img alt="Twitter" height="60" onerror="this.src='/assets/images/brand-logos/social/twitter.png'; this.onerror=null;" src="/assets/images/brand-logos/social/twitter.svg"></a>
                                            </span>
                                            <span class="l-box">
                                                <a class="c-badge c-badge--limit-height--6 youtube" href="https://www.youtube.com/user/NPEUOxford" rel="external noopener noreferrer" target="_blank"><img alt="YouTube" height="60" onerror="this.src='/assets/images/brand-logos/social/youtube.png'; this.onerror=null;" src="/assets/images/brand-logos/social/youtube.svg"></a>
                                            </span>

                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-border--bottom--thick">
            <div class="l-layout  l-gutter  l-distribute  l-distribute--balance-top  l--basis-20">
                <p class="l-layout__inner">
                    <span class="l-box  l-box--center">
                        <a href="http://www.ndph.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank"><img src="/assets/images/brand-logos/affiliate/ndph-logo.svg" onerror="this.src='/assets/images/brand-logos/affiliate/ndph-logo.png'; this.onerror=null;" alt="Logo: Nuffield Department of Population Health" height="80" width="264"></a>
                    </span>
                    <span class="l-box  l-box--center">
                        <a href="http://www.ox.ac.uk/" class="c-badge  c-badge--limit-height" rel="external noopener noreferrer" target="_blank"><img src="/assets/images/brand-logos/affiliate/ou-logo-rect.svg" onerror="this.src='/assets/images/brand-logos/affiliate/ou-logo-rect.png'; this.onerror=null;" alt="Logo: University of Oxford" height="80" width="260"></a>
                    </span>
                </p>
            </div>
        </div>
        <div class="d-background--dark  page-footer">
            <div class="l-layout  l-row  l-gutter">
                <div class="l-layout__inner">
                    <div class="l-box  l-box--center">
                        <p class="c-utilitext   l-layout  l-row  l-row--start  l-gutter--xs  no-print">
                            <span role="list" class="l-layout__inner">
                                <span role="listitem" class="l-box">
                                    <a href="/"><span>NPEU Home</span></a>
                                </span>

                                <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                <span role="listitem" class="l-box">
                                    <a href="/about"><span>About the NPEU</span></a>
                                </span>

                                <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                <span role="listitem" class="l-box">
                                    <a href="/privacy-cookies"><span>Privacy &amp; Cookies</span></a>
                                </span>

                                <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                <span role="listitem" class="l-box">
                                    <a href="http://www.npeu.ox.ac.uk/accessibility"><span>Accessibility</span></a>
                                </span>

                                <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                <span role="listitem" class="l-box">
                                    <a href="#top"><span>Top of page</span></a>
                                </span>
                            </span>
                        </p>
                        <p class="c-utilitext   l-layout  l-row  l-row--start  l-gutter--xs  no-print">
                            <span role="list" class="l-layout__inner">
                                <span role="listitem" class="l-box">
                                    <a href="https://www.npeu.ox.ac.uk"><span>NPEU Main Site</span></a>
                                </span>

                                <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                <span role="listitem" class="l-box">
                                    <a href="https://www.npeu.ox.ac.uk/ctu"><span>NPEU CTU Site</span></a>
                                </span>

                                <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                <span role="listitem" class="l-box">
                                    <a href="https://www.npeu.ox.ac.uk/pru-mnhc"><span>PRU-MNHC Site</span></a>
                                </span>

                                <span class="l-box__separator">&nbsp;&nbsp;|&nbsp;&nbsp;</span>

                                <span role="listitem" class="l-box">
                                    <a href="https://www.npeu.ox.ac.uk/sheer"><span>NPEU SHEER Site</span></a>
                                </span>
                            </span>
                        </p>
                        <p class="c-utilitext   l-layout  l-row  l-row--start  l-gutter--xs">
                            <span class="l-layout__inner">
                                <span class="l-box">
                                    © NPEU <?php echo date('Y'); ?>
                                </span>
                            </span>
                        </p>
                    </div>
                    <div class="l-box  l-box--center">
                        <p class="c-panel  c-panel--rounded  d-background--white  d-border--thick">
                            <a href="https://www.npeu.ox.ac.uk/about/athena-swan" class="c-badge  c-badge--limit-height">
                                <img src="/assets/images/brand-logos/accolade/athena-swan-silver-logo.svg" onerror="this.src='/assets/images/brand-logos/accolade/athena-swan-silver-logo.png'; this.onerror=null;" alt="Logo: Athena Swan Silver Award" height="80" width="129">
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</div>
<?php
$offline_output = ob_get_contents();
ob_end_clean();

require_once('setup.php');

?>