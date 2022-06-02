@extends('layouts.admin_template')
@section('title','Repertoire')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Repertoire') }}</div>
                    <div class="col-md-6">
                        <h4> Liste des repertoires </h4>
                    </div> 
                    <div class="col-md-6" >
                        <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#modal-centered"> <i class="la la-plus"></i> Nouveau répertoire  </button>
                        <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#ajouter_contact"> <i class="la la-plus"></i> Nouveau contact  </button>
                        <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#import-file-contact" title="importer une liste de contact"> <i class="la la-plus"></i> Importer liste de contact  </button>


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
                            <a href="{{route('export')}} " class="dropdown-item"> Exporter CSV<i class="fa fa-download"></i></a>
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
                                <th> No.</th>
                                <th> Repertoire </th>
                                <th> Description </th>
                                <th> Nbre. de contact </th>
                                <th>Etat</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($repertoires))
                            <?php $i =1; ?>
                            @foreach($repertoires as $repertoire)
                            <tr>
                                <td> <?= $i++ ?> </td>
                                <td> {{ $repertoire->libelle }} </td>
                                <td> {{ $repertoire->description }} </td>
                                <td style="text-align:center"><?php echo count( $repertoire->contacts) ; ?> </td>

                                <td> 
                                    @if($repertoire->etat == 1)
                                        <button class="mr-1 mb-2 bg-info">  Activé </button>
                                    @elseif($repertoire->etat == 0)
                                        <button class="mr-1 mb-2 bg-danger"> Desactivé  </button>
                                    @endif
                                    
                                </td>
                                <td >  

                                    @if($repertoire->etat == 0)
                                        <a class="mr-1 mb-2" href="{{ url('/activerRepertoire',[$repertoire->id]) }}" onclick="return confirm('Activer ce repertoire ?')" title="Activer repertoire" ><i class="fa fa-play "></i> </a>&nbsp;&nbsp;
                                    @elseif($repertoire->etat == 1)
                                        <a class="mr-1 mb-2" href="{{ url('/desactiverRepertoire',[$repertoire->id]) }}" onclick="return confirm('Desactiver ce repertoire ?')" title="Desactiver repertoire" ><i class="fa fa-stop "></i> </a>&nbsp;&nbsp;
                                    @endif

                                    <a class="mr-1 mb-2" href="{{ url('/listeContact', [$repertoire->id]) }}" onclick="return confirm('Afficher les contacts de ce repertoire ?');" title="Voir les contacts du repertoire "> <i class="fa fa-users"></i> </a>

                                    <a href="repertoires/{{ $repertoire->id }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce repertoire ? <br/> Cette action est irreversible et tous les contacts contenu dans ce repertoire seront supprimer"> <i class="fa fa-remove"></i> </i></a>

                                    <a href="{{route('repertoires.edit',[$repertoire->id])}}" class="dropdown-item" title="modifier"> <i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                    </table>
                    {!! $links !!}
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div> 
</div>

    <!-- Begin Centered Modal Repertoire -->
    <div id="modal-centered" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Ajout d'un nouveau repertoire </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="needs-validation" id="formRepertoire" method="post" action="{{ url('repertoires') }}" accept-charset='UTF-8'>
                        {{ csrf_field() }}
                        
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom du repertoire</label>
                                <div class="col-lg-5">
                                    <input type="text" name='libelle' class="form-control" value="{{ old('libelle') }}" placeholder="ex : Personnel">
                                    @if ($errors->has('libelle'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('libelle') }}</strong>
                                    </span>
                                    @endif
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> description</label>
                                <div class="col-lg-5">
                                    <input type="text" name='description' class="form-control" value="{{ old('description') }}" placeholder="ex : Ce repertoire contient les contacts du personnel">
                                    @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
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
        <!-- End Centered Modal Repertoire -->

    <!-- Begin Centered Modal Import file -->
        <div id="import-file-contact" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Importer une liste de contact </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="needs-validation" enctype="multipart/form-data" id="formImportFileContact" method="post" action="{{ url('import') }}" accept-charset='UTF-8'>
                        {{ csrf_field() }}
                        
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Selectionnez le repertoire</label>
                                <div class="col-lg-5">
                                    <select name='repertoire_id' class="form-control" >
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
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Choisir fichier</label>
                                <div class="col-lg-5">
                                    <input type="file" name='fichier' class="form-control" value="{{ old('fichier') }}" placeholder=".csv ou .xslx">
                                    @if ($errors->has('fichier'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('fichier') }}</strong>
                                    </span>
                                    @endif
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
        <!-- End Centered Modal Repertoire -->

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

