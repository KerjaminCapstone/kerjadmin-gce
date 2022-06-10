@extends('layouts.master')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Form Edit Data Freelancer</h3>
                </div>
            </div>
        </div>
        <section class="section">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))
                    <div class="alert alert-{{ $msg }} alert-dismissible fade show">
                        {{ Session::get('alert-' . $msg) }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @endforeach
            <div class="card">
                <div class="card-body">
                    <form action="{{route('admin.freelancers.update', $freelancer->id_user)}}" method="post" id="tambah_blog">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" value="{{ $freelancer->name }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ $freelancer->email }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" id="nik" name="nik" value="{{ $freelancer->nik }}" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="no_wa">Nomor Whatsapp</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">+62</span>
                                <input type="text" class="form-control" placeholder="nomor whatsapp" value="{{ $freelancer->no_wa }}""
                                    aria-label="Username" aria-describedby="basic-addon1" id="no_wa" name="no_wa">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dob">Tanggal Lahir</label>
                            <input type="text" id="dob" name="dob" class="form-control" value="{{ $freelancer->dob }}">
                        </div>

                        <div class="form-group">
                            <label for="is_male">Jenis Kelamin</label>
                            <select class="form-control" id="is_male" name="is_male">
                              <option value="1" {{ $freelancer->is_male ? "selected" : ""}}>Laki-laki</option>
                              <option value="0" {{ $freelancer->is_male ? "" : "selected"}}>Perempuan</option>
                            </select>
                          </div>

                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea id="address" name="address" class="form-control">{{ $freelancer->address }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="job_child_code">Keahlian</label>
                            <select class="form-select" id="job_child_code" name="job_child_code">
                                @foreach($jobChildCodes as $jc)
                                    <option value="{{ $jc->job_child_code }}" {{ $jc->job_child_code == $freelancer->job_child_code ? "selected" : "" }}>{{ $jc->job_child_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Ganti password</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary ml-1 my-4">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">SUBMIT</span>
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </div>
@stop

@push('custom-scripts')
    <script>
          $( function() {
            $("#dob").datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat:"yy-mm-dd",
            });
        } );
    </script>
@endpush