@extends('client.main-content')
@section('content')
<br><br><br><br>
<div class="container">


<div class="row mt-5">
    <div class="col-md-12">
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
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title text-dark"> Liste des factures :</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive" >
              <table class="table tablesorter table-bordered" id="" style="border:2px solid gray;">
                <thead class="text-light bg-primary">
                  <tr>
                    <th style="border:2px solid gray;" class="text-center">Refference</th>
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
                            <form action="{{url('factures/'.$fact->id)}}" onsubmit="return confirm('Voulez vous vraiment supprimer cette facture ?');" method="post">

                                    {{ csrf_field() }} {{ method_field('DELETE') }}
                                    @if($fact->status_commande==='refusée')
                                   <button href="{{ url('factures/'.$fact->id) }}" class="btn btn-sm btn-danger " style="color:white"><i class="fas fa-trash"></i> Supprimer</button>
                            @else
                            <a href="{{ url('factures/'.$fact->id.'/details') }}" class="btn btn-sm btn-success " style="color:white"><i class="fas fa-eye"></i> Details</a>
                                

                            @endif
                              </form>
                        </td>

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
