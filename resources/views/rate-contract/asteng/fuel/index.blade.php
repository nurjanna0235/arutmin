@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Fuel Allowance</li>
            </ol>
        </nav>
        @include('componen.alert')
        <div class="icon mb-3">
            <a href="/rate-contract/asteng/fuel/tambah" type="button" class="btn btn-success"><i></i>Tambah</a>
        </div>

        <!-- Form untuk pencarian -->
        <div class="mb-4">
            <form method="GET" action="{{ url('/rate-contract/asteng/fuel') }}"
                class="d-flex align-items-center gap-3">
                <!-- Input Pencarian Tahun -->

                <div class="form-group">
                    <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun"
                        value="{{ request('tahun') }}">
                </div>
                <!-- Input Filter Item -->
                <div class="form-group">
                    <select name="item" class="form-select" id="item" aria-label="Floating label select example">
                        <option selected value="">Pilih Item</option>
                        <option data-activity="OB" value="Overburden @1.2 KM (liter/BCM)">Overburden @1.2 KM
                            (liter/BCM)</option>
                        <option data-activity="OB" value="Overhaul distance OB (liter/BCM/KM)">Overhaul distance
                            OB (liter/BCM/KM)</option>
                        <option data-activity="OB" value="Underhaul distance OB (liter/BCM/KM)">Underhaul
                            distance OB (liter/BCM/KM)</option>

                        <option data-activity="Coal" value="Coal Mine @1.234 KM (liter/ton)">Coal Mine @1.234 KM
                            (liter/ton)</option>
                        <option data-activity="Coal" value="Overhaul distance Coal Mine (liter/ton/KM)">Overhaul
                            distance Coal Mine (liter/ton/KM)</option>
                        <option data-activity="Coal" value="Underhaul distance Coal Mine (liter/ton/KM)">
                            Underhaul distance Coal Mine (liter/ton/KM)</option>

                        <option data-activity="Top Soil" value="Top Soil @1.2 KM (liter/BCM)">Top Soil @1.2 KM
                            (liter/BCM)</option>
                        <option data-activity="Top Soil" value="Overhaul distance Top Soil (liter/BCM/KM)">
                            Overhaul distance Top Soil (liter/BCM/KM)</option>
                        <option data-activity="Top Soil" value="Underhaul distance Top Soil (liter/BCM/KM)">
                            Underhaul distance Top Soil (liter/BCM/KM)</option>

                        <option data-activity="Mud Pre-mining" value="Mud Premining @1.2 KM (liter/BCM)">Mud
                            Premining @1.2 KM (liter/BCM)</option>
                        <option data-activity="Mud Pre-mining" value="Overhaul distance Mud Premining (liter/BCM/KM)">
                            Overhaul distance Mud
                            Premining (liter/BCM/KM)</option>
                        <option data-activity="Mud Pre-mining" value="Underhaul distance Mud Premining (liter/BCM/KM)">
                            Underhaul distance Mud
                            Premining (liter/BCM/KM)</option>

                        <option data-activity="Land Clearing" value="Land Clearing (liter/Ha)">Land Clearing
                            (liter/Ha)</option>
                    </select>
                </div>

                <!-- Tombol Submit untuk Search -->
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div><!-- Form untuk pencarian -->

        <!-- Table with stripped rows -->
        <table class="table datatable bordered-table">
            <thead class="table-primary">
                <tr>
                    <th><small>No</small></th>
                    <th><small>Bulan/Tahun</small></th>
                    <th><small>Activity</small></th>
                    <th><small>Item</small></th>
                    <th><small>Fuel Index</small></th>
                    <th><small>Contractual Distance (KM)</small></th>
                    <th><small>Aksi</small></th>
                </tr>
            </thead>
            <tbody>
                <?php $No = 1; ?>
                @foreach($dokumenfuel as $item)
                    <tr>
                        <td>{{ $No++ }}</td>
                        <td>{{ $item->bulan_tahun }}</td>
                        <td>{{ $item->activity }}</td>
                        <td>{{ $item->item }}</td>
                        <td>{{ $item->fuel_index }}</td>
                        <td>{{ $item->contractual_distance_km }}</td>
                        <td>
                            <!-- Menggunakan d-flex untuk mengatur ikon menjadi horizontal -->
                            <div class="d-flex gap-2 justify-content-center">
                                <!-- Tombol Detail -->
                                <a
                                    href="{{ url('rate-contract/asteng/fuel/detail/' . $item->id) }}">
                                    <i class="ri-information-line text-primary" title="Detail"></i>
                                </a>

                                <!-- Tombol Edit -->
                                <a
                                    href="{{ url('rate-contract/asteng/fuel/edit/' . $item->id) }}">
                                    <i class="ri-edit-2-line text-warning" title="Edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <form
                                    action="{{ url('/rate-contract/asteng/fuel/delete/' . $item->id) }}"
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
        <!-- End Table with stripped rows -->

    </div><!-- End Page Title -->
    <div class="icon mb-3">
        <a type="submit" href="/rate-contract/asteng" class="btn btn-secondary">Kembali</a>
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-5">
                <div class="row"></div>
            </div>
        </div>
    </section>

</main>
<!-- End #main -->

<style>
    /* Tambahkan garis vertikal */
    .bordered-table th,
    .bordered-table td {
        border-right: 1px solid #ddd;
    }

    .bordered-table th:last-child,
    .bordered-table td:last-child {
        border-right: none;
    }

    .bordered-table {
        border-collapse: collapse;
        width: 100%;
    }

    .bordered-table th,
    .bordered-table td {
        padding: 8px;
        text-align: center;
        vertical-align: middle;
    }

    .table-primary {
        background-color: #007bff;
        color: white;
    }

</style>

@endsection
