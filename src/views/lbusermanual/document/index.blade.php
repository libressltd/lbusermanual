@extends('app')

@section('sidebar_lbum')
active
@endsection

@section('sidebar_lbum_document')
active
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-edit fa-fw "></i> 
                {{ trans("lbum.document.list.title") }} 
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
                    <h2>{{ trans("lbum.document.list.title") }} </h2>
                </header>
                <div>
                    <div class="widget-body no-padding">
                        @include("layouts.elements.table", [
                            "url" => "/lbum/ajax/document",
                            "columns" => [
                                ["data" => "name_en", "title" => "name_en"],
                                ["data" => "name_vi", "title" => "name_vi"],
                                ["data" => "generate_button", "title" => "Action"],
                                ["data" => "function_button", "title" => "Action"],
                            ]
                        ])
                        <div class="widget-footer">
                            <a href="/lbum/document/create" class="btn btn-primary">Create</a>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>

@endsection
