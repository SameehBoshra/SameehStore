@extends('layouts.admin')

@section('title', 'Edit Category')

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
                            <li class="breadcrumb-item"><a href=""> {{trans('msg.mainpart')}}</a>
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
                                    {{trans('msg.editmainpart')}}

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
                                          action="{{route('dashboard.Category.update' , $category->id)}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf

                                        <input name="id" value="{{$category->id}}" type="hidden">

                                        <div class="form-group">
                                            <div class="text-center">
                                                <img
                                                    src=""
                                                    class="rounded-circle  height-150" alt= "{{trans('msg.partphoto')}}">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label> {{trans('msg.partphoto')}} </label>
                                            <label id="projectinput7" class="file center-block">
                                                <input type="file" id="file" name="photo">
                                                <span class="file-custom"></span>
                                            </label>
                                            @error('photo')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>

                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i>
                                                {{trans('msg.dataofpart')}}
                                            </h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">
                                                            {{trans('msg.namepart')}} </label>
                                                        <input type="text" id="name"
                                                               class="form-control"
                                                               placeholder="  "
                                                               value="{{$category->name}}"
                                                               name="name">
                                                        @error("name")
                                                        <span class="text-danger">  {{$message}} </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">
                                                                {{trans('msg.slugname')}} </label>
                                                            <input type="text" id="slug"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$category->slug}}"
                                                                   name="slug">
                                                            @error("slug")
                                                            <span class="text-danger">  {{$message}} </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value=""
                                                            SupCategoryupdatesuccess                        name="is_active"
                                                                   id="is_active"
                                                                   class="switchery" data-color="success"
                                                                   @if($category -> is_active == 1)checked @endif/>
                                                            <label for="is_active"
                                                                   class="card-title ml-1">{{trans('msg.status')}} </label>

                                                            @error("is_active")
                                                            <span class="text-danger"> {{$messages}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
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
