<?php
//Declare array  * To store product details into array
$name_array[] = array();
$rating_array[] = array();
$price_array[] =  array();
$href_array[] = array();
$image_array[] = array();
error_reporting(0);

//For Qoo10
$html = file_get_contents("https://www.qoo10.my/s/?search_option=tt&keyword_hist=sport+equipment&sortType=SORT_GD_NO&dispType=LIST");
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
$doc123->loadHTML($html123);
$xpath123 = new DOMXpath($doc123);
$Image = $xpath123->query( '//div[@class="img"]/a/img/@content')->item(0);
$image_array[$i] = $Image->textContent;
}
?>


<?php
//For lelong.my
//index starts from 8 onwards
$html = file_get_contents( "https://www.lelong.com.my/catalog/all/list?TheKeyword=sport+equipment&Sort=latest");
libxml_use_internal_errors( true);
$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);

for ($i=0;$i<8;$i++){
$Name = $xpath->query( '//div[@class="summary"]/a/b/@data-name')->item($i);
$name_array[$i+8] = $Name->textContent;
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
$html = file_get_contents("https://my.sportsdirect.com/new-arrival");
libxml_use_internal_errors(true);
$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);

for ($i=0;$i<8;$i++){
$Pname = $xpath->query( '//span[@class="productdescriptionname"]')->item($i);
$Bname = $xpath->query('//span[@class="productdescriptionbrand"]')->item($i);
$Name = ($Bname->textContent." ".$Pname->textContent);
$name_array[$i+16] = $Name;
$Price = $xpath->query( '//span[@class=" curprice "]')->item($i);
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
//For 
// index starts from 24
$html = file_get_contents("https://www.ebay.com.my/b/Sporting-Goods/888/bn_1865031?rt=nc&_from=R40&_sop=10");
libxml_use_internal_errors(true);
$doc = new DOMDocument;
$doc->loadHTML($html);
$xpath = new DOMXpath($doc);

for ($i=0;$i<8;$i++){
$Name = $xpath->query( '//h3[@class="s-item__title"]')->item($i);
$name_array[$i+24] = $Name->textContent;
$Price = $xpath->query( '//span[@class="s-item__price"]')->item($i);
$price_array[$i+24] = $Price->textContent;
$href = $xpath->query( '//div[@class="s-item__image"]/a/@href')->item($i);
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
	<title>Athletics</title>
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="css/linearicons.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/themify-icons.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/nice-select.css">
	<link rel="stylesheet" href="css/nouislider.min.css">
	<link rel="stylesheet" href="css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/main.css">
</head>

	<body>
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
							<li class="nav-item active"><a class="nav-link" href="index.html">Home</a></li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Shop</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="category.html">Shop Category</a></li>
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
									<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
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

	<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="active-banner-slider owl-carousel">
						<!-- single-slide -->
						<div class="row single-slide align-items-center d-flex">
							<div class="col-lg-5 col-md-6">
								<div class="banner-content">
									<h1>Athletics is </h1><h1>here !</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase">Starts comparing!</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/banner/logo.png" alt="">
								</div>
							</div>
						</div>
						<!-- single-slide -->
						<div class="row single-slide">
							<div class="col-lg-5">
								<div class="banner-content">
									<h1>Nike New <br>Collection!</h1>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
										dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
									<div class="add-bag d-flex align-items-center">
										<a class="add-btn" href=""><span class="lnr lnr-cross"></span></a>
										<span class="add-text text-uppercase">Take Me There!</span>
									</div>
								</div>
							</div>
							<div class="col-lg-7">
								<div class="banner-img">
									<img class="img-fluid" src="img/banner/banner-img.png" alt="">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon1.png" alt="">
						</div> 
						<h6>Free Delivery</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon2.png" alt="">
						</div>
						<h6>Return Policy</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon3.png" alt="">
						</div>
						<h6>24/7 Support</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="img/features/f-icon4.png" alt="">
						</div>
						<h6>Secure Payment</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->

	<!-- Start category Area -->
	<section class="category-area">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-8 col-md-12">
					<div class="row">
						<div class="col-lg-8 col-md-8">
							<div class="single-deal">
								<div class="overlay"></div>
								<!--set a category here-->
								<img class="img-fluid w-100" src="img/category/c1.jpg" alt="">
									<div class="deal-details">
										<h6 class="deal-title">Soccer</h6>
										<a href='category.php?Category=soccer+shoe'>Shoes</a>
										<br>
										<a href='category.php?Category=soccer+shirts'>Outfits</a>
										<br>
										<a href='category.php?Category=soccer+ball'>Soccer Ball</a>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="single-deal">
								<div class="overlay"></div>
								<!--set a category here-->
								<a href="category.php?Category=badminton">
								<img class="img-fluid w-100" src="img/category/c2.jpg" alt="">
									<div class="deal-details">
										<h6 class="deal-title">Badminton</h6>
										<a href='category.php?Category=badminton+shoes'>Shoes</a>
										<br>
										<a href='category.php?Category=badminton+shirts'>Outfits</a>
										<br>
										<a href='category.php?Category=badminton+racket'>Racquet</a>
										<br>
										<a href='category.php?Category=shuttlecock'>Shuttlecock</a>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-4 col-md-4">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="img/category/c3.jpg" alt="">
								<a href="img/category/c3.jpg" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">Basketball</h6>
										<a href='category.php?Category=basketball+shoes'><strong>Shoes</strong></a>
										<br>
										<a href='category.php?Category=basketball+shirt'><strong>Outfits</strong></a>
									</div>
								</a>
							</div>
						</div>
						<div class="col-lg-8 col-md-8">
							<div class="single-deal">
								<div class="overlay"></div>
								<img class="img-fluid w-100" src="img/category/c4.jpg" alt="">
								<a href="img/category/c4.jpg" class="img-pop-up" target="_blank">
									<div class="deal-details">
										<h6 class="deal-title">Sneaker for Sports</h6>
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-deal">
						<div class="overlay"></div>
						<img class="img-fluid w-100" src="img/category/c5.jpg" alt="">
						<a href="img/category/c5.jpg" class="img-pop-up" target="_blank">
							<div class="deal-details">
								<h6 class="deal-title">Sneaker for Sports</h6>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End category Area -->

	<!-- start product Area -->
	<section class="owl-carousel active-product-area section_gap">
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Latest Products from</h1>
							<p>Qoo10!</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					<?php
					for ($j=0;$j<8;$j++){
?>
				<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="<?php echo $image_array[$j];?>" alt="">
							<div class="product-details">
								<h6><?php echo $name_array[$j];?></h6>
								<div class="price">
									<h6><?php echo $price_array[$j];?></h6>
								</div>
								<div class="prd-bottom">
									<a href="<?php echo $href_array[$j];?>" class="social-info">
										<span class="ti-bag"></span>
										<p class="hover-text">Get one!</p>
									</a>
									</a>
								</div>
							</div>
						</div>
					</div>
<?php	
			}
?>
				</div>
			</div>
		</div>
		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Latest Products from</h1>
							<p>Lelong.my!</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					<?php
					for ($j=8;$j<16;$j++){
?>
				<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="<?php echo $image_array[$j];?>" alt="">
							<div class="product-details">
								<h6><?php echo $name_array[$j];?></h6>
								<div class="price">
									<h6><?php echo $price_array[$j];?></h6>
								</div>
								<div class="prd-bottom">
								<a href="<?php echo $href_array[$j];?>" class="social-info">
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
			</div>
		</div>

				<!-- single product slide -->
				<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Latest Products from</h1>
							<p>Sports Direct!</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					<?php
					for ($j=16;$j<24;$j++){
?>
				<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="<?php echo $image_array[$j];?>" alt="">
							<div class="product-details">
								<h6><?php echo $name_array[$j];?></h6>
								<div class="price">
									<h6><?php echo $price_array[$j];?></h6>
								</div>
								<div class="prd-bottom">
								<a class="social-info" href="<?php echo $href_array[$j];?>">
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
			</div>
		</div>

		<!-- single product slide -->
		<div class="single-product-slider">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center">
						<div class="section-title">
							<h1>Latest Products from</h1>
							<p>Ebay.my!</p>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					<?php
					for ($j=24;$j<32;$j++){
?>
				<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="<?php echo $image_array[$j];?>" alt="">
							<div class="product-details">
								<h6><?php echo $name_array[$j];?></h6>
								<div class="price">
									<h6><?php echo $price_array[$j];?></h6>
								</div>
								<div class="prd-bottom">
									<a class="social-info" href="<?php echo $href_array[$j];?>">
									<span class="ti-bag"></span>
										<p class="hover-text">Get one!</p>
									</a>
									</a>
								</div>
							</div>
						</div>
					</div>
<?php
				
			}
			?>
				</div>
			</div>
		</div>
	</section>
	<!-- end product Area -->

	<!-- Start brand Area -->
	<section class="brand-area section_gap">
		<div class="container">
			<div class="row">
				<a class="col single-img" href="">
					<img class="img-fluid d-block mx-auto" src="img/qoo10.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/lelong.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/sportsdirect.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/ebay.png" alt="">
				</a>
				<a class="col single-img" href="#">
					<img class="img-fluid d-block mx-auto" src="img/logo.png" alt="">
				</a>
			</div>
		</div>
	</section>
	<!-- End brand Area -->


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
								</div>
								<div class="info"></div>
							</form>
						</div>
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

	<script src="js/loading.js"></script>
	<script src="js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="js/vendor/bootstrap.min.js"></script>
	<script src="js/jquery.ajaxchimp.min.js"></script>
	<script src="js/jquery.nice-select.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/countdown.js"></script>
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="js/gmaps.min.js"></script>
	<script src="js/main.js"></script>
</body>


</html>