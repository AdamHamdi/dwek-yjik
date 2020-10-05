@extends('pharmacien.main-content')
@section('content')
<br><br><br><br>
<div class="row mt-5">
    <div class="col-md-8 offset-2 mx-auto">
        <div class="card">
            <div class="card-header bg-primary" ><h3 style="text-align: center; color :white">Passer la facture</h3></div>
            <div class="card-body">
                <form action="{{ route('passer.facture') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    @foreach($commandes as $cmd)
                    <input type="hidden" name='user_id' value="{{ $cmd->user_id }}">
                   <input type="hidden" name='pharmacie_id' value="{{ $cmd->pharmacie_id}}">
                   <input type="hidden" name='commande_id' value="{{ $cmd->id }}">
                   @endforeach
                    <div class="form-group" >

                      <input type="hidden" class="form-control" rows="5" id="montant" name="montant" value="0" placeholder="Saisir le montant de la facture">
                      @if($errors->get('montant'))
                      @foreach($errors->get('montant') as
                      $message)
                      <label style="color:red">{{ $message }}</label>
                      @endforeach @endif
                    </div>
                    <div class="form-group">
                        <label for="date_facturation">Date de facturation *</label>
                        <input type="date" class="form-control" id="date_facturation" name="date_facturation">
                        @if($errors->get('date_facturation'))
                                @foreach($errors->get('date_facturation') as
                                $message)
                                <label style="color:red">{{ $message }}</label>
                                @endforeach @endif
                      </div>
                      <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary " style="color:white"><i class="fas fa-arrow-circle-left"></i> Retour</a>
        
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-paper-plane"></i> Facturer</button>
                  </form>

            </div>
        </div>
    </div>
</div>






@endsection

