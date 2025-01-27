@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item avtive"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Fuel Allowance</li>
            </ol>
        </nav>
    </div>

    <!-- Form untuk pencarian -->
    <div class="mb-4">
        <form method="GET" action="{{ url('/user/rate-contract/asbar/fuelasbar') }}" class="d-flex align-items-center gap-3">
            <!-- Input Pencarian Tahun -->
            <div class="form-group">
                <input type="number" name="tahun" class="form-control" placeholder="Cari Tahun" value="{{ request('tahun') }}">
            </div>

            <!-- Input Filter Item -->
            <div class="form-group">
                <select name="item" class="form-select" id="item" aria-label="Floating label select example">
                    <option selected value="">Pilih Item</option>
                    <option value="Coal CPP - PLTU (liter/ton)">Coal CPP - PLTU (liter/ton)</option>
                    <option value="Over/under distance Coal CPP - PLTU (liter/ton/KM)">Over/under distance
                        Coal CPP - PLTU (liter/ton/KM)</option>
                    <option value="Distance Actual PLTU Unit 1-4 (KM)">Distance Actual PLTU Unit 1-4 (KM)
                    </option>
                    <option value="Distance Actual PLTU Unit 5-6 (KM)">Distance Actual PLTU Unit 5-6 (KM)
                    </option>
                    <option value="Contractual Distance (KM)">Contractual Distance (KM)</option>
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
                    <th scope="col" style="width: 10%;"> Activity </th>
                    <th scope="col" style="width: 15%;"> Item </th>
                    <th scope="col" style="width: 15%;"> Fuel Index </th>
                    <th scope="col" style="width: 15%;"> Distance </th>
                    <th scope="col" style="width: 10%;">Aksi</th>
                </tr>
            </thead>

            <?php $No = 1; ?>
            @foreach($dokumenfuelasbar as $item)
            <tr>
                <td>{{ $No++ }}</td>
                <td>{{ $item->bulan_tahun }}</td>
                <td>{{ $item->activity }}</td>
                <td>{{ $item->item }}</td>
                <td>{{ $item->fuel_index }}</td>
                <td>{{ $item->distance }}</td>
                <td>
                    <div class="d-flex gap-2 justify-content-center">
                        <!-- Tombol Detail -->
                        <a
                            href="{{ url('user/rate-contract/asbar/fuelasbar/detail/' . $item->id) }}">
                            <i class="ri-information-line text-primary" title="Detail"></i>
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
            <a type="submit" href="/user/rate-contract/asbar" class="btn btn-secondary">Kembali</a>
        </div>
    </section>

</main>

@endsection