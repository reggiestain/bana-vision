@extends('layouts.masterRegister')

@section('title')
  Welcome
@endsection

@section('content')
  @include('includes.message-block')
<!-- SIGN UP-->
  @if(session()->has('message'))
  <div class="alert alert-success">
      {{ session()->get('message') }}
  </div>
@endif

 <link href="{{URL::asset('/assets/css/custom.css')}}" rel="stylesheet">
<div class="row col-12 p-0 m-0">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_content">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row p-0 m-0">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                            <i class="fa fa-globe"></i> Invoice.
                            <small class="pull-right">Date: {{now()->format('M d Y')}}</small>
                          </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row m-0 p-0 invoice-info">
                        <div class="col-sm-4 invoice-col">
                          From
                          <address>
                            <strong>Bana.</strong>
                            <br>795 Freedom Ave, Suite 600
                            <br>New York, CA 94107
                            <br>Phone: 1 (804) 123-9876
                            <br>Email: ironadmin.com
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          To
                          <address>
                            <strong>{{$user->name}}</strong>
                            <br>{{$user->usable->address}}
                            <br>Phone:{{$user->usable->telephone}}
                            <br>Email:{{$user->email}}
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <b>Invoice #007612</b>
                          <br>
                          <br>
                          <b>Order ID:</b> 4F3S8J
                          <br>
                          <b>Payment Due:</b> {{now()->format('M d Y')}}
                          <br>
                          <b>Account:</b> 968-34567
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row m-0 p-0">
                        <div class="col-12 table-responsive">
                          <table class="table table-sm table-striped">
                            <thead>
                              <tr>
                                <th class="p-1">Qty</th>
                                <th class="p-1">Product</th>
                                <th class="p-1">Serial #</th>
                                <th class="p-1" style="width: 59%">Description</th>
                                <th class="p-1">Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>1</td>
                                <td>{{$pricing->product}}</td>
                                <td>{{$pricing->product_id}}</td>
                                <td>{{$pricing->description}}
                                </td>
                                <td>{{$pricing->currency_symbol}}{{$pricing->amount}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <div class="row m-0 p-0">
                        <!-- /.col -->
                        <div class="col-12">
                          <p class="lead">Amount Due {{now()->format('M d Y')}}</p>
                          <div class="table-responsive">
                            <table class="table table-sm">
                              <tbody>
                                <tr>
                                  <th class="p-1" style="width:50%">Subtotal:</th>
                                  <td>{{$pricing->currency_symbol}}{{$pricing->amount}}</td>
                                </tr>
                                <tr>
                                  <th class="p-1">Tax ("{{$pricing->country_vat}}"%)</th>
                                  <td>{{$pricing->currency_symbol}}{{$pricing->country_vat/100*$pricing->amount}}</td>
                                </tr>
                                <tr>
                                  <th>Total:</th>
                                  <td>{{$pricing->currency_symbol}}{{$pricing->country_vat/100*$pricing->amount + $pricing->amount}}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- this row will not appear when printing -->
                      <div class="row m-0 p-0 no-print">
                        <div class="col-12">
                          
                          {!!$htmlForm!!}
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
@endsection