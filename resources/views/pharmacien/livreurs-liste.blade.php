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
            <h4 class="card-title text-dark"> Liste des livreurs : </h4>

          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table tablesorter table-bordered" id="" style="border:2px solid gray;">
                <thead class="text-light bg-primary">
                  <tr>
                    <th style="border:2px solid gray;"class="text-center"> Nom </th>
                    <th style="border:2px solid gray;"class="text-center">Prénom</th>
                    <th style="border:2px solid gray;"class="text-center">Pharmacie</th>
                    <th style="border:2px solid gray;"class="text-center">N° de Téléphone</th>
                    <th style="border:2px solid gray;" class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($pharmacie as $liv)
                    <tr>
                        <td style="border:2px solid gray;">{{ $liv->nom}} </td>
                        <td style="border:2px solid gray;">{{ $liv->prenom}} </td>
                        <td style="border:2px solid gray;">{{ $liv->name}} </td>
                        <td style="border:2px solid gray;">{{ $liv->tel}} </td>
                        <td style="border:2px solid gray;">
                            <form action="{{url('livreurs/'.$liv->id)}}" onsubmit="return confirm('Voulez vous vraiment supprimer cet compte livreur ?');" method="post">

                                {{ csrf_field() }} {{ method_field('DELETE') }}

                            <button href="" class="btn btn-sm btn-danger " style="color:white"><i class="fas fa-trash"></i> Supprimer</button>

                            </form>
                        </td>

                      </tr>
                       @endforeach
                       <div class="float-right">{{ $pharmacie->links() }}</div>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
    @endsection
