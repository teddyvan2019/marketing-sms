@extends('layouts.admin_template')

@section('title','Ajout d\'un sms instantané')
@section('content')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card"> 
                <div class="card-header">{{ __('Message') }}</div>
                    <div class="col-md-6">
                        <h4> Ajout d'un sms instantané  <a href="{{ url('messagesinstantane') }}">retour</a> </h4>
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
                    <form class="needs-validation" method="post" action="{{ route('messagesinstantane.store') }}" accept-charset='UTF-8'>
                        {{ csrf_field() }}
                    
                      <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Numéro(s)</label>
                        <div class="col-lg-5">
                            <input type="text" name='numero'  class="form-control" value="{{ old('numero') }}" placeholder="ex :70xxxxxx;74xxxxxx">
                            @if ($errors->has('numero'))
                            <span class="help-block">
                                <strong style='color:red'>{{ $errors->first('numero') }}</strong>
                            </span>
                            @endif
                            <small class="help-block"></small>
                        </div>
                            </div>
        
                        <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Message </label>
                            <div class="col-lg-4">
                                
                         <textarea id="message"  name="message" rows="5" cols="10"class="form-control" placeholder="Redigez votre message ici ..."></textarea>
                              <span id="remaining">160 caractères restants</span>
                              <span id="messages">1 message(s)</span>
                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                            </div>
                       </div>
                        
                        <div class="text-right">
                            <button class="btn btn-square btn-gradient-01" type="submit">Envoyer</button>
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

