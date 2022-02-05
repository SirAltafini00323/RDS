<div class="col-12 form-group">
											<input type="text" id="name" name="name" autocomplete="off" value="{{old('name')}}" class="required form-control" placeholder="Nom" />
                      @error('name')
                                    <span class="erreur">
                                        {{ $message }}
                                    </span>
                                @enderror
										</div>
                      <div class="col-12 form-group">
											<input type="email" id="email" name="email" autocomplete="off" value="{{old('email')}}" class="required email form-control" placeholder="Email Addresse" />
                      @error('email')
                                    <span class="erreur">
                                      {{ $message }}
                                    </span>
                                @enderror
										</div>

										<div class="col-12 form-group">
											<input type="tel" id="tel" name="tel" autocomplete="off" value="{{old('tel')}}" class="required form-control" placeholder="Numéro de téléphone" />
                      @error('tel')
                                    <span class="erreur">
                                        {{ $message }}
                                    </span>
                                @enderror
										</div>

										<div class="col-12 form-group">
											<input type="password" id="password" name="password" autocomplete="new-password" value="" class="form-control" placeholder="Mot de passe" />
                      @error('password')
                                    <span class="erreur">
                                        {{ $message }}
                                    </span>
                                @enderror
										</div>

										<div class="col-12 form-group">
											<input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password" value="" class="form-control" placeholder="Confirmez votre mot de passe" />
										</div>

									
