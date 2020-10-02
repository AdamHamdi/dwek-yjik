@extends('acceuil2')

@section('content')
<br><br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">{{ __("Vérification de l'adresse email") }}</div>

                <div class="card-body">
                    @if(Session::has('danger'))
        <div class="alert alert-danger">
            <a href="https://mailtrap.io/inboxes/1073467/messages/1879694240" class ><p class="text-dark">Nous avons envoyé un code de validation.</p> <u>Svp verifiez votre adresse email !</u></a>
            {{ Session::get('danger') }} @php Session::forget('danger'); @endphp
        </div>@endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
