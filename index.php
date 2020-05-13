<?php
$hostname = $_SERVER["HTTP_HOST"];
$host_split = explode(".", $hostname);
$reverse_split = array_reverse($host_split);
$package = implode(".", $reverse_split);
header("X-Package: " . $package);

include "vars.php";

$headers = array(
    'Content-Type: application/json',
    'Authorization: Basic ' . AUTH,
    'User-Agent: PackageDomainRedirect'
);
$ch = curl_init("https://api.github.com/search/code?q=user:" . USER . "+\"package+" . $package . "\"");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$res = curl_exec($ch);
curl_close($ch);
$json = json_decode($res, true);

if (sizeof($json["items"]) <= 0) {
    http_response_code(404);
    echo "No Repository matching the domain found. Please check out https://github.com/" . USER . "?tab=repositories manually :)";
    return;
}

foreach ($json["items"] as $item) {
    //TODO: might wanna do some additional checks
    $repoUrl = $item["repository"]["html_url"];
    header("Location: " . $repoUrl);
    break;
}
