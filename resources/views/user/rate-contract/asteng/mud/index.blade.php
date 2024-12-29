@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Mud</li>
            </ol>
        </nav>

           <!-- Form untuk pencarian -->
           <div class="mb-4">
            <form method="GET" action="{{ url('/user/rate-contract/asteng/mud') }}" class="d-flex align-items-center gap-3">
                <!-- Input Pencarian Tahun -->
                <div class="form-group">
                    <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun" value="{{ request('tahun') }}">
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
                            <td class="text-center">{{ $item->premium_rate }}</td>
                            <td class="text-center">{{ $item->general_escalation }}</td>
                            <td class="text-danger fw-bold">{{ $item->rate_actual }}</td>
                            <td> <!-- Menggunakan d-flex untuk mengatur elemen menjadi horizontal -->
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- Tombol Detail -->
                                    <a href="{{ url('/user/rate-contract/asteng/mud/detail/' . $item->id) }}" >
                                        <i class="ri-information-line" title="Detail"></i>
                                    </a>

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
 <a type="submit" href="/user/rate-contract/asteng" class="btn btn-secondary">Kembali</a>   
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
