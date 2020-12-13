@extends('layouts.layout')
@section('location','Dashboard')

@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Manajemen Mata Kuliah 
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data mata kuliah yang sudah tersedia, silahkan tambahkan jika ada mata kuliah baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Mata Kuliah</h3>
                    <div class="box-tools pull-right">
                        <form action="{{ route('operator.matkul.post') }}" method="POST">
                            {{ csrf_field() }} {{ method_field('POST') }}
                            <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Generate Data Mata Kuliah</button>
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
                                <th>Program Study</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Kelas</th>
                                <th>SKS</th>
                                <th>Semester</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($matkuls as $matkul)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $matkul->prodi }}</td>
                                    <td>{{ $matkul->nm_matkul }}</td>
                                    <td>{{ $matkul->kelas }}</td>
                                    <td>{{ $matkul->sks }}</td>
                                    <td>{{ $matkul->semester_matkul }}</td>
                                    <td>
                                        <a onclick="ubahRuangan({{ $matkul->id }})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
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

        function ubahRuangan(id) {
            $('#modalhapus').modal('show');
            $('#id_delete').val(id);
        }

        $(document).ready(function(){
            $("#password1, #password2").keyup(function(){
                var password = $("#password1").val();
                var ulangi = $("#password2").val();
                if($("#password1").val() == $("#password2").val()){
                    $('#password_benar').show();
                    $('#password_salah').hide();
                    $('#btn_submit').attr("disabled",false);
                }
                else{
                    $('#password_benar').hide();
                    $('#password_salah').show();
                    $('#btn_submit').attr("disabled",true);
                }
            });
        });

        function ubahOperator(id){
            $.ajax({
                url: "{{ url('operator/manajemen_anggota') }}"+'/'+ id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data){
                    $('#modalubah').modal('show');
                    $('#id_edit').val(id);
                    $('#nm_anggota').val(data.nm_anggota);
                    $('#nik').val(data.nik);
                    $('#alamat').val(data.alamat);
                    $('#tahun_keanggotaan').val(data.tahun_keanggotaan);
                    $('#email').val(data.email);
                },
                error:function(){
                    alert("Nothing Data");
                }
            });
        }

        function ubahPassword(id) {
            $('#ubahpassword').modal('show');
            $('#id_password').val(id);
        }

        @if($errors->any())
            $('#modaltambah').modal('show');
        @endif
    </script>
@endpush