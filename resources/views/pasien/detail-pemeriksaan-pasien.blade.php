@extends('layouts.app')
@section('title', 'Detail Pemeriksaan Saya')
@section('setAktifPemeriksaanSaya', 'active')

@section('customCSS')

    <!-- Custom styles for this template -->
    <link href="/templating-assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/templating-assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="thankYouModal" tabindex="-1" aria-labelledby="thankYouModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="thankYouModalLabel">Hasil Pemeriksaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="biggest-font mt-5 mb-5">Detail Pemeriksaan Saya</h1>
        @if ($detail->isEmpty() || $detailPendaftaran->isEmpty())
        <p>Belum ada detail pemeriksaan.</p>
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
                                    <th>Tanggal Pemeriksaan</th>
                                    <th>Jenis Pemeriksaan</th>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai </th>
                                    <th>Ruangan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($detail as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nomorPemeriksaan }}</td>
                                        {{-- <td>{{ $item->tanggalPemeriksaan }}</td> --}}
                                        <td>{{ $detailPendaftaran[$loop->iteration - 1]->tanggalPendaftaranPemeriksaan }}</td>
                                        <td>{{ $detailPendaftaran[$loop->iteration - 1]->namaJenisPemeriksaan }}</td>
                                        <td>{{ $detailPendaftaran[$loop->iteration - 1]->jamMulai }}</td>
                                        <td>{{ $detailPendaftaran[$loop->iteration - 1]->jamSelesai }}</td>
                                        <td>{{ $item->ruangan }}</td>
                                        <td>
                                            @if ($item->status == 'Hasil sudah siap')
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#thankYouModal" data-index="{{ $loop->index }}">
                                                    Hasil sudah siap
                                                </button>
                                            @else
                                                {{ $item->status }}
                                            @endif
                                        </td>





                                        {{--
                                <td>@if (isset($detailHasil[$loop->iteration - 1]->laporan))
                                    {{ $detailHasil[$loop->iteration-1]->laporan }}
                                @endif</td> --}}
                                        {{-- <td>{{ $item->status }}</td> --}}
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var thankYouModal = document.getElementById('thankYouModal');
            thankYouModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var index = button.getAttribute('data-index'); // Extract info from data-* attributes
                var laporan = @json($detailHasil); // Pass the detailHasil array to JavaScript

                // Update the modal's content.
                var modalBody = thankYouModal.querySelector('.modal-body');
                modalBody.textContent = laporan[index].laporan;
            });
        });
    </script>

@endsection
