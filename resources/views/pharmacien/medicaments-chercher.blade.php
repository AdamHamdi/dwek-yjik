@extends('pharmacien.main-content')
@section('content')
<br><br><br><br>



<div class="row mt-5">
    <div class="col-md-12">
        <div class="card ">
          <div class="card-header">
            <h4 class="card-title text-dark"> Liste des médicaments : </h4>


          </div>
          <div class="card-body">
            <div class="table-responsive" >
              <table class="table tablesorter table-bordered" id="" style="border:2px solid gray;">
                <thead class="text-light bg-primary">
                  <tr>
                    <th style="border:2px solid gray;" class="text-center">Refference</th>
                    <th style="border:2px solid gray;"class="text-center"> Nom </th>
                    <th style="border:2px solid gray;"class="text-center">Posologie</th>
                    <th style="border:2px solid gray;"class="text-center">Prix</th>

                    <th style="border:2px solid gray;"class="text-center">Disponibilité</th>


                  </tr>
                </thead>
                <tbody>
                    @foreach($meds as $med)
                    <tr>
                        <td style="border:2px solid gray;">{{ $med->id}} </td>
                        <td style="border:2px solid gray;">{{ $med->nom_med}} </td>
                        <td style="border:2px solid gray;">{{ $med->posologie}} </td>
                        <th style="border:2px solid gray;">{{ $med->prix}} TND</th>
                        <th style="border:2px solid gray;">{{ $med->dispo}}</th>


                      </tr>
                       @endforeach
                       <div class="float-right">{{ $meds->links() }}</div>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
    @endsection
