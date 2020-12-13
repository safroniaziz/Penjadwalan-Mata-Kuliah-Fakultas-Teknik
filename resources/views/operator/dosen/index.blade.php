@extends('layouts.layout')
@section('location','Dashboard')

@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Data Dosen 
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data dosen yang sudah tersedia, silahkan tambahkan jika ada dosen baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Dosen</h3>
                    <div class="box-tools pull-right">
                        <form action="{{ route('operator.dosen.post') }}" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Generate Data Dosen</button>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-success-circle"></i><strong>Berhasil :</strong> {{ $message }}
                        </div>
                    @endif
                    <table class="table table-bordered table-hover" id="kelas">
                        <thead class="bg-primary">
                            <tr>
                                <th>No</th>
                                <th>Nip</th>
                                <th>Nama Dosen</th>
                                <th>Program Study</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($dosens as $dosen)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dosen->nip }}</td>
                                    <td>{{ $dosen->nm_dosen }}</td>
                                    <td>{{ $dosen->prodi }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                 </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready( function () {
            $('#kelas').DataTable();
        } );

    </script>
@endpush