@extends('layouts.admin')

@section('title', 'Create Image Product')

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
                                    <h4 class="card-title" id="basic-layout-form"> {{trans('msg.addproductphotopart')}} </h4>
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
                                        <form class="form" action="{{route('dashboard.product.photo.store',$id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="product_id"  value="{{$id}}">
                                           <div class="form-group">
                                                <label> {{trans('msg.uploadPhoto')}}  </label>
                                                <label id="projectinput7" class="file center-block" >
                                                    <input type="file" id="file" name="image" multiple>
                                                    <span class="file-custom"></span>
                                                </label>
                                            </div>
                                                @error("image")
                                                <span class="text-danger"> {{$message}}</span>
                                                @enderror

                                              {{--   <div class="form-body">

                                                    <h4 class="form-section"><i class="ft-home"></i> صور ألاسليدر </h4>
                                                    <div class="form-group">
                                                        <div id="dpz-multiple-files" class="dropzone dropzone-area">
                                                            <div class="dz-message">يمكنك رفع اكثر من صوره هنا</div>
                                                        </div>
                                                        <br><br>
                                                    </div>
                                                </div> --}}


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
    $('select[name="manage_stock"]').change(
        function()
        {
            if(this.value==1)
        {
            $('#quantity').removeClass('hidden');
        }
        else
        {
            $('#quantity').addClass('hidden');

        }
        }
    );
</script>
@stop


