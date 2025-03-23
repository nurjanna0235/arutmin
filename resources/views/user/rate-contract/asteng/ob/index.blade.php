@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">OB</li>
            </ol>
        </nav>

         <!-- Form untuk pencarian -->
         <div class="mb-4">
            <form method="GET" action="{{ url('/user/rate-contract/asteng/ob') }}" class="d-flex align-items-center gap-3">
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
                        <th class="text-center"><small>No</small></th>
                        <th class="text-center"><small>Bulan/Tahun</small></th>
                        <th class="text-center"><small>Load and Haul (Rp/BCM)</small></th>
                        <th class="text-center"><small>Drill and Blast (if required) (Rp/BCM)</small></th>
                        <th class="text-center"><small>Pit Support (Rp/BCM)</small></th>
                        <th class="text-center"><small>Pit Lighting (Rp/BCM)</small></th>
                        <th class="text-center"><small>HRM (Rp/BCM)</small></th>
                        <th class="text-center"><small>Dump Maintenance (Rp/BCM)</small></th>
                        <th class="text-center"><small>Dewatering/Sediment (Rp/BCM)</small></th>
                        <th class="text-center"><small>Sub Total Base Rate OB (Rp/BCM)</small></th>
                        <th class="text-center"><small>SR</small></th>
                        <th class="text-center"><small>Currency Adjustment</small></th>
                        <th class="text-center"><small>Premium Rate</small></th>
                        <th class="text-center"><small>General Escalation</small></th>
                        <th class="text-center"><small>Total Rate OB Actual (Rp/BCM)</small></th>
                        <th class="text-center"><small>Name Contract</small></th>
                        <th class="text-center"><small>Aksi</small></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $No = 1; ?>
                    @foreach($dokumenob as $item)
                        <tr>
                            <td class="text-center">{{ $No++ }}</td>
                            <td class="text-center"> {{ $item->bulan_tahun }}</td>
                            <td class="text-center">{{ $item->load_and_haul }}</td>
                            <td class="text-center">{{ $item->drill_and_blast }}</td>
                            <td class="text-center">{{ $item->pit_support }}</td>
                            <td class="text-center">{{ $item->pit_lighting }}</td>
                            <td class="text-center">{{ $item->hrm }}</td>
                            <td class="text-center">{{ $item->dump_maintenance }}</td>
                            <td class="text-center">{{ $item->dewatering_sediment }}</td>
                            <td class="text-danger fw-bold">{{ $item->sub_total_base_rate_ob }}</td>
                            <td class="text-center">{{ $item->sr }}</td>
                            <td class="text-center">{{ $item->currency_adjustment }}</td>
                            <td class="text-center">{{ $item->premium_rate }}</td>
                            <td class="text-center">{{ $item->general_escalation }}</td>
                            <td class="text-danger fw-bold">{{ $item->total_rate_ob_actual }}</td>
                            <td class="text-center">{{ $item->name_contract }}</td>
                            <td class="text-center">
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- Tombol Detail -->
                                    <a
                                        href="{{ url('/user/rate-contract/asteng/ob/detail/' . $item->id) }}">
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
    </section>

</main>
<!-- End #main -->

@endsection
