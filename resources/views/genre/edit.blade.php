@extends('layouts.admin_template')

@section('title','Modification du genre')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Genre') }}</div>
                    <div class="col-md-6">
                        <h4>Modification du genre </h4>
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
                    {!! Form::model($genre, ['route' => ['genres.update', $genre->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
                        {{ csrf_field() }}
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom de la ville</label>
                                <div class="col-lg-5">
                                    <input type="text" name='libelle' required="true" class="form-control" value="{{ $genre->libelle }}" >
                                    @if ($errors->has('libelle'))
                                        <span class="help-block">
                                            <strong style='color:red'>{{ $errors->first('libelle') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-gradient-01" type="submit">Enregistrer</button>
                                <button class="btn btn-shadow" type="reset">Réinitialiser</button>
                            </div>
                        <!-- </form> -->
                    {!! Form::close() !!}
                </div>
                <!-- /.card-body -->
            </div> <!-- /.card -->
        </div> <!-- col-md -->
    </div> <!-- row -->
</div>


@endsection