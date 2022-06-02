@extends('layouts.admin_template')
@section('title','Repertoire des acteurs de controle')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Repertoire') }}</div>

                <!-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Liste!') }}
                </div> -->
            </div>
            <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Table With Full Features</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-wrench"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" role="menu">
                            <a href="{{ route('acteurs.create') }}" class="dropdown-item">Ajouter <i class="fa fa-plus"></i></a>
                            <a href="#" class="dropdown-item">Exporter <i class="fa fa-download"></i></a>
                        </div>
                    </div>
                </div> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Rendering engine</th>
                        <th>Browser</th>
                        <th>Platform(s)</th>
                        <th>Engine version</th>
                        <th>CSS grade</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                    <tbody>
                        @for($i=0; $i<=50; $i++)
                        <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 4.0
                        </td>
                        <td>Win 95+</td>
                        <td> 4</td>
                        <td>X</td>
                        <td>
                            <a href="acteurs/1" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer cet acteur ?"><i class="la la-trash delete"> </i></a>    

                            <a href="#" class="dropdown-item" title="supprimer"> <i class="fa fa-remove"></i></a>
                            <a href="{{route('acteurs.edit',[1])}}" class="dropdown-item" title="modifier"> <i class="fa fa-pencil"></i></a>
                         </td>
                        </tr>
                        <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.0
                        </td>
                        <td>Win 95+</td>
                        <td>5</td>
                        <td>C</td>
                        <td>
                            <a href="acteurs/1" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer cet acteur ?"><i class="la la-trash delete"> </i></a>    

                            <a href="#" class="dropdown-item" title="supprimer"> <i class="fa fa-remove"></i></a>
                            <a href="{{route('acteurs.edit',[1])}}" class="dropdown-item" title="modifier"> <i class="fa fa-pencil"></i></a>
                         </td>
                        </tr>
                        <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 5.5
                        </td>
                        <td>Win 95+</td>
                        <td>5.5</td>
                        <td>A</td>
                        <td>
                            <a href="acteurs/1" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer cet acteur ?"><i class="fa fa-remove"> </i></a>    

                            <!-- <a href="#" class="dropdown-item" title="supprimer"> <i class="fa fa-remove"></i></a> -->
                            <a href="{{ route('acteurs.edit',[1] )}}" class="dropdown-item" title="modifier"> <i class="fa fa-pencil"></i></a>
                         </td>
                        </tr>
                        <tr>
                        <td>Trident</td>
                        <td>Internet
                            Explorer 6
                        </td>
                        <td>Win 98+</td>
                        <td>6</td>
                        <td>A</td>
                        <td>
                            <a href="acteurs/1" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer cet acteur ?"><i class="la la-trash delete"> </i></a>    

                            <a href="#" class="dropdown-item" title="supprimer"> <i class="fa fa-remove"></i></a>
                            <a href="{{route('acteurs.edit',[1])}}" class="dropdown-item" title="modifier"> <i class="fa fa-pencil"></i></a>
                         </td>
                        </tr>
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Engine version</th>
                            <th>CSS grade</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div>
</div>
@endsection
