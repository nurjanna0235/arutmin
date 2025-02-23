@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> Laz Coal Mandiri</li>
                <li class="breadcrumb-item active">Astim</li>
                <li class="breadcrumb-item active">Pit Clearing</li>
            </ol>
        </nav>

        @include('componen.alert')

        <div class="icon mb-3">
            <a href="/rate-contract/astim/pit-clearing-lcm/tambah" type="button"
                class="btn btn-success"><i></i>Tambah</a>
        </div>

        <!-- Form untuk pencarian -->
        <div class="mb-4">
            <form method="GET" action="{{ url('/rate-contract/astim/pit-clearing-lcm') }}"
                class="d-flex align-items-center gap-3">
                <!-- Input Pencarian Tahun -->
                <div class="form-group">
                    <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun"
                        value="{{ request('tahun') }}">
                </div>
                <!-- Tombol Submit untuk Search -->
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <!-- Table with stripped rows -->
        <div class="table-container" style="width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" style="width: 5%;">No</th>
                        <th scope="col" style="width: 15%;">Bulan/Tahun</th>
                        <th scope="col" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $No = 1; ?>
                    @foreach($dokumenpit_clearing_lcm as $item)
                        <tr>
                            <td>{{ $No++ }}</td>
                            <td>
                                <!-- Basic Modal -->
                                <button type="button" class="btn" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $item->id }}">
                                    {{ $item->bulan_tahun }}
                                </button>
                                <div class="modal fade" id="basicModal{{ $item->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Rate Contract</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container mt-4">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th></th> <!-- Kosong untuk header kiri -->
                                                                <th>Base Rate (ICI 4 >= $60)</th>
                                                                <th>Base Rate (ICI 4 < $60)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <th>Rate Actual (Rp/Ha)</th>
                                                                <td>{{ $item->rate_actual_base_rate_lebih_dari }}</td>
                                                                <td>{{ $item->rate_actual_base_rate_kurang_dari }}
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Kembali</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Basic Modal-->
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a
                                        href="{{ url('rate-contract/astim/pit-clearing-lcm/detail/' . $item->id) }}">
                                        <i class="ri-information-line" title="Detail"></i>
                                    </a>
                                    <a
                                        href="{{ url('rate-contract/astim/pit-clearing-lcm/edit/' . $item->id) }}">
                                        <i class="ri-edit-2-line text-warning" title="Edit"></i>
                                    </a>
                                    <form
                                        action="{{ url('/rate-contract/astim/pit-clearing-lcm/delete/' . $item->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background: none;">
                                            <i class="ri-delete-bin-line text-danger" title="Hapus"></i>
                                        </button>
                                    </form>



                                </div>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row"></div>
        <div class="icon mb-5">
            <a type="submit" href="/rate-contract/astim" class="btn btn-secondary">Kembali</a>
        </div>
    </section>

</main>

@endsection
