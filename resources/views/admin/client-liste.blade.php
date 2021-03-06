@extends('admin.main-content')
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
            <h4 class="card-title text-dark"> La liste des Clients : </h4>
                {{--  <form class="form-inline my-2 my-lg-0" action="{{ route('medicaments.search') }}" method="post">
                    {{ csrf_field() }}
                    <input class="form-control mr-sm-2" type="search" name="search"  placeholder="Chercher un médicament" aria-label="Search">
                    <button class="btn btn-info my-2 my-sm-0" type="submit"><i class="fas fa-search"></i> Recherche</button>
                </form>  --}}

          </div>
          <div class="card-body">
            <div class="table-responsive" >
              <table class="table tablesorter table-bordered" id="" style="border:2px solid gray;">
                <thead class="text-light bg-primary">
                  <tr>
                    <th style="border:2px solid gray;" class="text-center">Nom et prenom</th>
                    <th style="border:2px solid gray;"class="text-center"> Adresse </th>
                    <th style="border:2px solid gray;"class="text-center">Téléphone</th>

                    <th style="border:2px solid gray;"class="text-center">Actions</th>



                  </tr>
                </thead>
                <tbody>

                    @foreach($clients as $client)
                    <tr>
                        <td style="border:2px solid gray;">{{ $client->nom}} {{ $client->prenom}} </td>
                        <td style="border:2px solid gray;">{{ $client->adresse}} </td>
                        <td style="border:2px solid gray;">{{ $client->tel}} </td>

                         <td style="border:2px solid gray;">
                            <form action="{{url('clients/'.$client->id)}}" onsubmit="return confirm('Voulez vous vraiment supprimer ce client ?');" method="post">

                                {{ csrf_field() }} {{ method_field('DELETE') }}
                                <button class="btn btn-sm btn-danger" type ="submit" style="color:white"><i class="fas fa-trash"></i> Supprimer</button>


                             </form>
                          </td>


                      </tr>
                       @endforeach
                         <div class="float-right">{{ $clients->links() }}</div>

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

