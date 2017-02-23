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
    @if (isset($function))
    <li>{{ $function->name }}</li>
    <li>Edit</li>
    @else
    <li>Add function</li>
    @endif
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
                    @if (isset($function))
                    {!! Form::open(["url" => "/lbum/document/$document->id/function/$function->id", "method" => "put"]) !!}
                    @else
                    {!! Form::open(["url" => "/lbum/document/$document->id/function", "method" => "post"]) !!}
                    @endif
                    <div class="widget-body">
                        {!! Form::lbText("name_en", @$function->name_en, "Name en") !!}
                        {!! Form::lbText("name_vi", @$function->name_vi, "Name vi") !!}
                        {!! Form::lbTextarea("description_en", @$function->description_en, "Description en") !!}
                        {!! Form::lbTextarea("description_vi", @$function->description_vi, "Description vi") !!}
                        {!! Form::lbSelect2("parent_id", -1, $document->functions()->toOption("name_vi"), "Parent") !!}

                        {!! Form::lbText("order_number", @$function->order_number, "Order Number") !!}
                        {!! Form::file("image_en") !!}
                        {!! Form::file("image_vi") !!}


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
