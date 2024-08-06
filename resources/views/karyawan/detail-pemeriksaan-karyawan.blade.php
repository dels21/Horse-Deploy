@extends('layouts.app')
@section('title', 'Detail List Pemeriksaan Karyawan')
@section('setAktifListDetailPemeriksaanKaryawan', 'active')

@section('customCSS')

    <!-- Custom styles for this template -->
    <link href="/templating-assets/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="/templating-assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')
<div class="container">
    <h1 class="biggest-font mt-5 mb-5">List Detail Pemeriksaan Karyawan</h1>
    @if ($detail->isEmpty() || $detailPendaftaran->isEmpty())
    <p>Belum ada detail pemeriksaan.</p>
    @else
        <p>Nomor pemeriksaan : {{ $detail[0]->nomorPemeriksaan  }}</p>
        <div class="card shadow mb-4">
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pemeriksaan</th>
                            <th>Jenis Pemeriksaan</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Ruangan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detail as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detailPendaftaran[$loop->iteration-1]->tanggalPendaftaranPemeriksaan }}</td>
                                <td>{{ $detailPendaftaran[$loop->iteration-1]->namaJenisPemeriksaan }}</td>
                                <td>{{ $detailPendaftaran[$loop->iteration-1]->jamMulai }}</td>
                                <td>{{ $detailPendaftaran[$loop->iteration-1]->jamSelesai }}</td>
                                <td>{{ $item->ruangan }}</td>
                                <td>
                                    <form action="{{ route('update_status') }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="idDPP" value="{{ $item->idDetailPemeriksaan }}">
                                        <div class="form-group">
                                            <select name="status" class="form-select" style="width: fit-content" onchange="this.form.submit()">
                                                <option value="Dalam antrian" {{ $item->status == 'Dalam antrian' ? 'selected' : '' }}>Dalam antrian</option>
                                                <option value="Ruang Tunggu" {{ $item->status == 'Ruang Tunggu' ? 'selected' : '' }}>Ruang Tunggu</option>
                                                <option value="Pemeriksaan" {{ $item->status == 'Pemeriksaan' ? 'selected' : '' }}>Pemeriksaan</option>
                                                <option value="Menunggu Hasil" {{ $item->status == 'Menunggu Hasil' ? 'selected' : '' }}>Menunggu Hasil</option>
                                                <option value="Hasil sudah siap" {{ $item->status == 'Hasil sudah siap' ? 'selected' : '' }}>Hasil sudah siap</option>
                                            </select>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $detail->links() }}
        </div>

        <div class="container-fluid p-5">

            <!-- Form to edit the record -->
            <form action="{{ route('update_diagnosis_keterangan') }}" method="POST">
                @csrf
                @method('POST')

                <input type="hidden" name="idPemeriksaan" value="{{ $detail[0]->nomorPemeriksaan }}">
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis:</label>
                    <textarea id="diagnosis" name="diagnosis" class="form-control" rows="4">{{ old('diagnosis', $diagnosis) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan:</label>
                    <textarea id="keterangan" name="keterangan" class="form-control" rows="4">{{ old('keterangan', $keterangan) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        @endif

</div>
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
