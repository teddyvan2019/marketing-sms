@extends('layouts.admin_template')
@section('title','Ajout d\'un acteur de controle')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{ __('Creation') }}</h3>
                </div>
              <!-- /.card-header -->
              <!-- form start -->
                <form class="form-horizontal">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Libelle</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Centre d'informations,de Formation et d'Etudes sur le Budget">
                                    </div>
                                </div>
                            </div> <!-- ./form-group -->
                        </div> <!-- ./col-sm-6 -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Abreviation</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-check"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="CIFOEB">
                                    </div>
                                </div>
                            </div> <!-- ./form-group -->
                        </div> <!-- ./col-sm-6 -->
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputEmail3" class=" control-label"> Telephone 1</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                        
                                    </div>
                                </div>
                            </div> <!-- ./form-group -->
                        </div> <!-- ./col-sm-6 -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label"> Telephone 2</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                                        </div>
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="">
                                    </div>
                                </div>
                            </div> <!-- ./form-group -->
                        </div> <!-- ./col-sm-6 -->
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputEmail3" class=" control-label">Site web</label>
                                <div class="col-sm-10">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> <i class="fa fa-globe"></i> </span>
                                        </div>
                                        <input type="url" class="form-control" id="inputEmail3" placeholder="">
                                    </div>
                                </div>
                            </div> <!-- ./form-group -->
                        </div> <!-- ./col-sm-6 -->

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                                <div class="col-sm-8">
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> @ </span>
                                        </div>
                                        <input type="email" class="form-control" id="inputEmail3" placeholder="">
                                    </div>
                                </div>
                            </div> <!-- ./form-group -->
                        </div> <!-- ./col-sm-6 -->
                    </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Enregistrer</button>
                    <button type="reset" class="btn btn-default float-right">Cancel</button>
                </div>
                <!-- /.card-footer -->
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
@endsection
