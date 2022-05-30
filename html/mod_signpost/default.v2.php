<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_signpost
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;


$doc = JFactory::getDocument();

$signs = (array) $params->get('signs');

JLoader::register('TplNPEU6Helper', dirname(dirname(__DIR__)) . '/helper.php');
$page_brand = TplNPEU6Helper::get_brand();
$theme = 't-' . $page_brand->alias;
#echo '<pre>'; var_dump($page_brand); echo '</pre>'; exit;
?>
<?php if (count($signs) > 0) : ?>
<div class="u-fill-height  mod_signpost">
    <div class="c-signpost">
        <?php foreach ($signs as $sign): ?>
        <?php if (isset($sign->status) && $sign->status == '0') { continue; } ?>
        <?php
            $sign_class= 'c-sign  d-background--sloped';
            if ($sign->colspan) {
                $sign_class .= '  c-sign--span-all';
            }
            
            $sfx_class= '';
            if (!empty($sign->signclass_sfx)) {
                $sfx_class = $sign->signclass_sfx;
            }
            
            $padding_class = '';
            if ($sign->padding) {
                $padding_class = '  l-box--space--block--l';
            }
            
            $svg = '';
            if (!empty($sign->svg)) {
                $svg = '<span class="c-sign__svg" style="background-image: url(\'data:image/svg+xml;base64,' . base64_encode($sign->svg) . '\');"></span>';
            }
            
            $sign_content = $sign->content;
            
            $data_src = $sign->data_src;
            if (!empty($data_src)) {

                $data_tpl        = $sign->content;
                $data_src_err    = $sign->data_src_err;
                $data_decode_err = $sign->data_decode_err;

                // Allow for relative data src URLs:
                if (strpos($data_src, 'http') !== 0) {
                    $s        = empty($_SERVER['SERVER_PORT']) ? '' : ($_SERVER['SERVER_PORT'] == '443' ? 's' : '');
                    $protocol = preg_replace('#/.*#',  $s, strtolower($_SERVER['SERVER_PROTOCOL']));
                    $domain   = $protocol.'://'.$_SERVER['SERVER_NAME'];
                    $data_src = $domain . '/' . trim($data_src, '/');
                }

                if (!$data = file_get_contents($data_src)) {
                    $sign_content = $data_src_err;
                } else {
                    if (!$json = json_decode($data)) {
                        $sign_content = $data_decode_err;
                    } else {
                        $twig = ModSignpostHelper::getTwig(array(
                            'tpl' => $data_tpl
                        ));

                        $sign_content = $twig->render('tpl', array('data' => $json));
                    }
                }
            }
        ?>
        <div class="<?php echo $sign_class; ?> <?php echo $theme . $sfx_class; ?>">
            <a href="<?php echo $sign->url; ?>" class="c-sign__link">
                <span class="c-sign__centered-content<?php echo $padding_class; ?>">
                    <?php echo $svg; ?>
                    <?php echo $sign_content; ?>
                </span>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>