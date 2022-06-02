@extends('layouts.admin_template')

@section('title','Liste des contacts ')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Contacts') }}</div>
                    <div class="col-md-6">
                        <h4> Liste des contacts du repertoire : {{ $repertoire->libelle }}  </h4>
                    </div> 
                    <div class="col-md-6" >
                        <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#ajouter_contact"> <i class="la la-plus"></i> Nouveau contact  </button>
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
                        <div class="btn-group">
                            <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-wrench"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" role="menu">
                                <a href="#" class="dropdown-item"> Exporter PDF<i class="fa fa-download"></i></a>
                                <a href="#" class="dropdown-item"> Exporter CSV<i class="fa fa-download"></i></a>
                            </div>
                        </div>
                    </div> 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th> No </th>
                                    <th> Nom et Prenom  </th>
                                    <th> Date de naissance</th>
                                    <th> Sexe </th>
                                    <th> Religion </th>
                                    <th> Ville </th>
                                    <th> Numero de telephone</th>
                                    <th> Email </th>
                                    <th> Profession </th>
                                    <th> etat </th>
                                    <th >Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($contacts))
                                <?php $i =1; ?>
                                @foreach ($contacts as $contact)
                                <tr>
                                    <td> <?= $i++ ?> </td>
                                    <td> {{ $contact->nom }} {{ $contact->prenom }} </td>
                                    <td> {{ $contact->date_naissance }} </td>
                                    <td> {{ $contact->sexe->libelle }} </td>
                                    <td> {{ $contact->religion->libelle }} </td>
                                    <td> {{ $contact->ville->libelle }} </td>
                                    <td> {{ $contact->telephone }} </td>
                                    <td> {{ $contact->email }} </td>
                                    <td> {{ $contact->profession }} </td>
                                    <td> 
                                        @if($contact->etat == 1)
                                            <button class="mr-1 mb-2 bg-info">  Activé </button>
                                        @elseif($contact->etat == 0)
                                            <button class="mr-1 mb-2 bg-danger"> Desactivé  </button>
                                        @endif
                                    </td>
                                    <td class="td-actions">  

                                        @if($contact->etat == 0)
                                            <a class="mr-1 mb-2" href="{{ url('/activerContact',[$contact->id]) }}" onclick="return confirm('Activer ce contact ?')" title="Activer contact" ><i class="fa fa-pencil edit"></i> </a>&nbsp;&nbsp;
                                        @elseif($contact->etat == 1)
                                            <a class="mr-1 mb-2" href="{{ url('/desactiverContact',[$contact->id]) }}" onclick="return confirm('Desactiver ce contact ?')" title="Desactiver contact" ><i class="fa fa-minus-circle edit"></i> </a>&nbsp;&nbsp;
                                        @endif
                                        <a class="mr-1 mb-2" href="{{ route('contacts.show',[$contact->id]) }}"  title="details"> <i class="fa fa-eye"> </i> </a>
                                        <a class="mr-1 mb-2" href="{{ route('contacts.edit',[$contact->id]) }}"  title="modifier"> <i class="fa fa-pencil"> </i> </a>
                                        <a href="contacts/{{ $contact->id }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce contact ? "><i class="fa fa-remove"> </i></a>

                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                
                            </tbody>
                        </table>
                        {!! $links !!}
                    </div> <!--  responsive -->
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>

<!-- Begin Centered Modal  formulaire de contact-->
<div id="ajouter_contact" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg"> 
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Ajouter un contact </h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                    <span class="sr-only">close</span>
                </button>
            </div>
            <div class="modal-body">
            <form class="needs-validation" method="post" id="formContact" action="{{ route('contacts.store') }}" accept-charset='UTF-8'>
                {{ csrf_field() }}
                    <div id="error_add_manuel" class="alert alert-danger alert-block" hidden="true">
                        <button type="button" class="close" data-dismiss="alert" >×</button>	
                            <strong id="error_msg_add_manuel"> </strong>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Selectionnez le repertoire</label>
                        <div class="col-lg-5">
                            <select name='repertoire_id' class="form-control" >
                                <option value="{{ $repertoire->id }}"> {{ $repertoire->nom }}</option>
                            </select>

                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom </label>
                        <div class="col-lg-5">
                            <input type="text" name='nom' class="form-control" value="{{ old('nom') }}"  placeholder="">
                             @if ($errors->has('nom'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('nom') }}</strong>
                                    </span>
                                    @endif
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Prenom </label>
                        <div class="col-lg-5">
                            <input type="text" name='prenom' class="form-control" value="{{ old('prenom') }}"  placeholder="">
                             @if ($errors->has('prenom'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('prenom') }}</strong>
                                    </span>
                                    @endif
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date de naissance </label>
                        <div class="col-lg-5">
                            <input type="text" name='date_naissance' id="date_naissance" class="form-control"  placeholder="">
                             @if ($errors->has('date_naissance'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('date_naissance') }}</strong>
                                    </span>
                                    @endif
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Numero de telephone</label>
                        <div class="col-lg-5">
                            <input type="text" name='telephone' class="form-control" value="{{ old('telephone') }}"  placeholder="">
                             @if ($errors->has('telephone'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                    @endif
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Email </label>
                        <div class="col-lg-5">
                            <input type="email" name='email' class="form-control" value="{{ old('email') }}"  placeholder="">
                             @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date de relance </label>
                        <div class="col-lg-5">
                            <input type="text" name='date_relance' id="date_relance" class="form-control"  placeholder="">
                             @if ($errors->has('date_relance'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('date_relance') }}</strong>
                                    </span>
                                    @endif
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> profession </label>
                        <div class="col-lg-5">
                            <input type="text" name='profession' class="form-control" value="{{ old('profession') }}"  placeholder="ex: DSI,Menusier">
                             @if ($errors->has('profession'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('profession') }}</strong>
                                    </span>
                                    @endif
                            <small class="help-block"></small>
                        </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Sexe</label>
                        <div class="col-lg-5">
                        <select name='sexe_id' class="form-control" >
                            @if(!empty($genres))
                                @foreach($genres as $genre)
                                    <option value="{{$genre->id}}"> {{$genre->libelle}} </option>
                                @endforeach
                            @endif
                        </select>
                        <small class="help-block"></small>
                    </div>
                    </div>
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Religion </label>
                        <div class="col-lg-5">
                        <select  name='religion_id' class="form-control" >
                            @if(!empty($religions))
                                @foreach($religions as $religion)
                                    <option value="{{$religion->id}}"> {{$religion->libelle}} </option>
                                @endforeach
                            @endif
                        </select>
                        <small class="help-block"></small>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center mb-5">
                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Ville de residence</label>
                    <div class="col-lg-5">
                        <select name='ville_id' class="form-control" >
                            @if(!empty($villes))
                                @foreach($villes as $ville)
                                    <option value="{{$ville->id}}"> {{$ville->libelle}} </option>
                                @endforeach
                            @endif
                        </select>
                        <small class="help-block"></small>
                    </div>
                </div>
                <div class="text-right">
                    <button class="btn btn-square btn-gradient-01" type="submit">Enregistrer</button>
                    <button class="btn btn-square btn-shadow" type="reset">Réinitialiser</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Centered Modal -->

@endsection