

@extends('componen.template-admin')

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
                    <li class="breadcrumb-item active">OB</li>
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
                        <div class="text-start mb-3">
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
