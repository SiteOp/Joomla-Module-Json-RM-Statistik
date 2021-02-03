<?php
/**
 * Confair JSON Modul SiteOp mod_sop_json.php
 *
 * @version         1.0.0
 * @package         Mod_Sop_Json
 * @author          Richard Gebhard <gebhard@site-optimierer.de>
 * @copyright       Copyright © 2020 Site-Optimierer All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @link            https://www.site-optimierer.de
 */

// -- No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Factory;

/**
 * Helper for mod_sop_json
 *
 * @since    1.0.0
 */
class ModRmStatistikJsonHelper
{

	/**
	 * Creating the url for the JSON API Web Service
	 *
	 * @param   \Joomla\Registry\Registry  $params      module parameters
	 * @param   string                     $eventId     uniquely identify eventId
	 * @param   string                     $apiKey      The apiKey

	 *
	 * @return  string                                  The url
	 *
	 * @since   1.0.0
	 *
	 */


	public static function getCurlUrl($params)
	{
		$rm_url           = $params->get('rm_url');
		$endpoint         = $params->get('endpoint');
		$apiKey  	      = $params->get('apikey');
		$limit_comments   = $params->get('limit_comments'); 
		$limit_routes     = $params->get('limit_routes'); 
		

		
	$url = "$rm_url/$endpoint/get/rm_statistik/list?limit_routes=$limit_routes&limit_comments=$limit_comments&api_key=$apiKey";

		return $url;
	}

	/**
	 * cURL-Session
	 *
	 * @param   string                     $url        url API
	 * @param   \Joomla\Registry\Registry  $params     module parameters
	 * @param   string                     $refresh    Cache file always update -  boolean
	 * @param   interger                   $cachetime  Cache time in seconds
	 * @param   string                     $cache      The cache folder
	 *
	 * @return  void                                   json ../cache/json.cache
	 *
	 * @since    1.0.0
	 *
	 */
	public static function getCurl($url,$params)
	{
		$refresh     = $params->get("refresh");
		$cachetime   = $params->get("cachetime");
		$cache       = __DIR__ . "/cache/json.cache";

		if ($refresh || ((time() - filectime($cache)) > ($cachetime) || 0 == filesize($cache)))
		{
			// Read json source
			$ch = curl_init($url) or die("curl issue");
			$curlOptions = array(
				CURLOPT_RETURNTRANSFER   => true,
				CURLOPT_HEADER           => false,
				CURLOPT_FOLLOWLOCATION   => true,
				CURLOPT_ENCODING         => "",
				CURLOPT_AUTOREFERER      => true, 
				CURLOPT_CONNECTTIMEOUT   => 20,
				CURLOPT_HTTPHEADER => $headers,
				CURLOPT_TIMEOUT          => 20,
				CURLOPT_MAXREDIRS        => 3,
				CURLOPT_SSL_VERIFYHOST   => 2,
			);
			curl_setopt_array($ch, $curlOptions);
			$curlcontent = curl_exec($ch);
			curl_close($ch);

			$handle = fopen($cache, 'wb') or die('no fopen');
			$jsonCache = $curlcontent;
			fwrite($handle, $jsonCache);
			fclose($handle);
		}
		else
		{
			$jsonCache = file_get_contents($cache);
		}
	}

	/**
	 * Reading the cached file and decode json
	 *
	 * @param   \Joomla\Registry\Registry   $params       module parameters
	 * @param   string                      $data         The cached json - file cache/json.data
	 * @param   array                       $jsonrequest  The decode json
	 *
	 * @return   array
	 *
	 * @since    1.0.0
	 */
	public static function getJson()
	{
		$data = file_get_contents(dirname(__FILE__) . '/cache/json.cache');
		$jsonrequest = json_decode($data);

		return $jsonrequest;
	}



	/**
	 * Include assets
	 *
	 * @param   \Joomla\Registry\Registry  $params  module parameters
	 * @param   array                      $doc     Factory
	 * @param   string                     $css     Return css select yes/no
	 *
	 * @return   string
	 *
	 * @since    1.0.2
	 */
	public static function getCss($params)
	{
		$doc = Factory::getDocument();
		$css   = $params->get("css");

		if ($css != 1)
		{
			JHtml::stylesheet('mod_rm_statistik_json/style.css', false, true, false);
		}

		return $css;
	}

}

