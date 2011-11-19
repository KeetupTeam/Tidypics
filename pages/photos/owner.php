<?php
/**
 * Show all the albums that belong to a user or group
 *
 * @author Cash Costello
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU General Public License v2
 */

group_gatekeeper();

$owner = elgg_get_page_owner_entity();

//set the title
$title = elgg_echo('album:user', array($owner->name));

// set up breadcrumbs
elgg_push_breadcrumb(elgg_echo('photos'), 'photos/all');
elgg_push_breadcrumb($owner->name);


$num_albums = 16;

elgg_push_context('tidypics:main');
$content = elgg_list_entities(array(
	'type' => 'object',
	'subtype' => 'album',
	'container_guid' => $owner->getGUID(),
	'limit' => $num_albums,
	'full_view' => false,
	'list_type' => 'gallery',
	'list_type_toggle' => false,
	'gallery_class' => 'tidypics-gallery',
));
elgg_pop_context();

elgg_register_title_button();

$body = elgg_view_layout('content', array(
	'filter_context' => 'mine',
	'content' => $content,
	'title' => $title,
	'sidebar' => elgg_view('tidypics/sidebar', array('page' => 'owner')),
));

echo elgg_view_page($title, $body);
