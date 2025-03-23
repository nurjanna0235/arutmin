@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Over Under Distance</li>
            </ol>
        </nav>
        @include('componen.alert')
        <div class="icon mb-3">
            <a href="/rate-contract/asteng/oudistance/tambah" type="button" class="btn btn-success"><i></i>Tambah</a>
        </div>

        <!-- Form untuk pencarian -->
        <div class="mb-4">
            <form method="GET" action="{{ url('/rate-contract/asteng/oudistance') }}"
                class="d-flex align-items-center gap-3">
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
                    <select name="item" class="form-select" id="item" aria-label="Floating label select example">
                        <option value="" selected>Pilih Item</option>
                        <option data-activity="OB" value="OB Overhaul Distance (Rp/BCM/KM)">OB Overhaul Distance
                            (Rp/BCM/KM)</option>
                        <option data-activity="OB" value="OB Underhaul Distance (Rp/BCM/KM)">OB Underhaul
                            Distance (Rp/BCM/KM)</option>
                        <option data-activity="Top Soil" value="Top Soil Overhaul Distance (Rp/BCM/KM)">Top Soil
                            Overhaul Distance (Rp/BCM/KM)</option>
                        <option data-activity="Top Soil" value="Top Soil Underhaul Distance (Rp/BCM/KM)">Top
                            Soil Underhaul Distance (Rp/BCM/KM)</option>
                        <option data-activity="Coal" value="Coal Overhaul Distance (Rp/ton/KM)">Coal Overhaul
                            Distance (Rp/ton/KM)</option>
                        <option data-activity="Coal" value="Coal Underhaul Distance (Rp/ton/KM)">Coal Underhaul
                            Distance (Rp/ton/KM)</option>
                        <option data-activity="Mud Removal" value="Overhaul Mud Removal (Rp/BCM/KM)">Overhaul
                            Mud Removal (Rp/BCM/KM)</option>
                        <option data-activity="Mud Removal" value="Underhaul Mud Removal (Rp/BCM/KM)">Underhaul
                            Mud Removal (Rp/BCM/KM)</option>
                    </select>
                </div>
                <!-- Tombol Submit untuk Search -->
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div><!-- Form untuk pencarian -->

        <!-- Table with stripped rows -->
        <div class="table-container" style="width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" style="width: 5%;">No</th>
                        <th scope="col" style="width: 15%;">Bulan/Tahun</th>
                        <th scope="col" style="width: 15%;">Activity</th>
                        <th scope="col" style="width: 15%;">Item</th>
                        <th scope="col" style="width: 10%;">Base Rate</th>
                        <th scope="col" style="width: 10%;">Currency Adjustment</th>
                        <th scope="col" style="width: 10%;">Premium Rate</th>
                        <th scope="col" style="width: 10%;">General Escalation</th>
                        <th scope="col" style="width: 15%;">Contractual Distance (KM)</th>
                        <th scope="col" style="width: 10%;">Name Contract</th>
                        <th scope="col" style="width: 10%;">Actual Rate</th>
                        <th scope="col" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $No = 1; ?>
                    @foreach($dokumenoudistance as $item)
                    <tr>
                        <td>{{ $No++ }}</td>
                        <td>{{ $item->bulan_tahun }}</td>
                        <td>{{ $item->activity }}</td>
                        <td>{{ $item->item }}</td>
                        <td>{{ $item->base_rate }}</td>
                        <td>{{ $item->currency_adjustment }}</td>
                        <td>{{ $item->premium_rate }}</td>
                        <td>{{ $item->general_escalation }}%</td>
                        <td>{{ $item->contractual_distance_km }}%</td>
                        <td>{{ $item->name_contract }}</td>
                         <!-- Tambahkan kelas Bootstrap untuk Rate Actual -->
                         <td class="text-danger fw-bold">{{ $item->actual_rate }}</td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <!-- Detail Button -->
                                <a
                                    href="{{ url('rate-contract/asteng/oudistance/detail/' . $item->id) }}">
                                    <i class="ri-information-line" title="Detail"></i>
                                </a>

                                <!-- Edit Button -->
                                <a
                                    href="{{ url('rate-contract/asteng/oudistance/edit/' . $item->id) }}">
                                    <i class="ri-edit-2-line text-warning" title="Edit"></i>
                                </a>

                                <!-- Delete Button -->
                                <form
                                    action="{{ url('/rate-contract/asteng/oudistance/delete/'.$item->id) }}"
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
        <!-- End Table with stripped rows -->
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <div class="col-lg-5">
                <div class="row">
                    <!-- Content here -->
                </div>
            </div>
        </div>
    </section>

    <!-- Back Button -->
    <div class="icon mb-5">
        <a type="submit" href="/rate-contract/asteng" class="btn btn-secondary">Kembali</a>
    </div>

</main>
<!-- End #main -->

@endsection

<style>
    /* Ensure borders for table cells */
    .table-container .table td,
    .table-container .table th {
        text-align: center;
        vertical-align: middle;
        border: 1px solid #ddd;
    }

    /* Add padding and text center alignment */
    .table-container .table th,
    .table-container .table td {
        padding: 8px;
    }

    /* Ensure last column does not have extra right border */
    .table-container .table th:last-child,
    .table-container .table td:last-child {
        border-right: none;
    }

    /* Optional: Improve table spacing and usability */
    .table-container .table {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>
