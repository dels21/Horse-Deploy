<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="profile" href="#">
                <i class="bi bi-person-circle"></i>
                <span>{{ Auth::user()->name }}</span>
            </a>
        </li><!-- End Profile -->

        {{-- Navigation Admin --}}
        @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link @yield('setAktifDashboardKaryawan')" href="/admin/dashboard">
                    <i class="bi bi-house-door-fill"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-database-fill"></i><span>List Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/admin/list-karyawan">
                            <span>Karyawan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/list-pasien">
                            <span>Pasien</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/list-dokter">
                            <span>Dokter</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End List Data -->
        @endif
        {{-- End Navigation Admin --}}

        {{-- Navigation Karyawan --}}
        @if (Auth::user()->role == 'karyawan')
            <li class="nav-item">
                <a class="nav-link @yield('setAktifDashboardKaryawan')" href="/karyawan/dashboard">
                    <i class="bi bi-house-door-fill"></i><span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-database-fill"></i><span>List Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="/karyawan/list-pasien">
                            <span>Pasien</span>
                        </a>
                    </li>
                    <li>
                        <a href="/karyawan/list-dokter">
                            <span>Dokter</span>
                        </a>
                    </li>
                    <li>
                        <a href="/karyawan/list-modalitas">
                            <span>Modalitas</span>
                        </a>
                    </li>
                    <li>
                        <a href="/karyawan/list-dicom">
                            <span>DICOM</span>
                        </a>
                    </li>
                    <li>
                        <a href="/karyawan/list-jenis-pemeriksaan">
                            <span>Jenis Pemeriksaan</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End List Data -->

            <li class="nav-item">
                <a class="nav-link @yield('setAkfifListPemeriksaan')" href="/karyawan/list-pemeriksaan">
                    <i class="bi bi-clock-fill"></i><span>Pemeriksaan</span>
                </a>
            </li><!-- End Pemeriksaan -->

            <li class="nav-item">
                <a class="nav-link @yield('setAktifVerifikasi')" href="/karyawan/verifikasi">
                    <i class="bi bi-patch-check-fill"></i><span>Verifikasi</span>
                </a>
            </li><!-- End Verifikasi -->

            {{-- <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-box-seam-fill"></i><span>Kirim Data</span>
                </a>
            </li><!-- End Verifikasi --> --}}
        @endif
        {{-- End Navigation Karyawan --}}

        {{-- Navigation Dokter --}}
        @if (Auth::user()->role == 'dokter')
            <li class="nav-item">
                <a class="nav-link @yield('setAktifDashboardDokter')" href="/dokter/dashboard">
                    <i class="bi bi-house-door-fill"></i><span>Dashboard</span>
                </a>
            </li><!-- End Dashboard -->

            <li class="nav-item">
                <a class="nav-link @yield('setAktifListPasien')" href="/dokter/list-pasien">
                    <i class="bi bi-view-list"></i><span>List Pasien</span>
                </a>
            </li><!-- End List Pasien -->
        @endif
        {{-- End Navigation Dokter --}}

        {{-- Navigation Pasien --}}
        @if (Auth::user()->role == 'pasien')
            <li class="nav-item">
                <a class="nav-link @yield('setAktifHalamanUtama')" href="/pasien/dashboard">
                    <i class="bi bi-house-door-fill"></i><span>Halaman Utama</span>
                </a>
            </li><!-- End Dashboard -->

            <li class="nav-item">
                <a class="nav-link @yield('setAktifPemeriksaanSaya')" href="/pasien/pemeriksaan">
                    <i class="bi bi-view-list"></i><span>Pemeriksaan Saya</span>
                </a>
            </li><!-- End Pemeriksaan Saya -->

            <li class="nav-item">
                <a class="nav-link @yield('setAktifDaftarPemeriksaan')" href="/pasien/daftar-pemeriksaan">
                    <i class="bi bi-bookmark-plus-fill"></i><span>Daftar Pemeriksaan</span>
                </a>
            </li><!-- End Daftar Pemeriksaan -->

            @unless ($dataExists)
            <li class="nav-item">
                <a class="nav-link @yield('setAktifLengkapiDataDiri')" href="/pasien/lengkapi-data-diri">
                    <i class="bi bi-card-text"></i><span>Lengkapi Data Diri</span>
                </a>
            </li><!-- End Daftar Pemeriksaan -->
            @endunless
        @endif
        {{-- End Navigation Pasien --}}

    </ul>
    <!-- Logout Button -->
    <div class="logout">
        <a class="nav-link" href="/logout">
            <i class="bi bi-box-arrow-right"></i><span>Logout</span>
        </a>
    </div><!-- End Logout -->
</aside><!-- End Sidebar -->
