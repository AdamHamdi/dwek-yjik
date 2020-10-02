@extends('pharmacien.main-content')
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
                        <td style="border:2px solid gray;" >
                            <form action="{{url('pharmaciens/commandes/'.$comm->id)}}" onsubmit="return confirm('Voulez vous vraiment supprimer cette commande ?');" method="post">

                                {{ csrf_field() }} {{ method_field('DELETE') }}
                            @if($comm->status_commande=='en cours')
                                      <a href="{{url('commandes/'.$comm->id.'/details') }}" class="btn btn-sm btn-info" style="color:white"><i class="fas fa-eye"></i> Détails</a>
                            <button class="btn btn-sm btn-danger" style="color:white"><i class="fas fa-trash"></i> Supprimer</button> </td>
                            @elseif($comm->status_commande=='payée')

                            <a href="{{url('commandes/'.$comm->id.'/exedier') }}" class="btn btn-sm btn-warning" style="color:white"><i class="fas fa-eye"></i> Expédiée</a>
                              @else
                            <button class="btn btn-sm btn-danger" style="color:white"><i class="fas fa-trash"></i> Supprimer</button>
                            @endif
                        </form>
                        </td>
                        </tr>
                   @endforeach
                   <div class="float-right">{{ $commandes->links() }}</div>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    @endsection
