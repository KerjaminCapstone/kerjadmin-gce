@extends('layouts.master')
@section('tableId', '#freelancers')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Manajemen Freelancer</h3>
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
                            <h4 class="card-title">Daftar freelancer</h4>
                        </div>
                        <div class="col-2">
                            <a class="btn btn-primary btn-sm" href="{{route('admin.freelancers.create')}}" role="button">
                                <i class="fas fa-plus-circle"></i> Buat akun freelancer
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="freelancers">
                        <thead>
                            <tr>
                                <th class="text-center">No.</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($freelancers as $freelancer)
                                <tr>
                                    <td class="text-center">{{$loop->iteration}}</td>
                                    <td>{{$freelancer->name}}</td>
                                    <td>{{$freelancer->email}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-warning btn-sm" href="{{route('admin.freelancers.edit', $freelancer->id_user)}}" role="button">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{route('admin.freelancers.destroy', $freelancer->id_user)}}" style="display: inline" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" class="btn btn-sm btn-danger "data-bs-toggle="modal"
                                                data-bs-target="#freelancer_destroy_{{$freelancer->id_user}}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Delete --}}
                                <div class="modal fade text-left" id="freelancer_destroy_{{$freelancer->id_user}}" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="$freelancer_dest_ttl_{{$freelancer->id_user}}">Apakah Anda yakin untuk menghapus freelancer {{$freelancer->name}}?</h5>
                                                <button type="button" class="close rounded-pill"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn" data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Tidak</span>
                                                </button>
                                                <form action="{{route('admin.freelancers.destroy', $freelancer->id_user)}}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger ml-1">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Ya</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@stop