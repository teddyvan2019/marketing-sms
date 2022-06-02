@extends('layouts.admin_template')
@section('title','Détails d\'un message')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('message') }} </div>
                    <div class="col-md-6">
                        <h6> Details du message de la campagne ***  {{$campagne->libelle }} *** &nbsp;&nbsp;<a href="{{ url('/listeMessage', $campagne->id) }}">retour</a></h6>
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
                                    <div class="message">
                                   @if(!empty($message))

                                    <h4><b> Message </b> :{{ $message->message}} </h4> <br>
                                    <h4><b> Date d'envoie </b> :{{ $message->dateEnvoi}} </h4> <br>
                                    <h4><b> Heure d'envoie </b> :{{ $message->heureEnvoi}} </h4> <br>
                                    <h4><b> Repertoire </b>
                                        @if(!empty($repertoiresSelectionnes))
                                            @foreach($repertoiresSelectionnes as $repertoire)
                                            <br/>{{ $repertoire->repertoire->libelle }} :
                                            <?php echo count( $repertoire->repertoire->contacts) ; ?> 
                                            @endforeach
                                        @endif 
                                    </h4> <br>
 
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
