@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Top Soil</li>
            </ol>
        </nav>

         <!-- Form untuk pencarian -->
    <div class="mb-4">
        <form method="GET" action="{{ url('/user/rate-contract/asteng/top-soil') }}" class="d-flex align-items-center gap-3">
            <!-- Input Pencarian Tahun -->
            <div class="form-group">
                <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun" value="{{ request('tahun') }}">
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
                        <th scope="col" style="width: 15%;;">Base Rate (Rp/Ha)</th>
                        <th scope="col" style="width: 10%;">Currency Adjustment</th>
                        <th scope="col" style="width: 10%;">Premium Rate</th>
                        <th scope="col" style="width: 10%;">General Escalation</th>
                        <th scope="col" style="width: 15%;">Rate Actual (Rp/Ha)</th>
                        <th scope="col" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $No = 1; ?>
                    @foreach($dokumentop_soil as $item)
                        <tr>
                            <td>{{ $No++ }}</td>
                            <td>{{ $item->bulan_tahun }}</td>
                            <td>{{ $item->base_rate }}</td>
                            <td>{{ $item->currency_adjustment }}</td>
                            <td>{{ $item->premium_rate }}</td>
                            <td>{{ $item->general_escalation }}</td>
                            <td class="text-danger fw-bold">{{ $item->rate_actual }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <!-- Tombol Detail -->
                                    <a href="{{ url('/user/rate-contract/asteng/top-soil/detail/' . $item->id) }}" >
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
        <div class="icon mb-5 d-flex justify-content-start gap-2">
            <a type="submit" href="/user/rate-contract/asteng" class="btn btn-secondary">Kembali</a>
        </div>
    </section>
</main>
<!-- End #main -->

@endsection