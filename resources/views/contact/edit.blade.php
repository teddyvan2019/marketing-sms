@extends('layouts.admin_template')

@section('title','Modification dun contact')
@section('content')
<div class="row">
    <div class="col-md-6" style="text-align:left">
        <a class="btn btn-info btn-sm btn-square mr-1 mb-2" href="{{ url('/listeContact',[$contact->repertoire->id]) }}" onclick="return confirm('Retourner a la liste des contacts ?')"  ><i class="la la-arrow-left">  </i> </a>&nbsp;&nbsp;
    </div>
</div>
<div class="row flex-row"> 
    <div class="col-xl-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4>Modification d'un contact </h4>
            </div>
            <div class="widget-body">

            {!! Form::model($contact, ['route' => ['contacts.update', $contact->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Selectionnez le repertoire</label>
                        <div class="col-lg-5">
                            <select name='repertoire_id' class="form-control" >
                                <option value="{{ $contact->repertoire->id }}"> {{ $contact->repertoire->libelle }}</option>
                            </select>
                            @if ($errors->has('repertoire_id'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('repertoire_id') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom </label>
                        <div class="col-lg-5">
                            <input type="text" name='nom' class="form-control" value="{{ $contact->nom }}"  placeholder="">
                            @if ($errors->has('nom'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('nom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Prenom </label>
                        <div class="col-lg-5">
                            <input type="text" name='prenom' class="form-control" value="{{ $contact->prenom }}"  placeholder="">
                            @if ($errors->has('prenom'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('prenom') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date de naissance </label>
                        <div class="col-lg-5">
                            <input type="text" name='date_naissance' id="date_naissance" value="{{ $contact->date_naissance }}" class="form-control"  placeholder="">
                            @if ($errors->has('date_naissance'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('date_naissance') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Numero de telephone</label>
                        <div class="col-lg-5">
                            <input type="text" name='telephone' class="form-control" value="{{ $contact->telephone }}"  placeholder="">
                            @if ($errors->has('telephone'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('telephone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Email </label>
                        <div class="col-lg-5">
                            <input type="email" name='email' class="form-control" value="{{ $contact->email }}"  placeholder="">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date de relance </label>
                        <div class="col-lg-5">
                            <input type="text" name='date_relance' id="date_relance" class="form-control" value="{{ $contact->date_relance }}" placeholder="">
                            @if ($errors->has('date_relance'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('date_relance') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> profession </label>
                        <div class="col-lg-5">
                            <input type="text" name='profession' class="form-control" value="{{ $contact->profession }}"  placeholder="ex: DSI,Menusier">
                            @if ($errors->has('profession'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('profession') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Sexe</label>
                        <div class="col-lg-5">
                        <select name='sexe_id' class="form-control" >
                        
                            <option value="{{ $contact->sexe->id }}"> {{ $contact->sexe->libelle }} </option>
                            @if(!empty($genres))
                                @foreach($genres as $genre)
                                    @if($genre->id != $contact->sexe->id )
                                        <option value="{{$genre->id}}"> {{$genre->libelle}} </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('sexe_id'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('sexe_id') }}</strong>
                                </span>
                            @endif
                    </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Religion </label>
                        <div class="col-lg-5">
                        <select  name='religion_id' class="form-control" >
                            <option value="{{ $contact->religion->id }}"> {{ $contact->religion->libelle }} </option>
                            @if(!empty($religions))
                                @foreach($religions as $religion)
                                    @if($religion->id != $contact->religion->id )
                                        <option value="{{ $religion->id }}"  > {{$religion->libelle}} </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('religion_id'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('religion_id') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center mb-5">
                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Ville de residence</label>
                    <div class="col-lg-5">
                        <select name='ville_id' class="form-control" >
                            <option value="{{ $contact->ville->id }}"> {{ $contact->ville->libelle }} </option>
                            @if(!empty($villes))
                                @foreach($villes as $ville)
                                    @if($ville->id != $contact->ville->id )
                                        <option value="{{$ville->id}}"> {{$ville->libelle}} </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('ville_id'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('ville_id') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-square btn-gradient-01" type="submit">Enregistrer</button>
                    <button class="btn btn-square btn-shadow" type="reset">Réinitialiser</button>
                </div>

            {!! Form::close() !!}

            </div>
        </div>
        <!-- End Form -->
    </div>
</div>
<!-- End Row -->
@endsection