@extends('client.main-content') @section('content')
<br><br><br><br>
<div class="row mt-5">
    <div class="col-md-6 offset-3 mx-auto">
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
        <div class="card">
            <div class="card-header bg-primary">
                <h3 style="text-align: center; color :white">Paiement avec carte banquaire </h3>
            </div>
            <div class="card-body">
                @foreach ($facture as $fa)


                <form action="{{ url('factures/'.$fa->commande_id.'/payer')}}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}


                    <div class="form-group">
                        <label for="cc_number">Numéro de la carte *</label>
                        <input type="text" class="form-control" rows="5" id="cc_number" name="cc_number" placeholder="Saisir le numéro de votre carte s-v-p">
                        @if($errors->get('cc_number')) @foreach($errors->get('cc_number') as $message)
                        <label style="color:red">{{ $message }}</label> @endforeach @endif
                    </div>

                    <div class="form-group">
                        <input type="hidden" class="form-control" rows="5" id="solde" name="solde" value="{{ $fa->montant }}">
                        @if($errors->get('solde')) @foreach($errors->get('solde') as $message)
                        <label style="color:red">{{ $message }}</label> @endforeach @endif
                    </div>
                        <div class="row">


                            <div class="col-10">
                                <div class="form-group">
                                    <label for="validity">La date de validitée *</label>
                                    <input type="date" class="form-control " id="validity" name="validity">
                                    @if($errors->get('validity')) @foreach($errors->get('validity') as $message)
                                    <label style="color:red">{{ $message }}</label> @endforeach @endif
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="cvv">CVV/CVC *</label>
                                    <input type="text" class="form-control " id="cvv" max="4" name="cvv" placeholder="CVV">
                                    @if($errors->get('cvv')) @foreach($errors->get('cvv') as $message)
                                    <label style="color:red">{{ $message }}</label> @endforeach @endif
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-secondary btn-lg"><i class="fab fa-cc-visa"></i> Payer</button>
                </form>
          @endforeach
                </div>
            </div>
        </div>
    </div>






    @endsection
