@extends('layouts.admin_template')

@section('title','Liste des messages ')
@section('content')

<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('message') }} de la campagne <b> ***  {{$campagne->libelle }} *** </b> </div>
                    <div class="col-md-6">
                    </div> 
                    <div class="col-md-6" >
                     @if( ($campagne->dateFin) < @gmdate('Y-m-d')) 
                        <a  class=""  href="#"> </a>
                    @else
                        <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#creer-message"> <i class="fa fa-plus"></i> Programmer un message </button>
                        <!-- <a class="btn btn-info btn-sm"  href="{{url('messagecreer', $campagne->id)}} "> Creer message</a> -->
                    @endif
                        
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
                                        <th style="width:20%"> Message</th>
                                        <th> Date d'envoie </th>
                                        <th> Heure d'envoie </th>    

                                        <th >Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
 
                                    </tr>
                                    @if(!empty($messages))
                                    <?php $i =1; ?>
                                    @foreach($messages as $message)
                                    <tr>
                                        <td> <?= $i++ ?> </td>
                                        <td style="width:40%;"> {{ $message->message }} </td>
                                        <td> {{ $message->dateEnvoi }} </td>
                                        <td>{{ $message->heureEnvoi }} </td>

                                        <td  class="td-actions">  
                                            <a class=" mr-1 mb-2" href="{{url('/detailMessage',[$message->id,$campagne->id])}}"  title="Details"> <i class="fa fa-eye edit"> </i> </a>
                                            
                                        @if((($message->dateEnvoi) == @gmdate('Y-m-d') )&&($message->heureEnvoi) >= (@gmdate('H:i:s')))

                                        <a href="{{url('/messageDelete',[$message->id,$campagne->id])}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce message ? <br/> Cette action est irreversible et tous les contacts contenu dans ce message seront supprimer"><i class="fa fa-remove"> </i></a>
                                        
                                            <a class="mr-1 mb-2" href="{{url('/messageEdit',[$message->id,$campagne->id])}}"  title="modifier"> <i class="fa fa-pencil"></i> </a>

                                            @else
                                            <a class="mr-1 mb-2" href=""  title="modifier">  </a>
                                            <a href="#" ></a>
                                            @endif
                                            

                                            @if(@gmdate('Y-m-d') < ($message->dateEnvoi))
                                            <a href="{{url('/messageDelete',[$message->id,$campagne->id])}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce message ? <br/> Cette action est irreversible et tous les contacts contenu dans ce message seront supprimer"><i class="fa fa-remove"> </i></a>
                                            
                                                <a class="mr-1 mb-2" href="{{url('/messageEdit',[$message->id,$campagne->id])}}"  title="modifier"> <i class="fa fa-pencil"></i> </a> 
                                            @else
                                            <a class="mr-1 mb-2" href=""  title="modifier">  </a>
                                            <a href="" ></a>
                                            @endif

                                            <a class=" mr-1 mb-2" href="{{ url('/UserDetailSmsCampagne', [$message->id]) }}" onclick="return confirm('Voir la liste des messages ?');"  title="Programmer Message"><i class="fa fa-users mr-2"></i></a>
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

n Centered Modal  formulaire de contact-->
<div id="creer-message" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
            <!-- <form class="needs-validation" id="formAddMessageCampagne" method="post" action="{{ url('messageStore',$campagne->id) }}" accept-charset='UTF-8'> -->
            <form class="needs-validation" id="formAddMessageCampagne" method="post" action="{{ url('messages') }}" accept-charset='UTF-8'>
                    {{ csrf_field() }}

                <input type="hidden" name='campagne_id' class="form-control" value="{{$campagne_id}}">
                <input type="hidden" id="dateDebutCampagne" name='dateDebutCampagne' class="form-control" value="{{$campagne->dateDebut}}">
                <input type="hidden" id="dateFinCampagne" name='dateFinCampagne' class="form-control" value="{{$campagne->dateFin}}">

                <div class="form-group row d-flex align-items-center mb-5">
                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Date d'envoie</label>
                    <div class="col-lg-5">
                        <input id="dateDebut" type="text" class="form-control" name="dateEnvoi">
                        <small class="help-block"></small>
                    </div>
                </div>
                <div class="form-group row d-flex align-items-center mb-5">
                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Heure d'envoie</label>
                <div class="col-lg-5">
                    <input type="time" name='heureEnvoi' class="form-control" value="{{ old('heureEnvoi') }}">
                    <small class="help-block"></small>
                </div>
            </div>


                <div class="form-group row d-flex align-items-center mb-5">
                    <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Selectionnez le repertoire</label>
                    <div class="col-lg-5">
                        <select name='repertoires[]' id='repertoire' class="mul-select form-control" multiple="true" style='width: 100%;'>
                            <option value="-1"> Selectionnez le repertoire </option>
                            @if(!empty($repertoires))
                                @foreach($repertoires as $repertoire)
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
                            <span id="remaining"> 160 caractères </span>
                            <span id="messages"> 1 message(s) </span>
                        </div>
                        
                                <fieldset>
                                <legend style='background-color: #000;color: #fff;padding: 3px 6px;'>les informations</legend>

                                <ol>
                                    <ul>[nom] -- Nom</ul>
                                    <ul>[prenom] -- Prenom</ul>
                                    <ul>[telephone] -- Telephone</ul>
                                    <ul>[email]-- Email</ul>
                                </ol>
                            
                                </fieldset>
                            </div>
                    
                        <div class="text-right">
                            <button class="btn btn-primary" type="submit"> <i class='fa fa-save'></i> Enregistrer</button>
                        <button class="btn btn-square btn-shadow" type="reset">Réinitialiser</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Centered Modal -->
@endsection