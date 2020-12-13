@extends('layouts.layout')
@section('location','Dashboard')

@section('location2')
    <i class="fa fa-dashboard"></i>&nbsp;Manajemen Ruangan 
@endsection
@section('user-login','Operator')
@section('sidebar-menu')
    @include('operator/sidebar')
@endsection
@section('content')
    <div class="callout callout-info ">
        <h4>Perhatian!</h4>
        <p>
            Berikut adalah data anggota yang sudah tersedia, silahkan tambahkan jika ada anggota baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Ruangan</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modaltambah">
                            <i class="fa fa-plus"></i>&nbsp;Tambah Baru
                        </button>

                        <!-- Modal Tambah -->
                        <div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-list"></i>&nbsp;Tambah Data ruangan Pemira
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </h5>
                                </div>
                                <form action=" {{ route('operator.ruangan.post') }} " method="POST">
                                    {{ csrf_field() }} {{ method_field('POST') }}
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Nama Ruangan</label>
                                                <input type="text" name="nm_ruangan" class="form-control @error('nm_ruangan') is-invalid @enderror">
                                                @if ($errors->has('nm_ruangan'))
                                                    <small class="form-text text-danger">{{ $errors->first('nm_ruangan') }}</small>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Program Studi</label>
                                                <select name="prodi" class="form-control" id="">
                                                    <option disabled selected>-- pilih program studi --</option>
                                                    <option value="all">Semua Prodi</option>
                                                    @foreach ($prodis['fakultas'][0]['prodi'] as $prodi)
                                                        <option value="{{ $prodi['prodiNamaResmi'] }}">{{ $prodi['prodiNamaResmi'] }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('prodi'))
                                                    <small class="form-text text-danger">{{ $errors->first('prodi') }}</small>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Kapasitas</label>
                                                <input type="text" name="kapasitas" class="form-control @error('kapasitas') is-invalid @enderror">
                                                @if ($errors->has('kapasitas'))
                                                    <small class="form-text text-danger">{{ $errors->first('kapasitas') }}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Batalkan</button>
                                            <button type="submit" class="btn btn-primary" id="btn-submit"><i class="fa fa-save"></i>&nbsp;Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
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
                                <th>Nama Ruangan</th>
                                <th>Program Studi</th>
                                <th>Kapasitas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no=1;
                            @endphp
                            @foreach ($ruangans as $ruangan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $ruangan->nm_ruangan }}</td>
                                    <td>{{ $ruangan->nm_prodi }}</td>
                                    <td>{{ $ruangan->kapasitas }} Mahasiswa</td>
                                    <td>
                                        <a onclick="hapusruangan({{ $ruangan->id }})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" id="modalhapus">
                        <div class="modal-dialog modal-danger">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"><i class="fa fa-info-circle"></i>&nbsp;Perhatian</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>Apakah anda yakin ingin menghapus data?</h4>
                                </div>
                                <div class="modal-footer">
                                    <form method="POST" action="{{ route('operator.ruangan.delete') }}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <input type="hidden" name="id" id="id_delete">
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&nbsp;Kembali</button>
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Hapus Data</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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

        function hapusruangan(id) {
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