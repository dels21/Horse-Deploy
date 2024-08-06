@extends('layouts.app')
@section('title', 'Detail Pemeriksaan Dokter')
@section('setAktifPemeriksaanSaya', 'active')

@section('customCSS')

    <!-- Custom styles for this template -->
    <link href="/templating-assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/templating-assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="biggest-font mt-5 mb-5">Detail Pemeriksaan Dokter</h1>
        @if ($detailPendaftaran->isEmpty() || $detailPemeriksaan->isEmpty())
            <p>Belum ada detail pemeriksaan.</p>
            {{-- <p>{{ $loggedInUserId }}</p> --}}
            @else
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Pemeriksaan</th>
                                <th>Jenis Pemeriksaan</th>
                                <th>Nama Pasien</th>
                                <th>Hasil Pemeriksaan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailPemeriksaan as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nomorPemeriksaan }}</td>
                                <td>{{ $detailPendaftaran[$loop->iteration-1]->namaJenisPemeriksaan }}</td>
                                <td>{{ $detailPendaftaran[$loop->iteration-1]->name }}</td>
                                <td>@if(isset($detailHasil[$loop->iteration-1]->laporan))
                                    {{ $detailHasil[$loop->iteration-1]->laporan }}
                                @endif</td>
                                <td>{{ $item->status }}</td>
                                <td><a href="{{ route('edit_detail_pemeriksaan', $item->idDetailPemeriksaan) }}" class="btn btn-info">Edit</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('customJS')

    <!-- Bootstrap core JavaScript-->
    <script src="/templating-assets/vendor/jquery/jquery.min.js"></script>
    <script src="/templating-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/templating-assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/templating-assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/templating-assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="/templating-assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/templating-assets/js/demo/datatables-demo.js"></script>

@endsection
