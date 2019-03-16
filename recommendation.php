<?php

//$result_recommendation = false;
function recommendation($rating, $price,$budget) {
	
	
	
	$price = str_replace('RM ','',$price);
	$price = str_replace('RM','',$price);
	$rating = (float)$rating;
	$price = (float)$price;
	$budget = (float)$budget;
	$price_recomend = ($price/$budget);

	$final_rating =(($rating/5)*60);
	$recommendation_123 = (($final_rating)+((1-$price_recomend)*40));
return $recommendation_123;

	
}

?>