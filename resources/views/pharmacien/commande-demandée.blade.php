@extends('pharmacien.main-content')
@section('content')
<br><br><br><br>
<div class="container">


<div class="row mt-5">
    <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title text-dark"> Liste des commandes :</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive" >
              <table class="table tablesorter table-bordered" id="" style="border:2px solid gray;">
                <thead class="text-light bg-primary">
                  <tr >
                    <th  style="border:2px solid gray;" class="text-center"> Référence </th>
                    <th style="border:2px solid gray;"class="text-center">Adresse</th>
                    <th style="border:2px solid gray;"class="text-center">Date</th>
                    <th style="border:2px solid gray;"class="text-center">Statut</th>

                    <th style="border:2px solid gray;"class="text-center">Ordonnance</th>
                    <th style="border:2px solid gray;"class="text-center">Client</th>
                    <th style="border:2px solid gray;" class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $comm )
                    <tr>
                        <td style="border:2px solid gray;">{{ $comm->id}} </td>
                        {{--  <td style="border:2px solid gray;">{{ str_limit($comm->description,30)}} </td>  --}}
                        <td style="border:2px solid gray;">{{ $comm->adresse}} </td>
                        <td style="border:2px solid gray;">{{ $comm->created_at}} </td>
                        <td style="border:2px solid gray;"> {{ $comm->status_commande}}</td>

                        <td style="border:2px solid gray;"> <img src="{{ URL::to('ordonnance/'.$comm->file) }}" alt="" class="card-img  mb-3 rounded " style="width:100px;height:50px">
                        </td>
                        <td style="border:2px solid gray;"> {{ App\User::findOrFail($comm->user_id)->nom}} {{ App\User::findOrFail($comm->user_id)->prenom}}</td>
                        <td style="border:2px solid gray;" ><a href="{{ url('commandes/'.$comm->id.'/traiter') }}" class="btn btn-sm btn-success" style="color:white"><i class="fas fa-check-square"></i> Traiter</a>
                            <a href="{{url('commandes/'.$comm->id.'/details') }}" class="btn btn-sm btn-info" style="color:white"><i class="fas fa-eye"></i> Détails</a>
                            <a class="btn btn-sm btn-danger" style="color:white"><i class="fas fa-trash"></i> Supprimer</a> </td>

                      </tr>
                   @endforeach
                   <div class="float-right">{{ $commandes->links() }}</div>
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
