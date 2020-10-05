@extends('client.main-content')
@section('content')
<br><br><br><br>
<div class="container">


<div class="row mt-5">
    <div class="col-md-12 ">

        <div class="card ">
          <div class="card-header">
            @foreach($commandes as $cmd)
            <div class="card-title text-dark row">
                 <h4 class="text-left col-md-4">{{ $cmd->name }}</h4>
                 <h4 class="text-center col-md-4">Devis : 0000{{  $cmd->id}} </h4>
                 <h4 class="text-right col-md-4"> Client : {{ $cmd->nom }} {{ $cmd->prenom }}</h4>
            </div>
            <div class="card-title text-dark row">
                <h4 class="text-left col-md-4"> {{ $cmd->mat_fiscale}}</h4>
                <h4 class="text-center col-md-4"> {{ $cmd->date_facturation }}</h4>
                <h4 class="text-right col-md-4">Commande :000{{ App\Commande::findorFail($cmd->commande_id)->id}}</h4>
           </div>
@endforeach
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table tablesorter table-bordered" id="" style="border:2px solid gray;">
                <thead class="text-dark bg-light">
                  <tr>
                    <th style="border:2px solid gray;"class="text-center"> Medicament </th>
                    <th style="border:2px solid gray;"class="text-center">Disponibilitée</th>
                    <th style="border:2px solid gray;"class="text-center">Posologie</th>
                    <th style="border:2px solid gray;" class="text-center">Prix</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($fact as $fa)
                    <tr>
                        <td style="border:2px solid gray;">{{ $fa->nom_med }} </td>
                        <td style="border:2px solid gray;">{{ $fa->dispo }}  </td>
                        <td style="border:2px solid gray;"> {{ $fa->posologie }} </td>
                        <td style="border:2px solid gray;" class="text-right"> {{ $fa->prix }} </td>

                      </tr>
                        @endforeach
                        @if($fact)
                        <tr>
                        <td  style="border:2px solid gray;" colspan="3"> Le montant total est :</td>
                        <td class="text-right" style="border:2px solid gray;"><h4>{{ $fact->sum('prix') }} TND</h4></td>
                      </tr>
                      <tr>
                        <td  style="border:2px solid gray;" colspan="3"> Le frais de livraison est :</td>
                        <td class="text-right" style="border:2px solid gray;"><h4>5 TND</h4></td>
                      </tr>
                       <tr>
                        <td  style="border:2px solid gray;" colspan="3"> Le montant Total à payer est :</td>
                        <td class="text-right" style="border:2px solid gray;"><h4>{{ $fact->sum(('prix'))+5 }} TND</h4></td>


                      </tr>
                       @endif

                </tbody>
              </table>
              <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary " style="color:white"><i class="fas fa-arrow-circle-left"></i> Retour</a>


                        @if(( App\Commande::findorFail($cmd->commande_id)->status_commande !='payée') && ( App\Commande::findorFail($cmd->commande_id)->status_commande !='expediée'))
                             <a href="{{ url('factures/'.$cmd->id.'/paiement') }}" class="btn btn-sm btn-info " style="color:white"><i class="fas fa-money-bill-wave"></i> Paiement</a>

                             @endif
           

            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    @endsection
