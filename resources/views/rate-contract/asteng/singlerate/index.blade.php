@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Single Rate</li>
            </ol>
        </nav>

        <div class="icon mb-3">
            <a href="/rate-contract/asteng/single-rate/tambah" type="button" class="btn btn-success"><i></i>Tambah</a>
        </div>

            <!-- Form untuk pencarian -->
            <div class="mb-4">
            <form method="GET" action="{{ url('/rate-contract/asteng/single-rate') }}" class="d-flex align-items-center gap-3">
                <!-- Input Pencarian Tahun -->
                <div class="form-group">
                    <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun" value="{{ request('tahun') }}">
                </div>
                <!-- Tombol Submit untuk Search -->
                <button type="submit" class="btn btn-primary">Cari</button>
            </form>
        </div>

        <!-- Table with stripped rows -->
        <div class="table-container" style="width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" style="width: 5%;">No</th>
                        <th scope="col" style="width: 15%;">Bulan/Tahun</th>
                        <th scope="col" style="width: 15%;">Total Base Rate OB (Rp/BCM)</th>
                        <th scope="col" style="width: 15%;">Total Base Rate Coal (Rp/ton)</th>
                        <th scope="col" style="width: 10%;">SR</th>
                        <th scope="col" style="width: 10%;">Currency Adjustment</th>
                        <th scope="col" style="width: 10%;">Premium Rate</th>
                        <th scope="col" style="width: 10%;">General Escalation</th>
                        <th scope="col" style="width: 15%;">Total Single Rate Actual (Rp/ton)</th>
                        <th scope="col" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $No = 1; ?>
                    @foreach($dokumensingle_rate as $item)
                        <tr>
                            <td>{{ $No++ }}</td>
                            <td>{{ $item->bulan_tahun }}</td>
                            <td>{{ $item->total_base_rate_ob }}</td>
                            <td>{{ $item->total_base_rate_coal }}</td>
                            <td>{{ $item->sr }}</td>
                            <td>{{ $item->currency_adjustment }}</td>
                            <td>{{ $item->premium_rate }}</td>
                            <td>{{ $item->general_escalation }}</td>
                            <td class="text-danger fw-bold">{{ $item->total_single_rate_actual }}</td>
                            <td>
                                <!-- Menggunakan d-flex untuk mengatur elemen menjadi horizontal -->
                                <div class="d-flex gap-2 justify-content-center">
                                    <!-- Tombol Detail -->
                                    <a href="{{ url('rate-contract/asteng/single-rate/detail/' . $item->id) }}" >
                                        <i class="ri-information-line" title="Detail"></i>
                                    </a>

                                    <!-- Tombol Edit -->
                                    <a href="{{ url('rate-contract/asteng/single-rate/edit/' . $item->id) }}" >
                                        <i class="ri-edit-2-line text-warning" title="Edit"></i>
                                    </a>
                                   
                                   <!-- Tombol Hapus -->
                                   <form action="{{ url('/rate-contract/asteng/single-rate/delete/' . $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background: none;" >
                                            <i class="ri-delete-bin-line text-danger" title="Hapus"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">
            <!-- Content here -->
        </div>
         <!-- Tombol Kembali -->
 <div class="icon mb-3">
 <a type="submit" href="/rate-contract/asteng" class="btn btn-secondary">Kembali</a>   
    </div>
    </section>

</main>
<!-- End #main -->

@endsection

<style>
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }
</style>
