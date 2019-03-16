<?php

$html = file_get_contents( "https://www.lelong.com.my/catalog/all/list?TheKeyword=sport+equipment");
libxml_use_internal_errors( true);
	$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);

//var_dump($html);

$href = $xpath->query( '//img/@data-link')->item(0);
$href =($href->textContent);
$href =  str_replace("//","https://",$href);
$html123 = file_get_contents($href);
libxml_use_internal_errors( true);
$doc123 = new DOMDocument;
$doc123->loadHTML($html123);
$xpath123 = new DOMXpath($doc123);
$Image = $xpath123->query( '//div[@class="prd-img-div"]/div/div/a/img/@src')->item(0);
echo "<img src='".$Image->textContent."'>";
?>