@extends('layouts.admin_template')

@section('title','Liste des réligions ')
@section('content')


@section('content')
<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Religion') }}</div>
                    <div class="col-md-6">
                        <h4> Liste des religions </h4>
                    </div> 
                    <div class="col-md-6" >
                        <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#modal-centered"> <i class="la la-plus"></i> Nouvelle réligion  </button>
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
                            @if(!empty($religions))
                            <?php $i =1; ?>
                            @foreach($religions as $laReligion)
                            <tr>
                                <td> <?= $i++ ?> </td>
                                <td> {{ $laReligion->libelle }} </td>
                                <td class="td-actions">                                                                        
                                    <a class=" mr-1 mb-2" href="{{ route('religions.edit',[$laReligion->id]) }}"  title="modifier"> <i class="fa fa-pencil "> </i> </a>
                                    <a href="religions/{{ $laReligion->id }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer cette religion ?"><i class="fa fa-remove"> </i></a>                 
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
                        <h4 class="modal-title"> Ajout d'une nouvelle réligion </h4>
                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                            <span class="sr-only">close</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <form class="needs-validation" id="formReligion" method="post" action="{{ route('religions.store') }}" accept-charset='UTF-8'>
                        {{ csrf_field() }}
                        
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Libellé</label>
                                <div class="col-lg-5">
                                    <input type="text" name='libelle' class="form-control" value="{{ old('libelle') }}" placeholder="ex : Catholique">
                                    @if ($errors->has('libelle'))
                                    <span class="help-block">
                                        <strong style='color:red'>{{ $errors->first('libelle') }}</strong>
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
        <!-- End Centered Modal -->
@endsection