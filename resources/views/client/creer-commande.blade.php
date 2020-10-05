@extends('client.main-content')
@section('content')
<br><br><br><br>
<div class="row mt-5">
    <div class="col-md-6 offset-3 mx-auto">
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center; color :white">Passer votre commande</h3></div>
            <div class="card-body">
                <form action="{{ route('passer.commande') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}

                   <input type="hidden" name='pharmacie_id' value="{{ $pharm->id }}">
                    <div class="form-group" >
                      <label  for="description">Adresse *</label>
                      <input type="text" class="form-control" rows="5" id="adresse" name="adresse" placeholder="Saisir votre adresse s-v-p">
                      @if($errors->get('adresse'))
                      @foreach($errors->get('adresse') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                    </div>
                    <div class="form-group">
                        <label for="file">Ordonnance *</label>
                        <input type="file" class="form-control" id="file" name="file">
                        @if($errors->get('file'))
                                @foreach($errors->get('file') as
                                $message)
                                <label style="color:red">{{ $message }}</label>
                                @endforeach @endif
                      </div>
                      <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary " style="color:white"><i class="fas fa-arrow-circle-left"></i> Retour</a>

                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-paper-plane"></i> Commander</button>
                  </form>


            </div>
        </div>
    </div>
</div>






@endsection

