@extends('layouts.admin_template')
@section('title','Détails d\'un message instantané')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('message instantané') }}</div>
                    <div class="col-md-6">
                        <h4> Details d'un message instantané  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="{{ url('messagesinstantane') }}">retour</a>  </h4>
                    </div> 
                    <div class="col-md-6" >

                    </div>
                </div>
            </div>
        </div>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-widget="collapse">
                            <i class="fa fa-minus"></i>
                        </button>
                        
                    </div> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <ul class="reviews list-group w-100">
                                <!-- 01 -->
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <div class="smsinstantane">
                                    @if(!empty($smsinstantane))
                                                <h4><b> Date et heure d'envoie </b> : {{ $smsinstantane->created_at}} </h4> <br>
                                                <h4><b> Message </b> : {{ $smsinstantane->message}} </h4> <br>
                                    <h4><b> numero(s) envoyé(s) </b> 
                                             : {{ $smsinstantane->num_reception}} </h4> <br>
                                            @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- End 01 -->
                    </ul>
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>


@endsection
