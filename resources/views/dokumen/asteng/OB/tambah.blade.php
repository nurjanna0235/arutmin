@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Admin</a></li>
                <li class="breadcrumb-item active">OB</li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Vertical Form -->
                    <form action="/dokumen/asteng/ob/simpan" method="POST" class="row g-3">
                        @csrf
                        <div class="col-12">
                            <label for="load_and_haul" class="form-label">Load and Haul (Rp/BCM)</label>
                            <input name="load_and_haul" type="text" class="form-control" id="load_and_haul"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>

                        <div class="col-12">
                            <label for="drill_and_blast" class="form-label">Drill and Blast (if
                                required)(Rp/BCM)</label>
                            <input name="drill_and_blast" type="text" class="form-control" id="drill_and_blast"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>

                        <div class="col-12">
                            <label for="pit_support" class="form-label">Pit Support (Rp/BCM)</label>
                            <input name="pit_support" type="text" class="form-control" id="pit_support"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>

                        <div class="col-12">
                            <label for="pit_lighting" class="form-label">Pit Lighting (Rp/BCM)</label>
                            <input name="pit_lighting" type="text" class="form-control" id="pit_lighting"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>

                        <div class="col-12">
                            <label for="hrm" class="form-label">HRM</label>
                            <input name="hrm" type="text" class="form-control" id="hrm"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>

                        <div class="col-12">
                            <label for="dump_maintenance" class="form-label">Dump Maintenance (Rp/BCM)</label>
                            <input name="dump_maintenance" type="text" class="form-control" id="dump_maintenance"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>

                        <div class="col-12">
                            <label for="dewatering_sediment" class="form-label">Dewatering/Sediment (Rp/BCM)</label>
                            <input name="dewatering_sediment" type="text" class="form-control" id="dewatering_sediment"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>

                        <div class="col-12">
                            <label for="sr" class="form-label">SR</label>
                            <input name="sr" type="text" class="form-control" id="sr"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>
                       
                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input name="currency_adjustment" type="text" class="form-control" id="currency_adjustment"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>
                     
                        <div class="col-12">
                            <label for="currency_adjustment" class="form-label">Currency Adjustment</label>
                            <input name="currency_adjustment" type="text" class="form-control" id="currency_adjustment"
                                placeholder="Masukkan nilai, contoh: 22.222.222" required>
                        </div>

                        <div class="col-12">
                            <label for="premium_rate" class="form-label">Premium Rate</label>
                            <input name="premium_rate" type="text" class="form-control" id="premium_rate" placeholder="Masukkan nilai desimal, contoh: 1.10" required>
                        </div>
                        
                        <div class="col-12">
                            <label for="general_escalation" class="form-label">General Escalation</label>
                            <input name="general_escalation" type="text" class="form-control" id="general_escalation" placeholder="Masukkan nilai desimal, contoh: 1.05" required>
                        </div>

                        <div class="col-12">
                            <label for="contract_reference" class="form-label">Contract Reference</label>
                            <input name="contract_reference" type="text" class="form-control" id="contract_reference" placeholder="Masukkan referensi kontrak" required>
                        </div>
                                </select>

                            </div>

                        </div>
                        <div class="col-12 mt-3">
                            <button type="sumbit" class="btn btn-primary">Simpan</button>
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
