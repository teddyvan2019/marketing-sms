@extends('layouts.admin_template')

@section('title','Ajout d\'une nouvelle catégorie')
@section('content')
<div class="row flex-row"> 
    <div class="col-xl-12">
        <!-- Form -->
        <div class="widget has-shadow">
            <div class="widget-header bordered no-actions d-flex align-items-center">
                <h4> Ajout d'une nouvelle catégorie </h4>
            </div>
            <div class="widget-body">
                <form class="needs-validation" method="post" action="{{ url('categorie') }}" accept-charset='UTF-8'>
                {{ csrf_field() }}
                   
                    <div class="form-group row d-flex align-items-center mb-5">
                        <label class="col-lg-4 form-control-label d-flex justify-content-lg-end"> Catégorie</label>
                        <div class="col-lg-5">
                            <input type="text" name='libelle' class="form-control" value="{{ old('libelle') }}"  placeholder="">
                            @if ($errors->has('libelle'))
                                <span class="help-block">
                                    <strong style='color:red'>{{ $errors->first('libelle') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="text-right">
                        <button class="btn btn-square btn-gradient-01" type="submit">Enregistrer</button>
                        <button class="btn btn-square btn-shadow" type="reset">Réinitialiser</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- End Form -->
    </div>
</div>
<!-- End Row -->
@endsection