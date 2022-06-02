@extends('layouts.admin_template')

@section('title','Modification d\'un utilisateur')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Utilisateurs') }}</div>
                    <div class="col-md-6">
                        <h4> Mise a jour de l'utilisateur : {{ $user->name }}  </h4>
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
                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
                {{ csrf_field() }} 
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
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom & prénom</label>
                        <div class="col-lg-5">
                            <input type="text" name='name' class="form-control" value="{{ $user->name }}"  placeholder="">
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
                            <input type="email" name='email' class="form-control" value="{{ $user->email }}"  placeholder="">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('email') }}</strong>
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
                <!-- </form> -->
                {!! Form::close() !!}
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>

@endsection
