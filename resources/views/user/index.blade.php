@extends('layouts.admin_template')

@section('title','Liste des utilisateurs')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Contacts') }}</div>
                    <div class="col-md-6">
                        <h4> Liste des utilisateurs  </h4>
                    </div> 
                    <div class="col-md-6" >
                    <a href=" {{ route('users.create') }}" class="btn btn-info btn-sm btn-square mr-1 mb-2"><i class="la la-plus"></i> Nouvelle utilisateur </a>

                    <!-- <button type="button" class="btn btn-info btn-sm btn-square mr-1 mb-2" data-toggle="modal" data-target="#ajouter_contact"> <i class="la la-plus"></i> Nouveau contact  </button> -->
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
                                    <th> Nom & prénom</th>
                                    <th> E-mail </th>
                                    <th> Rôle </th>
                                    <th colspan='3' style="text-align:center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($users))
                                <?php $i=1;?>
                                @foreach($users as $user)
                                <tr>
                                    <td> <?= $i++ ?></td>
                                    <td> {{ $user->name }} </td>
                                    <td> {{ $user->email }} </td>
                                    <td> {{ $user->role->libelle }} </td>
                                    <td class="td-actions">
                                        <a class=" mr-1 mb-2" href="{{ route('users.show',[$user->id]) }}"  title="Details"> <i class="fa fa-eye edit"> </i> </a>
                                                                    
                                        <a class=" mr-1 mb-2" href="{{ route('users.edit',[$user->id]) }}"  title="modifier"> <i class="fa fa-pencil"> </i> </a>
                                        <a class=" mr-1 mb-2" href="{{ url('/editPassword',[$user->id]) }}"  title="Changer le mot de passe"> <i class="fa fa-tv edit"> </i> </a>
                                        <a href="users/{{ $user->id }}" title="Supprimer cet utilisateur ?" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer cet utilisateur ?"><i class="fa fa-remove delete"> </i></a>                                                   
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


@endsection
