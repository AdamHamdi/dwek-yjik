@extends('pharmacien.main-content')
@section('content')
<br><br><br>



<div class="row mt-5">
    <div class="col-md-8 mx-auto">
        @if(Session::has('danger'))
        <div class="alert alert-danger">
            {{ Session::get('danger') }} @php Session::forget('danger'); @endphp
        </div>
        @endif @if(Session::has('warning'))
        <div class="alert alert-warning">
            {{ Session::get('warning') }} @php Session::forget('warning'); @endphp
        </div>
        @endif @if(Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }} @php Session::forget('success'); @endphp
        </div>
        @endif
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center;font-size: 20px; color :white">Ajouter un médicament :</h3></div>
            <div class="card-body">
                <form action="{{ url('medicaments/'.$fact->id.'/store') }}" method="post" >
                    {{ csrf_field() }}
                    <input type="hidden" name="facture_id" value="{{ $fact->id }}">
                    <div class="form-group">
                      <label for="nom_med">Nom du medicament* </label>
                      <input type="text" class="form-control" required id="nom_med" name="nom_med" placeholder="Nom du médicament" >
                      @if($errors->get('nom_med'))
                      @foreach($errors->get('nom_med') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                    </div>
                    <div class="form-group">
                        <label for="posologie">La posologie* </label>
                        <input type="text" class="form-control" required id="posologie" name="posologie" placeholder="La posologie " >
                        @if($errors->get('posologie'))
                        @foreach($errors->get('posologie') as
                        $message)
                        <label style="color:red">{{ $message }}</label>
                        @endforeach @endif
                      </div>


                      <div class="form-group" >
                        <label  for="prix">Le prix *</label>
                        <input type="prix" class="form-control" required id="prix" name="prix" placeholder="Le prix">
                        @if($errors->get('prix'))
                        @foreach($errors->get('prix') as
                        $message)
                        <label style="color:red">{{ $message }}</label>
                        @endforeach @endif
                      </div>
                    <div class="form-group">
                        <label for="dispo">La disponibilitée * :</label>
                        <div class="radio">
                            <label><input type="radio" name="dispo" value="oui" checked>Oui</label>
                          </div>
                          <div class="radio">
                            <label><input type="radio" name="dispo" value="non">Non</label>
                          </div>

                          @if($errors->get('dispo'))
                      @foreach($errors->get('dispo') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif

                    </div>

                    <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary " style="color:white"><i class="fas fa-arrow-circle-left"></i> Retour</a>

                    <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Ajouter</button>
                    <a href="/factures" type="submit" class="btn btn-sm btn-primary"><i class="fa fa-send"></i> Valider</a href="/factures">


                  </form>


            </div>
        </div>
    </div>
</div>






@endsection
