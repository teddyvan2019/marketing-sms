@extends('layouts.admin_template')
@section('title','Détails d\'une campagne')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('campagne') }} </div>
                    <div class="col-md-6">
                        <h4> Details de la campagne &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ url('campagne') }}">retour</a> </h4>
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
                                    <div class="campagne">
                                    @if(!empty($campagne))
                                    <h4><b> Libellé </b> :{{ $campagne->libelle}} </h4> <br>
                                    <h4><b> Description </b> :{{ $campagne->description}} </h4> <br>
                                    <h4><b> Date Debut </b> :{{ $campagne->dateDebut}} </h4> <br>
                                    <h4><b> Date Fin </b> :{{ $campagne->dateFin}} </h4> <br>
                                    
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
