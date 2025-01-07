@extends('componen.template-admin')

@section('conten')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Detail Dokumen - ARUTMIN ASAM-ASAM</title>
    <link href="/template-admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/template-admin/assets/css/style.css" rel="stylesheet">
    <style>
        /* Kelas CSS untuk gambar besar */
        .large-image {
            max-width: 100%;
            /* Gambar akan mengikuti lebar kontainer */
            height: auto;
            /* Proporsi gambar tetap terjaga */
            border: 1px solid #ddd;
            /* Menambahkan border */
            border-radius: 5px;
            /* Membuat sudut gambar melengkung */
            display: block;
            margin: 0 auto;
            /* Memusatkan gambar */
        }
    </style>
</head>

<body>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Rate Contract</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">Darma Henwa</li>
                    <li class="breadcrumb-item active">Asteng</li>
                    <li class="breadcrumb-item active">Mud</li>
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
                            <a href="{{ asset('storage/' . $dokumenmud->contract_reference) }}" target="_blank">
                                <img src="{{ asset('storage/' . $dokumenmud->contract_reference) }}"
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