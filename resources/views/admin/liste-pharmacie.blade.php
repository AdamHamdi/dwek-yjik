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
            <h4 class="card-title text-dark"> La liste des Pharmacies : </h4>
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
                    <th style="border:2px solid gray;" class="text-center">Nom</th>
                    <th style="border:2px solid gray;"class="text-center"> Adresse </th>
                    <th style="border:2px solid gray;"class="text-center">Téléphone</th>
                    <th style="border:2px solid gray;"class="text-center">Matricule fiscale</th>

                    <th style="border:2px solid gray;"class="text-center">Code de déontologie</th>
                    <th style="border:2px solid gray;"class="text-center">Etat</th>
                    <th style="border:2px solid gray;"class="text-center">Action</th>

                  </tr>
                </thead>
                <tbody>

                    @foreach($pharmacies as $pharm)
                    <tr>
                        <td style="border:2px solid gray;">{{ $pharm->name}} </td>
                        <td style="border:2px solid gray;">{{ $pharm->adresse}} </td>
                        <td style="border:2px solid gray;">{{ $pharm->phone}} </td>
                        <td style="border:2px solid gray;">{{ $pharm->mat_fiscale}} TND</td>
                        <td style="border:2px solid gray;">{{ $pharm->code_deontologie}}</t>
                         <td style="border:2px solid gray;">
                         {{ $pharm->etat}} </td>
                        <td style="border:2px solid gray;">
                            <form action="" onsubmit="return confirm('Voulez vous vraiment supprimer cette pharmacie ?');" method="post">

                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                        <a href="{{ url('pharmacies/'.$pharm->id) }}" type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Supprimer</a>

                         </form>
                        </td>

                      </tr>
                       @endforeach
                         <div class="float-right">{{ $pharmacies->links() }}</div>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    @endsection
