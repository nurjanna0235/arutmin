@extends('componen.template-user')

@section('conten')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Rate Contract</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"> Laz Coal Mandiri</li>
                    <li class="breadcrumb-item active">Astim</li>
                    <li class="breadcrumb-item active">Fuel</li>
                </ol>
            </nav>
            <!-- Form untuk pencarian -->
            <div class="mb-4">
                <form method="GET" action="{{ url('/rate-contract/astim/fuel-lcm') }}"
                    class="d-flex align-items-center gap-3">
                    <!-- Input Pencarian Tahun -->
                    <div class="form-group">
                        <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun"
                            value="{{ request('tahun') }}">
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
                            <th scope="col" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $No = 1; @endphp <!-- Inisialisasi nomor urut -->
                        @foreach ($dokument as $key => $item)
                            <tr>
                                <td>{{ $No++ }}</td>
                                <td>
                                    {{ $item->created_at }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ url('user/rate-contract/astim/fuel-lcm/detail/' . $item->id_contract) }}">
                                            <i class="ri-information-line" title="Detail"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row"></div>
            <div class="icon mb-5">
                <a type="submit" href="/user/rate-contract/astim" class="btn btn-secondary">Kembali</a>
            </div>
        </section>

    </main>
@endsection
