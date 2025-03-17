@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row"></div>
        <div class="content-body">


                    <!-- eCommerce statistic -->
                    <div class="row">
                      <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="media-body text-left">
                                  <h3 class="info">11850$</h3>
                                  <h6>{{trans('msg.allseller')}}</h6>
                                </div>
                                <div>
                                  <i class="icon-basket-loaded info font-large-2 float-right"></i>
                                </div>
                              </div>
                              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 80%"
                                aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="media-body text-left">
                                  <h3 class="warning">$748</h3>
                                  <h6>{{trans('msg.allproduct')}}</h6>
                                </div>
                                <div>
                                  <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                </div>
                              </div>
                              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%"
                                aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="media-body text-left">
                                  <h3 class="danger">{{ App\Models\Product::count() }}</h3>
                                  <h6> {{trans('msg.productnumber')}}</h6>
                                </div>
                                <div>
                                  <i class="icon-heart danger font-large-2 float-right"></i>
                                </div>
                              </div>
                              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%"
                                aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-3 col-lg-6 col-12">
                        <div class="card pull-up">
                          <div class="card-content">
                            <div class="card-body">
                              <div class="media d-flex">
                                <div class="media-body text-left">
                                  <h3 class="success">{{ App\Models\User::count() }}</h3>
                                  <br>
                                  <h6>{{trans('msg.customernumber')}}</h6>
                                </div>
                                <div>
                                  <i class="icon-user-follow success font-large-2 float-right"></i>
                                </div>
                              </div>
                              <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('msg.order_sale') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-de mb-0">
                                    <thead>
                                        <tr>
                                            <th>الطلب</th>
                                            <th>العميل</th>
                                            <th>السعر</th>
                                            <th>حاله الطلب</th>
                                            <th>الاجمالي($)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-success bg-lighten-5">
                                            <td>10583</td>
                                            <td>سميح بشري</td>
                                            <td>$100</td>
                                            <td>مكتمل</td>
                                            <td>$4762.53</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

      </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">أحدث التقييمات</h4>
                        </div>
                        <div class="card-content">
                            <div class="table-responsive">
                                <table class="table table-de mb-0">
                                    <thead>
                                        <tr>
                                            <th>العميل</th>
                                            <th>المنتج</th>
                                            <th>التقييم</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-danger bg-lighten-5">
                                            <td>سميح بشري</td>
                                            <td>ساعة يد</td>
                                            <td>جيدة</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





@stop
