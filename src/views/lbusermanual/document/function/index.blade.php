@extends('app')

@section('sidebar_lbum')
active
@endsection

@section('sidebar_lbum_document')
active
@endsection

@push('ribbon')

<ol class="breadcrumb">
    <li><a href="/lbum/document">LBUserGuide</a></li>
    <li><a href="/lbum/document/{{ $document->id }}/function">{{ $document->name }}</a></li>
    <li>Function</li>
</ol>

@endpush

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-edit fa-fw "></i> 
                {{ trans("lbum.function.list.title") }} 
            <span>> 
                {{ trans("general.list") }} 
            </span>
        </h1>
    </div>
</div>

<section id="widget-grid" class="">
    <div class="row">
        <article class="col-lg-12">
            <div class="jarviswidget" id="wid-id-1" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
                <header>
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>{{ trans("lbum.function.list.title") }} </h2>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        @include("layouts.elements.table", [
                            "url" => "/lbum/ajax/document/$document->id/function",
                            "columns" => [
                                ["data" => "name_en", "title" => "Name en"],
                                ["data" => "name_vi", "title" => "Name vi"],
                                ["data" => "order_number", "title" => "Order"],
                                ["data" => "edit_button", "title" => "Action"],
                                ["data" => "step_button", "title" => "Action"],
                            ]
                        ])
                        <div class="widget-footer">
                            <a href="/lbum/document/{{ $document->id }}/function/create" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

@endsection
