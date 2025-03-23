@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"> Laz Coal Mandiri</li>
                <li class="breadcrumb-item active">Astim</li>
                <li class="breadcrumb-item active">OB</li>
            </ol>
        </nav>

        @include('componen.alert')

      

        <!-- Form untuk pencarian -->
        <div class="mb-4">
            <form method="GET" action="{{ url('/user/rate-contract/astim/ob-lcm') }}"
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
                           <th scope="col" style="width: 10%;">Name Contract</th>
                        <th scope="col" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php $No = 1; ?>
                    @foreach($dokumenob_lcm as $item)
                        <tr>
                            <td>{{ $No++ }}</td>
                            <td>
                                <!-- Basic Modal -->
                                <a href="{{ url('user/rate-contract/astim/ob-lcm/view/' . $item->id) }}" type="button" class="btn"
                                    data-bs-target="#basicModal{{ $item->id }}">
                                    {{ $item->bulan_tahun }}</a>
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
                                                                <th>Load and Haul (Rp/BCM)</th>
                                                                <td>{{ $item->load_and_haul_lcm_base_rate_lebih_dari }}</td>
                                                                <td>{{ $item->load_and_haul_lcm_base_rate_kurang_dari }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Pit Support (Rp/BCM)</th>
                                                                <td>{{ $item->pit_support_lebih_dari }}</td>
                                                                <td>{{ $item->pit_support_kurang_dari }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Pit Lighting (Rp/BCM)</th>
                                                                <td>{{ $item->pit_lighting_lebih_dari }}</td>
                                                                <td>{{ $item->pit_lighting_kurang_dari }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Haul Road Maintenance (Rp/BCM)</th>
                                                                <td>{{ $item->haul_road_maintenance_lebih_dari }}</td>
                                                                <td>{{ $item->haul_road_maintenance_kurang_dari }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Dewatering/Sediment Pit Active (Rp/BCM)</th>
                                                                <td>{{ $item->dewatering_sediment_pit_active_lebih_dari }}</td>
                                                                <td>{{ $item->dewatering_sediment_pit_active_kurang_dari }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Water Treatment (liming) (Rp/BCM)</th>
                                                                <td>{{ $item->water_treatment_lebih_dari }}</td>
                                                                <td>{{ $item->water_treatment_kurang_dari }}
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <th>Total Rate OB Actual (Rp/BCM)</th>
                                                                <td>{{ $item->total_rate_ob_actual_lebih_dari }}</td>
                                                                <td>{{ $item->total_rate_ob_actual_kurang_dari }}
                                                                </td>
                                                            </tr>

                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            
                                                    <td>{{ $item->name_contract}}</td>
                                </div><!-- End Basic Modal-->
                            </td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <a
                                        href="{{ url('user/rate-contract/astim/ob-lcm/detail/' . $item->id) }}">
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
        <div class="row"></div>
        <div class="icon mb-5">
            <a type="submit" href="/user/rate-contract/astim" class="btn btn-secondary">Kembali</a>
        </div>
    </section>

</main>

@endsection
