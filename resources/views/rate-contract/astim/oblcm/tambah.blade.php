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
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Vertical Form -->
                    <form action="/rate-contract/astim/ob-lcm/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
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
                                            <input name="load_and_haul_lcm_base_rate_lebih_dari" type="number" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="load_and_haul_lcm_base_rate_kurang_dari" type="number" class="form-control">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Pit Support (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_support_lebih_dari" type="text" class="form-control" >
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_support_kurang_dari" type="text" class="form-control">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Pit Lighting (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_lighting_lebih_dari" type="text" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="pit_lighting_kurang_dari" type="text" class="form-control">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Haul Road Maintenance (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="haul_road_maintenance_lebih_dari" type="text" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="haul_road_maintenance_kurang_dari" type="text" class="form-control">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Dewatering/Sediment Pit Active (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="dewatering_sediment_pit_active_lebih_dari" type="text" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="dewatering_sediment_pit_active_kurang_dari" type="text" class="form-control">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Water Treatment (liming) (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="water_treatment_lebih_dari" type="text" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="water_treatment_kurang_dari" type="text" class="form-control">
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <th>Total Rate OB Actual (Rp/BCM)</th>
                                    <td>
                                        <div class="col-12">
                                            <input name="total_rate_ob_actual_lebih_dari" type="number" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col-12">
                                            <input name="total_rate_ob_actual_kurang_dari" type="number" class="form-control">
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                        <label for="bulan" class="form-label">Bulan</label>
                                <div class="input-group mb-3">
                                    <input type="date" class="form-control" name="bulan">
                                </div>

                                <div class="col-12">
                            <label for="name_contract" class="form-label">Name Contract</label>
                            <input name="name_contract" type="text" class="form-control" id="name_contract">
                        </div>

                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            <input name="contract_reference" type="file" class="form-control" id="contract_reference">
                        </div>

                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-start">
                                <button type="submit" class="btn btn-primary me-2">Simpan</button>
                                <a href="/rate-contract/astim/ob-lcm" class="btn btn-secondary">Batal</a>
                            </div>
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