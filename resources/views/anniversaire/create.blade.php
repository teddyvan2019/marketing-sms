@extends('layouts.admin_template')

@section('title','Ajout d\'un anniversaire')
@section('content')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('anniversaire') }}</div>
                    <div class="col-md-6">
                        <h4> Ajout d'un anniversaire </h4>
                    </div> 
                    <div class="col-md-6" >
                    <!-- <a href=" {{ route('users.create') }}" class="btn btn-info btn-sm btn-square mr-1 mb-2"><i class="la la-plus"></i> Nouvelle utilisateur </a> -->

                    <!-- <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#ajouter_contact"> <i class="la la-plus"></i> Nouveau contact  </button> -->
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
                    <form class="needs-validation" method="post" action="{{ route('anniversaire.store') }}" accept-charset='UTF-8'>
                    {{ csrf_field() }}
                    <style>
                         .mul-select{
                                    width: 60%;
                                }
                            </style>
                        
                             <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom de la anniversaire</label>
                                <div class="col-lg-5">
                                    <input type="text" name='libelle' class="form-control" value="{{ old('libelle') }}" placeholder="ex : Lancement du Produit X">
                                     @if ($errors->has('libelle'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('libelle') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> description</label>
                                <div class="col-lg-5">
                                    <input type="text" name='description' class="form-control" value="{{ old('description') }}" placeholder="ex : Cet anniversaire concerne le lancement du Produit X">
                                      @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date d'envoie</label>
                                <div class="col-lg-5">
                                    <input type="date" name='dateDebut' class="form-control" value="{{ old('dateDebut') }}" placeholder="">
                                      @if ($errors->has('dateDebut'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('dateDebut') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date d'envoie</label>
                                <div class="col-lg-5">
                                    <input type="date" name='dateFin' class="form-control" value="{{ old('dateFin') }}" placeholder="">
                                   @if ($errors->has('dateFin'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('dateFin') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>
                        
                            <div class="text-right">
                             <button class="btn btn-square btn-gradient-01" type="submit">Enregistrer</button>
                            <button class="btn btn-square btn-shadow" type="reset">Réinitialiser</button>
                            </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>

@endsection

