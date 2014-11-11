<?php
global $site_id, $secret_key, $api_url, $hostname;

$site_id		= '64610';
$secret_key		= '70ad29459b8bdf545334d26c2ccb2b656a1f5920';
$api_url 		= 'https://colobe.net/?wh=api';
$hostname		= 'colobe.net';

function colobe_get_client_ip() {
	foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
    	if (array_key_exists($key, $_SERVER) === TRUE) {
        	foreach (explode(',', $_SERVER[$key]) as $ip) {
            	$ip = trim($ip);
               	if (filter_var($ip, FILTER_VALIDATE_IP) !== FALSE)
                   	return $ip;
            }
       	}
    }
	
	return NULL;
}

function colobe_api($content) {
	global $api_url, $hostname;
	
	try {
		$post_cont = '';
		foreach($content as $key => $value) {
			$post_cont .= $key.'='.$value.'&';
		}
		$post_cont = rtrim($post_cont, '&');
		
		$ch = curl_init();
    	curl_setopt($ch, CURLOPT_HEADER, FALSE);
    	curl_setopt($ch, CURLOPT_URL, $api_url);
    	curl_setopt($ch, CURLOPT_REFERER, $api_url);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_cont);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    	$result = curl_exec($ch);
    	curl_close($ch);
    	
    	return $result;
	} catch (exception $e) {
		error_log($e->getMessage());
		return FALSE;
	}
}

function colobe_explode_api_result($result) {
	try {
		$result = explode('<br/>', $result);
		
		if (empty($result[count($result) - 1]))
			unset($result[count($result) - 1]);
		
		$res = array();
		foreach ($result as $r) {
			$r = explode(':', $r);
			
			$n = count($r);
			for ($i=0; $i < $n; $i += 2) {
				$res[trim($r[$i], '"')] = trim($r[$i + 1]);
			}
		}
		return $res;
	} catch (exception $e) {
		return array();
	}
}

/**
 * @return int
 *		-1 	=> error,
 *		0 	=> the client is a threat,
 *		1 	=> the client is reliable, 
 */
function colobe_get_client_info() {
	global $site_id, $secret_key, $api_url;
	
	$ip = colobe_get_client_ip();
	
	if (!empty($ip)) {
		$content = array(
			'api' => 'get-client-info',
			'site-id' => $site_id,
			'secret-key' => $secret_key,
			'client-ip' => $ip
		);
		$result = colobe_api($content);
		if ($result != FALSE) {
			$result = colobe_explode_api_result($result);
			if (isset($result['level'])) {
				if ($result['level'] == 'threat')
					return 0;
				else if ($result['level'] == 'reliable')
					return 1;
				else
					return -1;
			} else {
				return -1;
			}
		} else {
			return -1;
		}
	} else {
		return -1;
	}
}

/**
 * @return bool
 *		1 	=> done,
 *		0	=> error,
 */
function colobe_log_login($outcome) {
	global $site_id, $secret_key, $api_url;
	
	$ip = colobe_get_client_ip();
	
	if (!empty($ip)) {
		$content = array(
			'api' => 'log-login',
			'site-id' => $site_id,
			'secret-key' => $secret_key,
			'page-url' => ltrim($_SERVER['PHP_SELF'], '/'),
			'client-ip' => $ip,
			'outcome' => $outcome
		);
		$result = colobe_api($content);
		if ($result != FALSE) {
			$result = colobe_explode_api_result($result);
			if (isset($result['return'])) {
				if ($result['return'] == '1')
					return 1;
				else
					return 0;
			} else {
				return 0;
			}
		} else {
			return 0;
		}
	} else {
		return 0;
	}
}
?>