@extends('layouts.layout')
@section('location','Dashboard')

@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Manajemen Jadwal Perkuliahan 
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Silahkan Pilih Jadwal Yang Akan Ditukarkan !!
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Jadwal Yang Dipilih </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-hover table-bordered">
                        <tr>
                            <td>Ruangan </td>
                            <td> : </td>
                            <td>
                                {{ $dari->nm_ruangan }}
                            </td>
                        </tr>
                        <tr>
                            <td>Mata Kuliah </td>
                            <td> : </td>
                            <td>
                                {{ $dari->nm_matkul }}
                            </td>
                        </tr>
                        <tr>
                            <td>Program Study </td>
                            <td> : </td>
                            <td>
                                {{ $dari->prodi }}
                            </td>
                        </tr>
                        <tr>
                            <td>Dosen Pengampu </td>
                            <td> : </td>
                            <td>
                                {{ $dari->nm_dosen }}
                            </td>
                        </tr>
                        <tr>
                            <td>Kelas </td>
                            <td> : </td>
                            <td>
                                {{ $dari->kelas }}
                            </td>
                        </tr>
                        <tr>
                            <td>Hari </td>
                            <td> : </td>
                            <td>
                                {{ $dari->hari }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jam Mulai </td>
                            <td> : </td>
                            <td>
                                {{ $dari->jam_mulai }}
                            </td>
                        </tr>
                        <tr>
                            <td>Jam Selesai </td>
                            <td> : </td>
                            <td>
                                {{ $dari->jam_selesai }}
                            </td>
                        </tr>
                    </table>    
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Pilih Jadwal Yang Akan Ditukar </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table class="table table-hover table-bordered" id="kelas">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Ruangan</th>
                                <th>Mata Kuliah</th>
                                <th>Dosen Pengampu</th>
                                <th>Hari</th>
                                <th>Kelas</th>
                                <th>Jam Mulai</th>
                                <th>Jam Selesai</th>
                                <th>Ubah Jadwal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($jadwals as $jadwal)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $jadwal->nm_ruangan }}</td>
                                    <td>{{ $jadwal->nm_matkul }}</td>
                                    <td>{{ $jadwal->nm_dosen }}</td>
                                    <td>{{ $jadwal->hari }}</td>
                                    <td>{{ $jadwal->kelas }}</td>
                                    <td>{{ $jadwal->jam_mulai }}</td>
                                    <td>{{ $jadwal->jam_selesai }}</td>
                                    <td>
                                        <form action="{{ route('operator.ubah_jadwal.post',[$id_dari,$jadwal->id]) }}" method="POST">
                                            {{ csrf_field() }} {{ method_field('PATCH') }}
                                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i>&nbsp; Pilih</button>
                                        </form>
                                    </td>
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

        @if($errors->any())
            $('#modaltambah').modal('show');
        @endif
    </script>
@endpush