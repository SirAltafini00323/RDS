<!DOCTYPE html>
<html dir="ltr" lang="fr">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="SemiColonWeb" />
  @include("layouts/include/css")

	<!-- Document Title
	============================================= -->
	<title>RDS - Motors | Accueil</title>

	<style>

		.dropdown-toggle::after { margin-left: 0.255em; }

	</style>



  @yield('style')

    



</head>

<body class="stretched side-push-panel" data-loader-html="<div><img src='{{ asset('demos/car/images/page-loader.gif') }}' alt='Loader'></div>">

	<!-- Side Panel Overlay -->
	<div class="body-overlay"></div>

	<!-- Side Panel -->
	<div id="side-panel">

		<div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="icon-line-cross"></i></a></div>

		<div class="side-panel-wrap">

			<div class="widget clearfix">

				
				<p>Bienvenue au service client de RDS Motors, Contactez nous et nous sauront répondre à vos attentes.</p>

				<div class="widget quick-contact-widget form-widget border-0 pt-0 clearfix">

					
					<div class="form-result"></div>
					<form id="quick-contact-form" name="quick-contact-form" action="include/form.php" method="post" class="quick-contact-form mb-0">
						<input type="hidden" name="prefix" value="quick-contact-form-">
						<button type="submit" id="quick-contact-form-submit" name="quick-contact-form-submit" class="button button-small button-3d m-0" value="submit">Contacter</button>
					</form>

				</div>


			</div>

		</div>

	</div>

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
        @include("layouts/include/header")
        @yield("content") 
	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- Contact Button
	============================================= -->
	<div id="contact-me" class="icon-line-mail side-panel-trigger bg-color"></div>


  @include("layouts/include/js")

  
</body>
</html>
