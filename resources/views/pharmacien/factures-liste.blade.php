@extends('pharmacien.main-content')
@section('content')
<br><br><br><br>
<div class="container">


<div class="row mt-5">
    <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title text-dark"> Liste des factures :

            </h4>
          </div>
          <div class="card-body">
            <div class="table-responsive" >
              <table class="table tablesorter table-bordered" id="" style="border:2px solid gray;">
                <thead class="text-light bg-primary">
                  <tr>
                    <th style="border:2px solid gray;" class="text-center">Référence</th>
                    <th style="border:2px solid gray;"class="text-center"> Pharmacie </th>
                    <th style="border:2px solid gray;"class="text-center">Commande</th>
                    <th style="border:2px solid gray;"class="text-center">Date</th>
                    <th style="border:2px solid gray;"class="text-center" >Montant</th>
                    <th style="border:2px solid gray;"class="text-center">Client</th>

                    <th style="border:2px solid gray;" class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($factures as $fact)
                    <tr>
                        <td style="border:2px solid gray;">{{ $fact->id}} </td>
                        <td style="border:2px solid gray;">{{ $fact->name}} </td>
                        <td style="border:2px solid gray;">{{ $fact->status_commande}} </td>
                        <th style="border:2px solid gray;">{{ $fact->date_facturation}}</th>
                        <th style="border:2px solid gray;">{{ $fact->montant+5}} TND</th>
                        <th style="border:2px solid gray;">{{ App\User::findOrFail($fact->user_id)->nom}} {{ App\User::findOrFail($fact->user_id)->prenom}}</th>
                        <td style="border:2px solid gray;">
                      @if(( App\Commande::findorFail($fact->commande_id)->status_commande =='payée') || ( App\Commande::findorFail($fact->commande_id)->status_commande =='expediée'))

                            <a href="{{ url('factures/'.$fact->id.'/imprimer') }}" class="btn btn-md btn-info " style="color:white"><i class="fas fa-print"></i> Imprimer</a></td>

                            @else
                            <a href="{{ url('medicaments/'.$fact->id.'/ajouter') }}" class="btn btn-md btn-success " style="color:white"><i class="fas fa-file-invoice"></i> Ajouter médicament</a>
                            <a href="{{ url('factures/'.$fact->id.'/imprimer') }}" class="btn btn-md btn-info " style="color:white"><i class="fas fa-print"></i> Imprimer</a></td>

                            @endif

                      </tr>
                       @endforeach
                       <div class="float-right">{{ $factures->links() }}</div>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    @endsection
