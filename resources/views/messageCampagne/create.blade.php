@extends('layouts.admin_template')

@section('title','Ajout d\'un message')
@section('content')
 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">La date du debut de la campagne * {{$campagne->libelle }} * était *  {{$campagne->dateDebut }} * et prendra fin le *  {{$campagne->dateFin }} *  </div>
                    <div class="col-md-6">
                        <h4> Ajout d'un message </h4>
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
                    <form class="needs-validation" method="post" action="{{ url('messageStore',$campagne->id) }}" accept-charset='UTF-8'>
                    {{ csrf_field() }}
                    <style>
                         .mul-select{
                                    width: 100%;
                                }
                            </style>

                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date d'envoie</label>
                        <div class="col-lg-5">
                            <input id="dateEnvoi" type="date" class="form-control @error('dateEnvoi') is-invalid @enderror" name="dateEnvoi" value="1" @if(old('dateEnvoi')) checked @endif required autocomplete="dateEnvoi" autofocus>

                           @error('dateEnvoi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <small class="help-block"></small>
                        </div>

                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Heure d'envoie</label>
                    <div class="col-lg-5">
                        <input type="time" name='heureEnvoi' class="form-control" value="{{ old('heureEnvoi') }}">
                        @if ($errors->has('heureEnvoi'))
                        <span class="help-block">
                            <strong style='color:red'>{{ $errors->first('heureEnvoi') }}</strong>
                        </span>
                        @endif
                        <small class="help-block"></small>
                    </div>
                </div>

                  <div class="form-group row d-flex align-items-center mb-5">
                  
                </div>  
                 <input type="hidden" name='campagne_id' class="form-control" value="{{$campagne_id}}">

                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Selectionnez le repertoire</label>
                        <div class="col-lg-5">
                            <select name='repertoires[]' class="mul-select" multiple="true" >
                                <option value="-1"> Selectionnez le repertoire </option>
                                @if(!empty($repertoiresActifs))
                                    @foreach($repertoiresActifs as $repertoire)
                                    <option value="{{$repertoire->id}}"> {{ $repertoire->libelle }} </option>
                                    @endforeach
                                @endif
                            </select>
                            <small class="help-block"></small>
                        </div>
                    </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Message </label>
                            <div class="col-lg-4">
                                <textarea value=""  rows="5" placeholder="Redigez votre message ici !!!" name="message" id="message" class="form-control @error('message') is-invalid @enderror"></textarea>
                                <span id="remaining">160 caractères restants</span>
                                <span id="messages">1 message(s)</span>
                              
                                @if ($errors->has('message'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif


                            </div>
                            
                                  <fieldset>
                                    <legend>les informations</legend>

                                   <ol>
                                       <ul>[nom] -- Nom</ul>
                                       <ul>[prenom] -- Prenom</ul>
                                       <ul>[telephone] -- Telephone</ul>
                                       <ul>[email]-- Email</ul>
                                   </ol>
                                
                                  </fieldset>
                                <style type="text/css">
                                    
                                legend {
                                    background-color: #000;
                                    color: #fff;
                                    padding: 3px 6px;
                                }

                                </style>
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

