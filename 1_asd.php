<?php

//Declare array  * To store product into array
$name_array[] = array();
$rating_array[] = array();
$price_array[] =  array();
$href_array[] = array();
$image_array[] = array();


//error_reporting(0);


//if(isset($_POST['search_btn'])){

//size of this loop is depend on how many products you wants to retrieve
$_POST['search_txt'] = str_replace(" ","+",$_POST['search_txt']);
$_POST['search_txt'] = "football+shoe";
$html = file_get_contents( "https://www.qoo10.my/s?keyword='".$_POST['search_txt']."'");
libxml_use_internal_errors( true);
	$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);


for ($i=0;$i<5;$i++){

$Name = $xpath->query( '//div[@class="sbj"]/a')->item($i);
$name_array[$i] = $Name->textContent;
$Rating = $xpath->query( '//span[@class="rate_v"]')->item($i);
$rating_array[$i] = $Rating->textContent;
$Price = $xpath->query( '//div[@class="prc"]/strong')->item($i);
$price_array[$i] = $Price->textContent;
$href = $xpath->query( '//div[@class="sbj"]/a/@href')->item($i);
$href_array[$i] = $href->textContent;
// Reuse one more times file get content is because the image is difficult to retrieve , its only way to retrieve image from qoo10, others may be no need.
$html123 = file_get_contents($href_array[$i]);
libxml_use_internal_errors(true);
$doc123 = new DOMDocument;
$doc123->loadHTML( $html123);
$xpath123 = new DOMXpath($doc123);
$Image = $xpath123->query( '//div[@class="img"]/a/img/@content')->item(0);
$image_array[$i] = "<img src='".$Image->textContent."'>";
}

//}

?>

<body>
		
	<!--	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
			<input type="textbox" name="search_txt">
			<input type="submit" value="Search" name ="search_btn">
		</form>
-->		
		
		
		
		

<!--  --------------------------------------------------->


		<table border="2px solid black">
			<?php
		//	if(isset($_POST['search_btn'])){
			for ($j=0;$j<sizeof($name_array);$j++){
				echo "<tr colspan='3'>";
					echo "<td>";
						echo "Name :".$name_array[$j];
					echo "</td>";
					echo "<td>";
						echo "Price :".$price_array[$j];
					echo "</td>";
					echo "<td>";
						echo "Rating :".$rating_array[$j];
					echo "</td>";
					echo "<td style='height:100px'>";
						echo $image_array[$j];
					echo "</td>";
				echo "</tr>";
				
			}
		//	}
			?>
		</table>


</body>