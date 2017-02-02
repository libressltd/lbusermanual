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
                {{ trans("lbum.step.list.title") }} 
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
                    <h2>{{ trans("lbum.step.list.title") }} </h2>
                </header>
                <div>
                    @if (isset($step))
                    {!! Form::open(["url" => "/lbum/function/$function->id/step/$step->id", "method" => "put", "files" => true]) !!}
                    @else
                    {!! Form::open(["url" => "/lbum/function/$function->id/step", "method" => "post", "files" => true]) !!}
                    @endif
                    <div class="widget-body">
                        {!! Form::lbText("name_en", @$step->name_en, "Name en") !!}
                        {!! Form::lbText("name_vi", @$step->name_vi, "Name vi") !!}
                        {!! Form::lbText("note_en", @$step->note_en, "Note en") !!}
                        {!! Form::lbText("note_vi", @$step->note_vi, "Note vi") !!}

                        {!! Form::lbText("order_number", @$step->order_number, "Order Number") !!}
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
