@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item avtive"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Fuel Allowance</li>
            </ol>
        </nav>
    </div>
    <div class="icon mb-3">
        <a href="/rate-contract/asbar/fuel-asbar/tambah" type="button" class="btn btn-success"><i></i>Tambah</a>
    </div>

    <!-- Form untuk pencarian -->
    <div class="mb-4">
        <form method="GET" action="{{ url('/rate-contract/asbar/fuel-asbar') }}" class="d-flex align-items-center gap-3">
            <!-- Input Pencarian Tahun -->
            <div class="form-group">
                <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun" value="{{ request('tahun') }}">
            </div>

            <!-- Input Filter Item -->
            <div class="form-group">
                <select name="item" class="form-select" id="item" aria-label="Floating label select example">
                    <option selected value="">Pilih Item</option>
                    <option value="Coal CPP - PLTU (liter/ton)">Coal CPP - PLTU (liter/ton)</option>
                    <option value="Over/under distance Coal CPP - PLTU (liter/ton/KM)">Over/under distance
                        Coal CPP - PLTU (liter/ton/KM)</option>
                    <option value="Distance Actual PLTU Unit 1-4 (KM)">Distance Actual PLTU Unit 1-4 (KM)
                    </option>
                    <option value="Distance Actual PLTU Unit 5-6 (KM)">Distance Actual PLTU Unit 5-6 (KM)
                    </option>
                    <option value="Contractual Distance (KM)">Contractual Distance (KM)</option>
                </select>
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
                    <th scope="col" style="width: 5%;"> No</th>
                    <th scope="col" style="width: 15%;"> Bulan/Tahun </th>
                    <th scope="col" style="width: 10%;"> Activity </th>
                    <th scope="col" style="width: 15%;"> Item </th>
                    <th scope="col" style="width: 15%;"> Fuel Index </th>
                    <th scope="col" style="width: 15%;"> Distance </th>
                    <th scope="col" style="width: 10%;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-danger fw-bold"></td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ url('rate-contract/asbar/fuel-asbar/detail/1') }}">
                                <i class="ri-information-line" title="Detail"></i>
                            </a>
                            <a href="{{ url('rate-contract/asbar/fuel-asbar/edit/1') }}">
                                <i class="ri-edit-2-line text-warning" title="Edit"></i>
                            </a>
                            <form action="{{ url('/rate-contract/asbar/fuel-asbar/delete/1') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border: none; background: none;">
                                    <i class="ri-delete-bin-line text-danger" title="Hapus"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row"></div>
        <div class="icon mb-5">
            <a type="submit" href="/rate-contract/asbar" class="btn btn-secondary">Kembali</a>
        </div>
    </section>

</main>

@endsection