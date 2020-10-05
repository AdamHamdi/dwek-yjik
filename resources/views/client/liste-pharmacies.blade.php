@extends('client.main-content')
@section('content')
<br><br><br><br>
<div class="container">


<div class="row mt-5">
    <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title text-dark"> Liste des pharmacies :

            <div class="float-right">
              <form class="form-inline my-2 my-lg-0" action="{{route('pharmacies.search')}}" method="post">
            {{ csrf_field() }}
            <input class="form-control mr-sm-2" type="search" name="search"  placeholder="Recherche" aria-label="Search">
            <button class="btn btn-info my-2 my-sm-0" type="submit">Recherche</button>
        </></div></h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table tablesorter table-bordered" id="" style="border:2px solid gray;">
                <thead class=" text-light bg-primary">
                  <tr>
                    <th style="border:2px solid gray;"class="text-center"> Nom </th>
                    <th style="border:2px solid gray;"class="text-center">Adresse</th>
                    <th style="border:2px solid gray;"class="text-center">Téléphone</th>
                    <th style="border:2px solid gray;"class="text-center">Pharmacien</th>
                    <th style="border:2px solid gray;" class="text-center">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($pharmacies as $pharm)
                        <tr>

                            <td style="border:2px solid gray;">{{ $pharm->name}} </td>
                            <td style="border:2px solid gray;"> {{ $pharm->adresse}}</td>
                            <td style="border:2px solid gray;"> {{ $pharm->phone}}</td>
                            <td style="border:2px solid gray;"> {{ App\User::findOrFail($pharm->user_id)->nom}} {{ App\User::findOrFail($pharm->user_id)->prenom}}</td>
                            <td style="border:2px solid gray;" class="text-center">
                                <a href="{{ url('commandes/'.$pharm->id.'/create') }}" class="btn btn-sm btn-success" style="color:white"><i class="far fa-paper-plane"></i> Passer commande</a>
                            </td>

                        </tr>
                       @endforeach
                       <div class="float-right">{{ $pharmacies->links() }}</div>
                </tbody>
              </table>
              <a href="{{url()->previous()}}" class="btn btn-sm btn-secondary " style="color:white"><i class="fas fa-arrow-circle-left"></i> Retour</a>
        
            </div>
          </div>
        </div>
      </div>

    </div>
    {{--  <div class="row">
        <div class="col-md-12">
            <div class="card card-plain">
                <div class="card-header">
                    Google Maps
                </div>
                <div class="card-body">
                    <div id="map" class="map"></div>
                </div>
            </div>
        </div>
    </div>


@push('js')
    <!-- Place this tag in your head or just before your close body tag. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAjOIk2FPrhXzNJEl28ZexWbVnTu0CSpZU"></script>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            demo.initGoogleMaps();
        });
    </script>
@endpush  --}}
</div>
    @endsection
