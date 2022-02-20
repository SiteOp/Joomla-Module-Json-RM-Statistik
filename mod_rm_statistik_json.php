<?php
/**
 * JSON Modul RM mod_rm_statistik_json.php
 *
 * @version         1.0.0
 * @package         mod_rm_statistik_json
 * @author          Richard Gebhard <gebhard@site-optimierer.de>
 * @copyright       Copyright © 2018 Site-Optimierer All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link            https://www.site-optimierer.de
 */

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

$user = Factory::getUser();
$isAdmin = $user->get('isRoot');

$doc = Factory::getDocument();

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

// Params
$debugapi        = $params->get('debugapi');

// Helper Variablen
$url           = modRmStatistikJsonHelper::getCurlUrl($params);
$curl          = modRmStatistikJsonHelper::getCurl($url, $params);
$jrequest      = modRmStatistikJsonHelper::getJson();
$css           = modRmStatistikJsonHelper::getCSS($params);

$rm_url        = $params->get('rm_url'); // URL der Routendatenbank
$url_rm_route  = "/component/act/route/"; // Link zu der Route 
$show_beginn_routes = $params->get('show_beginn_routes');
$show_beginn_comments = $params->get('show_beginn_comments');
if($jrequest->data->route !=0) {
    $count_routes  = count($jrequest->data->route);
}
if($jrequest->data->comment !=0) {
    $count_comments = count($jrequest->data->comment); 
}

require JModuleHelper::getLayoutPath('mod_rm_statistik_json', $params->get('layout', 'default'));
