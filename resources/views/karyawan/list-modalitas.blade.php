@extends('layouts.app')
@section('title', 'Manage Modalitas')
@section('setAktifListModalitas', 'active')

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
        <h1 class="biggest-font mt-5 mb-5">Modalitas</h1>
        <!-- DataTales Example -->
        <div class="col d-flex" style="margin-top: 1.5rem; margin-bottom: 2.5rem">
            <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center"
                style="width: 7.5rem;" data-toggle="modal" data-target="#myModal" id="addModalitasBtn">
                <i class="bi bi-plus-lg me-2"></i> Tambah
            </button>
            {{-- <button type="button" class="btn btn-danger mx-2 d-flex align-items-center justify-content-center"
                style="width: 7.5rem;">
                <i class="bi bi-trash3-fill me-2"></i> Hapus
            </button> --}}
        </div>

        <!-- Modal -->
        <div class="modal fade bd-example-modal-xl" id="myModal" tabindex="-1" role="dialog"
            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h1 class="h1-title-600 w-100 text-center" id="modalTitle">Tambah Modalitas</h1>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('store_modalitas') }}" id="modalitasForm">
                            @csrf
                            <input type="hidden" name="kodeModalitas" id="inputkodeModalitas" value="">
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputNamaModalitas" class="col-sm-4 col-form-label">Nama
                                        Modalitas:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputNamaModalitas"
                                            placeholder="Enter name" name="namaModalitas">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputJenisModalitas" class="col-sm-4 col-form-label">Jenis
                                        Modalitas:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="inputJenisModalitas" name="jenisModalitas">
                                            <option value="CT Scan">CT Scan</option>
                                            <option value="MRI">MRI</option>
                                            <option value="Fluoroskopi">Fluoroskopi</option>
                                            <option value="Angiografi">Angiografi</option>
                                            <option value="Mamografi">Mamografi</option>
                                            <option value="USG">USG</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputMerkModalitas" class="col-sm-4 col-form-label">Merk
                                        Modalitas:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputMerkModalitas"
                                            placeholder="Enter brand" name = "merekModalitas">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputKodeRuangan" class="col-sm-4 col-form-label">Kode Ruangan: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputKodeRuangan" name="kodeRuang" placeholder="Enter Kode Ruangan">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputTipeModalitas" class="col-sm-4 col-form-label">Tipe
                                        Modalitas:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputTipeModalitas"
                                            placeholder="Enter type" name = "tipeModalitas">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputSerialNumber" class="col-sm-4 col-form-label">Nomor Seri Modalitas</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputSerialNumber"
                                            placeholder="Enter serial number" name = "nomorSeriModalitas">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputAlamatIp" class="col-sm-4 col-form-label">Alamat IP:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="inputAlamatIp" name="alamatIp">
                                            @foreach ($joinAlamatIp as $list)
                                            <option value={{ $list->alamatIp }}>{{ $list->alamatIp }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center mt-4">
                                <div class="col-auto">
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Modalitas</th>
                                <th>Jenis Modalitas</th>
                                <th>Merek Modalitas</th>
                                <th>Nomor Seri Modalitas</th>
                                <th>Alamat IP</th>
                                <th>Kode Ruang</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($showModalitas as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->namaModalitas }}</td>
                                <td>{{ $item->jenisModalitas }}</td>
                                <td>{{ $item->merekModalitas }}</td>
                                <td>{{ $item->nomorSeriModalitas }}</td>
                                <td>{{ $item->alamatIp }}</td>
                                <td>{{ $item->kodeRuang }}</td>
                                <td style="display:flex; flex-direction:row;gap:25px;">
                                    <i class="bi bi-pencil-square edit-btn"
                                        data-toggle="modal"
                                        data-target="#myModal"
                                        data-kodemodalitas="{{ $item->kodeModalitas }}"
                                        data-namamodalitas="{{ $item->namaModalitas }}"
                                        data-jenismodalitas="{{ $item->jenisModalitas }}"
                                        data-merekmodalitas="{{ $item->merekModalitas }}"
                                        data-koderuang="{{ $item->kodeRuang }}"
                                        data-tipemodalitas="{{ $item->tipeModalitas }}"
                                        data-nomorserimodalitas="{{ $item->nomorSeriModalitas }}"
                                        data-alamatip="{{ $item->alamatIp }}"
                                    ></i>

                                    <form id="delete-form-{{$loop->index}}" action="delete-modalitas/{{ $item->kodeModalitas }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-{{$loop->index}}').submit(); }">
                                            <i class="bi bi-trash3-fill text-danger"></i>
                                        </a>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

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
        $(document).ready(function() {
            $('#dataTable').on('click', '.edit-btn', function() {
                var kodeModalitas = $(this).data('kodemodalitas');
                var namaModalitas = $(this).data('namamodalitas');
                var jenisModalitas = $(this).data('jenismodalitas');
                var merekModalitas = $(this).data('merekmodalitas');
                var kodeRuang = $(this).data('koderuang');
                var tipeModalitas = $(this).data('tipemodalitas');
                var nomorSeriModalitas = $(this).data('nomorserimodalitas');
                var alamatIp = $(this).data('alamatip');

                $('#modalTitle').text('Edit Modalitas');
                $('#modalitasForm').attr('action', '{{ route('update_modalitas') }}');  // Pastikan endpoint yang benar untuk update
                $('#inputkodeModalitas').val(kodeModalitas);
                $('#inputNamaModalitas').val(namaModalitas);
                $('#inputJenisModalitas').val(jenisModalitas);
                $('#inputMerkModalitas').val(merekModalitas);
                $('#inputKodeRuangan').val(kodeRuang);
                $('#inputTipeModalitas').val(tipeModalitas);
                $('#inputSerialNumber').val(nomorSeriModalitas);
                $('#inputAlamatIp').val(alamatIp);
            });

            $('#addModalitasBtn').on('click', function() {
                $('#modalTitle').text('Tambah Modalitas');
                $('#modalitasForm').attr('action', '{{ route('store_modalitas') }}');  // Endpoint untuk store
                $('#modalitasForm').trigger('reset');
                $('#inputkodeModalitas').val('');
            });
        });
    </script>

@endsection
