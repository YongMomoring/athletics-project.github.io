<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Karma Shop</title>

	<!--
            CSS
            ============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/main.css">
</head>

<?php

require_once("recommendation.php");	
$name_array[] = array();
$rating_array[] = array();
$price_array[] =  array();
$href_array[] = array();
$image_array[] = array();

error_reporting(0);

if($_GET[urlencode('Category')]!= null){
	$Category = $_GET[urlencode('Category')];
	$Category = str_replace(" ", "+", $Category);
}else{
	$Category = "soccer+shoe";
}

if(isset($_POST['budget_filter'])!= null){
	$abcd = $_POST['budget_filter'];
}else{
	$abcd = 100;
}

$html = file_get_contents("https://www.qoo10.my/s?keyword=".$Category."");
libxml_use_internal_errors( true);
$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);

for ($i=0;$i<8;$i++){
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
$image_array[$i] = $Image->textContent;
}
?>


<?php
//For lelong.my
//index starts from 8 onwards
$html = file_get_contents( "https://www.lelong.com.my/catalog/all/list?TheKeyword=".$Category."");
libxml_use_internal_errors( true);
$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);

for ($i=0;$i<8;$i++){
$Name = $xpath->query( '//div[@class="summary"]/a/b/@data-name')->item($i);
$name_array[$i+8] = $Name->textContent;
$rating_array[$i+8] = 0;
$Price = $xpath->query( '//span[@class="price"]/b')->item($i);
$price_array[$i+8] = $Price->textContent;
$href = $xpath->query( '//div[@class="summary"]/a/@href')->item($i);
$href_array[$i+8] = $href->textContent;
$href = $xpath->query( '//img/@data-link')->item($i);
$href =($href->textContent);
$href =str_replace("//","https://",$href);
$html123 = file_get_contents($href);
libxml_use_internal_errors(true);
$doc123 = new DOMDocument;
$doc123->loadHTML($html123);	
$xpath123 = new DOMXpath($doc123);
$Image = $xpath123->query( '//div[@class="prd-img-div"]/div/div/a/img/@src')->item(0);
$image_array[$i+8] = $Image->textContent;
}
?>


<?php
//For sportsdirect.com
// index starts from 16
$html = file_get_contents("https://my.sportsdirect.com/SearchResults?DescriptionFilter=".$Category."");
libxml_use_internal_errors(true);
$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);

for ($i=0;$i<8;$i++){
$Pname = $xpath->query( '//span[@class="productdescriptionname"]')->item($i);
$Bname = $xpath->query('//span[@class="productdescriptionbrand"]')->item($i);
$Name = ($Bname->textContent." ".$Pname->textContent);
$name_array[$i+16] = $Name;
$rating_array[$i+16] = 0;
$Price = $xpath->query( '//span[@class=" curprice productHasRef"]')->item($i);
if($Price->textContent == NULL)
{
$Price = $xpath->query( '//span[@class=" curprice "]')->item($i);
}
$price_array[$i+16] = $Price->textContent;
$href = $xpath->query( '//div[@class="s-producttext-top-wrapper"]/a/@href')->item($i);
$href_array[$i+16] = ("https://my.sportsdirect.com".$href->textContent);
$html123 = file_get_contents($href_array[$i+16]);
libxml_use_internal_errors(true);
$doc123 = new DOMDocument;
$doc123->loadHTML($html123);
$xpath123 = new DOMXpath($doc123);
$Image = $xpath123->query( '//div[@class="easyzoom"]/img/@src')->item(0);
$image_array[$i+16] = $Image->textContent;
}
?>

<?php
//For ebay 
// index starts from 24
$html = file_get_contents("https://www.ebay.com.my/sch/i.html?_from=R40&_trksid=m570.l1313&_nkw=".$Category."&_oac=1");
libxml_use_internal_errors(true);
$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);

for ($i=0;$i<8;$i++){
$Name = $xpath->query( '//div[@class="gvtitle"]/h3/a')->item($i);
if($Name->textContent == NULL)
{
	$Name = $xpath->query( '//h3[@class="lvtitle"]/a')->item($i);
}
$name_array[$i+24] = $Name->textContent;
var_dump($name_array[$i+24]);
$rating_array[$i+24] = 0;
$Price = $xpath->query( '//span[@class="amt bold"]')->item($i);
while ($Price->textContent == NULL)
{
	$Price = $xpath->query( '//span[@class="amt"]/span')->item($i);
	$Price = $xpath->query( '//span[@class="bold"]')->item($i);
}
$price_array[$i+24] = $Price->textContent;
$href = $xpath->query('//div[@class="gvtitle"]/h3/a/@href')->item($i);
if($href->textContent == NULL)
{
	$href = $xpath->query('//h3[@class="lvtitle"]/a/@href')->item($i);
}
$href_array[$i+24] = $href->textContent;
$html123 = file_get_contents($href_array[$i+24]);
libxml_use_internal_errors(true);
$doc123 = new DOMDocument;
$doc123->loadHTML($html123);
$xpath123 = new DOMXpath($doc123);
$Image = $xpath123->query( '//img[@class="img img300"]/@src')->item(0);
$image_array[$i+24] = $Image->textContent;
}
?>
	<script>
function myFunction() {
  var x = document.getElementById("yongasd").value;
  document.getElementById("budget_filter").value = x;

  //button click
 document.getElementById("submit_budget").click();
}
</script>	
<body id="category">
					
	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
							<li class="nav-item submenu dropdown active">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Shop</a>
								<ul class="dropdown-menu">
									<li class="nav-item active"><a class="nav-link" href="category.html">Shop Category</a></li>
									<li class="nav-item"><a class="nav-link" href="single-product.html">Product Details</a></li>
									<li class="nav-item"><a class="nav-link" href="checkout.html">Product Checkout</a></li>
									<li class="nav-item"><a class="nav-link" href="cart.html">Shopping Cart</a></li>
									<li class="nav-item"><a class="nav-link" href="confirmation.html">Confirmation</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Pages</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
									<li class="nav-item"><a class="nav-link" href="tracking.html">Tracking</a></li>
									<li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
					
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Fashon Category</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
					<div class="head"></div>
					<ul class="main-categories">
						<li class="main-nav-list"><a data-toggle="collapse" href="#fruitsVegetable" aria-expanded="false" aria-controls="fruitsVegetable"><span
								 class="lnr lnr-arrow-right"></span><span class="number"></span></a>
						</li>

						<li class="main-nav-list"><a data-toggle="collapse" href="#meatFish" aria-expanded="false" aria-controls="meatFish"><span
								 class="lnr lnr-arrow-right"></span><span class="number"></span></a>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#cooking" aria-expanded="false" aria-controls="cooking"><span
								 class="lnr lnr-arrow-right"></span><span class="number"></span></a>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#beverages" aria-expanded="false" aria-controls="beverages"><span
								 class="lnr lnr-arrow-right"></span><span class="number"></span></a>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#homeClean" aria-expanded="false" aria-controls="homeClean"><span
								 class="lnr lnr-arrow-right"></span><span class="number"></span></a>
						</li>
						<li class="main-nav-list"><a href="#"><span class="number"></span></a></li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#officeProduct" aria-expanded="false" aria-controls="officeProduct"><span
								 class="lnr lnr-arrow-right"></span><span class="number"></span></a>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#beauttyProduct" aria-expanded="false" aria-controls="beauttyProduct"><span
								 class="lnr lnr-arrow-right"></span><span class="number"></span></a>
						</li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#healthProduct" aria-expanded="false" aria-controls="healthProduct"><span
								 class="lnr lnr-arrow-right"></span><span class="number"></span></a>
						</li>
						<li class="main-nav-list"><a href="#"><span class="number"></span></a></li>
						<li class="main-nav-list"><a data-toggle="collapse" href="#homeAppliance" aria-expanded="false" aria-controls="homeAppliance"><span
								 class="lnr lnr-arrow-right"></span><span class="number"></span></a>
						</li>
						<li class="main-nav-list"><a class="border-bottom-0" data-toggle="collapse" href="#babyCare" aria-expanded="false"></a>
						</li>
					</ul>
				</div>
				
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head"></div>
					<div class="common-filter">
						<div class="head"></div>
						<form action="#">
						</form>
					</div>
					<div class="common-filter">
						<div class="head">Budget</div>
						<div class="price-range-area">
							<div id="price-range"></div>
							<div class="value-wrapper d-flex">
								<div class="price">Price:</div>
								<span>$</span>
								<div id="lower-value"></div>
								<div class="to">to</div>
								<span>$</span>
								<div id="upper-value"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">
				<!-- Start Filter Bar -->

				<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="POST">
				<input type="hidden" name="budget_filter" id="budget_filter">
				<input type="submit" id="submit_budget" style="display:none;">
				</form>
				<div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting">
						<select id="yongasd" onchange="myFunction()">
							<option value="100">100</option>
							<option value="200">200</option>
							<option value="300">300</option>
						</select>
					</div>
					<div class="sorting mr-auto">
						<select>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
						</select>
					</div>
					<div class="pagination">
						<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
						<a href="#" class="active">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
						<a href="#">6</a>
						<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				<!-- End Filter Bar
				
			-------------------------------------	Recommendation-------------------
				-->

				<?php
				$budget=100;
				(int)$Recommendation_Array[] = array();
				$total_recommendation_array[] = array();
				$recommendation_index_array[] = array();
				$total_recommendation_index_array[] = array();		
				//gets the best recommendation score for qoo10;
				for ($j=0;$j<8;$j++){
					if($price_array[$j] < $budget){
					echo "price: ".$price_array[$j];
					$Final_Rating = substr($rating_array[$j], 9, -3);
					if ($Final_Rating==0){$Final_Rating = 3;}
					else{$Final_Rating = (int)$Final_Rating ;}
					echo "  Rating: ".$Final_Rating;
					echo "  Budget:  100    ";
					$Recommendation_Array[$j] = recommendation($Final_Rating,$price_array[$j],$budget);
					echo "Final: ".recommendation($Final_Rating,$price_array[$j],$budget);
					echo "<br>------------------------------------<br>";
					
				}
			}
			$recommendation_index_array[0] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[0] = $Recommendation_Array[$recommendation_index_array[0]]; 
			$Recommendation_Array[$recommendation_index_array[0]] = 0;
			$recommendation_index_array[1] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[1] =$Recommendation_Array[$recommendation_index_array[1]];
			$Recommendation_Array[$recommendation_index_array[1]] = 0;
			$recommendation_index_array[2] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[2] = $Recommendation_Array[$recommendation_index_array[2]];
			for($j=0;$j<8;$j++){
				$Recommendation_Array[$j]=0;
			}
  ?>	

				<?php
				//gets the best recommendation score for lelong.my;
				for ($j=8;$j<16;$j++){
					if($price_array[$j] < $budget){
					echo "price: ".$price_array[$j];
					echo $rating_array[$j];
					$Final_Rating = substr($rating_array[$j], 9, -3);
					if ($Final_Rating==0){$Final_Rating = 3;}
					else{$Final_Rating = (int)$Final_Rating ;}				
					echo "  Rating: ".$Final_Rating;
					echo "  Budget:  100    ";
					$Recommendation_Array[$j] = recommendation($Final_Rating,$price_array[$j],$budget);
					echo "Final: ".recommendation($Final_Rating,$price_array[$j],$budget);
					echo "<br>------------------------------------<br>";
				}
			}
			$recommendation_index_array[3] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[3] = $Recommendation_Array[$recommendation_index_array[3]]; 
			$Recommendation_Array[$recommendation_index_array[3]] = 0;
			$recommendation_index_array[4] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[4] =$Recommendation_Array[$recommendation_index_array[4]];
			$Recommendation_Array[$recommendation_index_array[4]] = 0;
			$recommendation_index_array[5] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[5] =$Recommendation_Array[$recommendation_index_array[5]];
			for($j=8;$j<16;$j++){
				$Recommendation_Array[$j]=0;
			}
  ?>	

<?php
				for ($j=16;$j<24;$j++){
					if($price_array[$j] < $budget){
					echo "price: ".$price_array[$j];
					$Final_Rating = substr($rating_array[$j], 9, -3);
					if ($Final_Rating==0){$Final_Rating = 3;}
					else{$Final_Rating = (int)$Final_Rating ;}
					echo "  Rating: ".$Final_Rating;
					echo "  Budget:  100    ";
					$Recommendation_Array[$j] = recommendation($Final_Rating,$price_array[$j],$budget);
					echo "Final: ".recommendation($Final_Rating,$price_array[$j],$budget);
					echo "<br>------------------------------------<br>";
				}
			}
			$recommendation_index_array[6] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[6] = $Recommendation_Array[$recommendation_index_array[6]]; 
			$Recommendation_Array[$recommendation_index_array[6]] = 0;
			$recommendation_index_array[7] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[7] =$Recommendation_Array[$recommendation_index_array[7]];
			$Recommendation_Array[$recommendation_index_array[7]] = 0;
			$recommendation_index_array[8] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[8] =$Recommendation_Array[$recommendation_index_array[8]];
			for($j=16;$j<24;$j++){
				$Recommendation_Array[$j]=0;
			}
  ?>


<?php
				for ($j=24;$j<32;$j++){
					if($price_array[$j] < $budget){
					echo "price: ".$price_array[$j];
					$Final_Rating = substr($rating_array[$j], 9, -3);
					if ($Final_Rating==0){$Final_Rating = 3;}
					else{$Final_Rating = (int)$Final_Rating ;}
					echo "  Rating: ".$Final_Rating;
					echo "  Budget:  100    ";
					$Recommendation_Array[$j] = recommendation($Final_Rating,$price_array[$j],$budget);
					echo "Final: ".recommendation($Final_Rating,$price_array[$j],$budget);
					echo "<br>------------------------------------<br>";
				}
			}
			$recommendation_index_array[9] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[9] = $Recommendation_Array[$recommendation_index_array[9]]; 
			$Recommendation_Array[$recommendation_index_array[9]] = 0;
			$recommendation_index_array[10] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[10] =$Recommendation_Array[$recommendation_index_array[10]];
			$Recommendation_Array[$recommendation_index_array[10]] = 0;
			$recommendation_index_array[11] = array_search(max($Recommendation_Array), $Recommendation_Array);
			$total_recommendation_array[11] =$Recommendation_Array[$recommendation_index_array[11]];
		
  ?>
			<?php	
			for ($j=0;$j<3;$j++){
			$total_recommendation_index_array[$j] = array_search(max($total_recommendation_array),$total_recommendation_array);
			$total_recommendation_array[$total_recommendation_index_array[$j]] =0;
			}

			for($j=0;$j<3;$j++)
			{
				echo $price_array[$recommendation_index_array[$total_recommendation_index_array[$j]]];
				echo "<br>";
			}
			?>					

				<!-- Start compared result showcase -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
					<p style="text-align:center;color:white;background:black;width:100%;font-size:30px"><I>Top 3 best best</I></p>
					<!-- single brand product -->
					<?php
							for($k=0;$k<3;$k++){
						?>
							<div class="col-lg-4 col-md-6">
								<div class="single-product">
									<img class="img-fluid" src="<?php  echo $image_array[$recommendation_index_array[$total_recommendation_index_array[$k]]];?>" alt="">
									<div class="product-details">
										<h6><?php echo $name_array[$recommendation_index_array[$total_recommendation_index_array[$k]]];?></h6>
										<div class="price">
											<h6><?php  echo $price_array[$recommendation_index_array[$total_recommendation_index_array[$k]]]; ?></h6>
										</div>
										<div class="prd-bottom">
											<a href="<?php echo $href_array[$recommendation_index_array[$total_recommendation_index_array[$k]]];?>" class="social-info">
												<span class="ti-bag"></span>
												<p class="hover-text">Get one!</p>
											</a>
										</div>
									</div>
								</div>
							</div>
						<?php
							}
																				
						?>


<p style="text-align:center;color:white;background:black;width:100%;font-size:30px"><I>Qoo10 Top 3 best best</I></p>
						<?php
							for($k=0;$k<3;$k++){
						?>
							<div class="col-lg-4 col-md-6">
								<div class="single-product">
									<img class="img-fluid" src="<?php  echo $image_array[$recommendation_index_array[$k]];?>" alt="">
									<div class="product-details">
										<h6><?php echo $name_array[$recommendation_index_array[$k]];?></h6>
										<div class="price">
											<h6><?php  echo $price_array[$recommendation_index_array[$k]]; ?></h6>
										</div>
										<div class="prd-bottom">
											<a href="<?php echo $href_array[$recommendation_index_array[$k]];?>" class="social-info">
												<span class="ti-bag"></span>
												<p class="hover-text">Get one!</p>
											</a>
										</div>
									</div>
								</div>
							</div>
						<?php
							}
																				
						?>



					<p style="text-align:center;color:white;background:black;width:100%;font-size:30px"><I>Lelong Top 3 best best</I></p>
					<!-- single product -->
									<?php
									for($k=3;$k<6;$k++){
									?>
										<div class="col-lg-4 col-md-6">
											<div class="single-product">
												<img class="img-fluid" src="<?php  echo $image_array[$recommendation_index_array[$k]];?>" alt="">
												<div class="product-details">
													<h6><?php
													echo $name_array[$recommendation_index_array[$k]];
													?></h6>
													<div class="price">
														<h6><?php  echo $price_array[$recommendation_index_array[$k]]; ?></h6>
													</div>
													<div class="prd-bottom">
														<a href="<?php echo $href_array[$recommendation_index_array[$k]];?>" class="social-info">
															<span class="ti-bag"></span>
															<p class="hover-text">Get one!</p>
														</a>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
																				
										?>
			
			<p style="text-align:center;color:white;background:black;width:100%;font-size:30px"><I>Sports Direct Top 3 best best</I></p>
					<!-- single product -->
									<?php
									for($k=6;$k<9;$k++){
									?>
										<div class="col-lg-4 col-md-6">
											<div class="single-product">
												<img class="img-fluid" src="<?php  echo $image_array[$recommendation_index_array[$k]];?>" alt="">
												<div class="product-details">
													<h6><?php
													echo $name_array[$recommendation_index_array[$k]];
													?></h6>
													<div class="price">
														<h6><?php  echo $price_array[$recommendation_index_array[$k]]; ?></h6>
													</div>
													<div class="prd-bottom">
														<a href="<?php echo $href_array[$recommendation_index_array[$k]];?>" class="social-info">
															<span class="ti-bag"></span>
															<p class="hover-text">Get one!</p>
														</a>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
																				
										?>
			
			<p style="text-align:center;color:white;background:black;width:100%;font-size:30px"><I>Ebay Top 3 best best</I></p>
					<!-- single product -->
									<?php
									for($k=9;$k<12;$k++){
									?>
										<div class="col-lg-4 col-md-6">
											<div class="single-product">
												<img class="img-fluid" src="<?php  echo $image_array[$recommendation_index_array[$k]];?>" alt="">
												<div class="product-details">
													<h6><?php
													echo $name_array[$recommendation_index_array[$k]];
													?></h6>
													<div class="price">
														<h6><?php  echo $price_array[$recommendation_index_array[$k]]; ?></h6>
													</div>
													<div class="prd-bottom">
														<a href="<?php echo $href_array[$recommendation_index_array[$k]];?>" class="social-info">
															<span class="ti-bag"></span>
															<p class="hover-text">Get one!</p>
														</a>
													</div>
												</div>
											</div>
										</div>
										<?php
									}
																				
										?>
			
					</div>
				</section>
				<!-- End Best Seller -->

			</div>
		</div>
	</div>

	<!-- Start related-product Area -->
	<section class="related-product-area section_gap">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Deals of the Week</h1>
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
							magna aliqua.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r1.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r2.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r3.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r5.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r6.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6 mb-20">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r7.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r9.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r10.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-6">
							<div class="single-related-product d-flex">
								<a href="#"><img src="img/r11.jpg" alt=""></a>
								<div class="desc">
									<a href="#" class="title">Black lace Heels</a>
									<div class="price">
										<h6>$189.00</h6>
										<h6 class="l-through">$210.00</h6>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="ctg-right">
						<a href="#" target="_blank">
							<img class="img-fluid d-block mx-auto" src="img/category/c5.jpg" alt="">
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End related-product Area -->

	<!-- start footer Area -->
	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
							magna aliqua.
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">

							<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="form-inline">

								<div class="d-flex flex-row">

									<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
									 required="" type="email">


									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
									<div style="position: absolute; left: -5000px;">
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
									</div>

									<!-- <div class="col-lg-4 col-md-4">
													<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
												</div>  -->
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Instragram Feed</h6>
						<ul class="instafeed d-flex flex-wrap">
							<li><img src="img/i1.jpg" alt=""></li>
							<li><img src="img/i2.jpg" alt=""></li>
							<li><img src="img/i3.jpg" alt=""></li>
							<li><img src="img/i4.jpg" alt=""></li>
							<li><img src="img/i5.jpg" alt=""></li>
							<li><img src="img/i6.jpg" alt=""></li>
							<li><img src="img/i7.jpg" alt=""></li>
							<li><img src="img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Follow Us</h6>
						<p>Let us be social</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		</div>
	</footer>
	<!-- End footer Area -->

	<!-- Modal Quick Product View -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="container relative">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<div class="product-quick-view">
					<div class="row align-items-center">
						<div class="col-lg-6">
							<div class="quick-view-carousel">
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
								<div class="item" style="background: url(img/organic-food/q1.jpg);">

								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="quick-view-content">
								<div class="top">
									<h3 class="head">Mill Oil 1000W Heater, White</h3>
									<div class="price d-flex align-items-center"><span class="lnr lnr-tag"></span> <span class="ml-10">$149.99</span></div>
									<div class="category">Category: <span>Household</span></div>
									<div class="available">Availibility: <span>In Stock</span></div>
								</div>
								<div class="middle">
									<p class="content">Mill Oil is an innovative oil filled radiator with the most modern technology. If you are
										looking for something that can make your interior look awesome, and at the same time give you the pleasant
										warm feeling during the winter.</p>
									<a href="#" class="view-full">View full Details <span class="lnr lnr-arrow-right"></span></a>
								</div>
								<div class="bottom">
									<div class="color-picker d-flex align-items-center">Color:
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
										<span class="single-pick"></span>
									</div>
									<div class="quantity-container d-flex align-items-center mt-15">
										Quantity:
										<input type="text" class="quantity-amount ml-15" value="1" />
										<div class="arrow-btn d-inline-flex flex-column">
											<button class="increase arrow" type="button" title="Increase Quantity"><span class="lnr lnr-chevron-up"></span></button>
											<button class="decrease arrow" type="button" title="Decrease Quantity"><span class="lnr lnr-chevron-down"></span></button>
										</div>

									</div>
									<div class="d-flex mt-20">
										<a href="#" class="view-btn color-2"><span>Add to Cart</span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-layers"></span></a>
										<a href="#" class="like-btn"><span class="lnr lnr-heart"></span></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>

</html>