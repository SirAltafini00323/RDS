@extends('layouts/layout')

@section('content')
<br>
        <div class="section">
                <div class="container">
                  <section class="section">
                    <div class="container has-text-centered">
                      <div class="columns is-centered">
                        <div class="column is-5 is-4-desktop">
                          <form method="POST" action="{{ route('register') }}">
                              @include("users/form")
                              <div class="field is-grouped">
                              <div class="control is-expanded">
                                <button class="button is-primary is-outlined is-fullwidth">Annuler</button>
                              </div>
                              <div class="control is-expanded">
                                <button type="submit" class="button is-primary is-fullwidth">S'inscrire</button>
                              </div>
                            </div>
                        </div>
                          </form>
                          
                      </div>
                    </div>
                  </section>
                </div>
              
         
        </div>
@endsection