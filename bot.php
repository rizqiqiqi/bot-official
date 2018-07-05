<?php
/*
just for fun
*/
require_once('./line_class.php');
require_once('./unirest-php-master/src/Unirest.php');
$channelAccessToken = '2DhKDawTbkCxm56SHeASscjhCK9Ag8JN3XT9HTA/zxat5MGbN9UGd8mgvc2HZdTBj/eIiqT1ZEttf9HCWKqPkR8zXO/M61JEoBTQdbjyaTRHfldYJYbMM2Z33Xw5F8YqFnbIqw3jgErkcht3JsN64QdB04t89/1O/w1cDnyilFU='; //sesuaikan
$channelSecret = '10b16df672083bc921ad50e99cd19c2f';//sesuaikan
$client = new LINEBotTiny($channelAccessToken, $channelSecret);
$userId 	= $client->parseEvents()[0]['source']['userId'];
$groupId 	= $client->parseEvents()[0]['source']['groupId'];
$replyToken = $client->parseEvents()[0]['replyToken'];
$timestamp	= $client->parseEvents()[0]['timestamp'];
$type 		= $client->parseEvents()[0]['type'];
$message 	= $client->parseEvents()[0]['message'];
$messageid 	= $client->parseEvents()[0]['message']['id'];
$profil = $client->profil($userId);
$pesan_datang = explode(" ", $message['text']);
$pesan_simi = explode("Sally ", $message['text']);
$siminya = $pesan_simi[1];
$msg_type = $message['type'];
$command = $pesan_datang[0];
$options = $pesan_datang[1];
if (count($pesan_datang) > 2) {
    for ($i = 2; $i < count($pesan_datang); $i++) {
        $options .= '+';
        $options .= $pesan_datang[$i];
    }
}
#-------------------------[Function]-------------------------#
function simi($keyword) {
    $uri = "https://corrykalam.gq/simi.php?text=" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = $json["answer"];
    return $result;
}
function say($keyword) { 
    $uri = "https://script.google.com/macros/exec?service=AKfycbw7gKzP-WYV2F5mc9RaR7yE3Ve1yN91Tjs91hp_jHSE02dSv9w&nama=" . $keyword . "&tanggal=10-05-2003"; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
 $result .= $json['data']['nama']; 
    return $result; 
}
function instapoto($keyword) {
    $uri = "https://ari-api.herokuapp.com/instagram?username=" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = $json['result']['profile_pic_url'];
    return $result;
}
function film_syn($keyword) {
    $uri = "http://www.omdbapi.com/?t=" . $keyword . '&plot=full&apikey=d5010ffe';

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = "Judul : \n";
	$result .= $json['Title'];
	$result .= "\n\nSinopsis : \n";
	$result .= $json['Plot'];
    return $result;
}
function film($keyword) {
    $uri = "http://www.omdbapi.com/?t=" . $keyword . '&plot=full&apikey=d5010ffe';

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = " 「 FILM 」\n\n";
    $result = "Judul : ";
	$result .= $json['Title'];
	$result .= "\nRilis pada : ";
	$result .= $json['Released'];
	$result .= "\nTipe : ";
	$result .= $json['Genre'];
	$result .= "\nPemain : ";
	$result .= $json['Actors'];
	$result .= "\nBahasa : ";
	$result .= $json['Language'];
	$result .= "\nDari negara : ";
	$result .= $json['Country'];
    return $result;
}
function ytdownload($keyword) {
    $uri = "http://wahidganteng.ga/process/api/b82582f5a402e85fd189f716399bcd7c/youtube-downloader?url=" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "-Judul : \n";
	$result .= $json['title'];
	$result .= "\n-Type : ";
	$result .= $json['data']['type'];
	$result .= "\n-Ukuran : ";
	$result .= $json['data']['size'];
	$result .= "\n-Alamat : ";
	$result .= $json['data']['link'];
    return $result;
}
function insta($keyword) {
    $uri = "https://ari-api.herokuapp.com/instagram?username=" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = " 「 INFO INSTAGRAM 」\n\n";
    $result .= "DisplayName : ";
    $result .= $json['result']['full_name'];
    $result .= "\nUserName : ";
    $result .= $json['result']['username'];
    $result .= "\nPrivasi : ";
    $result .= $json['result']['is_private'];
    $result .= "\nPengikut : ";
    $result .= $json['result']['byline'];
    $result .= "\n\n https://www.instagram.com/" . $keyword;
    return $result;
}

function youtubelist($keyword) {
    $uri = "https://ari-api.herokuapp.com/youtube/search?q=" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $parsed = " 「 YOUTUBE LIST 」\n\n";
    $parsed .= "ID: ";
    $parsed .= $json['result'][0]['id'];
    $parsed .= "\nJUDUL\n";
    $parsed .= $json['result'][0]['title'];
    $parsed .= "\nURL\n";
    $parsed .= $json['result'][0]['link'];
    $parsed .= "\n\nID: ";
    $parsed .= $json['result'][1]['id'];
    $parsed .= "\nJUDUL\n";
    $parsed .= $json['result'][1]['title'];
    $parsed .= "\nURL\n";
    $parsed .= $json['result'][1]['link'];
    $parsed .= "\n\nID: ";
    $parsed .= $json['result'][2]['id'];
    $parsed .= "\nJUDUL\n";
    $parsed .= $json['result'][2]['title'];
    $parsed .= "\nURL\n";
    $parsed .= $json['result'][2]['link'];
    $parsed .= "\n\nID: ";
    $parsed .= $json['result'][3]['id'];
    $parsed .= "\nJUDUL\n";
    $parsed .= $json['result'][3]['title'];
    $parsed .= "\nURL\n";
    $parsed .= $json['result'][3]['link'];
    $parsed .= "\n\nID: ";
    $parsed .= $json['result'][4]['id'];
    $parsed .= "\nJUDUL\n";
    $parsed .= $json['result'][4]['title'];
    $parsed .= "\nURL\n";
    $parsed .= $json['result'][4]['link'];
    return $parsed;
}

function music($keyword) { 
    $uri = "http://api.ntcorp.us/joox/search?q=" . $keyword . ""; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result = " 「 MUSIK 」 ";
    $result .= "\nJudul : ";
    $result .= $json['0']['0'];
    $result .= "\nDurasi : ";
    $result .= $json['0']['1'];
    $result .= "\nAlamat : ";
    $result .= $json['0']['4'];
    $result .= "\n\nPencarian : Google";
    return $result; 
}

function urb_dict($keyword) {
    $uri = "http://api.urbandictionary.com/v0/define?term=" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = $json['list'][0]['definition'];
    $result .= "\n\nContoh : \n";
    $result .= $json['list'][0]['example'];
    return $result;
}

function qrcode($keyword) {
    $uri = "http://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=" . $keyword;
    return $uri;
}

function quotes($keyword) {
    $uri = "http://quotes.rest/qod.json?category=" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = "Result : ";
	$result .= $json['success']['total'];
	$result .= "\n-Quotes : ";
	$result .= $json['contents']['quotes']['quote'];
	$result .= "\n-Author : ";
	$result .= $json['contents']['quotes']['author'];
    return $result;
}

function google_image($keyword) {
    $uri = "https://ari-api.herokuapp.com/images?q=" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = $json['result'][0];	
    return $result;
}
function image_neon($keyword) {
    $uri = "https://ari-api.herokuapp.com/neon?text=" . $keyword;	
    return $uri;
}

function bodybuilder($keyword) {
    $uri = "https://ari-api.herokuapp.com/bodybuilder?url=" . $keyword;
    return $uri;
}

function zodiak($keyword) {
    $uri = "https://script.google.com/macros/exec?service=AKfycbw7gKzP-WYV2F5mc9RaR7yE3Ve1yN91Tjs91hp_jHSE02dSv9w&nama=ervan&tanggal=" . $keyword;

    $response = Unirest\Request::get("$uri");

    $json = json_decode($response->raw_body, true);
    $result = " 「 Zodiak 」 ";
    $result .= "\n-Lahir : ";
	$result .= $json['data']['lahir'];
	$result .= "\n-Usia : ";
	$result .= $json['data']['usia'];
	$result .= "\n-Ultah : ";
	$result .= $json['data']['ultah'];
	$result .= "\n-Zodiak : ";
	$result .= $json['data']['zodiak'];
	$result .= "\n\nPencarian : Google";
    return $result;
}

function manga($keyword) {

    $fullurl = 'https://myanimelist.net/api/manga/search.xml?q=' . $keyword;
    $username = 'jamal3213';
    $password = 'FZQYeZ6CE9is';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_VERBOSE, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_URL, $fullurl);

    $returned = curl_exec($ch);
    $xml = new SimpleXMLElement($returned);
    $parsed = array();

    $parsed['id'] = (string) $xml->entry[0]->id;
    $parsed['image'] = (string) $xml->entry[0]->image;
    $parsed['title'] = (string) $xml->entry[0]->title;
    $parsed['desc'] = "Episode : ";
    $parsed['desc'] .= $xml->entry[0]->episodes;
    $parsed['desc'] .= "\nNilai : ";
    $parsed['desc'] .= $xml->entry[0]->score;
    $parsed['desc'] .= "\nTipe : ";
    $parsed['desc'] .= $xml->entry[0]->type;
    $parsed['synopsis'] = str_replace("<br />", "\n", html_entity_decode((string) $xml->entry[0]->synopsis, ENT_QUOTES | ENT_XHTML, 'UTF-8'));
    return $parsed;
}

function ps($keyword) { 
    $uri = "https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20171227T171852Z.fda4bd604c7bf41f.f939237fb5f802608e9fdae4c11d9dbdda94a0b5&text=" . $keyword . "&lang=id-id"; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
    $result .= "-Nama : ";
    $result .= $json['text']['0'];
    $result .= "\n-Link: ";
    $result .= "https://play.google.com/store/search?q=" . $keyword . "";
    $result .= "\n\nPencarian : PlayStore";
    return $result; 
}

function manga_syn($title) {
    $parsed = manga($title);
    $result = "-Judul : " . $parsed['title'];
    $result .= "\n\n-Sinopsis :\n" . $parsed['synopsis'];
    return $result;
}

function jadwaltv() {
    $uri = "https://ari-api.herokuapp.com/jadwaltv";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = " 「 Jadwal Tv 」\n\n";
    $result .= "Waktu :";
    $result .= $json['result'][0]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][0]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][0]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][1]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][1]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][1]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][2]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][2]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][2]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][3]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][3]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][3]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][4]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][4]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][4]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][5]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][5]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][5]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][6]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][6]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][6]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][7]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][7]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][7]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][8]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][8]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][8]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][9]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][9]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][9]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][10]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][10]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][10]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][11]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][11]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][11]["channelName"];
    $result .= "\n\nWaktu :";
    $result .= $json['result'][12]["jam"];
    $result .= "\n[ Judul ]\n";
    $result .= $json['result'][12]["acara"];
    $result .= "\n[ CHANNEL ]\n";
    $result .= $json['result'][12]["channelName"];
    return $result;
}
function shalat($keyword) {
    $uri = "https://time.siswadi.com/pray/" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = " 「 Jadwal Waktu Sholat 」\n\n";
	  $result .= $json['location']['address'];
	  $result .= "\nTanggal : ";
	  $result .= $json['time']['date'];
	  $result .= "\n\nShubuh : ";
	  $result .= $json['data']['Fajr'];
	  $result .= "\nDzuhur : ";
	  $result .= $json['data']['Dhuhr'];
	  $result .= "\nAshar : ";
	  $result .= $json['data']['Asr'];
	  $result .= "\nMaghrib : ";
	  $result .= $json['data']['Maghrib'];
	  $result .= "\nIsya : ";
	  $result .= $json['data']['Isha'];
    return $result;
}
function cuaca($keyword) {
    $uri = "http://api.openweathermap.org/data/2.5/weather?q=" . $keyword . ",ID&units=metric&appid=e172c2f3a3c620591582ab5242e0e6c4";
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = " 「 Cuaca 」 ";
    $result .= "\n\nNama kota:";
	  $result .= $json['name'];
	  $result .= "\n\nCuaca : ";
	  $result .= $json['weather']['0']['main'];
	  $result .= "\nDeskripsi : ";
	  $result .= $json['weather']['0']['description'];
    return $result;
}
function waktu($keyword) {
    $uri = "https://time.siswadi.com/pray/" . $keyword;
    $response = Unirest\Request::get("$uri");
    $json = json_decode($response->raw_body, true);
    $result = " 「 Waktu 」 ";
    $result .= "\nLokasi : ";
	$result .= $json['location']['address'];
	$result .= "\nJam : ";
	$result .= $json['time']['time'];
	$result .= "\nSunrise : ";
	$result .= $json['debug']['sunrise'];
	$result .= "\nSunset : ";
	$result .= $json['debug']['sunset'];
    return $result;
}
function qibla($keyword) { 
    $uri = "https://time.siswadi.com/qibla/" . $keyword; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
 $result .= $json['data']['image'];
    return $result; 
}
function adfly($url, $key, $uid, $domain = 'adf.ly', $advert_type = 'int')
{
  // base api url
  $api = 'http://api.adf.ly/api.php?';

  // api queries
  $query = array(
    '7970aaad57427df04129cfe2cfcd0584' => $key,
    '16519547' => $uid,
    'advert_type' => $advert_type,
    'domain' => $domain,
    'url' => $url
  );

  // full api url with query string
  $api = $api . http_build_query($query);
  // get data
  if ($data = file_get_contents($api))
    return $data;
}
function lokasi($keyword) { 
    $uri = "https://time.siswadi.com/pray/" . $keyword; 
 
    $response = Unirest\Request::get("$uri"); 
 
    $json = json_decode($response->raw_body, true); 
 $result['address'] .= $json['location']['address'];
 $result['latitude'] .= $json['location']['latitude'];
 $result['longitude'] .= $json['location']['longitude'];
    return $result; 
}
function send($input, $rt){
    $send = array(
        'replyToken' => $rt,
        'messages' => array(
            array(
                'type' => 'text',					
                'text' => $input
            )
        )
    );
    return($send);
}
function jawabs(){
    $list_jwb = array(
		'Ya',
	        'Bisa jadi',
	        'Mungkin',
	        'Gak tau',
	        'Woya donk',
	        'Jawab gk yah!',
		'Tidak',
		'Coba ajukan pertanyaan lain',	    
		);
    $jaws = array_rand($list_jwb);
    $jawab = $list_jwb[$jaws];
    return($jawab);
}
#-------------------------[Function]-------------------------#
# require_once('./src/function/search-1.php');
# require_once('./src/function/download.php');
# require_once('./src/function/random.php');
# require_once('./src/function/search-2.php');
# require_once('./src/function/hard.php');
if ($type == 'join') {
    $text = "Terimakasih sudah mengundang Puy ke Grup\n\nInfo perintah Puy :\n#menu\n#Creator\n#myinfo";
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
            array(
                'type' => 'text',
                'text' => $text
            )
        )
    );
}
//show menu, saat join dan command /menu
if ($command == '#menu') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
          array (
  'type' => 'template',
  'altText' => 'Perintah Puy',
  'template' =>
  array (
    'type' => 'carousel',
    'columns' =>
    array (
        0 =>
      array (
        'thumbnailImageUrl' => 'https://img.buzzfeed.com/buzzfeed-static/static/2016-07/7/15/campaign_images/buzzfeed-prod-web12/i-am-tired-of-watching-black-people-die-2-29975-1467919446-2_dblbig.jpg',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'PEMBUAT PUY',
        'text' => 'KLIK DISINI',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'https://line.me/ti/p/~heefpuy',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#creator',
          ),
        ),
      ),
       1 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'DEFINISI',
        'text' => 'Menampilkan definisi',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#definisi botak',
          ),
        ),
      ),
      2 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'PLAYSTORE',
        'text' => 'Mencari isi PlayStore',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#playstore tiktok ',
          ),
        ),
      ),
      3 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'GOOGLE IMAGE',
        'text' => 'Menampilkan gambar dari Google',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#carigambar sarahvilo',
          ),
        ),
      ),
      4 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'TIME',
        'text' => 'Menampilkan Waktu saat ini',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#waktu depok',
          ),
        ),
      ),
      5 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'PRAYTIME',
        'text' => 'Menampilkan Jadwal Waktu Sholat',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#jshalat depok',
          ),
        ),
      ),
      6 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'YOUTUBE',
        'text' => 'Menampilkan video video dari youtube',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#youtube sarahvilo',
          ),
        ),
      ),
      7 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'FILM',
        'text' => 'Mencari Film',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#film kuntilanak',
          ),
        ),
      ),
      8 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'TV JADWAL',
        'text' => 'Menampilkan Jadwal TV',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#jadwaltv',
          ),
        ),
      ),
      9 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'CUACA',
        'text' => 'Menampilkan Cuaca',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#cuaca depok',
          ),
        ),
      ),
    ),
    'imageAspectRatio' => 'rectangle',
    'imageSize' => 'cover',
  ),
)
)
);
}
if ($command == '#menus') {
    $balas = array(
        'replyToken' => $replyToken,
        'messages' => array(
          array (
  'type' => 'template',
  'altText' => 'Perintah Puy',
  'template' =>
  array (
    'type' => 'carousel',
    'columns' =>
    array (
        10 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'INSTAGRAM',
        'text' => 'Stalk Instagram Akun',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#instainfo muh.khadaffy',
          ),
        ),
      ),
       11 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'FILM INFO',
        'text' => 'Menampilkan info film',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#filminfo warkop dki',
          ),
        ),
      ),
      12 =>
      array (
        'thumbnailImageUrl' => 'https://em.wattpad.com/49d77b703d641e9ce98fd54cdf88b622f9de1124/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f776174747061642d6d656469612d736572766963652f53746f7279496d6167652f4f4161326e596176346b465972513d3d2d31382e313463613930336637373331356434303737373632383633363835362e6a7067?s=fit&w=720&h=720',
        'imageBackgroundColor' => '#00FFFF',
        'title' => 'YtVidGet',
        'text' => 'Mengambil video dari Youtube',
        'defaultAction' =>
        array (
          'type' => 'uri',
          'label' => 'View detail',
          'uri' => 'http://heefpuy18.eaters.me/',
        ),
        'actions' =>
        array (
          0 =>
          array (
            'type' => 'message',
            'label' => 'CONTOH',
            'text' => '#ytget garox',
          ),
        ),
      ),
    ),
    'imageAspectRatio' => 'rectangle',
    'imageSize' => 'cover',
  ),
)
)
);
}
//fitur googlemap
if($message['type']=='text') {
	    if ($command == '#lokasi') {
        $result = lokasi($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'location',
                    'title' => 'Lokasi',
                    'address' => $result['address'],
                    'latitude' => $result['latitude'],
                    'longitude' => $result['longitude']
                ),
            )
        );
    }
}
//fitur musik
if($message['type']=='text') {
	    if ($command == '#carimusik') {
        $result = music($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//fitur sound cloud
//if($message['type']=='text') {
	//    if ($command == '/soundcloud' || $command == '/Soundcloud') {
      //  $result = cloud($options);
    //    $balas = array(
  //          'replyToken' => $replyToken,
//            'messages' => array(
		//    array(
              //    'type' => 'audio',
            //      'originalContentUrl' => $result['audio'],
          //        'duration' => 60000
        //        )
      //      )
    //    );
  //  }
//}
if($message['type']== 'text'){
    $pesan_datang = strtolower($message['text']);
    $filter = explode(' ', $pesan_datang);
    if($filter[0] == '#apakah') {
        $balas = send(jawabs(), $replyToken);
    }
}
// fitur instagram
if($message['type']=='text') {
	    if ($command == '#instainfo') {
        $resultnya = instapoto($options);
        $result = insta($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
		array(
                  'type' => 'image',
                  'originalContentUrl' => $resultnya,
                  'previewImageUrl' => $resultnya
                ),
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//fitur film
if($message['type']=='text') {
	    if ($command == '#film') {

        $result = film($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//fitur quotes
if($message['type']=='text') {
        if ($command == '#quotes') {
        $result = quotes($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text'  => $result
                )
            )
        );
    }
}
//fitur synfilm
if($message['type']=='text') {
        if ($command == '#filminfo') {
        $result = film_syn($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array( 
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//fitur youtube
if($message['type']=='text') {
	    if ($command == '#youtube') {
        $result = youtubelist($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '#myinfo') {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(

										'type' => 'text',					
										'text' => '「 Info Profile 」

-Nama : '.$profil->displayName.'
-Status : '.$profil->statusMessage.'
Picture : '.$profil->pictureUrl.'
'
                                    )
                            )
                        );
    }
}
if($message['type']=='text') {
	    if ($command == '#creator') {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(

										'type' => 'text',					
										'text' => '「 Creator 」

Creator by PUY

The Beginning of this Bot Comes from Rynda, Im just Reworked This!
Of Course Special Thanks To Ryndaaaaa, And the Friends Around Me!'
									)
							)
						);
				
	}
}
//fitur qr
if($message['type']=='text') {
	    if ($command == '#qr') {
        $result = qrcode($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $result,
                    'previewImageUrl' => $result
                )
            )
        );
    }
}
//fitur zodiak
if($message['type']=='text') {
	    if ($command == '#zodiak') {
        $result = zodiak($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//fitur replymsg
if($message['type']=='text') {
	    if ($command == 'Halo' || $command == 'Hai' || $command == 'Woi' || $command == 'Bot' ) {

        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'iya kak? Ketik #menu untuk info perintah Puy!, '.$profil->displayName
                )
            )
        );
    }
}
//fitur pstore
if($message['type']=='text') {
	    if ($command == '#playstore') {

        $result = ps($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }

}
//fitur manga
if($message['type']=='text') {
	    if ($command == '#manga') {
        $result = manga($options);
        $altText = "Title : " . $result['title'];
        $altText .= "\n\n" . $result['desc'];
        $altText .= "\nMAL Page : https://myanimelist.net/manga/" . $result['id'];
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'template',
                    'altText' => $altText,
                    'template' => array(
                        'type' => 'buttons',
                        'title' => $result['title'],
                        'thumbnailImageUrl' => $result['image'],
                        'text' => $result['desc'],
                        'actions' => array(
                            array(
                                'type' => 'postback',
                                'label' => 'Baca Sinopsis-nya',
                                'data' => 'action=add&itemid=123',
                                'text' => '/manga-syn' . $options
                            ),
                            array(
                                'type' => 'uri',
                                'label' => 'Website MAL',
                                'uri' => 'https://myanimelist.net/manga/' . $result['id']
                            )
                        )
                    )
                )
            )
        );
    }
}
//fitur sinopsis manga
if($message['type']=='text') {
	    if ($command == '#manga-syn') {

        $result = manga_syn($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//fitur waktu
if($message['type']=='text') {
	    if ($command == '#waktu') {
        $result = waktu($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//fitur kata 
if($message['type']=='text') {
	    if ($command == '#katakan') {
        $result = say($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//fitur definisi
if ($message['type'] == 'text') {
    if ($command == '#definisi') {
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => 'Definisi : ' . urb_dict($options)
                )
            )
        );
    }
}
//fitur yt-get
if($message['type']=='text') {
	    if ($command == '/ytget') {
        $result = ytdownload($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => ytdownload($options)
                )
            )
        );
    }
}
//fitur gambar kiblat
if($message['type']=='text') {
	    if ($command == '#qiblat') {
        $hasil = qibla($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'image',
                    'originalContentUrl' => $hasil,
                    'previewImageUrl' => $hasil
                )
            )
        );
    }
}

if($message['type']=='text') {
	    if ($command == '#carigambar') {
        $result = google_image($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                  'type' => 'image',
                  'originalContentUrl' => $result,
                  'previewImageUrl' => $result
                )
            )
        );
    }
}
if($message['type']=='text') {
	    if ($command == '#gambarneon') {
        $result = image_neon($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                  'type' => 'image',
                  'originalContentUrl' => $result,
                  'previewImageUrl' => $result
                )
            )
        );
    }
}

if($message['type']=='text') {
	    if ($command == '#bodybuilder') {
        $result = bodybuilder($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                  'type' => 'image',
                  'originalContentUrl' => $result,
                  'previewImageUrl' => $result
                )
            )
        );
    }
}

if($message['type']=='text') {
	    if ($command == '#jadwaltv') {
        $result = jadwaltv();
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}
//fitur pray
if($message['type']=='text') {
	    if ($command == '#jshalat') {
        $result = shalat($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}

//fitur cuaca
if($message['type']=='text') {
	    if ($command == '#cuaca') {
        $result = cuaca($options);
        $balas = array(
            'replyToken' => $replyToken,
            'messages' => array(
                array(
                    'type' => 'text',
                    'text' => $result
                )
            )
        );
    }
}

if (isset($balas)) {
    $result = json_encode($balas);
//$result = ob_get_clean();
    file_put_contents('./balasan.json', $result);
    $client->replyMessage($balas);
}
?>
