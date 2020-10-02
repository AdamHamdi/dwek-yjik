@extends('client.main-content')
@section('content')
<br><br><br><br>
<div class="row mt-5">
    <div class="col-md-10 offset-1 mx-auto">
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center; color :white">Modifier la commande</h3></div>
            <div class="card-body">
                <form action="{{ url('commandes/'.$comm->id.'/update') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PUT" />
                    {{ csrf_field() }}

                   <input type="hidden" name='pharmacie_id' value="{{  App\Pharmacie::findOrFail($comm->pharmacie_id)->id}}">
                   <input type="hidden" name='status_commande' value="demandée">
                    <div class="form-group" >
                      <label  for="adresse">Adresse *</label>
                      <input type="text" class="form-control col-10" rows="5" id="adresse" name="adresse " value="{{ $comm->adresse }}">
                      @if($errors->get('adresse'))
                      @foreach($errors->get('adresse') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                    </div>
                    <div class="form-group" >
                        <img src="{{  URL::to('ordonnance/'.$comm->file)}}" alt="" height="1000" width="1000" class="img-fluid rounded">
                      </div>
                    <div class="form-group">
                    <div class="form-group">
                        <label for="file">Ordonnance *</label>
                        <input type="file" class="form-control col-10" id="file" name="file" value="{{ $comm->file }}">
                        @if($errors->get('file'))
                                @foreach($errors->get('file') as
                                $message)
                                <label style="color:red">{{ $message }}</label>
                                @endforeach @endif
                      </div>
                    <button type="submit" class="btn btn-success"><i class="fa fa-paper-plane"></i> Valider</button>
                  </form>

            </div>
        </div>
    </div>
</div>






@endsection

