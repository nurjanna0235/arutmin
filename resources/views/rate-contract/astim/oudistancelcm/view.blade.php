@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                <li class="breadcrumb-item active">Astim</li>
                <li class="breadcrumb-item active">Over/Under Distance</li>
            </ol>
        </nav>

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <!-- Vertical Form -->
                    <form action="/rate-contract/astim/oudistance-lcm/simpan" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="text-center">
                            <div class="container">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>

                                            <th>Activity</th>
                                            <th>Item</th>
                                            <th>Base Rate High</th>
                                            <th>Base Rate Low</th>
                                            <th>Contractual Distance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($dokumen as $index => $item)
                                        <tr>
                                            <th>{{$item->activity}}</th>
                                            <th>{{$item->item}}</th>
                                            <th>{{$item->base_rate_high}}</th>
                                            <th>{{$item->base_rate_low}}</th>
                                            <th>{{$item->contractual_distance}}</th>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-start">

                                <a href="/rate-contract/astim/oudistance-lcm" class="btn btn-secondary">Kembali</a>
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
