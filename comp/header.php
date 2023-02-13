<!doctype html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="author" content="<?php echo $author; ?>">
	<meta name="google" content="notranslate" />
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="title" content="<?php echo $title; ?>" />
	<meta name="robots" content="noindex, nofollow" />
	<meta name="description" content="<?php echo $description; ?>" />
	<meta name="keywords" content="<?php echo $keyword; ?>" />
	<meta name="news_keywords" content="<?php echo $news_keywords; ?>" />

	<meta name="news_keywords" content="<?php echo $keyword; ?>" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:site" content="@learningdays.com" />
	<meta name="twitter:title" content="<?php echo $title; ?>" />
	<meta name="twitter:creator" content="@learningdays.com" />
	<meta name="twitter:description" content="<?php echo $description; ?>" />
	<meta class="imgmeta" name="twitter:image" content="https://learningdays.id<?php echo $inc_; ?>/assets/ic/logo-learningdays.jpg" />
	<meta property="og:site_name" content="learningdays.com" />
	<meta class="imgmeta" property="og:image" content="https://learningdays.id<?php echo $inc_; ?>/assets/ic/logo-learningdays.jpg" />
	<meta property="og:image:width" content="200" />
	<meta property="og:image:height" content="200" />
	<meta property="og:locale" content="id_ID" />
	<meta property="og:title" content="<?php echo $title; ?>" />
	<!-- <meta property="og:url" content="' . $uniq . '" /> -->
	<meta property="og:description" content="<?php echo $description; ?>" />
	<meta property="og:type" content="article" />
	<meta name="author" content="learningdays.id">

	<title id="title-head" name="description" content="<?php echo $title; ?>"><?php echo $title; ?></title>
	<link rel="icon" type="image/png" href="<?php echo $inc_; ?>/tryout-edunitas.ico">

	<link href="<?php echo $inc_; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="preload" as="style">
	<link href="<?php echo $inc_; ?>/assets/plugins/custom/css/custom.min.css" rel="preload" as="style">
	<!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="preload" as="style">-->

	<link rel="preload" href="<?php echo $inc_; ?>/assets/plugins/bootstrap/js/bootstrap.min.js" as="script">
	<link rel="preload" href="<?php echo $inc_; ?>/assets/plugins/jquery/js/jquery.min.js" as="script">
	<link rel="preload" href="<?php echo $inc_; ?>/assets/plugins/custom/js/custom.min.js" as="script">

	<link href="<?php echo $inc_; ?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo $inc_; ?>/assets/plugins/custom/css/custom.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-5-theme/1.2.0/select2-bootstrap-5-theme.min.css" integrity="sha512-ZaFewc2ndIrsFWmG9gZR9zfJtR1Q+bvikASGXnQlUtoGj1PLDTyDabWdLbjC/YmyqTH8Txi/RdYcQW5Xpah3Ig==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.0.19/sweetalert2.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<script type="text/javascript" src="<?php echo $inc_; ?>/assets/plugins/jquery/js/jquery.min.js"></script>

	<script type="text/javascript" src="<?php echo $inc_; ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $inc_; ?>/assets/plugins/custom/js/custom.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script>
		var urlget = "<?php echo $urlget; ?>";
		var urlpost = "<?php echo $urlget; ?>";

		var page = 1;
		var search = '';
		var filter = ''; /* isi lengkap misal a=b&c=d*/
		var create_pagination = true;

		var objlike = [];

		function tag_replace(str) {
			if (str != '') {
				str = str.replace(/\[/g, '<');
				str = str.replace(/\]/g, '>');
			}
			return str;
		}
	</script>



</head>

<body>

	<div style="min-height:93.5vh;">
		<!-- <div style="display: block;"> -->