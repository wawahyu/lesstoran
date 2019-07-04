@extends('waiter.layouts.master')

@section('content')
<link href="{{asset('css')}}/datatables.bootstrap.css" rel="stylesheet">
<div class="container">
    <div class="row margint90">
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Dashboard</li>
        </ul><!-- breadcrumbs -->
        
        <div class="col-md-5">
            <div class="media">
                <div class="media-body">
                    <h3 class="media-heading"><span class="fa fa-coffee"></span> <a href="#">{{$title}}</a></h3>
                    <p></p>
                    <hr style="margin:8px auto;height:1px;">
                </div>
            </div>    
            <div class="panel panel-medidu">
                <div class="panel-heading"><h3>Selamat Datang {{Auth::User()->name}} !</h3></div>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div class="box">
                            Anda Login Sebagai : {{Auth::User()->myRoleName()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- content -->
</div>
@endsection

@section('scripts')
<script src="{{asset('js')}}/jquery.dataTables.min.js"></script>
<script src="{{asset('js')}}/datatables.bootstrap.js"></script>
<script src="{{asset('js')}}/handlebars.js"></script>


@endsection