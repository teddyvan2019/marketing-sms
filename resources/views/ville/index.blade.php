@extends('layouts.admin_template')

@section('title','Liste des villes ')
@section('content')

@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ville') }}</div>
                    <div class="col-md-6">
                        <h4> Liste des villes </h4>
                    </div> 
                    <div class="col-md-6" >
                        <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#modal-centered"> <i class="la la-plus"></i> Nouvelle ville  </button>
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
                                <th> Libellé</th>
                                <th >Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($villes))
                            <?php $i =1; ?>
                            @foreach($villes as $ville)
                            <tr>
                                <td> <?= $i++ ?> </td>
                                <td> {{ $ville->libelle }} </td>
                                <td class="td-actions">                                                                        
                                    <a class=" mr-1 mb-2" href="{{ route('villes.edit',[$ville->id]) }}"  title="modifier"> <i class="fa fa-pencil "> </i> </a>
                                    <a href="villes/{{ $ville->id }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer cette ville ?"><i class="fa fa-remove"> </i></a>                 
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

<!-- Begin Centered Modal -->
<div id="modal-centered" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"> Ajout d'une nouvelle ville </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div> 
                    <div class="modal-body">
                    <form class="needs-validation" id="formVille" method="post" action="{{ route('villes.store') }}" accept-charset='UTF-8'>
                        {{ csrf_field() }}
                        
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom de la ville</label>
                                <div class="col-lg-5">
                                    <input type="text" name='libelle' class="form-control" value="{{ old('libelle') }}" placeholder="ex : Ouagadougou">
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