<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * VMT
 *
 * A volunteer management system.
 *
 * @package     VMT
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 * @copyright   Copyright (c) 2009 - 2010, Guillermo A. Fisher
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * VMT Application RSS Library
 *
 * This class provides functionality for parsing RSS feeds.
 *
 * @package     VMT
 * @subpackage  Libraries
 * @category    Libraries
 * @author      Guillermo A. Fisher <guillermoandraefisher@gmail.com>
 */
class VMT_Rss
{

	/**
	 * Parses the feed.
	 * 
	 * @param string $url  The feed URL
	 * @param int $num_items  OPTIONAL The number of feed items to parse
	 * @param int $lifetime  OPTIONAL The cache lifetime in minutes
	 * @return stdClass  The parsed feed data
	 */
	public function parse($url, $num_items = 5, $lifetime = 60)
	{
		$feed = new stdClass();
		if ($data = $this->_get_feed($url, $lifetime)) {
			$xml = simplexml_load_string($data);
			$feed->title = $xml->channel->title;
			$feed->url = $xml->channel->link;
			$i = 0;
			foreach ($xml->channel->item as $item) {
				$entry = new stdClass();
				$entry->title = $item->title;
				$entry->url = $item->link;
				$entry->date = $item->pubDate;
				$feed->entries[] = $entry;
				if ($i == $num_items - 1) {
					break;
				}
				$i++;
			}
		}
		return $feed;
	}

	// --------------------------------------------------------------------

	/**
	 * Pulls either the live feed or the cached version.
	 * 
	 * @param string $url  The feed URL
	 * @param int $lifetime  OPTIONAL The cache lifetime in minutes
	 * @return string  The feed
	 */
	protected function _get_feed($url, $lifetime)
	{
		$name = 'rss-' . md5($url) . '.cache';
		$ci =& get_instance();
		$ci->load->driver('cache', array('adapter' => 'file'));
		if (!$data = $ci->cache->get($name)) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$data = curl_exec($ch);
			curl_close($ch);
			$ci->cache->save($name, $data, $lifetime*60);				
		}
		return $data;	
	}
	
}