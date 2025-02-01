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
                    <li class="breadcrumb-item active">Pit Clearing</li>
                    <li class="breadcrumb-item active">Detail</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Contract Reference</h5>
                            <a href="{{ asset('storage/' . $dokumenpit_clearing_lcm->contract_reference) }}"
                                target="_blank">
                                <img src="{{ asset('storage/' . $dokumenpit_clearing_lcm->contract_reference) }}"
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