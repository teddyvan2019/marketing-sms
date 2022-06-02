@extends('layouts.admin_template')

@section('title','SMS INSTANTANE ')
@section('content')

<div class="container">
    <div class="row justify-content-center"> 
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('SMS INSTANTANE') }}</div>
                    <div class="col-md-6">
                    </div> 
                    <div class="col-md-6" >
                        <a  class="btn btn-info btn-sm"  href="{{ route('messagesinstantane.create') }} "> Envoyer sms</a>
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
                <div class="table-responsive">
                    <table id="example2" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> No </th>
                                <th> Numero envoyé </th>
                                <th> Messages</th>
                                <th> Date et l'heure d'envoi</th>
                                <th> DLR </th>

                                <th >Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($smsinstantanes))
                            <?php $i =1; ?>
                            @foreach($smsinstantanes as $smsinstantane)
                            <tr>
                                <td> <?= $i++ ?> </td>
                                <td> {{ $smsinstantane->destinataire }} </td>
                                <td> {{ $smsinstantane->message }} </td>
                                <td> {{ $smsinstantane->dateHeure }} </td>

                                <td> {{ $smsinstantane->dlr }} </td>

                                <td class="td-actions">   
                                 <a class=" mr-1 mb-2" href="{{ route('messagesinstantane.show',[$smsinstantane->id]) }}"  title="Details"> <i class="fa fa-eye edit"> </i> </a>                                                           
                                    <!-- <a href="messagesinstantane/{{ $smsinstantane->id }}" data-method="delete" data-token="{{csrf_token()}}" data-confirm="Vraiment supprimer cet message instantané ?"><i class="fa fa-remove"> </i></a>                  -->
                                </td>
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