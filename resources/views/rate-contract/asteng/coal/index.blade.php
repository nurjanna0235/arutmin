@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Coal</li>
            </ol>
        </nav>
    </div>

    @include('componen.alert')

    <!-- Tombol Tambah -->
    <div class="icon mb-3">
        <a href="/rate-contract/asteng/coal/tambah" class="btn btn-success"><i></i>Tambah</a>
    </div>

    <!-- Form untuk pencarian -->
    <div class="mb-4">
        <form method="GET" action="{{ url('/rate-contract/asteng/coal') }}" class="d-flex align-items-center gap-3">
            <!-- Input Pencarian Tahun -->
            <div class="form-group">
                <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun" value="{{ request('tahun') }}">
            </div>
            <!-- Tombol Submit untuk Search -->
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div><!-- Form untuk pencarian -->


    <!-- Tabel Data -->
    <div class="table-container" style="width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch;">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th scope="col" style="width: 5%;">No</th>
                    <th scope="col" style="width: 10%;">Bulan/Tahun</th>
                    <th scope="col" style="width: 15%;">Clean Coal (Rp/ton)</th>
                    <th scope="col" style="width: 15%;">Loading and Ripping (Rp/ton)</th>
                    <th scope="col" style="width: 15%;">Coal Hauling @8,463 Km (Rp/ton)</th>
                    <th scope="col" style="width: 10%;">HRM @8,463 Km (Rp/ton)</th>
                    <th scope="col" style="width: 10%;">Pit Support (Rp/ton)</th>
                    <th scope="col" style="width: 15%;">Sub Total Base Rate Coal (Rp/ton)</th>
                    <th scope="col" style="width: 10%;">Currency Adjustment</th>
                    <th scope="col" style="width: 10%;">Premium Rate</th>
                    <th scope="col" style="width: 10%;">General Escalation</th>
                    <th scope="col" style="width: 15%;">Total Rate Coal Actual (Rp/ton)</th>
                    <th scope="col" style="width: 10%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $No = 1; ?>
                @foreach($dokumencoal as $item)
                <tr>
                    <td>{{ $No++ }}</td>
                    <td>{{ $item->bulan_tahun }}</td>
                    <td>{{ $item->clean_coal }}</td>
                    <td>{{ $item->loading_and_ripping }}</td>
                    <td>{{ $item->coal_hauling }}</td>
                    <td>{{ $item->hrm }}</td>
                    <td>{{ $item->pit_support }}</td>
                    <td class="text-danger fw-bold">{{ $item->sub_total_base_rate_coal }}</td>
                    <td>{{ $item->currency_adjustment }}</td>
                    <td>{{ $item->premium_rate }}</td>
                    <td>{{ $item->general_escalation }}</td>
                    <td class="text-danger fw-bold">{{ $item->total_rate_coal_actual }}</td>
                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <!-- Tombol Detail -->
                            <a href="{{ url('rate-contract/asteng/coal/detail/' . $item->id) }}">
                                <i class="ri-information-line" title="Detail"></i>
                            </a>

                            <!-- Tombol Edit -->
                            <a href="{{ url('rate-contract/asteng/coal/edit/' . $item->id) }}">
                                <i class="ri-edit-2-line text-warning" title="Edit"></i>
                            </a>

                            <!-- Tombol Hapus -->
                            <form action="{{ url('/rate-contract/asteng/coal/delete/' . $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="d-inline">
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

    <!-- Tombol Kembali -->
    <div class="icon mb-5">
        <a href="/rate-contract/asteng" class="btn btn-secondary">Kembali</a>
    </div>

</main>

@endsection
