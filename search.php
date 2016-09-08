<?php
	function Discogs($query) {
		$url = "https://api.discogs.com/". $query;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'SNGRS/0.1 +http://sngrs.com');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result= curl_exec($ch);
		curl_close($ch);
		
		$someArray = json_decode($result, true);
		return $someArray;
	}
	
	function releaseLookup($id) {
		$query= "releases/". $id;
		$data = Array();
		$get = Discogs($query);
		
		/* Artiesten */
		$artists_array = $get["artists"];
		$artists_string = implode(', ', array_map(function ($entry) {
			return $entry['name'];
		}, $artists_array));
		$data[] = $artists_string;
		
		/* Genre */
		$genres_array = $get["genres"];
		$genres_string = implode(", ",$genres_array);
		$data[] = $genres_string;
		
		/* Titel */
		$data[]= $get["title"];
		
		/* Styles */
		$styles_array = $get["styles"];
		$styles_string = implode(", ",$styles_array);
		$data[] = $styles_string;
		
		/* Released */
		$data[]= $get["released"];
		
		return $data;
		
	}
	
	function albumArt($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_USERAGENT, 'SNGRS/0.1 +http://sngrs.com');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$result= curl_exec($ch);
		curl_close($ch);
		
		$save = file_put_contents('tmp.jpg',$result);
	}
	
	function dbSearch($title, $artist, $poging = NULL) {
		$token = "xuhACNGplutczfwscFJLZFNyICzKVPhgtwmvajKD";
		$query = "database/search?q=". rawurlencode($title) . "%20" . rawurlencode($artist) . "&token=" . $token;
		$go = Discogs($query)["results"][$poging];
		$id = $go["id"];
		$thumb = $go["thumb"];
		albumArt($thumb);
		$array2 = array($thumb);
		
		$result = array_merge(releaseLookup($id), $array2);
		print_r($result);
		return $result;
	}
	
	dbSearch("sylva", "snarky puppy", 0);
	?>