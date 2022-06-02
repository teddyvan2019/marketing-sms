@extends('layouts.admin_template')

@section('title','Liste des campagnes ')
@section('content')

<div class="row flex-row">
    <div class="col-xl-12 col-12">
        <div class="widget has-shadow">
        <div class="row">
            <div class="col-xl-12">
                <!-- Sorting -->
             
                <div class="widget has-shadow">
            
                    <div class="widget-header bordered no-actions d-flex align-items-center">
                        <div class="col-md-6">
                            <h4> Liste des campagnes </h4>
                        </div>
                        <div class="col-md-6" >
                            <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#modal-centered"> <i class="la la-plus"></i> Nouvelle Campagne  </button>
                            <!-- <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#ajouter_contact"> <i class="la la-plus"></i> Nouveau contact  </button> -->
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="table-responsive">

                            <table id="repertoire_list" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Nom de la campagne </th>
                                        <th style="width:20%"> Description</th>
                                        <th> Date Debut </th>
                                        <th> Date Fin </th>
                                        <th> Nbre de sms </th>
                                        <th> etat </th>
                                        <th >Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                        <td> 1 </td>
                                        <td> Campagne de lancement du produit X </td>
                                        <td> Cette campagne concerne le lancement du Produit X </td>
                                        <td> 25-06-2020 </td>
                                        <td> 30-06-2020 </td>
                                        <td style="text-align:center"> 250 </td>

                                        <td> 

                                            <button class="mr-1 mb-2 bg-info">  Activé </button>
                                            
                                        </td>
                                        <td class="td-actions">  
                                        <a class="mr-1 mb-2" href="#" onclick="return confirm('Desactiver ce repertoire ?')" title="Desactiver repertoire" ><i class="la la-minus-circle edit"></i> </a>&nbsp;&nbsp;

                                        
                                            <a class="mr-1 mb-2" href="#"  title="modifier"> <i class="la la-edit edit"> </i> </a>
                                            <a class="mr-1 mb-2" href="#" onclick="return confirm('Afficher les contacts de ce repertoire ?');" title="Voir les contacts du repertoire "> <i class="la la-user edit"> </i> </a>

                                            <a href="#" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce repertoire ? <br/> Cette action est irreversible et tous les contacts contenu dans ce repertoire seront supprimer"><i class="la la-trash delete"> </i></a>

                                        </td>
                                    </tr>
                                    @if(!empty($repertoires))
                                    <?php $i =1; ?>
                                    @foreach($repertoires as $repertoire)
                                    <tr>
                                        <td> <?= $i++ ?> </td>
                                        <td> {{ $repertoire->libelle }} </td>
                                        <td> {{ $repertoire->description }} </td>
                                        <td style="text-align:center"> <?php echo count( $repertoire->contacts) ; ?> </td>

                                        <td> 
                                            @if($repertoire->etat == 1)
                                                <button class="mr-1 mb-2 bg-info">  Activé </button>
                                            @elseif($repertoire->etat == 0)
                                                <button class="mr-1 mb-2 bg-danger"> Desactivé  </button>
                                            @endif
                                            
                                        </td>
                                        <td class="td-actions">  

                                            @if($repertoire->etat == 0)
                                                <a class="mr-1 mb-2" href="{{ url('/activerRepertoire',[$repertoire->id]) }}" onclick="return confirm('Activer ce repertoire ?')" title="Activer repertoire" ><i class="la la-caret-right edit"></i> </a>&nbsp;&nbsp;
                                            @elseif($repertoire->etat == 1)
                                                <a class="mr-1 mb-2" href="{{ url('/desactiverRepertoire',[$repertoire->id]) }}" onclick="return confirm('Desactiver ce repertoire ?')" title="Desactiver repertoire" ><i class="la la-minus-circle edit"></i> </a>&nbsp;&nbsp;
                                            @endif

                                            <a class="mr-1 mb-2" href="{{ route('repertoire.edit',[$repertoire->id]) }}"  title="modifier"> <i class="la la-edit edit"> </i> </a>
                                            <a class="mr-1 mb-2" href="{{ url('/listeContact', [$repertoire->id]) }}" onclick="return confirm('Afficher les contacts de ce repertoire ?');" title="Voir les contacts du repertoire "> <i class="la la-user edit"> </i> </a>

                                            <a href="repertoire/{{ $repertoire->id }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce repertoire ? <br/> Cette action est irreversible et tous les contacts contenu dans ce repertoire seront supprimer"><i class="la la-trash delete"> </i></a>

                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    
                                </tbody>
                            </table>
                            {!! $links ?? '' !!}
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
    <!-- Begin Centered Modal campagne -->
        <div id="modal-centered" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Creer une nouvelle campagne </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="needs-validation" id="formRepertoire" method="post" action="{{ url('repertoire') }}" accept-charset='UTF-8'>
                        {{ csrf_field() }}
                        
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom de la campagne</label>
                                <div class="col-lg-5">
                                    <input type="text" name='libelle' class="form-control" value="{{ old('libelle') }}" placeholder="ex : Lancement du Produit X">
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> description</label>
                                <div class="col-lg-5">
                                    <input type="text" name='description' class="form-control" value="{{ old('description') }}" placeholder="ex : Cette campagne concerne le lancement du Produit X">
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date de debut</label>
                                <div class="col-lg-5">
                                    <input type="date" name='dateDebut' class="form-control" value="{{ old('dateDebut') }}" placeholder="">
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date de fin</label>
                                <div class="col-lg-5">
                                    <input type="date" name='dateFin' class="form-control" value="{{ old('dateFin') }}" placeholder="">
                                    <small class="help-block"></small>
                                </div>
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
                    <form class="needs-validation" enctype="multipart/form-data" id="formImportFileContact" method="post" action="{{ url('contact.file') }}" accept-charset='UTF-8'>
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
                    <form class="needs-validation" method="post" id="formContact" action="#" accept-charset='UTF-8'>
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
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Prenom </label>
                                <div class="col-lg-5">
                                    <input type="text" name='prenom' class="form-control" value="{{ old('prenom') }}"  placeholder="">
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date de naissance </label>
                                <div class="col-lg-5">
                                    <input type="text" name='date_naissance' id="date_naissance" class="form-control"  placeholder="">
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Numero de telephone</label>
                                <div class="col-lg-5">
                                    <input type="text" name='telephone' class="form-control" value="{{ old('telephone') }}"  placeholder="">
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Email </label>
                                <div class="col-lg-5">
                                    <input type="email" name='email' class="form-control" value="{{ old('email') }}"  placeholder="">
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date de relance </label>
                                <div class="col-lg-5">
                                    <input type="text" name='date_relance' id="date_relance" class="form-control"  placeholder="">
                                    <small class="help-block"></small>
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> profession </label>
                                <div class="col-lg-5">
                                    <input type="text" name='profession' class="form-control" value="{{ old('profession') }}"  placeholder="ex: DSI,Menusier">
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