@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Other</li>
            </ol>
        </nav>

         <!-- Form untuk pencarian -->
    <div class="mb-4">
        <form method="GET" action="{{ url('/user/rate-contract/asteng/other') }}" class="d-flex align-items-center gap-3">
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
    </div><!-- Form untuk pencarian -->
    
        <!-- Table with stripped rows -->
        <div class="table-container" style="width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" style="width: 5%;">No</th>
                        <th scope="col" style="width: 15%;">Bulan/Tahun</th>
                        <th scope="col" style="width: 15%;">Base Rate HRM LCM (Rp/ton/KM)</th>
                        <th scope="col" style="width: 10%;">Currency Adjustment</th>
                        <th scope="col" style="width: 10%;">Premium Rate</th>
                        <th scope="col" style="width: 10%;">General Escalation</th>
                        <th scope="col" style="width: 15%;">Rate Actual HRM LCM (Rp/ton/KM)</th>
                        <th scope="col" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $No = 1; ?>
                    @foreach($dokumenother as $item)
                        <tr>
                            <td>{{ $No++ }}</td>
                            <td>{{ $item->bulan_tahun }}</td>
                            <td>{{ $item->base_rate_hrm_lcm }}</td>
                            <td>{{ $item->currency_adjustment }}</td>
                            <td>{{ $item->premium_rate }}</td>
                            <td>{{ $item->general_escalation }}</td>
                            <!-- Tambahkan kelas Bootstrap untuk Rate Actual -->
                            <td class="text-danger fw-bold">{{ $item->rate_actual_hrm_lcm }}</td>
                            <td>
                                <!-- Menggunakan d-flex untuk mengatur elemen menjadi horizontal -->
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- Tombol Detail -->
                                    <a href="{{ url('/user/rate-contract/asteng/other/detail/' . $item->id) }}" >
                                        <i class="ri-information-line" title="Detail"></i>
                                    </a>

                                </div>
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
        <!-- Tombol Kembali -->
        <div class="icon mb-5">
            <a type="submit" href="/user/rate-contract/asteng" class="btn btn-secondary">Kembali</a>
        </div>
    </section>

</main>
<!-- End #main -->

@endsection
