@extends('layouts/layout2')
	<!-- Document Title
	============================================= -->
	<title>Inscription | RDS</title>

  @section('style')
	<style>
		.dotted-bg {
			position: absolute;
			top: 0;
			right: 0;
			width: 30%;
			height: 100%;
			background: url('images/blocks/preview/dot-grid-light.svg');
			z-index: 0;
		}
	</style>
  @endsection


@section('content')
		<!-- Hero Section
		============================================= -->
		<section id="slider" class="slider-element" style="background-image: -webkit-linear-gradient(to bottom, #315653, #182927 ); background-image: linear-gradient(to bottom, #315653, #182927);">

			<div class="dotted-bg"></div>

			<div class="vertical-middle min-vh-lg-100">
				<div class="container py-5 py-lg-0">
					<div class="row align-items-center">
						<div class="col-lg-7 dark py-5">
							
							<h1 class="display-4 font-weight-bold">Bienvenue chez RDS MOTORS.</h1>
							
						</div>
						<div class="col-lg-5 mt-5 mt-lg-0">
							<div class="card bg-white">
								<div class="card-header p-4">
									<h2 class="mb-1">S'inscrire</h2>
									<p class="mb-0">Vous avez déja un compte? <a href="{{ route('users.login') }}">Connectez vous</a></p>
								</div>
								<div class="card-body p-4">
			
									
									<form id="login-form" name="login-form" class="row mb-0" action="{{ route('users.store') }}" method="post">
                    @csrf
                    @include("users/form")
										<div class="col-12">
											<button type="submit" class="button m-0 btn-block rounded" id="register-form-submit" name="register-form-submit" value="register">S'inscrire </button>
										</div>

									</form>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>

		</section>

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap py-0">
				
			</div>
		</section><!-- #content end -->


	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>
@endsection