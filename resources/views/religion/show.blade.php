@extends('layouts.dashboard_admin')

@section('title','Détails d\'une religion')
@section('content')

<div class="row flex-row">
    <div class="col-xl-12 col-12">
        <div class="widget has-shadow">
        <div class="row">
            <div class="col-xl-12">
            <div class="col-xl-12 os-animation" data-os-animation="fadeInUp">
                <!-- Begin Widget 06 -->
                <div class="widget widget-06 has-shadow">
                    <!-- Begin Widget Header -->
                    <div class="widget-header bordered d-flex align-items-center">
                        <h2> Détails d'une catégorie </h2>
                    </div>
                    <!-- End Widget Header -->
                    <!-- Begin Widget Body -->
                    <div class="widget-body p-0">
                        <div id="list-group" class="widget-scroll" style="max-height:490px;">
                            <ul class="reviews list-group w-100">
                                <!-- 01 -->
                                <li class="list-group-item">
                                    <div class="media">
                                        <div class="media-body align-self-center">
                                            <div class="username">
                                            @if(!empty($categorie))
                                                <h4><b> Libellé </b> :{{ $categorie->libelle}} </h4> <br>
                                            @endif

                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <!-- End 01 -->
                            </ul>
                        </div>
                        <!-- End List -->
                    </div>
                    <!-- End Widget Body -->
                </div>
                <!-- End Widget 06 -->
            </div>
        </div>
    </div>
</div>
@endsection