<?php

	/**
	 * Scrape an Instagram user's public feed data
	 * @author  Ryan Boylett <http://boylett.uk/>
	 * @version 0.2.0
	 */
	
	function get_instagram_feed($username)
	{
		$username = trim($username);
        	$endpoint = 'https://www.instagram.com/' . $username;
		$feed     = array();

		$page = @file_get_contents($endpoint);

		if($page)
		{
		    preg_match("/window\._sharedData\s?=\s?(.*?);?\s?<\/script>/i", $page, $data);

		    if(isset($data[1]) and preg_match("/^({|\[)/", $data[1]) and preg_match("/(}|\])$/", $data[1]))
		    {
			$data = @json_decode($data[1], true);

			if($data)
			{
			    return $data;
			}
		    }
		}

		return $feed;
	}
