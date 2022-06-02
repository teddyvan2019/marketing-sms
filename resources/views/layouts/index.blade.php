@extends('layouts.admin_template')

@section('title','Liste des campagnes ')
@section('content')

<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Campagne') }}</div>
                <h5>Nombre de campagne: {{$campagnes->count()}} </h5>
                    <div class="col-md-6">
                    </div> 
                    <div class="col-md-6" >
                        <a  class="btn btn-info btn-sm"  href="{{route('campagne.create')}} "> Creer campagne</a>
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
                                         <td style="text-align:center"> <?php echo count( $campagne->messages) ; ?> </td>
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
                                         @if( ($campagne->dateFin) < @gmdate('Y-m-d'))   
                                         <a class=" mr-1 mb-2" href="{{ url('/listeMessage', [$campagne->id]) }}" onclick="return confirm('Voir la liste des messages ?');"  title="Programmer Message"> </a>
                                        @else
                                          <a class=" mr-1 mb-2" href="{{ url('/listeMessage', [$campagne->id]) }}" onclick="return confirm('Voir la liste des messages ?');"  title="Programmer Message"> <i class="fa fa-envelope"></i></a>
                                         @endif


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
   

@endsection