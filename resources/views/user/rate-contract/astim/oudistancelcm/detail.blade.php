

@extends('componen.template-user')

@section('conten')
<!DOCTYPE html>
<html lang="en">

<body>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Rate Contract</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Laz Coal Mandiri</li>
                    <li class="breadcrumb-item active">Astim</li>
                    <li class="breadcrumb-item active">Over/Under Distance</li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div>
                    <div >
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
                                        @foreach ($dokument as $index => $item)
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
                        <div class="card-body text-center">
                            <h5 class="card-title">Contract Reference</h5>
                            <a href="{{ asset('storage/' . $rate_contract->contract_refren) }}"
                                target="_blank">
                                <img src="{{ asset('storage/' . $rate_contract->contract_refren) }}"
                                    alt="Contract Reference" class="img-fluid large-image">
                            </a>
                        </div>
                        <div class="text-center mb-3">
                            <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script src="/template-admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/template-admin/assets/js/main.js"></script>
</body>

</html>
@endsection
