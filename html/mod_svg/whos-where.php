<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_svg
 *
 * @copyright   Copyright (C) NPEU 2020.
 * @license     MIT License; see LICENSE.md
 */

defined('_JEXEC') or die;


$doc = JFactory::getDocument();

$db    = JFactory::getDbo();
$query = $db->getQuery(true);

// Create the select statement.
$q  = 'SELECT u.id, u.name, u.email, up1.profile_value AS first_name, up2.profile_value AS last_name, up3.profile_value AS tel, up4.profile_value AS room, up5.profile_value AS alias, up6.profile_value AS avatar , up7.profile_value AS role ';
$q .= 'FROM `#__users` u ';
$q .= 'JOIN `#__user_usergroup_map` ugm ON u.id = ugm.user_id ';
$q .= 'JOIN `#__usergroups` ug ON ugm.group_id = ug.id ';
$q .= 'JOIN `#__user_profiles` up1 ON u.id = up1.user_id AND up1.profile_key = "firstlastnames.firstname" ';
$q .= 'JOIN `#__user_profiles` up2 ON u.id = up2.user_id AND up2.profile_key = "firstlastnames.lastname" ';
$q .= 'JOIN `#__user_profiles` up3 ON u.id = up3.user_id AND up3.profile_key = "staffprofile.tel" ';
$q .= 'JOIN `#__user_profiles` up4 ON u.id = up4.user_id AND up4.profile_key = "staffprofile.room" ';
$q .= 'JOIN `#__user_profiles` up5 ON u.id = up5.user_id AND up5.profile_key = "staffprofile.alias" ';
$q .= 'JOIN `#__user_profiles` up6 ON u.id = up6.user_id AND up6.profile_key = "staffprofile.avatar_img" ';
$q .= 'JOIN `#__user_profiles` up7 ON u.id = up7.user_id AND up7.profile_key = "staffprofile.role" ';
$q .= 'WHERE ug.title = "Staff" ';
$q .= 'AND u.block = 0 ';
$q .= 'ORDER BY last_name, first_name;';

$db->setQuery($q);
if (!$db->execute($q)) {
    JError::raiseError( 500, $db->stderr() );
    return false;
}

$staff_members = $db->loadAssocList();
#echo '<pre>'; var_dump($staff_members); echo '</pre>'; #exit;

// Process the data:

// It's friendlier to show first names, but there are sometimes conflicts (Jenny, Andy):
$first_names    = [];
$friendly_names = [];
$rooms          = [];
$room_to_names  = [];

foreach ($staff_members as $k => $staff) {

    $first_name = trim($staff['first_name']);
    if (!array_key_exists($first_name, $first_names)) {
        $first_names[$first_name] = 0;
    }
    $first_names[$first_name]++;



    $lastname = trim($staff['last_name']);
    $t = str_replace(' ', '-', $lastname);

    if (strpos($t, '-') !== false) {
        $lastname_initials = '';

        $parts = explode('-', $t);
        foreach($parts as $part) {
            $lastname_initials .= $part[0];
        }
    } else {
        $lastname_initials = $staff['last_name'][0];
    }

    $friendly_name = trim($staff['first_name']) . ' ' . $lastname_initials;
    if (!array_key_exists($friendly_name, $friendly_names)) {
        $friendly_names[$friendly_name] = 0;
    }
    $friendly_names[$friendly_name]++;
    $staff_members[$k]['friendly_name'] = $friendly_name;

    // Check the avatar while we're here:
    if (empty($staff['avatar'])) {
        $staff_members[$k]['avatar'] = '/assets/images/avatars/_none.jpg';
    }



    $room = empty($staff['room']) ? 'unassigned' : $staff['room'];
    if (!array_key_exists($room, $rooms)) {
        $rooms[$room] = [];
    }
    $rooms[$room][] = $k;
    $room_to_names[$room][] = $staff['name'];
}
#echo '<pre>'; var_dump($staff_members); echo '</pre>'; exit;
#echo '<pre>'; var_dump($room_to_names); echo '</pre>'; exit;
#echo '<pre>'; var_dump($rooms); echo '</pre>'; exit;
// 2nd pass to add the <tspan> elements to the svg:

foreach ($rooms as $room => $keys) {
    $s = '';
    $y = 0;
    foreach ($keys as $k) {

        $staff_member = $staff_members[$k];
        $name = trim($staff_member['first_name']);

        if ($first_names[$name] > 1) {

            $name = $staff_member['friendly_name'];
            if ($friendly_names[$name] > 1) {
                $name = trim($staff_member['name']);
            }
        }

        $s .= '<a href="#' . $staff_member['alias'] . '"><tspan x="0" y="' . $y . '" class="st12 st5 st13">' . $name . '</tspan></a>';
        $y += 7.8;
    }

    $module->content = str_replace('{' . $room . '}', $s, $module->content);
}

// <tspan x="0" y="0" class="st13 st4 st14">DAVE M </tspan><tspan x="0" y="7.8" class="st13 st4 st14">AAA </tspan><tspan x="0" y="15.6" class="st13 st4 st14">BBB </tspan>
#echo '<pre>'; var_dump($first_names); echo '</pre>'; #exit;
#echo '<pre>'; var_dump($friendly_names); echo '</pre>'; exit;
#echo '<pre>'; var_dump($rooms); echo '</pre>'; exit;
?>

<?php if ($module->showtitle): ?>
<<?php echo $params->get('header_tag'); ?>><?php echo $module->title; ?></<?php echo $params->get('header_tag'); ?>>
<?php endif; ?>
<figure class="u-space--below<?php if ($border) : ?>  d-bands  t-neutral<?php endif; ?>  mod_svg">
    <?php echo $module->content; ?>
</figure>

<?php if (!empty($rooms['unassigned'])) : ?>
<h2>Staff members with no rooms entered in their profile</h2>
<ul>
    <?php foreach ($rooms['unassigned'] as $k) : $m = $staff_members[$k]; ?>
    <li><a href="#<?php echo $m['alias']; ?>"><?php echo $m['name']; ?></a></li>
    <?php endforeach; ?>
</ul>
<?php endif; ?>

<h2>Staff member details</h2>
<div class="l-layout  l-gallery-grid  l-gallery-grid--gutter--m  l-gallery-grid--basis-15">
    <ul class="l-layout__inner">
        <?php foreach ($staff_members as $k => $staff) : ?>

        <li class="l-box  l-box--space--block">
            <article class="c-glimpse  c-glimpse--image-round  d-background--light" id="<?php echo $staff['alias']; ?>">

                <div data-fs-block="border">
                    <h3 class="c-glimpse__title"><span><?php echo $staff['first_name']; ?></span> <span><?php echo $staff['last_name']; ?></span></h3>


                    <div class="c-glimpse__image  d-border">
                        <div class="u-image-cover  js-image-cover  u-image-cover--min-100">
                            <div class="u-image-cover__inner">
                                <img src="<?php echo $staff['avatar']; ?>?s=300" sizes="100vw" srcset="<?php echo $staff['avatar']; ?>?s=1600 1600w, <?php echo $staff['avatar']; ?>?s=900 900w, <?php echo $staff['avatar']; ?>?s=300 300w" alt="" class="u-image-cover__image" width="120" height="120">
                            </div>
                        </div>
                    </div>

                    <div class="c-glimpse__body">

                        <p class="c-utilitext  c-utilitext--no-font-reduction"><?php echo $staff['role']; ?></p>
                        <p class="c-utilitext  c-utilitext--no-font-reduction"><a href="mailto:<?php echo $staff['email']; ?>"><svg height="20" width="20" focusable="false" aria-hidden="true"><use xlink:href="#icon-email"></use></svg> <span><?php echo $staff['email']; ?></span></a></p>
                        <?php if (!empty($staff['tel'])) : ?>
                        <p class="c-utilitext  c-utilitext--no-font-reduction  l-box--space--block--xs"><svg height="20" width="20" focusable="false" aria-hidden="true"><use xlink:href="#icon-phone"></use></svg> <span><?php echo $staff['tel']; ?></span></p>
                        <?php endif; ?>
                        <p class="c-utilitext  c-utilitext--no-font-reduction  l-box--space--block--xs  l-layout  l-row  l-row--start  l-gutter--xs  l-flush-edge-gutter">
                            <span class="l-layout__inner">
                                <span class="l-box"><a href="/about/people/<?php echo $staff['alias']; ?>"><svg height="20" width="20" focusable="false" aria-hidden="true"><use xlink:href="#icon-person"></use></svg> <span>Profile</span></a></span>&emsp;
                                <span class="l-box"><a href="/staff-area/whatson#user-<?php echo $staff['id']; ?>?whatson_filter=<?php echo urlencode($staff['name']) ?>"><svg height="20" width="20" focusable="false" aria-hidden="true"><use xlink:href="#icon-calendar"></use></svg> <span>WhatsOn</span></a><?php if (!empty($staff['room'])) : ?></span>&emsp;
                                <span class="l-box"><a href="#<?php echo strtolower(str_replace('/', '-', $staff['room'])); ?>"><svg height="20" width="20" focusable="false" aria-hidden="true"><use xlink:href="#icon-map-pin"></use></svg> <span>Office (<?php echo $staff['room']; ?>)</span></a><?php endif; ?></span>
                            </span>
                        </p>
                    </div>


                </div>

            </article>
        </li>

        <?php endforeach; ?>
    </ul>
</div>
