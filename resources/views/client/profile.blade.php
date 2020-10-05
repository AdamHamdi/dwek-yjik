@extends('client.main-content')
@section('content')
<br><br>



<div class="row mt-5">
    <div class="col-md-8 mx-auto">
        <div class="card">

            <div class="card-body">
            @foreach($client as $client)
            <div class="card mx-auto border border-success" style="width: 38rem;">

                <img src="{{ URL::to('image/'.$client->image) }}" alt="" class="card-img mx-auto border border-info mb-3 mt-4 rounded-circle " style="width:200px;height:200px;">
                <div class="card-body">
                    <h3 class="card-title text-center text-primary"> {{$client->nom}} {{$client->prenom}}</h3><hr>
                    <p class="card-text text-primary"> <a class="btn btn-lg text-dark"><i class="fas fa-birthday-cake"></i></a>{{$client->ddn}}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-primary"> <a class="btn btn-lg text-dark"><i class="fas fa-at"></i></a>{{$client->email}}</li>
                    <li class="list-group-item text-primary"> <a class="btn btn-lg text-dark"><i class="fas fa-phone-square"></i><a> {{$client->tel}}</li>
                    <li class="list-group-item text-primary"> <a class="btn btn-lg text-dark"><i class="fas fa-map-marker-alt"></i></a>  {{$client->adresse}}</li>
                </ul>
                <div class="card-body">
                    <a href="{{url('clients/'.$client->id.'/edit')}}" class="btn btn-lg btn-block btn-info"><i class="fas fa-edit"></i>Modifier profile</a>

                </div>
                </div>
                @endforeach


            </div>
        </div>
    </div>
</div>





@endsection

