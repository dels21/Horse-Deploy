@extends('layouts.app')
@section('title', 'Manage Dokter')
@section('setAktifListDokter', 'active')

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
        <h1 class="biggest-font mt-5 mb-5">Dokter</h1>

        <!-- DataTales Example -->
        <div class="col d-flex" style="margin-top: 1.5rem; margin-bottom: 2.5rem">
            <button type="button" class="btn btn-primary d-flex align-items-center justify-content-center"
                style="width: 7.5rem;" id="addDokterBtn" data-toggle="modal" data-target="#myModal">
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
                        <h1 class="h1-title-600 w-100 text-center" id="modalTitle">Tambah Dokter</h1>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="dokterForm">
                            @csrf
                            <input type="hidden" id="inputIdDokter" name="idDokter">
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputNama" class="col-sm-4 col-form-label">Nama:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputNama" name="name" placeholder="Masukkan Nama">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputEmail" class="col-sm-4 col-form-label">Email:</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Masukkan Email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Password:</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Masukkan Password">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputIdKTP" class="col-sm-4 col-form-label">ID KTP:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputIdKTP" name="idKtp" placeholder="Masukkan ID KTP">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputJenisKelamin" class="col-sm-4 col-form-label">Jenis Kelamin:</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="jenisKelamin" id="inputJenisKelamin">
                                            <option value="laki">Laki-Laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputTanggalLahir" class="col-sm-4 col-form-label">Tanggal Lahir:</label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="tanggalLahir" id="inputTanggalLahir">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-start">
                                    <label for="inputAlamat" class="col-sm-4 col-form-label">Alamat:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputAlamat" name="alamat" placeholder="Masukkan Alamat"></input>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputKota" class="col-sm-4 col-form-label">Kota:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputKota" name="kota" placeholder="Masukkan Kota">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputNomorHP" class="col-sm-4 col-form-label">Nomor HP:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputNomorHP" name="nomorHp" placeholder="Masukkan Nomor HP">
                                    </div>
                                </div>
                                <div class="form-group col-md-6 d-flex align-items-center">
                                    <label for="inputNomorTelpRumah" class="col-sm-4 col-form-label">Nomor Telp Rumah:</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="inputNomorTelpRumah" name='nomorTelpRumah' placeholder="Masukkan Nomor Telp Rumah">
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
                                <th>ID Staff</th>
                                <th>Nama</th>
                                <th>Telepon Rumah</th>
                                <th>Alamat</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <tr>
                                <td>1</td>
                                <td>UAC90</td>
                                <td>Jahja Setiaatmadja</td>
                                <td>08999999999</td>
                                <td>Menara BCA</td>
                                <td>Aktif</td>
                                <td><i class="bi bi-pencil-square"></i><i class="bi bi-trash3-fill text-danger"></i></td>
                            </tr> --}}

                            @foreach ($dokterFromUser as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->idDokter}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->nomorTelpRumah}}</td>
                                <td>{{$item->alamat}}</td>
                                <td>{{$item->status}}</td>
                                <td>
                                    <i class="bi bi-pencil-square edit-btn" data-toggle="modal" data-target="#myModal"
                                    data-id="{{$item->idDokter}}"
                                    data-name="{{$item->name}}"
                                    data-email="{{$item->email}}"
                                    data-idktp="{{$item->idKtp}}"
                                    data-jeniskelamin="{{$item->jenisKelamin}}"
                                    data-tanggallahir="{{$item->tanggalLahir}}"
                                    data-alamat="{{$item->alamat}}"
                                    data-kota="{{$item->kota}}"
                                    data-nomorhp="{{$item->nomorHp}}"
                                    data-nomortelprumah="{{$item->nomorTelpRumah}}"></i>
                                    <a href="#" onclick="event.preventDefault(); if (confirm('Are you sure you want to delete?')) { document.getElementById('delete-form-{{$loop->index}}').submit(); }">
                                        <i class="bi bi-trash3-fill text-danger"></i>
                                    </a>

                                    <form id="delete-form-{{$loop->index}}" action="{{ route('destroy_dokter_admin') }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="idUser" value="{{$item->id}}">
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
                var name = $(this).data('name');
                var email = $(this).data('email');
                var idKtp = $(this).data('idktp');
                var jenisKelamin = $(this).data('jeniskelamin');
                var tanggalLahir = $(this).data('tanggallahir');
                var alamat = $(this).data('alamat');
                var kota = $(this).data('kota');
                var nomorHp = $(this).data('nomorhp');
                var nomorTelpRumah = $(this).data('nomortelprumah');

                $('#modalTitle').text('Edit Dokter');
                $('#dokterForm').attr('action', '{{ route('update_dokter_admin') }}');
                $('#inputIdDokter').val(id);
                $('#inputNama').val(name);
                $('#inputEmail').val(email);
                $('#inputIdKTP').val(idKtp);
                $('#inputJenisKelamin').val(jenisKelamin);
                $('#inputTanggalLahir').val(tanggalLahir);
                $('#inputAlamat').val(alamat);
                $('#inputKota').val(kota);
                $('#inputNomorHP').val(nomorHp);
                $('#inputNomorTelpRumah').val(nomorTelpRumah);

                // Disable password field and change placeholder when editing
                $('#inputPassword').prop('disabled', true).attr('placeholder', 'Tidak dapat diedit');
            });

            $('#addDokterBtn').on('click', function() {
                $('#modalTitle').text('Tambah Dokter');
                $('#dokterForm').attr('action', '{{ route('store_dokter_admin') }}');
                $('#dokterForm').trigger('reset');
                $('#inputIdDokter').val('');

                // Enable password field and reset placeholder when adding
                $('#inputPassword').prop('disabled', false).attr('placeholder', 'Masukkan Password');
            });
        });
    </script>

@endsection
