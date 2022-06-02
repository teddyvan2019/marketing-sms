@extends('layouts.admin_template')

@section('title','Ajout d\'un nouvel utilisateur')
@section('content')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Utilisateurs') }}</div>
                    <div class="col-md-6">
                        <h4> Ajout d'un utilisateur  </h4>
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
                    <form class="needs-validation" method="post" action="{{ url('users') }}" accept-charset='UTF-8'>
                        <!-- <form class="needs-validation" method="post" action="{{ url('register') }}" accept-charset='UTF-8'> -->
                        {{ csrf_field() }}
                    
                        <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom & prénom</label>
                            <div class="col-lg-5">
                                <input type="text" name='name' class="form-control" value="{{ old('name') }}"  placeholder="">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> E-mail</label>
                            <div class="col-lg-5">
                                <input type="email" name='email' class="form-control" value="{{ old('email') }}"  placeholder="">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Mot de passe </label>
                            <div class="col-lg-5">
                                <input type="password" name='password' class="form-control" value="{{ old('password') }}"  placeholder="">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Confirmer mot de passe </label>
                            <div class="col-lg-5">
                                <input type="password" name='password_confirmation' class="form-control" value="{{ old('password_confirmation') }}"  placeholder="">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Rôle </label>
                            <div class="col-lg-5">
                                <select name="role_id" id="role_id" class="form-control" >
                                @if(!empty($roles))
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"> {{ $role->libelle }}  </option>
                                @endforeach
                                @endif
                                </select>
                                @if ($errors->has('role_id')) 
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('role_id') }}</strong>
                                    </span>
                                @endif
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
