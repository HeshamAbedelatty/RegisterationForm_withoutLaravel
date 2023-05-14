
<?php
$month=$_GET['month'];
$day=$_GET['day'];

$Api1='https://imdb8.p.rapidapi.com/actors/list-born-today?month='.$month.'&day='.$day;




//$cityId = $_REQUEST['CityID'];

$ch = curl_init();

curl_setopt_array($ch, [
	CURLOPT_URL => $Api1,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
		"X-RapidAPI-Key: cac0fff92fmsh8107ca2c0d83c16p1145f5jsn61926ceb8a26"
	],
]);

$actors_List=curl_exec($ch);
$actors_List=json_decode($actors_List);
curl_close($ch);






foreach($actors_List as $actor)
{
$actor=str_replace('/name/', "", $actor);
$actor=str_replace('/', "", $actor);
$Api2="https://imdb8.p.rapidapi.com/actors/get-bio?nconst=".$actor;
$ch2 = curl_init();

curl_setopt_array($ch2, [
	CURLOPT_URL => $Api2,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_FOLLOWLOCATION => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"X-RapidAPI-Host: online-movie-database.p.rapidapi.com",
		"X-RapidAPI-Key: cac0fff92fmsh8107ca2c0d83c16p1145f5jsn61926ceb8a26"
	],
]);
$details=curl_exec($ch2);
$details=json_decode($details);
curl_close($ch2);
echo $details->{'name'}."<br>";
$image = $details->{'image'}->{'url'};
$imageData = base64_encode(file_get_contents($image));
echo '<img src="data:image/jpeg;base64,'.$imageData.'"> ';

echo "------------------------------------------------------------ <br>";

}

?>

<style>
img {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 150px;
}
</style>