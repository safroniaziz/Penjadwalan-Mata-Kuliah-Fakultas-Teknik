<li class="header" style="font-weight:bold;">MENU UTAMA</li>
<li class="{{ set_active('operator.dashboard') }}">
    <a href="{{ route('operator.dashboard') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
    </a>
</li>

<li class="{{ set_active('operator.dosen') }}">
    <a href="{{ route('operator.dosen') }}">
        <i class="fa fa-users"></i> <span>Data Dosen</span>
    </a>
</li>

<li class="{{ set_active('operator.matkul') }}">
    <a href="{{ route('operator.matkul') }}">
        <i class="fa fa-book"></i> <span>Mata Kuliah</span>
    </a>
</li>

<li class="{{ set_active('operator.ruangan') }}">
    <a href="{{ route('operator.ruangan') }}">
        <i class="fa fa-clock-o"></i> <span>Manajemen Ruangan</span>
    </a>
</li>

<li class="{{ set_active('operator.jadwal') }}">
    <a href="{{ route('operator.jadwal') }}">
        <i class="fa fa-users"></i> <span>Jadwal Perkuliahan</span>
    </a>
</li>

<li class="{{ set_active('operator.tanpa_jadwal') }}">
    <a href="{{ route('operator.tanpa_jadwal') }}">
        <i class="fa fa-ban"></i> <span>Matkul Tanpa Jadwal</span>
    </a>
</li>

<li class="">
    <a href="">
        <i class="fa fa-power-off text-danger"></i> <span class="text-danger">Keluar</span>
    </a>
</li>