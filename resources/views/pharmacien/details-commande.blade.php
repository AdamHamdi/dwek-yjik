@extends('pharmacien.main-content')
@section('content')
<br><br><br>
<div class="row mt-5">
    <div class="col-md-8 offset-2">
        <div class="card rounded-0">
            <div class="card-body">

               <h3 class="card-title ml-3 text-primary">{{ App\User::findOrFail($commandes->user_id)->nom}} {{ App\User::findOrFail($commandes->user_id)->prenom}}</h3>
               <h5 class="card-title ml-3 text-primary">{{ $commandes->created_at}} </h5>
               <img src="{{ URL::to('ordonnance/'.$commandes->file) }}" alt="" class="ml-3 card-img  mb-3 rounded img-fluid" style="width:600px;">
               <div class=" ml-3 card-text text-dark">L&#039adresse du Client est : <b class="text-primary">{{ $commandes->adresse}}. </b></div>
<br><div>
<a href="{{url()->previous()}}" class="btn btn-sm btn-secondary " style="color:white"><i class="fas fa-arrow-circle-left"></i> Retour</a>

                   @if($commandes->status_commande!='payée')or($commandes->status_commande!='expediée')or ($commandes->status_commande!='reçue')
                       <a href="{{ url('factures/'.$commandes->id.'/create') }}" class="  btn btn-sm btn-success"><i class="fas fa-file-invoice"></i> Préparer facture</a>

                @endif
                <a href="{{ url('factures/'.$commandes->id.'/voir-facture') }}" class="  btn btn-sm btn-info"><i class="fas fa-eye"></i> Voir facture</a>



                </div>

            </div>

        </div>
    </div>
</div>

    @endsection
