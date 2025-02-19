@extends('layouts.admin')

@section('title', 'Create price Product')

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
                                        <form class="form" action="{{route('dashboard.product.price.store',$id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf

                                            <input type="hidden" name="product_id"  value="{{$id}}">
                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> {{trans('msg.dataofproductprice')}}  </h4>
                                                        <div class="row">

                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="price"> {{trans('msg.productprice')}}  </label>
                                                                    @foreach($products as $product)
                                                                        <input type="number" value="{{ old('price', $product->price) }}" id="price"
                                                                               class="form-control"
                                                                               placeholder="  "
                                                                               name="price">
                                                                    @endforeach
                                                                    @error("price")
                                                                           <span class="text-danger">  {{$message}} </span>
                                                                           @enderror

                                                                </div>
                                                            </div>
                                                                <div class="col-md-6 col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="special_price"> {{trans('msg.spcialprice')}} </label>
                                                                        @foreach($products as $product)
                                                                        <input type="number" value="{{old('special_price', $product->special_price)}}" id="slug"
                                                                               class="form-control"
                                                                               placeholder="  "
                                                                               name="special_price">
                                                                        @endforeach
                                                                               @error("special_price")
                                                                               <span class="text-danger">  {{$message}} </span>
                                                                               @enderror

                                                                    </div>
                                                                </div>

                                                            <div class="col-md-12 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="special_price_type"> {{trans('msg.specialpricetype')}} </label>
                                                                    @foreach($products as $product)
                                                                 <select name="special_price_type" multiple class="select2 form-control" value="{{old('special_price_type', $product->special_price_type)}}">
                                                                     <optgroup label="{{trans('msg.pleasechoosetype')}}">
                                                                         <option value="Precent">{{trans('msg.precent')}}</option>
                                                                         <option value="Precent">{{trans('msg.precent')}}</option>
                                                                     <option value="Fixed">{{trans('msg.fixed')}}</option>
                                                                     </optgroup>
                                                                 </select>
                                                                    @endforeach
                                                                    @error("special_price_type")
                                                                    <span class="text-danger">  {{$message}} </span>
                                                                    @enderror

                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="special_price_start"> {{trans('msg.special_price_start')}} </label>
                                                                    @foreach($products as $product)
                                                                    <input type="date" value="{{old('special_price_start',$product->special_price_start)}}" id="special_price_start"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="special_price_start">
                                                                    @endforeach
                                                                    @error("special_price_start")
                                                                    <span class="text-danger">  {{$message}} </span>
                                                                    @enderror

                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="special_price_end"> {{trans('msg.special_price_end')}} </label>
                                                                    @foreach($products as $product)
                                                                    <input type="date" value="{{old('special_price_end' ,$product->special_price_end)}}" id="special_price_end"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="special_price_end">
                                                                    @endforeach
                                                                    @error("special_price_end")
                                                                    <span class="text-danger">  {{$message}} </span>
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
