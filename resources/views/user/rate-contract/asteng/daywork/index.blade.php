@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Daywork</li>
            </ol>
        </nav>

          <!-- Form untuk pencarian -->
        <!-- Form untuk pencarian -->
<div class="mb-4">
    <form method="GET" action="{{ url('/user/rate-contract/asteng/daywork') }}" class="d-flex align-items-center gap-3">
        <!-- Input Pencarian Tahun -->
        <div class="form-group">
            <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun" value="{{ request('tahun') }}">
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
                        <td>{{ $item->premium_rate }}</td>
                        <td>{{ $item->general_escalation }}</td>
                        <td class="text-danger fw-bold">{{ $item->actual_rate_exc }}</td>
                        <td>
                            <!-- Menggunakan d-flex untuk mengatur elemen menjadi horizontal -->
                            <div class="d-flex gap-2 justify-content-center">
                                    <!-- Tombol Detail -->
                                    <a href="{{ url('/user/rate-contract/asteng/daywork/detail/' . $item->id_daywork) }}" >
                                        <i class="ri-information-line" title="Detail"></i>
                                    </a>

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
 <a type="submit" href="/user/rate-contract/asteng" class="btn btn-secondary">Kembali</a>   
    </div>
</main>

@endsection