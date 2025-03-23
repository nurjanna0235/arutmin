@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Fuel Allowance</li>
            </ol>
        </nav>

        <!-- Form untuk pencarian -->
        <div class="mb-4">
            <form method="GET" action="{{ url('/user/rate-contract/asteng/fuel') }}" class="d-flex align-items-center gap-3">
               <!-- Input Pencarian Tahun -->
             <div class="form-group row">
                    <div class="col-md-6">
                        <label for="start_year" style="font-size: 15px;">Tahun Awal:</label>
                        <input type="number" name="start_year" class="form-control" id="start_year"
                            value="{{ request('start_year') }}" min="2000" max="2900">
                    </div>
                    <div class="col-md-6">
                        <label for="end_year" style="font-size: 15px;">Tahun Akhir:</label>
                        <input type="number" name="end_year" class="form-control" id="end_year"
                            value="{{ request('end_year') }}" min="2000" max="2900">
                    </div>
                </div>
                <!-- Input Filter Item -->
                <div class="form-group">
                    <select name="item" class="form-select" id="item"
                        aria-label="Floating label select example">
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
                        <option data-activity="Mud Pre-mining"
                            value="Overhaul distance Mud Premining (liter/BCM/KM)">Overhaul distance Mud
                            Premining (liter/BCM/KM)</option>
                        <option data-activity="Mud Pre-mining"
                            value="Underhaul distance Mud Premining (liter/BCM/KM)">Underhaul distance Mud
                            Premining (liter/BCM/KM)</option>

                        <option data-activity="Land Clearing" value="Land Clearing (liter/Ha)">Land Clearing
                            (liter/Ha)</option>
                    </select>
                </div>

                <!-- Tombol Submit untuk Search -->
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

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
                    <th><small>Name Contract</small></th>
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
                    <td>{{ $item->name_contract }}</td>
                    <td>
                        <!-- Menggunakan d-flex untuk mengatur ikon menjadi horizontal -->
                        <div class="d-flex gap-2 justify-content-center">
                            <!-- Tombol Detail -->
                            <a href="{{ url('/user/rate-contract/asteng/fuel/detail/' . $item->id) }}">
                                <i class="ri-information-line text-primary" title="Detail"></i>
                            </a>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- End Table with stripped rows -->

    </div><!-- End Page Title -->
    <div class="icon mb-3">
        <a type="submit" href="/user/rate-contract/asteng" class="btn btn-secondary">Kembali</a>
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