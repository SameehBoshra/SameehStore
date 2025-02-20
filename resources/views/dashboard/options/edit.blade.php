@extends('layouts.admin')

@section('title', 'Edit Product Attribute Option')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">{{trans('msg.optionpage')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href=""> {{trans('msg.optionpart')}}</a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('msg.edit')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- Basic form layout section start -->
            <section id="basic-form-layouts">
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-form">
                                    {{trans('msg.editoptionpart')}}

                                </h4>
                                <a class="heading-elements-toggle"><i
                                        class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @include('dashboard.includes.alerts.success')
                            @include('dashboard.includes.alerts.errors')
                            <div class="card-content collapse show">
                                <div class="card-body">
                                    <form class="form"
                                          action="{{route('dashboard.option.update' , $option->id)}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <input name="id" value="{{$option->id}}" type="hidden">

                                      <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="projectinput1"> {{trans('msg.optionname')}}  </label>
                                                <input type="text" value="{{old($option->name)}}" id="name"
                                                       class="form-control"
                                                       placeholder="  "
                                                       name="name">
                                                       @error("name")
                                                       <span class="text-danger">  {{$message}} </span>
                                                       @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="price"> {{trans('msg.price')}}  </label>
                                                <input type="number" value="{{old($option->price)}}" id="name"
                                                       class="form-control"
                                                       placeholder="  "
                                                       name="price">
                                                       @error("price")
                                                       <span class="text-danger">  {{$message}} </span>
                                                       @enderror

                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12" >
                                            <div class="form-group">
                                                <label for="product_id" > {{trans('msg.chooseproduct')}}  </label>
                                                <select name="product_id" class="select2 form-control" >
                                                    <optgroup label="{{trans('msg.chooseproduct')}}">
                                                        @if($data['products'] && $data['products'] ->count()>0)
                                                            @foreach ($data['products'] as $product)
                                                                <option value="{{$product->id}}" @if ($product->id==$option->product_id) selected @endif>{{$product->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                </select>
                                                @error("products")
                                                <span class="text-danger">  {{$message}} </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12" >
                                            <div class="form-group">
                                                <label for="attribute_id"> {{trans('msg.chooseattribute')}}  </label>
                                                <select name="attribute_id" class="select2 form-control" >
                                                    <optgroup label="{{trans('msg.chooseattribute')}}">
                                                        @if($data['attributes'] && $data['attributes'] ->count()>0)
                                                            @foreach ($data['attributes'] as $attribute)
                                                                <option value="{{$attribute->id}}"
                                                                    @if( $attribute->id ==$option->attribute_id) selected @endif>{{$attribute->name}}</option>
                                                            @endforeach
                                                        @endif
                                                    </optgroup>
                                                </select>
                                                @error("attributes")
                                                <span class="text-danger">  {{$message}} </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i>
                                                {{trans('msg.dataofattributepart')}}
                                            </h4>
                                            <div class="row">


                                            </div>
                                        </div>


                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> {{trans('msg.back')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{trans('msg.Update')}}
                                            </button>
                                        </div>
                                    </form>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- // Basic form layout section end -->
        </div>
    </div>
</div>

@endsection
