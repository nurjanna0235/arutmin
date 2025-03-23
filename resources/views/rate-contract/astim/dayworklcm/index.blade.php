@extends('componen.template-admin')

@section('conten')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Rate Contract</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active"> Laz Coal Mandiri</li>
                    <li class="breadcrumb-item active">Astim</li>
                    <li class="breadcrumb-item active">Daywork</li>
                </ol>
            </nav>

            @include('componen.alert')

            <div class="icon mb-3">
                <a href="/rate-contract/astim/daywork-lcm/tambah" type="button" class="btn btn-success"><i></i>Tambah</a>
            </div>

            <!-- Form untuk pencarian -->
            <div class="mb-4">
                <form method="GET" action="{{ url('/rate-contract/astim/daywork-lcm') }}"
                    class="d-flex align-items-center gap-3">
                    <!-- Input Pencarian Tahun -->
              <div class="form-group row">
                    <div class="col-md-6">
                        <label for="start_year" style="font-size: 15px;">Tahun Awal:</label>
                        <input type="number" name="start_year" class="form-control" id="start_year"
                            value="{{ request('start_year') }}" min="2000" max="2900">
                    </div>
                    <div class="col-md-6">
                        <label for="end_year" style="font-size: 15px;">Tahun Akhir:</label>
                        <input type="number" name="end_year" class="form-control" id="end_year"
                            value="{{ request('end_year') }}" min="2000" max="2900">
                    </div>
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
                            <th scope="col" style="width: 10%;">Name Contract</th>
                            <th scope="col" style="width: 10%;">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php $No = 1; @endphp <!-- Inisialisasi nomor urut -->
                        @foreach ($dokument as $key => $item)
                            <tr>
                                <td>{{ $No++ }}</td>
                                <td>
                                    <a class="btn" href="{{ url('rate-contract/astim/daywork-lcm/view/' . $item->id_contract) }}"> {{ $item->created_at }}</a>
                                   
                                </td>
                                <td>{{ $item->name_contract}}</td>
                                <td>
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="{{ url('rate-contract/astim/daywork-lcm/detail/' . $item->id_contract) }}">
                                            <i class="ri-information-line" title="Detail"></i>
                                        </a>
                                        <a href="{{ url('rate-contract/astim/daywork-lcm/edit/' . $item->id_contract) }}">
                                            <i class="ri-edit-2-line text-warning" title="Edit"></i>
                                        </a>
                                        <form action="{{ url('/rate-contract/astim/daywork-lcm/delete/' . $item->id_contract) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; background: none;">
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
            <div class="row"></div>
            <div class="icon mb-5">
                <a type="submit" href="/rate-contract/astim" class="btn btn-secondary">Kembali</a>
            </div>
        </section>

    </main>
@endsection
