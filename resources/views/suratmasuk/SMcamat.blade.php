@extends('layouts.main')
@section('main')
    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>

        <div class="page-heading">
            <h3>Validasi Surat Masuk</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12">
                    <section class="section">
                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible show fade">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card">
                            <div class="card-header">
                                Surat Masuk
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No Surat</th>
                                            <th>Tanggal Surat</th>
                                            <th>Tanggal Diterima</th>
                                            <th>Instansi Pengirim</th>
                                            <th>Keterangan</th>
                                            <th>Detail Surat</th>
                                            <th>Tindakan</th>
                                            <th>File Surat</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sm as $s)
                                            <tr>
                                                <td>{{ $s->nosurat }}</td>
                                                <td>{{ \Carbon\Carbon::parse($s->tglsurat)->translatedFormat('l, d F Y') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($s->tglditerima)->translatedFormat('l, d F Y') }}
                                                </td>
                                                <td>{{ ucwords($s->instansi) }}</td>
                                                <td>
                                                    @if ($s->role == 1)
                                                        Sedang diproses Camat
                                                    @elseif ($s->role == 2)
                                                        Dalam Pengecekan Sekretaris Camat
                                                    @elseif ($s->role == 3)
                                                        Menunggu tindakan Operator
                                                    @elseif ($s->role == 4)
                                                        Surat Masuk tidak disetujui Camat
                                                    @elseif ($s->role == 5)
                                                        Surat Masuk diterima oleh
                                                        @if ($s->detailsm->count() > 1)
                                                            @foreach ($s->detailsm as $dsm)
                                                                {{ $dsm->user->jabatan }} |
                                                            @endforeach
                                                        @else
                                                            @foreach ($s->detailsm as $dsm)
                                                                {{ $dsm->user->jabatan }}
                                                            @endforeach
                                                        @endif
                                                    @endif
                                                </td>
                                                <td style="text-align: center;">
                                                    <button type="button" class="btn fs-3" style="border: none"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#detailsurat{{ $s->id }}">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </td>
                                                <!-- modal detail -->
                                                <div class="modal fade" id="detailsurat{{ $s->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg"
                                                        role="document">
                                                        <div class="modal-content" style="height: 610px">
                                                            <div class="modal-header bg-primary">
                                                                <h5 class="modal-title white"
                                                                    id="exampleModalScrollableTitle">
                                                                    Detail Surat Masuk</h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h5>INFORMASI UMUM</h5>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        No. Surat
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $s->nosurat }}
                                                                    </div>
                                                                    <div class="col-4">
                                                                        No. Registrasi
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $s->noregis }}
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Instansi Pengirim
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ ucwords($s->instansi) }}
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Judul atau Perihal Surat
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $s->perihal }}
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Tanggal Surat
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ \Carbon\Carbon::parse($s->tglsurat)->translatedFormat('l, d F Y') }}
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Tanggal Diterima
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ \Carbon\Carbon::parse($s->tglditerima)->translatedFormat('l, d F Y') }}
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Lampiran
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $s->lampiran }} Lampiran
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Status Surat
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $s->status }}
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Sifat Surat
                                                                    </div>
                                                                    <div class="col-8">
                                                                        {{ $s->sifat }}
                                                                    </div>

                                                                </div>
                                                                <h5 class="mt-5">INFORMASI TINDAKAN</h5>
                                                                <div class="row">
                                                                    <div class="col-4">
                                                                        Keterangan
                                                                    </div>
                                                                    <div class="col-8"
                                                                        style="font-style: oblique; font-weight: 700">
                                                                        @if ($s->validasi)
                                                                            @if ($s->validasi == 1)
                                                                                Disetujui oleh Camat
                                                                            @else
                                                                                Tidak disetujui oleh Camat
                                                                            @endif
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Tanggal Tindakan Camat
                                                                    </div>
                                                                    <div class="col-8">
                                                                        @if ($s->tglcamat)
                                                                            {{ \Carbon\Carbon::parse($s->tglcamat)->translatedFormat('l, d F Y') }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Catatan Camat
                                                                    </div>
                                                                    <div class="col-8">
                                                                        @if ($s->catcamat)
                                                                            {{ $s->catcamat }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Disposisi Kepada
                                                                    </div>
                                                                    <div class="col-8">
                                                                        @if ($s->validasi == 1)
                                                                            @foreach ($s->detailsm as $dsm)
                                                                                {{ $dsm->user->jabatan }} |
                                                                            @endforeach
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-4">
                                                                        Tanggal Disposisi
                                                                    </div>
                                                                    <div class="col-8">
                                                                        @if ($s->tgldisposisi)
                                                                            {{ \Carbon\Carbon::parse($s->tgldisposisi)->translatedFormat('l, d F Y') }}
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-light-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Tutup</span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <td style="text-align: center;">
                                                    <button type="button" class="btn btn-outline-primary"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#validasi{{ $s->id }}">
                                                        Validasi
                                                    </button>
                                                </td>
                                                <!-- modal validasi -->
                                                <div class="modal fade" id="validasi{{ $s->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalScrollableTitle"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
                                                        role="document">
                                                        <div class="modal-content" style="height: 530px;">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalScrollableTitle">
                                                                    Tindakan Surat Masuk
                                                                    <strong>{{ $s->nosurat }}</strong>
                                                                </h5>
                                                                <button type="button" class="close"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <i data-feather="x"></i>
                                                                </button>
                                                            </div>
                                                            <form action="/validasisuratmasukcamat" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="suratmasuk"
                                                                    value="{{ $s->id }}">
                                                                <div class="modal-body">
                                                                    <div class="d-flex align-items-ceter">
                                                                        <fieldset class="form-group" style="width: 100%">
                                                                            <select class="form-select tindakan"
                                                                                name="validasi" id="basicSelect" required>
                                                                                <option selected="selected"
                                                                                    disabled="disabled">--Pilih Tindakan--
                                                                                </option>
                                                                                <option value="1">Setuju</option>
                                                                                <option value="2">Tidak Setuju
                                                                                </option>
                                                                            </select>
                                                                        </fieldset>
                                                                    </div>

                                                                    <div class="form-group unit" style="display: none;">
                                                                        <label for="">Pilih Unit</label>
                                                                        <select class="select2" style="width: 100%"
                                                                            multiple="multiple" name="kasi[]" required>
                                                                            @foreach ($pegawai as $peg)
                                                                                <option value="{{ $peg->id }}">
                                                                                    {{ $peg->jabatan }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>


                                                                    <h5 class="mt-2">Catatan Camat</h5>
                                                                    <div class="form-group with-title mb-3">
                                                                        <textarea class="form-control" id="exampleFormControlTextarea1" name="catcamat" rows="3"></textarea>
                                                                        <label>Catatan</label>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Tutup</span>
                                                                    </button>
                                                                    <button type="submit" class="btn btn-primary ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Kirim</span>
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <td style="text-align: center;">
                                                    <a href="{{ asset('storage/' . $s->pdf) }}" target="_blank"><i
                                                            class="bi bi-file-earmark-medical fs-4"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </div>

        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2023 &copy; Sistem Aplikasi Administrasi Perkantoran</p>
                </div>
            </div>
        </footer>
    </div>
@endsection

@section('js')
    <script src="assets/vendors/choices.js/choices.min.js"></script>
    <script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="assets/vendors/jquery/jquery.min.js"></script>

    <!-- Masukkan jQuery (pastikan Anda memiliki jQuery) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Masukkan script Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

    <script>
        $(document).ready(function() {
            // Awalnya sembunyikan elemen dengan class "unit"
            $(".unit").hide();

            // Tangkap perubahan pada select "tindakan"
            $("#basicSelect").change(function() {
                // Periksa apakah "Setuju" dipilih
                if ($(this).val() == "1") {
                    // Jika "Setuju" dipilih, tampilkan elemen "unit"
                    $(".unit").show();
                } else {
                    // Jika "Tidak Setuju" atau opsi lain dipilih, sembunyikan elemen "unit"
                    $(".unit").hide();
                }
            });
        });
    </script>
@endsection
