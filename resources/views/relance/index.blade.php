@extends('layouts.admin_template')

@section('title','Liste desances ')
@section('content')

<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('relance') }}</div>
                    <div class="col-md-6">
                    </div> 
                    <div class="col-md-6" >
                        <a  class="btn btn-info btn-sm"  href="{{route('relance.create')}} "> Creer relance</a>
                       
                        
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
                    <table id="repertoire_list" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th> No </th>
                                        <th> Numero envoyé </th>
                                        <th> Nom de la relance </th>
                                        <th style="width:20%"> Description</th>
                                        <th> Date Debut </th>
                                        <th> Date Fin </th>
                                        <th >Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
 
                                    </tr>
                                    @if(!empty($relances))
                                    <?php $i =1; ?>
                                    @foreach($relances as $relance)
                                    <tr>
                                        <td> <?= $i++ ?> </td>
                                        <td> {{ $relance->num_reception }} </td>
                                        <td> {{ $relance->libelle }} </td>
                                        <td> {{ $relance->description }} </td>
                                         <td> {{ $relance->dateDebut }} </td>
                                        <td> {{ $relance->dateFin }} </td>
                              
                                        <td class="td-actions">  
                                             <a class=" mr-1 mb-2" href="{{ route('relance.show',[$relance->id]) }}"  title="Details"> <i class="fa fa-eye edit"> </i> </a>
                                               

                                            <a class="mr-1 mb-2" href="{{route('relance.edit',[$relance->id])}}"  title="modifier"> <i class="fa fa-pencil"></i> </a>
                                            

                                            <a href="{{route('relance.destroy',[$relance->id])}}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer ce relance ? <br/> Cette action est irreversible et tous les contacts contenu dans ce relance seront supprimer"><i class="fa fa-remove"> </i></a>

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