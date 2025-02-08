@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                <li class="breadcrumb-item active">Astim</li>
                <li class="breadcrumb-item active">OB</li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                   <!-- Vertical Form -->
                   <form action="/rate-contract/astim/ob-lcm/update/{{ $dokumenob_lcm->id }}" method="POST"
                        class="row g-3" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
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
                                    <td>
                                        <div class="col-12">
                                            <input name="load_and_haul_lcm_base_rate_lebih_dari" type="number" class="form-control" 
                                                   value="{{ old('load_and_haul_lcm_base_rate_lebih_dari', $dokumenob_lcm->load_and_haul_lcm_base_rate_lebih_dari) }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="load_and_haul_lcm_base_rate_kurang_dari" type="number" class="form-control"
                                            value="{{ old('load_and_haul_lcm_base_rate_kurang_dari', $dokumenob_lcm->load_and_haul_lcm_base_rate_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Pit Support (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_support_lebih_dari" type="text" class="form-control"
                                            value="{{ old('pit_support_lebih_dari', $dokumenob_lcm->pit_support_lebih_dari) }}" >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_support_kurang_dari" type="text" class="form-control"
                                            value="{{ old('pit_support_kurang_dari', $dokumenob_lcm->pit_support_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Pit Lighting (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_lighting_lebih_dari" type="text" class="form-control"
                                            value="{{ old('pit_lighting_lebih_dari', $dokumenob_lcm->pit_lighting_lebih_dari) }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_lighting_kurang_dari" type="text" class="form-control"
                                            value="{{ old('pit_lighting_kurang_dari', $dokumenob_lcm->pit_lighting_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Haul Road Maintenance (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="haul_road_maintenance_lebih_dari" type="text" class="form-control"
                                            value="{{ old('haul_road_maintenance_lebih_dari', $dokumenob_lcm->haul_road_maintenance_lebih_dari) }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="haul_road_maintenance_kurang_dari" type="text" class="form-control"
                                            value="{{ old('haul_road_maintenance_kurang_dari', $dokumenob_lcm->haul_road_maintenance_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Dewatering/Sediment Pit Active (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="dewatering_sediment_pit_active_lebih_dari" type="text" class="form-control"
                                            value="{{ old('dewatering_sediment_pit_active_lebih_dari', $dokumenob_lcm->dewatering_sediment_pit_active_lebih_dari) }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="dewatering_sediment_pit_active_kurang_dari" type="text" class="form-control"
                                            value="{{ old('dewatering_sediment_pit_active_kurang_dari', $dokumenob_lcm->dewatering_sediment_pit_active_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Water Treatment (liming) (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="water_treatment_lebih_dari" type="text" class="form-control"
                                            value="{{ old('water_treatment_lebih_dari', $dokumenob_lcm->water_treatment_lebih_dari) }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="water_treatment_kurang_dari" type="text" class="form-control"
                                            value="{{ old('water_treatment_kurang_dari', $dokumenob_lcm->water_treatment_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Total Rate OB Actual (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="total_rate_ob_actual_lebih_dari" type="number" class="form-control"
                                            value="{{ old('total_rate_ob_actual_lebih_dari', $dokumenob_lcm->total_rate_ob_actual_lebih_dari) }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="total_rate_ob_actual_kurang_dari" type="number" class="form-control"
                                            value="{{ old('total_rate_ob_actual_kurang_dari', $dokumenob_lcm->total_rate_ob_actual_kurang_dari) }}">
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        
                                <div class="col-12">
                                    <label for="contract_reference" class="form-label">Contract Reference</label>
                                    @if($dokumenob_lcm->contract_reference)
                                        <div class="mb-2">
                                            <a href="{{ asset('storage/' . $dokumenob_lcm->contract_reference) }}"
                                                target="_blank">
                                                <img src="{{ asset('storage/' . $dokumenob_lcm->contract_reference) }}"
                                                    alt="Image" style="max-width: 200px;">
                                            </a>
                                        </div>

                                    @endif
                                    <input type="file" name="contract_reference" class="form-control"
                                        id="contract_reference">
                                    <small class="text-muted">Upload file baru jika ingin mengganti gambar yang
                                        ada</small>
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Batal</a>
                                </div>
                    </form><!-- Vertical Form -->




                </div>
            </div>
        </div>
        </div>
        </div>
        </div><!-- End Card with an image on left -->

        </div><!-- End sidebar recent posts-->
        </div>
        </div><!-- End News & Updates -->
        </div><!-- End Right side columns -->
        </div>
    </section>

</main><!-- End #main -->
@endsection
