@extends('layouts.admin_template')

@section('title','Liste des anniversaires ')
@section('content')

<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('anniversaire') }}</div>
                    <div class="col-md-6">
                    </div> 
                    <div class="col-md-6" >
                        <a  class="btn btn-info btn-sm"  href="{{route('anniversaire.create')}} "> Creer anniversaire</a>
                       
                        
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
                    <table  id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Nom de l'anniversaire </th>
                                        <th style="width:20%"> Description</th>
                                        <th> Date Debut </th>
                                        <th> Date Fin </th>
                                        <th> Etat </th>

                                        <th >Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
 
                                    </tr>
                                    @if(!empty($anniversaires))
                                    <?php $i =1; ?>
                                    @foreach($anniversaires as $anniversaire)
                                    <tr>
                                        <td> <?= $i++ ?> </td>
                                        <td> {{ $anniversaire->libelle }} </td>
                                        <td> {{ $anniversaire->description }} </td>
                                         <td> {{ $anniversaire->dateDebut }} </td>
                                        <td> {{ $anniversaire->dateFin }} </td>
                              
                                        <td> 
                                         @if($anniversaire->etat == 1)
                                            <button class="mr-1 mb-2 bg-info">  Activé </button>
                                         @elseif($anniversaire->etat ==0)
                                         <button class="mr-1 mb-2 bg-danger">  Desactivé </button>
                                         </td>
                                         @endif
                                        <td class="td-actions">
                                             
                                          @if($anniversaire->etat == 0)
                                            <a class="mr-1 mb-2" href="{{ url('/activeranniversaire',[$anniversaire->id]) }}" onclick="return confirm('Activer ce anniversaire ?')" title="Activer anniversaire" ><i class="fa fa-play "></i> </a>&nbsp;&nbsp;
                                        @elseif($anniversaire->etat == 1)
                                         <a class="mr-1 mb-2" href="{{ url('/desactiveranniversaire',[$anniversaire->id]) }}" onclick="return confirm('Desactiver ce anniversaire ?')" title="Desactiver anniversaire" ><i class="fa fa-stop "></i> </a>&nbsp;&nbsp;
                                           @endif

                                             <a class=" mr-1 mb-2" href="{{ route('anniversaire.show',[$anniversaire->id]) }}"  title="Details"> <i class="fa fa-eye edit"> </i> </a>
                                               
                                             <a class=" mr-1 mb-2" href="{{ url('/listeMessage', [$anniversaire->id]) }}" onclick="return confirm('Voir la liste des messages ?');"  title="Programmer Message"> <i class="fa fa-envelope"></i></a>

                                            <a class="mr-1 mb-2" href="{{route('anniversaire.edit',[$anniversaire->id])}}"  title="modifier"> <i class="fa fa-pencil"></i> </a>
                                            

                                            <a href="{{route('anniversaire.destroy',[$anniversaire->id])}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce anniversaire ? <br/> Cette action est irreversible et tous les contacts contenu dans ce anniversaire seront supprimer"><i class="fa fa-remove"> </i></a>

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
   

@endsection