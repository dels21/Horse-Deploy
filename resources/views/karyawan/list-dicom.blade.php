@extends('layouts.app')
@section('title', 'Manage DICOM')
@section('setAktifListDICOM', 'active')

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
        <h1 class="biggest-font mt-5 mb-5">DICOM</h1>
        <!-- DataTales Example -->
        <div class="col d-flex" style="margin-top: 1.5rem; margin-bottom: 2.5rem">
            <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center"
                style="width: 7.5rem;" data-toggle="modal" data-target="#myModal" id="addDicomBtn">
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
                        <h1 class="h1-title-600 w-100 text-center" id="modalTitle">Tambah DICOM</h1>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('store_dicom') }}" id="dicomForm">
                            @csrf
                            <input type="hidden" name="idLayananDicom" id="inputIdLayananDicom" value="">
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputAlamatIP" class="col-sm-4 col-form-label">Alamat IP:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputAlamatIP"
                                            placeholder="Masukan Alamat IP" name="alamatIp">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputNetmask" class="col-sm-4 col-form-label">Netmask:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputNetmask"
                                            placeholder="Masukan Netmask" name="netMask">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputLayananDICOM" class="col-sm-4 col-form-label">Layanan DICOM:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="inputLayananDICOM" name="layananDicom">
                                            <option>MWL</option>
                                            <option>MPPS</option>
                                            <option>Query</option>
                                            <option>Send</option>
                                            <option>Print</option>
                                            <option>Store</option>
                                            <option>Retrieve</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputPeran" class="col-sm-4 col-form-label">Peran:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="inputPeran" name="peran">
                                            <option>SCU</option>
                                            <option>SCP</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputAET" class="col-sm-4 col-form-label">AET</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputAET" placeholder="Masukan AET" name="aet">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputPort" class="col-sm-4 col-form-label">Port:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputPort"
                                            placeholder="Masukan Port" name="port">
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
                                <th>Alamat IP</th>
                                <th>Netmask</th>
                                <th>Layanan DICOM</th>
                                <th>Peran</th>
                                <th>AET</th>
                                <th>Port</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($showDicom as $sd)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $sd->alamatIp }}</td>
                                <td>{{ $sd->netMask }}</td>
                                <td>{{ $sd->layananDicom }}</td>
                                <td>{{ $sd->peran }}</td>
                                <td>{{ $sd->aet }}</td>
                                <td>{{ $sd->port }}</td>
                                <td style="display:flex; flex-direction:row;gap:25px;">
                                    <i class="bi bi-pencil-square edit-btn"
                                        data-toggle="modal"
                                        data-target="#myModal"
                                        data-id="{{ $sd->idLayananDicom }}"
                                        data-alamatip="{{ $sd->alamatIp }}"
                                        data-netmask="{{ $sd->netMask }}"
                                        data-layanandicom="{{ $sd->layananDicom }}"
                                        data-peran="{{ $sd->peran }}"
                                        data-aet="{{ $sd->aet }}"
                                        data-port="{{ $sd->port }}"
                                    ></i>

                                    <form id="delete-form-{{$loop->index}}" action="delete-dicom/{{ $sd->idLayananDicom }}" method="POST">
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
                var id = $(this).data('id');
                var alamatip = $(this).data('alamatip');
                var netmask = $(this).data('netmask');
                var layanandicom = $(this).data('layanandicom');
                var peran = $(this).data('peran');
                var aet = $(this).data('aet');
                var port = $(this).data('port');
                console.log("alamat ip ", alamatip);

                $('#modalTitle').text('Edit DICOM');
                $('#dicomForm').attr('action', '{{ route('update_dicom') }}');
                $('#inputIdLayananDicom').val(id);
                $('#inputAlamatIP').val(alamatip);
                $('#inputNetmask').val(netmask);
                $('#inputLayananDICOM').val(layanandicom);
                $('#inputPeran').val(peran);
                $('#inputAET').val(aet);
                $('#inputPort').val(port);

            });

            $('#addDicomBtn').on('click', function() {
                $('#modalTitle').text('Tambah DICOM');
                $('#dicomForm').attr('action', '{{ route('store_dicom') }}');  // Endpoint untuk store
                $('#dicomForm').trigger('reset');
                $('#inputIdLayananDicom').val('');
            });
        });
    </script>

@endsection
