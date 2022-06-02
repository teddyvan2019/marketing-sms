@extends('layouts.admin_template')
@section('title','Repertoire')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Repertoire') }}</div>
                    <div class="col-md-12">
                        {!! Form::model($repertoire, ['route' => ['repertoires.update', $repertoire->id], 'method' => 'put', 'class' => 'form-horizontal panel']) !!}
                            {{ csrf_field() }}
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Nom du repertoire</label>
                                <div class="col-lg-5">
                                    <input type="text" name='libelle' required="true" class="form-control" value="{{ $repertoire->libelle }}" >
                                    @if ($errors->has('libelle'))
                                        <span class="help-block">
                                            <strong style='color:red'>{{ $errors->first('libelle') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row d-flex align-items-center mb-5">
                                <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> description</label>
                                <div class="col-lg-5">
                                    <input type="text" name='description' class="form-control" value="{{ $repertoire->description }}" placeholder="ex : Ce repertoire contient les contacts du personnel" >
                                    @if ($errors->has('libelle'))
                                        <span class="help-block">
                                            <strong style='color:red'>{{ $errors->first('description') }}</strong>
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
                </div>
            </div> <!-- /.card -->
        </div>
</div>

@endsection

