@extends('layouts.admin_template')

@section('title','Modification d\'un utilisateur')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Utilisateurs') }}</div>
                    <div class="col-md-12">
                        <h4> Mise a jour du mot de passe de l' utilisateur : {{ $user->name}} - identifiant : {{ $user->email }} </h4>
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
                    {!! Form::model($user, ['url' => ['savePassword', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}

                        @if (session('ok'))
                                <div class="alert alert-success alert-dismissible hidden">
                                {!! session('ok') !!}
                                </div>
                            @endif  
                            @if (session('erreur'))
                                <div class="alert alert-danger alert-dismissible ">
                                {!! session('erreur') !!}
                                </div>
                            @endif  
                            
                            <div class="form-group row d-flex align-items-center mb-5">
                                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end">Ancien mot de passe </label>
                                    <div class="col-lg-5">
                                        <input type="password" name='old_password' value="{{ old('old_password') }}" class="form-control"  >
                                        @if ($errors->has('old_password'))
                                            <span class="help-block">
                                                <strong style='color:red'>{{ $errors->first('old_password') }}</strong>
                                            </span>
                                        @endif
                                    </div> 
                                </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Mot de passe </label>
                                <div class="col-lg-5">
                                    <input type="password" name='password' class="form-control"  placeholder="">
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
                                    <input type="password" name='password_confirmation' class="form-control"  placeholder="">
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            <strong style='color:red'>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="text-right">
                                <button class="btn btn-square btn-gradient-01" type="submit">Enregistrer</button>
                                <button class="btn btn-square btn-shadow" type="reset">Réinitialiser</button>
                            </div>
                        <!-- </form> -->
                    {!! Form::close() !!}
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>


@endsection
