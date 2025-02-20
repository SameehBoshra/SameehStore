@extends('layouts.admin')

@section('title', 'Product Attribute options')

@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title" >{{trans('msg.optionpage')}}</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.option.index') }}">{{trans('msg.optionpart')}}</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-body">
            <!-- DOM - jQuery events table -->
            <section id="dom">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{trans('msg.alloptionpart')}}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                        <thead>
                                            <tr>
                                                <th>{{trans('msg.optionname')}}</th>
                                                <th>{{trans('msg.productname')}}</th>
                                                <th>{{trans('msg.attributename')}}</th>
                                                <th>{{trans('msg.price')}}</th>
                                                <th> {{trans('msg.actions')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($options)
                                                @foreach($options as $option)
                                                    <tr>
                                                        <td>{{ $option->name }}</td>
                                                        <td>{{ $option->product->name ?? 'No Product' }}</td>
                                                        <td>{{ $option->attribute->name ?? 'No Attribute' }}</td>


                                                        <td>{{ $option->price }}</td>

                                                        <td>
                                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                                <a href="{{ route('dashboard.option.edit', $option->id) }}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">{{trans('msg.edit')}}</a>

                                                                <a href="{{ route('dashboard.option.destroy', $option->id) }}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">{{trans('msg.delete')}}</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
