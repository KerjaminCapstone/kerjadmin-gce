@extends('layouts.master')
@section('tableId', '#complain')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Manajemen Komplain</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
            </div>
        </div>

            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <div class="alert alert-{{ $msg }} alert-dismissible fade show">
                        {{ Session::get('alert-' . $msg) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach

        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-10">
                            <h4 class="card-title">Daftar Komplain</h4>
                        </div>                        
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="complaints">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Title</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Reported By</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complaints as $complain)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$complain->title}}</td>
                                    <td>{{$complain->desc}}</td>
                                    <td>{{$complain->reported_by}}</td>
                                    <td>Hubla</td>

                                    <!-- tambahin status + waktu -->
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@stop