@extends('layouts.admin_template')

@section('title','SMS Envoyé ')
@section('content')

<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('SMS Envoyé') }}</div>
                    <div class="col-md-6">
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
                                <th> Numero envoyé </th>
                                <th> Messages</th>
                                <th> Date d'envoi</th>
                                <th> Heure d'envoi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($messages))
                            <?php $i =1; ?>
                            @foreach($messages as $message)
                            <tr>
                                <td> <?= $i++ ?> </td>
                                <td> {{ $message->num_reception }} </td>
                                <td> {{ $message->message }} </td>
                                <td> {{ $message->dateEnvoi }} </td>
                                <td> {{ $message->heureEnvoi }} </td>
                                
                            
                            </tr>
                            @endforeach
                            @endif
                            
                        </tbody>
                        
                    </table>
                    {!! $links ?? '' !!}
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
    </div> 
</div>

@endsection