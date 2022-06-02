@extends('layouts.admin_template')

@section('title','Liste des campagnes ')
@section('content')

<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Campagne') }}</div>
                    <div class="col-md-6">
                    </div> 
                    <div class="col-md-6" >
                        <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#creer-campagne"> <i class="la la-plus"></i> Creer une campagne </button>
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
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Nom de la campagne </th>
                                        <th style="width:20%"> Description</th>
                                        <th> Date Debut </th>
                                        <th> Date Fin </th>
                                        <th> Nombre de message</th>
                                        <th> Etat</th>
                                        <th >Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
 
                                    </tr>
                                    @if(!empty($campagnes))
                                    <?php $i =1; ?>
                                    @foreach($campagnes as $campagne)
                                    <tr>
                                        <td> <?= $i++ ?> </td>
                                        <td> {{ $campagne->libelle }} </td>
                                        <td> {{ $campagne->description }} </td>
                                        <td> {{ $campagne->dateDebut }} </td>
                                        <td> {{ $campagne->dateFin }} </td>
                                        <td></td>
                                        <td> 
                                         @if($campagne->etat == 1)
                                            <button class="mr-1 mb-2 bg-info">  Activé </button>
                                         @elseif($campagne->etat ==0)
                                         <button class="mr-1 mb-2 bg-danger">  Desactivé </button>
                                         </td>
                                         @endif
                                        <td class="td-actions">
                                             
                     
                                        
                                    @if(@gmdate('Y-m-d') >= ($campagne->dateDebut))
                                     
                                      @if($campagne->etat == 0)
                                        <a class="mr-1 mb-2" href="{{ url('/activerCampagne',[$campagne->id]) }}" onclick="return confirm('Activer ce campagne ?')" title="Activer campagne" > </a>&nbsp;&nbsp;
                                    @elseif($campagne->etat == 1)
                                     <a class="mr-1 mb-2" href="{{ url('/desactiverCampagne',[$campagne->id]) }}" onclick="return confirm('Desactiver ce campagne ?')" title="Desactiver campagne" > </a>&nbsp;&nbsp;
                                       @endif

                                    <a class=" mr-1 mb-2" href="{{ route('campagne.show',[$campagne->id]) }}"  title="Details"> </a>
                                           
                                         <a class=" mr-1 mb-2" href="{{ url('/listeMessage', [$campagne->id]) }}" onclick="return confirm('Voir la liste des messages ?');"  title="Programmer Message"></a>

                                        <a class="mr-1 mb-2" href="{{route('campagne.edit',[$campagne->id])}}"  title="modifier"> </a>
                                        
                                       <a class=" mr-1 mb-2" href="{{ route('campagne.show',[$campagne->id]) }}"  title="Details"> <i class="fa fa-eye edit"> </i> </a>
                                         
                                          <a class=" mr-1 mb-2" href="{{ url('/listeMessage', [$campagne->id]) }}" onclick="return confirm('Voir la liste des messages ?');"  title="Programmer Message"> <i class="fa fa-envelope"></i></a>
                                       


                                        <a href="{{route('campagne.destroy',[$campagne->id])}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce campagne ? <br/> Cette action est irreversible et tous les contacts contenu dans ce campagne seront supprimer"></a>
                                         
                                    @else

                                      @if($campagne->etat == 0)
                                        <a class="mr-1 mb-2" href="{{ url('/activerCampagne',[$campagne->id]) }}" onclick="return confirm('Activer ce campagne ?')" title="Activer campagne" ><i class="fa fa-play "></i> </a>&nbsp;&nbsp;
                                    @elseif($campagne->etat == 1)
                                     <a class="mr-1 mb-2" href="{{ url('/desactiverCampagne',[$campagne->id]) }}" onclick="return confirm('Desactiver ce campagne ?')" title="Desactiver campagne" ><i class="fa fa-stop "></i> </a>&nbsp;&nbsp;
                                       @endif
                                        
                                        <a class=" mr-1 mb-2" href="{{ route('campagne.show',[$campagne->id]) }}"  title="Details"> <i class="fa fa-eye edit"> </i> </a>

                                        <a class="mr-1 mb-2" href="{{route('campagne.edit',[$campagne->id])}}"  title="modifier"> <i class="fa fa-pencil"></i> </a>
                                        
                                         <a class=" mr-1 mb-2" href="{{ url('/listeMessage', [$campagne->id]) }}" onclick="return confirm('Voir la liste des messages ?');"  title="Programmer Message"> <i class="fa fa-envelope"></i></a>

                                        <a href="{{route('campagne.destroy',[$campagne->id])}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce campagne ? <br/> Cette action est irreversible et tous les contacts contenu dans ce campagne seront supprimer"><i class="fa fa-remove"> </i></a>
                                     @endif

                          <!-- Les campagne dont la date de fin est 
                          depasser, on peut juste(seulement) voir les detail de la campagne. -->               

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
   

        <!-- Begin Centered Modal  formulaire de contact-->
        <div id="creer-campagne" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <form class="needs-validation" id="formCampagne" method="post" action="{{ route('campagne.store') }}" accept-charset='UTF-8'>
                        {{ csrf_field() }}
                            <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom de la campagne</label>
                            <div class="col-lg-5">
                                <input type="text" name='libelle' id='libelle' class="form-control" value="{{ old('libelle') }}" placeholder="ex : Lancement du Produit X">
                                <small class="help-block"></small>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> description</label>
                            <div class="col-lg-5">
                                <textarea name="description"  class="form-control" id="" cols="30" rows="10"></textarea>
                                <small class="help-block"></small>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date debut</label>
                            <div class="col-lg-5">
                                <input type="date" name='dateDebut' id='dateDebut' class="form-control" value="{{ old('dateDebut') }}" placeholder="">
                                @if ($errors->has('dateDebut'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('dateDebut') }}</strong>
                                </span>
                                @endif
                                <small class="help-block"></small>
                            </div>
                        </div>
                        <div class="form-group row d-flex align-items-center mb-5">
                            <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date fin</label>
                            <div class="col-lg-5">
                                <input type="date" name='dateFin' id='dateFin' class="form-control" value="{{ old('dateFin') }}" placeholder="">
                                <small class="help-block"></small>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <button class="btn btn-primary" type="submit"> <i class='fa fa-save'></i> Enregistrer</button>
                            <button class="btn btn-square" type="reset">Réinitialiser</button>
                    </div>
                </form>
                    
                    </div>
                </div>
            </div>
        </div>
        <!-- End Centered Modal -->
@endsection