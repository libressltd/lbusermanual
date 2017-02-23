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
    <li><a href="/lbum/document/{{ $function->document->id }}/function">{{ $function->document->name }}</a></li>
    <li><a href="/lbum/function/{{ $function->id }}/step">{{ $function->name }}</a></li>
    @if (isset($step))
    <li>{{ $step->name }}</li>
    <li>Edit</li>
    @else
    <li>Add new step</li>
    @endif
</ol>

@endpush

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
    @if (isset($step))
    {!! Form::open(["url" => "/lbum/function/$function->id/step/$step->id", "method" => "put", "files" => true]) !!}
    @else
    {!! Form::open(["url" => "/lbum/function/$function->id/step", "method" => "post", "files" => true]) !!}
    @endif
    <div class="row">
        <article class="col-lg-8">
            @box_open(trans("lbum.step.list.title"))
                <div>
                    <div class="widget-body">
                        {!! Form::lbTextarea("name_en", @$step->name_en, "Name en") !!}
                        {!! Form::lbTextarea("name_vi", @$step->name_vi, "Name vi") !!}
                        {!! Form::lbTextarea("note_en", @$step->note_en, "Note en") !!}
                        {!! Form::lbTextarea("note_vi", @$step->note_vi, "Note vi") !!}

                        {!! Form::lbText("order_number", @$step->order_number, "Order Number") !!}
                        <div class="widget-footer">
                            {!! Form::lbSubmit() !!}
                        </div>
                    </div>
                </div>
            @box_close
        </article>
        <article class="col-lg-4">
            @box_open("Image EN")
                <div>
                    <div class="widget-body">
                        @if (isset($step) && $step->image_en_id)
                            <img src="/lbmedia/{{ $step->image_en_id }}" style="width: 100%"/>
                        @endif
                        {!! Form::file("image_en") !!}
                        <div class="widget-footer">
                            {!! Form::lbSubmit() !!}
                        </div>
                    </div>
                </div>
            @box_close
            @box_open("Image VI")
                <div>
                    <div class="widget-body">
                        @if (isset($step) && $step->image_vi_id)
                            <img src="/lbmedia/{{ $step->image_vi_id }}" style="width: 100%"/>
                        @endif
                        {!! Form::file("image_vi") !!}
                        <div class="widget-footer">
                            {!! Form::lbSubmit() !!}
                        </div>
                    </div>
                </div>
            @box_close
        </article>
    </div>
    {!! Form::close() !!}
</section>

@endsection
