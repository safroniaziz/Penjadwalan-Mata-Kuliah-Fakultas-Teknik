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
            Berikut adalah data jadwal perkuliahan yang sudah tersedia, silahkan tambahkan jika ada jadwal perkuliahan baru
            <br>
        </p>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-calendar"></i>&nbsp;Manajemen Data Jadwal Perkuliahan</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                            <i class="fa fa-success-circle"></i><strong>Berhasil :</strong> {{ $message }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{ route('operator.generate_jadwal') }}" method="POST">
                                {{ csrf_field() }} {{ method_field('POST') }}
                                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Generate Jadwal Kuliah</button>
                            </form>
                        </div>
                    </div>
                    <form action="{{ route('operator.cari_jadwal') }}" method="GET">
                        {{ csrf_field() }} {{ method_field('GET') }}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Cari Prodi</label>
                                <select name="prodi" id="" class="form-control">
                                    <option value="semua">Semua Prodi</option>
                                    <option value="INFORMATIKA">Informatika</option>
                                    <option value="TEKNIK SIPIL">Teknik Sipil</option>
                                    <option value="TEKNIK MESIN">Teknik Mesin</option>
                                    <option value="TEKNIK ELEKTRO">Teknik Elektro</option>
                                    <option value="ARSITEKTUR">Arsitektur</option>
                                    <option value="SISTEM INFORMASI">Sistem Informasi</option>
                                </select>
                                @if ($errors->has('prodi'))
                                    <small class="form-text text-danger">{{ $errors->first('prodi') }}</small>
                                @endif
                            </div>

                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1">Cari Hari</label>
                                <select name="hari" id="" class="form-control">
                                    <option value="semua">Semua Hari</option>
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jumat</option>
                                </select>
                                @if ($errors->has('hari'))
                                    <small class="form-text text-danger">{{ $errors->first('hari') }}</small>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i>&nbsp; Lihat Data</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            @if (isset($_GET['hari']))
                                <table class="table table-bordered table-hover" id="kelas">
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
                                            <th>Durasi</th>
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
                                                <td>{{ $jadwal->durasi }} Menit</td>
                                                <td>
                                                    <a href="{{ route('operator.ubah_jadwal',[$jadwal->id]) }}" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit"></i>&nbsp; Ganti Jadwal
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <script>
        $('#kelas').DataTable({
            "oLanguage": {
              "sSearch": "Cari Data :",
              "sZeroRecords": "Tidak Ada Data Ditampilkan",
              "sProcessing": "<i class='fa fa-spinner fa-1x fa-fw' style='color:black !important;'></i>&nbsp; Memuat. Harap Tunggu.. !!",
              "sEmptyTable": 'Tidak Ada Data Yang Dimuat',
              "sLengthMenu": 'Menampikan: <select>'+
                '<option value="10">10</option>'+
                '<option value="50">50</option>'+
                '<option value="100">100</option>'+
                '<option value="-1">Semua</option>'+
                '</select> Data',
                "sInfoFiltered": " - Filter Dari _MAX_ Data",
                "sInfo": "Mendapatkan _START_ - _END_ Data Untuk Ditampilkan Dari Total _TOTAL_ Data",
                "sInfoEmpty": "Mendapatkan 0 Sampai 0 Dari 0Data ",
                "oPaginate": {
                    "sPrevious": "Sebelumnya", 
                    "sNext": "Selanjutnya", 
                }
            },
            dom: 'lBfrtip',
            buttons: [
                { extend:'excel', text:'<i class="fa fa-file-excel-o"></i>&nbsp;Export Excel', className:'btn-export-excel',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8],
                    },
                },
                { extend:'csv', text:'<i class="fa fa-file-excel-o"></i>&nbsp;Export CSV', className:'btn-export-csv',
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8],
                    },
                },
            ],
          
        });

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