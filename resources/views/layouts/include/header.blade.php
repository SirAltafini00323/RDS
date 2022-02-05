  <header id="header" class="full-header header-size-custom" data-sticky-shrink="false">
			<div id="header-wrap">
				<div class="container-fluid">
					<div class="header-row flex-lg-row-reverse">

						<!-- Logo
						============================================= -->
						<div id="logo" class="mr-lg-0 ml-lg-auto">
							<a href="demo-car.html" class="standard-logo"><img src="{{asset('demos/car/images/logo.png')}}" alt="Canvas Logo"></a>
							<a href="demo-car.html" class="retina-logo"><img src="{{ asset('demos/car/images/logo@2x.png') }}" alt="Canvas Logo"></a>
						</div><!-- #logo end -->

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu with-arrows">
							<ul class="menu-container">
                @if(isset($title))
								<li class="menu-item {{ $title=='accueil' ? 'current' : ''}}"><a class="menu-link" href="{{route('accueil')}}"><div>Accueil</div></a></li>
                @else
                <li class="menu-item current"><a class="menu-link" href="{{route('accueil')}}"><div>Accueil</div></a></li>
                @endif
								<!-- Mega Menu -->
								<li class="menu-item mega-menu"><a class="menu-link" href="model.html"><div>Modèles</div></a>
									<div class="mega-menu-content mega-menu-style-2">
										<div class="container">
											<div class="row">
												<ul class="sub-menu-container mega-menu-column col-12">
													<li class="menu-item">
														<div class="widget text-center">

															<h3 class="mb-0">Cette page est réservée aux modèles de motos</h3>
															<a href="#" class="button button-small button-rounded button-border button-dark button-black font-primary" style="margin: 10px 0 40px">Elle sera bientôt disponible</a>

				
															
														</div>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</li>
                @if(isset($title))
								<li class="menu-item {{ $title=='piece' ? 'current' : ''}}"><a class="menu-link" href="{{ route('pieces.afficherTout') }}"><div>Boutique</div></a></li>
								<li class="menu-item {{ $title=='apropos' ? 'current' : ''}}"><a class="menu-link" href="{{ route('apropos') }}"><div>A Propos</div></a></li>
								<li class="menu-item {{ $title=='panier' ? 'current' : ''}}"><a class="menu-link" href="{{ route('panier') }}"><div><b> Mon panier <mark id="nbPiece" style="font-size:20px;position:relative;top:-5px;color:blue">{{ isset($nbPiece) ? $nbPiece : '0' }}</mark> </b></div></a></li>
								@if(Auth::check())
                    				@if(Auth::user()->isAdmin())
									<li class="menu-item {{$title=='admin' ? 'current' : ''}}"><a class="menu-link" href="{{ route('admin') }}"><div><b>Administrer</b></div></a></li>
									@endif
								@endif
                @else
                				<li class="menu-item"><a class="menu-link" href="{{ route('pieces.afficherTout') }}"><div>Boutique</div></a></li>
								<li class="menu-item"><a class="menu-link" href="{{ route('apropos') }}"><div>A Propos</div></a></li>
								<li class="menu-item"><a class="menu-link" href="{{ route('panier') }}"><div><b>Mon panier</b><mark id="nbPiece" style="font-size:20px;position:relative;top:-5px;color:blue">{{ isset($nbPiece) ? $nbPiece : '0' }}</mark></div></a></li>
								@if(Auth::check())
                    				@if(Auth::user()->isAdmin())
									<li class="menu-item"><a class="menu-link" href="{{ route('admin') }}"><div><b>Administrer</b></div></a></li>
									@endif
								@endif
                @endif
				@if(Auth::check())
				<li class="menu-item"><a class="menu-link" href="{{ route('users.logout') }}"><div><b>Se deconnecter</b></div></a></li>
				@else
				<li class="menu-item"><a class="menu-link" href="{{ route('users.login') }}"><div><b>Se connecter</b></div></a></li>
				@endif
							</ul>
						</nav><!-- #primary-menu end -->

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->
