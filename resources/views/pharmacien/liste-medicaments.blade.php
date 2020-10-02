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
            <h4 class="card-title text-dark"> Liste des médicaments : </h4>
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
                    <th style="border:2px solid gray;" class="text-center">Facture</th>
                    <th style="border:2px solid gray;"class="text-center"> Nom </th>
                    <th style="border:2px solid gray;"class="text-center">Posologie</th>
                    <th style="border:2px solid gray;"class="text-center">Prix</th>

                    <th style="border:2px solid gray;"class="text-center">Disponibilité</th>

                    <th style="border:2px solid gray;" class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($medicament as $med)
                    <tr>
                        <td style="border:2px solid gray;">000{{ $med->facture_id}} </td>
                        <td style="border:2px solid gray;">{{ $med->nom_med}} </td>
                        <td style="border:2px solid gray;">{{ $med->posologie}} </td>
                        <th style="border:2px solid gray;">{{ $med->prix}} TND</th>
                        <th style="border:2px solid gray;">{{ $med->dispo}}</th>
                        <td style="border:2px solid gray;">
                        <form action="{{ url('medicaments/'.$med->id) }}" onsubmit="return confirm('Voulez vous vraiment supprimer ce medicament ?');" method="post">

                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            {{--  <a href="" class="btn btn-sm btn-danger " style="color:white"><i class="fas fa-trash"></i> Supprimer</a>  --}}
                             <button type="submit" class="btn btn-danger btn-sm"><i class ="fas fa-trash"> </i> Supprimer</button>

                    </form>
                </td>

                      </tr>
                       @endforeach
                       <div class="float-right">{{ $medicament->links() }}</div>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    @endsection
