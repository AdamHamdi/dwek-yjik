@extends('main-content')
@section('content')
<br><br><br>



<div class="row mt-5">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center;font-size: 35px; color :white">Inscription</h3></div>
            <div class="card-body">
                <form action="{{ route('user.register') }}" method="post" >
                    {{ csrf_field() }}
                    <div class="form-group">
                      <label for="nom">Nom* </label>
                      <input type="text" class="form-control" required id="name" name="nom" placeholder="Nom " >
                      @if($errors->get('nom'))
                      @foreach($errors->get('nom') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                    </div>
                    <div class="form-group">
                        <label for="prenom">Prenom* </label>
                        <input type="text" class="form-control" required id="name" name="prenom" placeholder="Prenom " >
                        @if($errors->get('prenom'))
                        @foreach($errors->get('prenom') as
                        $message)
                        <label style="color:red">{{ $message }}</label>
                        @endforeach @endif
                      </div>
                      <div class="form-group">
                        <label for="ddn">Date de naissance* </label>
                        <input type="date" class="form-control" required id="name" name="ddn" placeholder="date de naissance " >
                        @if($errors->get('ddn'))
                        @foreach($errors->get('ddn') as
                        $message)
                        <label style="color:red">{{ $message }}</label>
                        @endforeach @endif
                      </div>
                      <div class="form-group" >
                        <label  for="adresse">Adresse *</label>
                        <input type="text" class="form-control" required id="adresse" name="adresse" placeholder="Adresse">
                        @if($errors->get('adresse'))
                        @foreach($errors->get('adresse') as
                        $message)
                        <label style="color:red">{{ $message }}</label>
                        @endforeach @endif
                      </div>
                      <div class="form-group" >
                        <label  for="tel">Tel *</label>
                        <input type="tel" class="form-control" required id="tel" name="tel" placeholder="Tel">
                        @if($errors->get('tel'))
                        @foreach($errors->get('tel') as
                        $message)
                        <label style="color:red">{{ $message }}</label>
                        @endforeach @endif
                      </div>
                    <div class="form-group">
                        <label for="role">Choisir votre role* :</label>
                        <select id="role" name="role">
                            <option value="pharmacien">pharmacien</option>
                            {{--  <option value="livreur">livreur</option>  --}}
                            <option value="client">client</option>

                          </select>
                          @if($errors->get('role'))
                      @foreach($errors->get('role') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif

                    </div>

                    <div class="form-group" >
                      <label  for="email">Email *</label>
                      <input type="email" class="form-control" required id="email" name="email" placeholder="Email">
                      @if($errors->get('email'))
                      @foreach($errors->get('email') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de Passe *</label>
                        <input type="password" class="form-control" required id="password" name="password"  placeholder="Mot de passe">

                        @if($errors->get('password'))
                        @foreach($errors->get('password') as
                        $message)
                        <label style="color:red">{{ $message }}</label>
                        @endforeach @endif</div>

                    <button type="submit" class="btn btn-primary"><i class="fa fa-laptop"></i> S'INSCRIRE</button>
                  </form>

            </div>
        </div>
    </div>
</div>







@endsection
