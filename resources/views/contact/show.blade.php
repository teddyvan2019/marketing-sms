@extends('layouts.admin_template')

@section('title','Détails d\'un contact')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Contacts') }}</div>
                    <div class="col-md-6">
                        <h4> details du contact :  </h4>
                    </div> 
                    <div class="col-md-6" >
                        <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#ajouter_contact"> <i class="la la-plus"></i> Nouveau contact  </button>
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
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-wrench"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item"> Exporter PDF<i class="fa fa-download"></i></a>
                                <a href="#" class="dropdown-item"> Exporter CSV<i class="fa fa-download"></i></a>
                            </div>
                        </div>
                    </div> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                   
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>

@endsection
