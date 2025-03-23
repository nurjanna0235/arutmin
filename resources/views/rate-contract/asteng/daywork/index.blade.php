@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Darma Henwa</li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Daywork</li>
            </ol>
        </nav>
        @include('componen.alert')
        <div class="icon mb-3">
            <a href="/rate-contract/asteng/daywork/tambah" type="button" class="btn btn-success"><i></i>Tambah</a>
        </div>

        <!-- Form untuk pencarian -->
        <!-- Form untuk pencarian -->
        <div class="mb-4">
            <form method="GET" action="{{ url('/rate-contract/asteng/daywork') }}" class="d-flex align-items-center gap-3">
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
                <!-- Input Filter Item -->
                <div class="form-group">
                    <select name="item" class="form-control">
                        <option value="">Pilih Item</option>
                        @foreach ($itemList as $item)
                        <option value="{{ $item->id_item }}" {{ request('item') == $item->id_item ? 'selected' : '' }}>
                            {{ $item->nama_item }}
                        </option>
                        @endforeach
                    </select>
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
                        <th scope="col" style="width: 5%;"> No</th>
                        <th scope="col" style="width: 15%;"> Bulan/Tahun </th>
                        <th scope="col" style="width: 10%;"> Item </th>
                        <th scope="col" style="width: 15%;"> Base Rate Fuel (Rp/hrs) </th>
                        <th scope="col" style="width: 15%;"> FBR (liter/hrs) </th>
                        <th scope="col" style="width: 15%;"> Currency Adjustment </th>
                        <th scope="col" style="width: 15%;"> Premium Rate </th>
                        <th scope="col" style="width: 15%;"> General Escalation </th>
                        <th scope="col" style="width: 15%;"> Name Contract </th>
                        <th scope="col" style="width: 15%;"> Actual Rate Exc. Fuel (Rp/Hrs) </th>
                        <th scope="col" style="width: 10%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $No = 1; ?>
                    @foreach($dokumendaywork as $item)
                    <tr>
                        <td>{{ $No++ }}</td>
                        <td>{{ $item->bulan_tahun }}</td>
                        <td>{{ $item->nama_item }}</td>
                        <td>{{ $item->base_rate_exc }}</td>
                        <td>{{ $item->fbr }}</td>
                        <td>{{ $item->currency_adjustment }}</td>
                        <td>{{ $item->premium_rate }}%</td>
                        <td>{{ $item->general_escalation }}%</td>
                        <td>{{ $item->name_contract }}</td>
                        <td class="text-danger fw-bold">{{ $item->actual_rate_exc }}</td>
                        <td>
                            <!-- Menggunakan d-flex untuk mengatur elemen menjadi horizontal -->
                            <div class="d-flex gap-2 justify-content-center">
                                <!-- Tombol Detail -->
                                <a href="{{ url('rate-contract/asteng/daywork/detail/' . $item->id_daywork) }}">
                                    <i class="ri-information-line" title="Detail"></i>
                                </a>

                                <!-- Tombol Edit -->
                                <a href="{{ url('rate-contract/asteng/daywork/edit/' . $item->id_daywork) }}">
                                    <i class="ri-edit-2-line text-warning" title="Edit"></i>
                                </a>

                                <!-- Tombol Hapus -->
                                <form action="{{ url('/rate-contract/asteng/daywork/delete/' . $item->id_daywork) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="d-inline">
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
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Content -->
        </div>
    </section>
    <div class="icon mb-3">
        <a type="submit" href="/rate-contract/asteng" class="btn btn-secondary">Kembali</a>
    </div>
</main>

@endsection
