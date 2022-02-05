@extends("layouts/layout")

@section('content')
<br><br>
        <div class="section">
         
            
                <div class="container">
                  <section class="section">
                    <div class="container has-text-centered">
                      <div class="columns is-centered">
                        <div class="column is-5 is-4-desktop">
                          <form method="POST" action="{{ route('login') }}" accept-charset="UTF-8" enctype="multipart/form-data">
                            @csrf
                            <div class="field">
                              <div class="control">
                                <input class="input" name="email" type="email" placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            
                            <div class="field">
                              <div class="control">
                                <input class="input" name="password" type="password" placeholder="Mot de passe">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                            </div>
                            <div class="field is-grouped">
                              <div class="control is-expanded">
                                <button class="button is-primary is-outlined is-fullwidth">Annuler</button>
                              </div>
                              <div class="control is-expanded">
                                <button type="submit" class="button is-primary is-fullwidth">Se connecter</button>
                              </div>
                            </div>
                            <p>Vous n'avez pas encore de compte chez nous <a href="{{ route('users.create') }}">Inscrivez vous!</a></p>
                          </form>
                        </div>
                      </div>
                    </div>
                  </section>
                </div>
              
         
        </div>
@endsection