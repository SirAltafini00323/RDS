@extends("layouts/layout2")

@section('content')
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
									<h2 class="mb-1">Se Connecter</h2>
									<p class="mb-0">Pas encore de compte? <a href="{{ route('users.create') }}">Inscrivez vous</a></p>
								</div>
								<div class="card-body p-4">
                  
                @error('erreur')
                          <div class="alert alert-danger">
                              {{$message}}
                          </div>
                          @enderror
									
									<form id="login-form" name="login-form" class="row mb-0" action="{{route('users.login')}}" method="post">

										@csrf

										<div class="col-12 form-group">
											<input type="email" id="email" name="email" autocomplete="off" value="{{old('email')}}" class="required email form-control" placeholder="Email Address" />
										</div>

										<div class="col-12 form-group">
											<input type="password" id="password" name="password" autocomplete="new-password" value="" class="form-control" placeholder="Password" />
										</div>
										<input hidden type="text" name="page" value="{{ request()->get('page')}}">

										<div class="col-12">
											<button type="submit" class="button m-0 btn-block rounded" id="register-form-submit" name="register-form-submit" value="register">Se conecter</button>
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

@endsection