@extends('layouts.admin_template')

@section('title','Mon profil')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>
                    <div class="col-md-6">
                        <h4> Profil </h4>
                    </div> 
                </div>
            </div>
        </div>
        
        <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                    <img src="{{ URL::asset('template/admin/dist/img/logo_smartprest.jpg') }}" class="avatar rounded-circle d-block mx-auto" style="width: 120px;">

                        <!-- <img src="{{ URL::asset('assets/img/logo_.png') }}" alt="..." class="avatar rounded-circle d-block mx-auto" style="width: 120px;"> -->
                    </div>

                    <h3 class="profile-username text-center"> {{ $user->name }} </h3>
                    <p class="text-muted text-center"> {{ $user->email }} </p>
                    <p class="text-muted text-center"> {{ $user->role->libelle }} </p>
                    <div class="em-separator separator-dashed"></div>

                    <a class="btn btn-info btn-sm btn-square mr-1 mb-3" href="{{ url('/editPasswordProfil',[$user->id]) }}"  title="Changer le mot de passe"> <i class="la la-tv edit"> </i> Changer le mot de passe </a>
                </div>   <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
        </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                
              </div><!-- /.card-header -->
              <div class="card-body">
              {!! Form::model($user, ['route' => ['profil.update', $user->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
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
                                <input type="text" name='name' class="form-control" value="{{ $user->name }}" required='true'  placeholder="">
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
                                <input type="email" name='email' class="form-control" value="{{ $user->email }}"  required='true' placeholder="">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('email') }}</strong>
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
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</div>


@endsection
