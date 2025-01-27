@extends('componen.template-user')

@section('conten')
<!DOCTYPE html>
<html lang="en">

<body>
    <main id="main" class="main">
    <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Daywork</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">Contract Reference</h5>
                            <a href="{{ asset('storage/' . $dokumendaywork_asbar->contract_reference) }}"
                                target="_blank">
                                <img src="{{ asset('storage/' . $dokumendaywork_asbar->contract_reference) }}"
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
