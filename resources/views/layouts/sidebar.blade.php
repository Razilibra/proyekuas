@include('include.style')
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <!-- Dashboard -->
        @canany(['isAdministrator', 'isSuperAdmin', 'isKajur', 'isKaprodi', 'isMahasiswa', 'isDosen'])
            <li class="nav-item">
                <a class="nav-link" href="/dashboard">
                    <i class="fas fa-tachometer-alt menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
        @endcanany

        <!-- Data Pengguna -->
        @canany(['isAdministrator', 'isSuperAdmin'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#data-pengguna" aria-expanded="false"
                    aria-controls="data-pengguna">
                    <i class="fas fa-users menu-icon"></i>
                    <span class="menu-title">Data Pengguna</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="data-pengguna">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/mahasiswa"><i class="fas fa-user-graduate"></i>
                                Mahasiswa</a></li>
                        <li class="nav-item"><a class="nav-link" href="/dosen"><i class="fas fa-chalkboard-teacher"></i>
                                Dosen</a></li>
                    </ul>
                </div>
            </li>
        @endcanany

        @canany(['isAdministrator', 'isSuperAdmin', 'isKajur', 'isKaprodi'])
            <!-- Data Master -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#data-master" aria-expanded="false"
                    aria-controls="data-master">
                    <i class="fas fa-database menu-icon"></i>
                    <span class="menu-title">Data Master</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="data-master">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/prodi"><i class="fas fa-school"></i> Prodi</a></li>
                        <li class="nav-item"><a class="nav-link" href="/jurusan"><i class="fas fa-graduation-cap"></i>
                                Jurusan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/ruangan"><i class="fas fa-door-open"></i>
                                Ruangan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/sesi"><i class="fas fa-clock"></i> Sesi</a></li>
                        <li class="nav-item"><a class="nav-link" href="/jabatan"><i class="fas fa-briefcase"></i>
                                Jabatan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/golongan"><i class="fas fa-user-tie"></i>
                                Golongan</a></li>
                        <li class="nav-item"><a class="nav-link" href="/jenjang"><i class="fas fa-user-tie"></i> Jenjang</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/pangkat"><i class="fas fa-user-tie"></i> Pangkat</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="/bidang"><i class="fas fa-building"></i> Bidang</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endcanany

        <!-- PKL -->
        @canany(['isAdministrator', 'isSuperAdmin', 'isKajur', 'isKaprodi', 'isDosen', 'isMahasiswa'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#pkl" aria-expanded="false" aria-controls="pkl">
                    <i class="fas fa-briefcase menu-icon"></i>
                    <span class="menu-title">PKL</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="pkl">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/laporan_pkl"><i class="fas fa-file-alt"></i> Laporan
                                PKL</a></li>
                        @canany(['isAdministrator', 'isSuperAdmin', 'isKajur', 'isKaprodi', 'isDosen'])
                            <li class="nav-item"><a class="nav-link" href="/tempat_pkl"><i class="fas fa-building"></i> Tempat
                                    PKL</a></li>
                        @endcanany
                        <li class="nav-item"><a class="nav-link" href="/registrasipkl"><i class="fas fa-edit"></i>
                                Registrasi PKL</a></li>
                        <li class="nav-item"><a class="nav-link" href="/mahasiswapkl"><i class="fas fa-user"></i>
                                Mahasiswa PKL</a></li>
                        {{-- <li class="nav-item"><a class="nav-link" href="/mahasiswapkllogbook"><i class="fas fa-book"></i> Log Book</a></li> --}}
                    </ul>
                </div>
            </li>
        @endcanany

        <!-- Tugas Akhir (TA) -->
        @canany(['isAdministrator', 'isSuperAdmin', 'isKajur', 'isKaprodi', 'isDosen', 'isMahasiswa'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ta" aria-expanded="false" aria-controls="ta">
                    <i class="fas fa-book menu-icon"></i>
                    <span class="menu-title">TA</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ta">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/pengajuan"><i class="fas fa-file-upload"></i>
                                Pengajuan </a></li>
                        <li class="nav-item"><a class="nav-link" href="/bimbingan"><i class="fas fa-comments"></i>
                                Bimbingan</a></li>
                        <li class="nav-item"><a class="nav-link" href="sidang_ta"><i class="fas fa-comments"></i>
                                Sidang Ta</a></li>

                    </ul>
                </div>
            </li>
        @endcanany

        @canany(['isAdministrator', 'isSuperAdmin', 'isKajur', 'isKaprodi', 'isDosen', 'isMahasiswa'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#sempro" aria-expanded="false" aria-controls="sempro">
                    <i class="fas fa-chalkboard menu-icon"></i>
                    <span class="menu-title">Sempro</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="sempro">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/sempro"><i class="fas fa-user"></i> Mahasiswa
                                Sempro</a></li>
                        <li class="nav-item"><a class="nav-link" href="/sempro/hasil"><i
                                    class="fas fa-check-circle"></i> Hasil Sempro</a></li>
                    </ul>
                </div>
            </li>
        @endcanany

        <!-- Data Penilaian -->
        @canany(['isAdministrator', 'isSuperAdmin', 'isKajur', 'isKaprodi', 'isDosen'])
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#data-penilaian" aria-expanded="false"
                    aria-controls="data-penilaian">
                    <i class="fas fa-star menu-icon"></i>
                    <span class="menu-title">Data Penilaian</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="data-penilaian">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/penilaian_sidang"><i
                                    class="fas fa-clipboard-check"></i> Penilaian Sidang pkl</a></li>
                        <li class="nav-item"><a class="nav-link" href="/nilaipkl"><i class="fas fa-file-alt"></i> Nilai
                                Bimbingan pkl</a></li>
                        <li class="nav-item"><a class="nav-link" href="/nilai_sempro"><i class="fas fa-book-reader"></i>
                                Penilaian Sempro</a></li>
                        <li class="nav-item"><a class="nav-link" href="/nilai_ta"><i class="fas fa-book-reader"></i>
                                Penilaian Tugas Akhir</a></li>
                    </ul>
                </div>
            </li>
        @endcanany



        <!-- User -->
        @can('isAdministrator')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#user" aria-expanded="false" aria-controls="user">
                    <i class="fas fa-user menu-icon"></i>
                    <span class="menu-title">User</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="user">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/users"><i class="fas fa-users"></i> User</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endcan
    </ul>
</nav>

<!-- Bootstrap 4 CSS for better layout -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- jQuery for Collapse and Interactions -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Bootstrap JS for Collapse functionality -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
