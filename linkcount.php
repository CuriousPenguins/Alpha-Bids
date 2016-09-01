<?
function GoogleBL($domain){
$url="http://ajax.googleapis.com/ajax/services/search/web?v=1.0&q=link:".$domain."&filter=0";
$ch=curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_HEADER, 0);
curl_setopt ($ch, CURLOPT_NOBODY, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$json = curl_exec($ch);
curl_close($ch);
$data=json_decode($json,true);
if($data['responseStatus']==200)
return $data['responseData']['cursor']['resultCount'];
else
return false;
}
?>