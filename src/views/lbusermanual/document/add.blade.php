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
    @if (isset($document))
    <li>{{ $document->name }}</li>
    <li>Edit</li>
    @else
    <li>Add document</li>
    @endif
</ol>

@endpush

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
                    @if (isset($document))
                    {!! Form::open(["url" => "/lbum/document/$document->id", "method" => "put"]) !!}
                    @else
                    {!! Form::open(["url" => "/lbum/document", "method" => "post"]) !!}
                    @endif
                    <div class="widget-body">
                        {!! Form::lbText("name_en", @$document->name_en, "Name en") !!}
                        {!! Form::lbText("name_vi", @$document->name_vi, "Name vi") !!}
                        <div class="widget-footer">
                            {!! Form::lbSubmit() !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </article>
    </div>
</section>

@endsection
