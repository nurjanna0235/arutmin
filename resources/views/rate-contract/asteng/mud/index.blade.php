@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
            <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Mud</li>
            </ol>
        </nav>
        @include('componen.alert')
        <div class="icon mb-3">
            <a href="/rate-contract/asteng/mud/tambah" type="button" class="btn btn-success"><i></i>Tambah</a>
        </div>

           <!-- Form untuk pencarian -->
           <div class="mb-4">
            <form method="GET" action="{{ url('/rate-contract/asteng/mud') }}" class="d-flex align-items-center gap-3">
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
                        <th scope="col" style="width: 20%;">Mud Removal - Load and Haul (Rp/BCM)</th>
                        <th scope="col" style="width: 15%;">Currency Adjustment</th>
                        <th scope="col" style="width: 15%;">Premium Rate</th>
                        <th scope="col" style="width: 15%;">General Escalation</th>
                        <th scope="col" style="width: 15%;">Rate Actual (Rp/Ha)</th>
                        <th scope="col" style="width: 15%;">Name Contract</th>
                        <th scope="col" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $No = 1; ?>
                    @foreach($dokumenmud as $item)
                        <tr>
                            <td class="text-center">{{ $No++ }}</td>
                            <td>{{ $item->bulan_tahun }}</td>
                            <td class="text-center">{{ $item->mud_removal_load_and_haul }}</td>
                            <td class="text-center">{{ $item->currency_adjustment }}</td>
                            <td class="text-center">{{ $item->premium_rate }}%</td>
                            <td class="text-center">{{ $item->general_escalation }}%</td>
                            <td class="text-danger fw-bold">{{ $item->rate_actual }}</td>
                            <td class="text-center">{{ $item->name_contract }}</td>
                            <td> <!-- Menggunakan d-flex untuk mengatur elemen menjadi horizontal -->
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- Tombol Detail -->
                                    <a href="{{ url('rate-contract/asteng/mud/detail/' . $item->id) }}" >
                                        <i class="ri-information-line" title="Detail"></i>
                                    </a>

                                    <!-- Tombol Edit -->
                                    <a href="{{ url('rate-contract/asteng/mud/edit/' . $item->id) }}" >
                                        <i class="ri-edit-2-line text-warning" title="Edit"></i>
                                    </a>

                                   <!-- Tombol Hapus -->
                                   <form action="{{ url('/rate-contract/asteng/mud/delete/' . $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background: none;" >
                                            <i class="ri-delete-bin-line text-danger" title="Hapus"></i>
                                        </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Content here -->
        </div>
    </section>

    <div class="icon mb-3">
 <a type="submit" href="/rate-contract/asteng" class="btn btn-secondary">Kembali</a>
    </div>
</main>
<!-- End #main -->

@endsection

<style>
    /* Make sure every table cell (td and th) has borders */
    .table-container .table td,
    .table-container .table th {
        text-align: center; /* Center text horizontally */
        vertical-align: middle; /* Center text vertically */
        border: 1px solid #ddd; /* Clear borders for all cells */
    }

    /* Optional: Remove the last right border */
    .table-container .table th:last-child,
    .table-container .table td:last-child {
        border-right: 1px solid #ddd; /* Ensure the last column also has the border */
    }

    /* Optional: Add a small shadow effect to improve table separation */
    .table-container .table {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Optional for a subtle shadow */
    }
</style>
