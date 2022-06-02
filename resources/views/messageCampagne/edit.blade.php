@extends('layouts.admin_template')

@section('title','Modification du message')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('message') }}</div>
                    <div class="col-md-6">
                        <h4>Modification du message </h4>
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
                
                <div class="card-body">
               {!! Form::open(array('class' => 'form-horizontal', 'method' => 'put', 'action' => array('MessageCampagnesController@update',$message->id,$campagne->id)) )!!}

                  {{ csrf_field() }}
                

                    <style>
                         .mul-select{
                                    width: 100%;
                                }
                            </style>
                        
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date d'envoie</label>
                        <div class="col-lg-5">
                            <input type="date" name='dateEnvoi' class="form-control" value="{{ $message->dateEnvoi }}" placeholder="">
                            @if ($errors->has('dateEnvoi'))
                            <span class="help-block">
                                <strong style='color:red'>{{ $errors->first('dateEnvoi') }}</strong>
                            </span>
                            @endif
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Heure d'envoie</label>
                    <div class="col-lg-5">
                        <input type="time" name='heureEnvoi' class="form-control" value="{{ $message->heureEnvoi }}" placeholder="">
                        @if ($errors->has('heureEnvoi'))
                        <span class="help-block">
                            <strong style='color:red'>{{ $errors->first('heureEnvoi') }}</strong>
                        </span>
                        @endif
                        <small class="help-block"></small>
                    </div>
                </div>

                  <div class="form-group row d-flex align-items-center mb-5">
                    
                 <input type="hidden" name='campagne_id' class="form-control" value="{{$campagne_id}}">
                </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Selectionnez le repertoire</label>
                        <div class="col-lg-5">
                            <select name='repertoires[]' class="mul-select" multiple="true" >
                                <!-- le garder les repertoire selectionner -->
                                @if(!empty($repertoiresSelectionnes))
                                    @foreach($repertoiresSelectionnes as $unRepertoire)
                                        <option value="{{$unRepertoire->repertoire->id}}" selected>{{$unRepertoire->repertoire->libelle}}</option>
                                    @endforeach
                                @endif
                                @if(!empty($repertoiresActifs))
                                    @foreach($repertoiresActifs as $repertoire)
                                    <option value="{{$repertoire->id}}"> {{ $repertoire->libelle}} </option>
                                    @endforeach
                                @endif
                            </select> 


            
                            <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Message </label>
                            <div class="col-lg-4">
                                <textarea  rows="5" placeholder="Redigez votre message ici !!!" name="message" id="message" class="form-control @error('message') is-invalid @enderror">{{$message->message}} </textarea>
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
                                       <ul>[Nom] -- Nom</ul>
                                       <ul>[Prenom] -- Prenom</ul>
                                       <ul>[Telephone] -- Telephone</ul>
                                       <ul>[Email]-- Email</ul>
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
                    <!-- </form> -->
                    {!! Form::close() !!}
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>

@endsection

