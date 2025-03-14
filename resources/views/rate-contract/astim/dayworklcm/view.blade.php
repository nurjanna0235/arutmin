@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                <li class="breadcrumb-item active">Astim</li>
                <li class="breadcrumb-item active">Daywork</li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Vertical Form -->
                    <form action="/rate-contract/astim/daywork-lcm/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="text-center">
                            <div class="container">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>

                                            <th>Item</th>
                                            <th>Model</th>
                                            <th>Actual Rate Exc. Fuel (Rp/Hrs)</th>
                                            <th>FBR (liter/hrs)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dokumen as $index => $item)
                                        <tr>
                                            <th>{{$item->item}}</th>
                                            <th>{{$item->model}}</th>
                                            <th>{{$item->rate_per_hour}}</th>
                                            <th>{{$item->fuel_burn_rate}}</th>
                                        </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>



                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-start">

                                <a href="/rate-contract/astim/daywork-lcm" class="btn btn-secondary">Kembali</a>
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
