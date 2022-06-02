@extends('layouts.admin_template')
@section('title','Détails d\'un utilisateur')
@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Utilisateurs') }}</div>
                    <div class="col-md-6">
                        <h4> Details d'un utilisateur  </h4>
                    </div> 
                    <div class="col-md-6" >

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
                    <ul class="reviews list-group w-100">
                                <!-- 01 -->
                        <li class="list-group-item">
                            <div class="media">
                                <div class="media-body align-self-center">
                                    <div class="username">
                                    @if(!empty($user))

                                    <h4><span> <b> Nom et prénom :</b> </span>{{ $user->name}} </h4> <br>
                                    <h4><span> <b> E-mail :</b> </span>{{ $user->email}} </h4> <br>
                                    <h4><span> <b> Rôles :</b> </span>{{ $user->role->libelle}} </h4> <br>

                                    @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- End 01 -->
                    </ul>
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>


@endsection
