<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->


    <!-- Sidebar -->
    <div class="sidebar">
        <h4 class="text-center text-warning"><strong>
        {{ (Auth::user()->name) }}
        </strong>
        </h4>
        <hr>
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link active">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Management Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ url('admin/kelas') }}" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Data Kelas
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/siswa') }}" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Data Siswa
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('admin/guru') }}" class="nav-link">
                                <i class="nav-icon fas fa-table"></i>
                                <p>
                                    Data Guru
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/user') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Management Users
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('admin/jadwal') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>
                            Jadwal Pengajian
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/info') }}" class="nav-link">
                        <i class="nav-icon fas fa-volume-up"></i>
                        <p>
                            Pengumuman
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/absensi') }}" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Absensi
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
