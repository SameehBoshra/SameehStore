@extends('layouts.admin')
@section('title','Shipping Method')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{trans('msg.mainpage')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href="">{{trans('msg.setting')}} </a>
                            </li>
                            <li class="breadcrumb-item"><a href=""> {{trans('msg.shippingMethod')}} </a>

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
                                    <form class="form" action="{{route('updateShippingMethod11' , $shippingMethod->id)}}" method="POST"
                                          enctype="multipart/form-data" >
                                        @csrf




                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-home"></i> {{trans('msg.dataofshippingmethod')}} </h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1" > {{trans('msg.nameshippingmethod')}} </label>
                                                        <input type="text"  id="name"
                                                               class="form-control"
                                                               value="{{$shippingMethod->value}}"
                                                               placeholder=" "
                                                               name="value">
                                                        @error('value')
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1" >  {{trans('msg.costShipping')}} </label>
                                                        <input type="number" value="{{$shippingMethod->plain_value}}" id="plain_value"
                                                               class="form-control"
                                                               placeholder=" "
                                                               name="plain_value">
                                                        @error('plain_value')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                        <div class="form-actions">
                                            <button type="submit" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> {{trans('msg.back')}}
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i>  {{trans('msg.Update')}}
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
@stop
