@extends('pharmacien.main-content')
@section('content')
<br><br><br>



<div class="row mt-5">
    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center;font-size: 20px; color :white">Ajouter votre pharmacie</h3></div>
            <div class="card-body">
                <form action="{{ route('pharmacies.store') }}" method="post" >
                    {{ csrf_field() }}

                    <div class="form-group">
                      <label for="name">Nom* </label>
                      <input type="text" class="form-control" required id="name" name="name" placeholder="Nom de la pharmacie" >
                      @if($errors->get('name'))
                      @foreach($errors->get('name') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                    </div>
                    <div class="form-group">
                        <label for="code_deontologie">Code de Déontologie* </label>
                        <input type="text" class="form-control" required id="name" name="code_deontologie" placeholder="Code de deontologie " >
                        @if($errors->get('code_deontologie'))
                        @foreach($errors->get('code_deontologie') as
                        $message)
                        <label style="color:red">{{ $message }}</label>
                        @endforeach @endif
                      </div>
                      <div class="form-group">
                        <label for="mat_fiscale">Le Matricule Fiscale * </label>
                        <input type="text" class="form-control" required id="name" name="mat_fiscale" placeholder="Le Matricule Fiscale " >
                        @if($errors->get('mat_fiscale'))
                        @foreach($errors->get('mat_fiscale') as
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
                        <label  for="phone">Téléphone *</label>
                        <input type="phone" class="form-control" required id="phone" name="phone" placeholder="Numéro de téléphone">
                        @if($errors->get('phone'))
                        @foreach($errors->get('phone') as
                        $message)
                        <label style="color:red">{{ $message }}</label>
                        @endforeach @endif
                      </div>
                    <div class="form-group">
                        <label for="convention_CNAM">La Convention avec le CNAM* :</label>
                        <div class="radio">
                            <label><input type="radio" name="convention_CNAM" value="1" checked>Oui</label>
                          </div>
                          <div class="radio">
                            <label><input type="radio" name="convention_CNAM" value="0">Non</label>
                          </div>
                        {{--
                        <select id="convention_CNAM" name="convention_CNAM">
                            <option value="oui">Oui</option>

                            <option value="non">Non</option>

                          </select>  --}}
                          @if($errors->get('convention_CNAM'))
                      @foreach($errors->get('convention_CNAM') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif

                    </div>

                    <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary " style="color:white"><i class="fas fa-arrow-circle-left"></i> Retour</a>

                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Ajouter</button>
                  </form>


            </div>
        </div>
    </div>
</div>







@endsection
