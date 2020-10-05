@extends('livreur.main-content')
@section('content')
<br><br><br><br>
<div class="container">


<div class="row mt-5">
    <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title text-dark"> Liste des factures :</h4>
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
                             <a href="{{ url('factures/'.$fact->id.'/livrer') }}" class="btn btn-md btn-info " style="color:white"><i class="fas fa-print"></i> Imprimer</a></td>

                      </tr>
                       @endforeach
                       <div class="float-right">{{ $factures->links() }}</div>

                </tbody>
              </table>
              <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary " style="color:white"><i class="fas fa-arrow-circle-left"></i> Retour</a>
           
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    @endsection
