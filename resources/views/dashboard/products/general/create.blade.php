@extends('layouts.admin')

@section('title', 'Create Category')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">{{trans('msg.productpage')}} </a>
                                </li>
                                <li class="breadcrumb-item"><a href=""> {{trans('msg.productpart')}} </a>
                                </li>
                                <li class="breadcrumb-item active">
                                    {{trans('msg.addproductpart')}}
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
                                    <h4 class="card-title" id="basic-layout-form"> {{trans('msg.addproductpart')}} </h4>
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
                                        <form class="form" action="{{route('dashboard.product.store_general.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input id="id" name="id" hidden>
                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> {{trans('msg.dataofproduct')}}  </h4>
                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> {{trans('msg.productname')}}  </label>
                                                                    <input type="text" value="{{old('name')}}" id="name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="name">
                                                                           @error("name")
                                                                           <span class="text-danger">  {{$message}} </span>
                                                                           @enderror

                                                                </div>
                                                            </div>
                                                                <div class="col-md-6 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="projectinput1"> {{trans('msg.slugname')}} </label>
                                                                        <input type="text" value="{{old('slug')}}" id="slug"
                                                                               class="form-control"
                                                                               placeholder="  "
                                                                               name="slug">
                                                                               @error("slug")
                                                                               <span class="text-danger">  {{$message}} </span>
                                                                               @enderror

                                                                    </div>
                                                                </div>

                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> {{trans('msg.description')}} </label>
                                                                    <input type="text" value="{{old('description')}}" id="description"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="description">
                                                                    @error("description")
                                                                    <span class="text-danger">  {{$message}} </span>
                                                                    @enderror

                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> {{trans('msg.short_description')}} </label>
                                                                    <input type="text" value="{{old('short_description')}}" id="description"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="description">
                                                                    @error("short_description")
                                                                    <span class="text-danger">  {{$message}} </span>
                                                                    @enderror

                                                                </div>
                                                            </div>





                                                                <div class="col-md-4 col-sm-12" >
                                                                    <div class="form-group">
                                                                        <label for="projectinput1"> {{trans('msg.chooseDepart')}}  </label>
                                                                       <select name="categories[]" class="select2 form-control" multiple>
                                                                        <optgroup label="{{trans('msg.pleasechoosedepart')}}">
                                                                            @if($data['categories'] && $data['categories'] ->count()>0)
                                                                                @foreach ($data['categories'] as $category)
                                                                                    <option value={{$category->id}}>{{$category->name}}</option>
                                                                                @endforeach
                                                                                @endif
                                                                        </optgroup>
                                                                       </select>
                                                                               @error("categories")
                                                                               <span class="text-danger">  {{$message}} </span>
                                                                               @enderror

                                                                    </div>
                                                                </div>


                                                            <div class="col-md-4 col-sm-12" >
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> {{trans('msg.choosetag')}}  </label>
                                                                    <select name="tags[]" class="select2 form-control"  multiple>
                                                                        <optgroup label="{{trans('msg.pleasechoosetag')}}">
                                                                            @if($data['tags'] && $data['tags'] ->count()>0)
                                                                                @foreach ($data['tags'] as $tags)
                                                                                    <option value={{$tags->id}}>{{$tags->name}}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </optgroup>
                                                                    </select>
                                                                    @error("tags")
                                                                    <span class="text-danger">  {{$message}} </span>
                                                                    @enderror

                                                                </div>
                                                            </div>

                                                            <div class="col-md-4" >
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> {{trans('msg.choosebrand')}}  </label>
                                                                    <select name="brand_id" class="select2 form-control" >
                                                                        <optgroup label="{{trans('msg.pleasechoosebrand')}}">
                                                                            @if($data['brands'] && $data['brands'] ->count()>0)
                                                                                @foreach ($data['brands'] as $brand)
                                                                                    <option value={{$brand->id}}>{{$brand->name}}</option>
                                                                                @endforeach
                                                                            @endif
                                                                        </optgroup>
                                                                    </select>
                                                                    @error("brand_id")
                                                                    <span class="text-danger">  {{$message}} </span>
                                                                    @enderror

                                                                </div>
                                                            </div>


                                                                <div class="col-md-6">
                                                                    <div class="form-group mt-1">
                                                                        <input type="checkbox" value=""
                                                                               name="is_active"
                                                                               id="is_active"
                                                                               class="switchery" data-color="success" checked
                                                                               />
                                                                        <label for="is_active"
                                                                               class="card-title ml-1">{{trans('msg.status')}} </label>

                                                                        @error("is_active")
                                                                        <span class="text-danger"> {{$messages}}</span>
                                                                        @enderror
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
                                                    <i class="la la-check-square-o"></i>{{trans('msg.sumbit')}}
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

@section('script')
<script>
    $('input:radio[name="type"]').change(
        function()
        {
            if(this.checked&&this.value=='2')
        {
            $('#category_list').removeClass('hidden');
        }
        else
        {
            $('#category_list').addClass('hidden');

        }
        }
    );
</script>
@stop
