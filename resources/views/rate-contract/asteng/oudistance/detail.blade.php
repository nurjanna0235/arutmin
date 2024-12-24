@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Rate Contract</h1> <!-- Mengubah judul halaman -->
        <nav>
        <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Over Under Distance</li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Contract Reference</h5> <!-- Mengubah judul untuk pit clearing -->
                        <a href="{{ asset('storage/' . $dokumenoudistance->contract_reference) }}"
                            target="_blank">
                            <img src="{{ asset('storage/' . $dokumenoudistance->contract_reference) }}"
                                alt="contract reference" class="img-fluid large-image">
                        </a>
                    </div>
                    <div class="text-center mb-3">
                        <a href="{{ url()->previous() }}" class="btn btn-primary w-100"
                            style="max-width: 200px;">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script src="/template-admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/template-admin/assets/js/main.js"></script>

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

    /* Kelas untuk tombol agar memiliki ukuran yang konsisten */
    .btn-custom {
        width: 100%;
        /* Membuat tombol lebar penuh */
        max-width: 200px;
        /* Mengatur batas lebar maksimal */
    }

</style>

@endsection
