<?php
namespace juanmicl\igcreator;

function randstring($lenght){
	return substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $lenght);
}

function curl_request($request, $url, $payload, $header){
	$curl = curl_init();
	curl_setopt_array($curl, array(
		//CURLOPT_PROXY => $proxy,
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_CUSTOMREQUEST => $request,
		CURLOPT_POSTFIELDS => http_build_query($payload),
		CURLOPT_HTTPHEADER => $header,
	));
	return curl_exec($curl);
	curl_close($curl);
}

class create {

	public function register($username, $password, $email, $firstname){

		$url = 'https://www.instagram.com/accounts/web_create_ajax/';
		$payload = array(
			'email' => $email,
			'password' => $password,
			'username' => $username,
			'first_name' => $firstname,
			'client_id' => randstring('28'),
			'seamless_login_enabled' => '1',
			'gdpr_s' => '%5B0%2C2%2C0%2Cnull%5D',
			'tos_version' => 'eu',
			'opt_into_one_tap' => 'false',
		);
		$header = array(
			'Cache-Control: no-cache',
			'Content-Type: application/x-www-form-urlencoded',
			'Referer: https://www.instagram.com/',
			'User-Agent: Mozilla/5.0 (Linux; Android 6.0.1; SM-G935T Build/MMB29M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/51.0.2704.81 Mobile Safari/537.36',
			'X-CSRFToken: '.randstring('32'),
		);

		$res = curl_request('POST', $url, $payload, $header);
		echo $res;
	}

	public function register_rand($domain){

		$url = 'https://randomuser.me/api/?nat=en&password=number,lower,10';
		$payload = array();
		$header = array();
		$randomuser = json_decode(curl_request('GET', $url, $payload, $header), true);
		
		$username = $randomuser['results'][0]['login']['username'];
		$password = $randomuser['results'][0]['login']['password'];
		$email = $username.'@'.$domain;
		$firstname = $randomuser['results'][0]['name']['first'].' '.$randomuser['results'][0]['name']['last'];

		$url = 'https://www.instagram.com/accounts/web_create_ajax/';
		$payload = array(
			'email' => $email,
			'password' => $password,
			'username' => $username,
			'first_name' => $firstname,
			'client_id' => randstring('28'),
			'seamless_login_enabled' => '1',
			'gdpr_s' => '%5B0%2C2%2C0%2Cnull%5D',
			'tos_version' => 'eu',
			'opt_into_one_tap' => 'false',
		);
		$header = array(
			'Cache-Control: no-cache',
			'Content-Type: application/x-www-form-urlencoded',
			'Referer: https://www.instagram.com/',
			'User-Agent: Mozilla/5.0 (Linux; Android 6.0.1; SM-G935T Build/MMB29M; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/51.0.2704.81 Mobile Safari/537.36',
			'X-CSRFToken: '.randstring('32'),
		);

		$res = curl_request('POST', $url, $payload, $header);
		echo $res;
		echo '<br>';
		echo $username.'<br>';
		echo $password;

	}

	public function testo(){

		$url = 'https://randomuser.me/api/?nat=en&password=number,lower,10';
		$payload = array();
		$header = array();
		$randomuser = json_decode(curl_request('GET', $url, $payload, $header), true);
		var_dump($randomuser['results'][0]['login']['username']);
	}
}