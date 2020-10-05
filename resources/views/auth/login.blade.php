@extends('main-content')
@section('content')
<br><br><br>

         @if(Session::has('warning'))
        <div class="alert alert-warning">
            {{ Session::get('warning') }} @php Session::forget('warning'); @endphp
        </div>
        @endif @if(Session::has('success'))
        <div class="alert alert-success">
            <a href="https://mailtrap.io/inboxes/1061224/messages/1862803465" >verifiez votre adresse email !</a>
            {{ Session::get('success') }} @php Session::forget('success'); @endphp
        </div>
        @endif
<div class="row mt-5">
    <div class="col-md-6 offset-3 mx-auto">
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center;font-size: 25px; color :white">Connexion</h3></div>
            <div class="card-body">
                <form action="{{ route('user.auth') }}" method="post" >
                    {{ csrf_field() }}


                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @if($errors->get('email'))
                      @foreach($errors->get('email') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe </label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" required autocomplete="current-password">

                            @if($errors->get('password'))
                            @foreach($errors->get('password') as
                            $message)
                            <label style="color:red">{{ $message }}</label>
                            @endforeach @endif
                        </div>
                    </div>

                    {{--  <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>  --}}

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i>
                                Connexion
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Mot de passe oublié
                                </a>
                            @endif
                        </div>
                    </div>
                  </form>

            </div>
        </div>
    </div>
</div>






@endsection
@extends('main-content')
@section('content')
<br><br><br>

         @if(Session::has('warning'))
        <div class="alert alert-warning">
            {{ Session::get('warning') }} @php Session::forget('warning'); @endphp
        </div>
        @endif @if(Session::has('success'))
        <div class="alert alert-success">
            <a href="https://mailtrap.io/inboxes/1061224/messages/1862803465" >verifiez votre adresse email !</a>
            {{ Session::get('success') }} @php Session::forget('success'); @endphp
        </div>
        @endif
<div class="row mt-5">
    <div class="col-md-6 offset-3 mx-auto">
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center;font-size: 25px; color :white">Connexion</h3></div>
            <div class="card-body">
                <form action="{{ route('user.auth') }}" method="post" >
                    {{ csrf_field() }}


                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @if($errors->get('email'))
                      @foreach($errors->get('email') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe </label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" required autocomplete="current-password">

                            @if($errors->get('password'))
                            @foreach($errors->get('password') as
                            $message)
                            <label style="color:red">{{ $message }}</label>
                            @endforeach @endif
                        </div>
                    </div>

                    {{--  <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>  --}}

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i>
                                Connexion
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Mot de passe oublié!
                                </a>
                            @endif
                        </div>
                    </div>
                  </form>

            </div>
        </div>
    </div>
</div>






@endsection
@extends('main-content')
@section('content')
<br><br><br>

         @if(Session::has('warning'))
        <div class="alert alert-warning">
            {{ Session::get('warning') }} @php Session::forget('warning'); @endphp
        </div>
        @endif @if(Session::has('success'))
        <div class="alert alert-success">
            <a href="https://mailtrap.io/inboxes/1061224/messages/1862803465" >verifiez votre adresse email !</a>
            {{ Session::get('success') }} @php Session::forget('success'); @endphp
        </div>
        @endif
<div class="row mt-5">
    <div class="col-md-6 offset-3 mx-auto">
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center;font-size: 25px; color :white">Connexion</h3></div>
            <div class="card-body">
                <form action="{{ route('user.auth') }}" method="post" >
                    {{ csrf_field() }}


                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @if($errors->get('email'))
                      @foreach($errors->get('email') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe </label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" required autocomplete="current-password">

                            @if($errors->get('password'))
                            @foreach($errors->get('password') as
                            $message)
                            <label style="color:red">{{ $message }}</label>
                            @endforeach @endif
                        </div>
                    </div>

                    {{--  <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>  --}}

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i>
                                Connexion
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                Mot de passe oublié!
                                </a>
                            @endif
                        </div>
                    </div>
                  </form>

            </div>
        </div>
    </div>
</div>






@endsection
@extends('main-content')
@section('content')
<br><br><br>

         @if(Session::has('warning'))
        <div class="alert alert-warning">
            {{ Session::get('warning') }} @php Session::forget('warning'); @endphp
        </div>
        @endif @if(Session::has('success'))
        <div class="alert alert-success">
            <a href="https://mailtrap.io/inboxes/1061224/messages/1862803465" >verifiez votre adresse email !</a>
            {{ Session::get('success') }} @php Session::forget('success'); @endphp
        </div>
        @endif
<div class="row mt-5">
    <div class="col-md-6 offset-3 mx-auto">
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center;font-size: 25px; color :white">Connexion</h3></div>
            <div class="card-body">
                <form action="{{ route('user.auth') }}" method="post" >
                    {{ csrf_field() }}


                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Adresse E-mail</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @if($errors->get('email'))
                      @foreach($errors->get('email') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe </label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror " name="password" required autocomplete="current-password">

                            @if($errors->get('password'))
                            @foreach($errors->get('password') as
                            $message)
                            <label style="color:red">{{ $message }}</label>
                            @endforeach @endif
                        </div>
                    </div>

                    {{--  <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>  --}}

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-key"></i>
                                Connexion
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                Mot de passe oublié!
                                </a>
                            @endif
                        </div>
                    </div>
                  </form>

            </div>
        </div>
    </div>
</div>






@endsection
