<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_map
 *
 * @copyright   Copyright (C) NPEU 2019.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$doc = Factory::getDocument();

$template_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname(dirname(__DIR__)));

$map_id = 'map_' . $module->id;
$lat    = $params->get('lat');
$lng    = $params->get('lng');
$zoom   = $params->get('zoom');
$token  = $params->get('access_token');
$height = $params->get('height');
$legend = $params->get('legend');

#$doc->addStyleDeclaration('#' . $map_id . ' {min-height: ' . $height . 'px;}');
// Add Leaflet assets:
$doc->addStyleSheet($template_path . '/css/map.min.css');
$doc->addScript($template_path . '/js/map.min.js');

$markers = array_merge($manual_markers, $remote_markers);
$markers_json   = 'null';

if (!empty($markers)) {
    $markers_json = json_encode($markers);
}

$map_data = new StdClass();
$map_data->lat   = $lat;
$map_data->lng   = $lng;
$map_data->zoom  = $zoom;
$map_data->token = $token;

$static_map_alt   = $params->get('static_map_alt', '');
$static_map_no_js = $params->get('static_map_no_js', '');

$geojson = '';
if (!empty($markers)) {

    $static_markers = [
        'type' => 'FeatureCollection',
        'features' => []
    ];

    $feature_template = [
        'type' => 'Feature',
        'properties' => [
            'marker-color' => null,
            'marker-size' => 'small'
        ],
        'geometry' => [
            'type' => 'MultiPoint',
            'coordinates' => []
        ]
    ];

    $marker_colors = [
        'red'    => '#FD7567',
        'blue'   => '#6991FD',
        'green'  => '#00E64D',
        'yellow' => '#FDF569',
        'orange' => '#FF9900',
        'pink'   => '#E661AC',
        'purple' => '#8E67FD'
    ];

    $collection = [];

    foreach ($markers as $marker) {
        $color = $marker['color'];
        if (!array_key_exists($color, $collection)) {
            $collection[$color] = [];
        }

        $collection[$color][] = [(float) ($marker['lng'] == 'true' ? $lng : $marker['lng']), (float) ($marker['lat'] == 'true' ? $lat : $marker['lat'])];
    }

    foreach ($collection as $color => $coords) {
        $feature = $feature_template;
        $feature['properties']['marker-color'] = $marker_colors[$color];
        $feature['geometry']['coordinates'] = $coords;
        $static_markers['features'][] = $feature;
    }
    $geojson = urlencode('geojson(' . json_encode($static_markers) .')') .'/';
}
$static_map_src   = 'https://api.mapbox.com/styles/v1/mapbox/streets-v10/static/' . $geojson . $lng  . ',' . $lat  . ',' . $zoom . ',0,0/600x600?access_token=' . $token;

?>

<figure class="c-map  c-map--<?php echo $height; ?>  u-fill-height  mod_map" tabindex="0">
    <div id="<?php echo $map_id; ?>">
        <p class="u-text-align--center">
            <img class="c-map__static" src="<?php echo $static_map_src; ?>" alt="<?php echo $static_map_alt; ?>">
        </p>
        <p class="u-text-align--center">
            <?php echo $static_map_no_js; ?>
        </p>
    </div>
    <?php if (!empty(trim($legend))): ?>
    <figcaption class="l-box--space--block-start  user-content">
        <?php echo $legend; ?>
    </figcaption>
    <?php endif; ?>

    <script>
    if ($flbk.u.css_has_rule('.leaflet-container' )) {
        leafletMapInitialize('<?php echo $map_id; ?>', <?php echo json_encode($map_data); ?>, <?php echo $markers_json; ?>);
    }
    </script>
</figure>
