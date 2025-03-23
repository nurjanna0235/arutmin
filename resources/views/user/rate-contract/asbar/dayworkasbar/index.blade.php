@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rate Contract</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asbar</li>
                <li class="breadcrumb-item active">Daywork</li>
            </ol>
        </nav>
    </div>
    <!-- Form untuk pencarian -->
    <div class="mb-4">
        <form method="GET" action="{{ url('/user/rate-contract/asbar/daywork-asbar/') }}"
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
            <!-- Input Filter Item -->
            <div class="form-group">
                <select name="item" class="form-select" id="item" aria-label="Floating label select example">
                    <option selected value="">Pilih Item</option>
                    @foreach($itemList as $item)
                    <option value="{{$item->id_item_daywork_asbar}}">{{$item->nama_item}}</option>
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
                    <th scope="col" style="width: 15%;"> Base Rate Exc. Fuel (Rp/Hrs) </th>
                    <th scope="col" style="width: 15%;"> Currency Adjustment </th>
                    <th scope="col" style="width: 15%;"> Index </th>
                    <th scope="col" style="width: 15%;"> Premium Rate </th>
                    <th scope="col" style="width: 15%;"> General Escalation </th>
                    <th scope="col" style="width: 15%;"> Actual Rate Exc. Fuel (Rp/Hrs) </th>
                    <th scope="col" style="width: 10%;">Name Contract</th>
                    <th scope="col" style="width: 10%;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php $No = 1; ?>
                @foreach($dokumendaywork as $item)
                <tr>
                    <td>{{$No++}}</td>
                    <td>{{ $item->bulan_tahun }}</td>
                    <td>{{ $item->nama_item }}</td>
                    <td>{{ $item->base_rate_exc_fuel }}</td>
                    <td>{{ $item->currency_adjustment }}</td>
                    <td>{{ $item->index }}</td>
                    <td>{{ $item->premium_rate }}</td>
                    <td>{{ $item->general_escalation }}</td>
                    <td>{{ $item->actual_rate_exc_fuel }}</td>
                    <td>{{ $item->name_contract }}</td>

                    <td>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="{{ url('/user/rate-contract/asbar/daywork-asbar/detail/'.$item->id_daywork_asbar)}}">
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
            <a type="submit" href="/user/rate-contract/asbar" class="btn btn-secondary">Kembali</a>
        </div>
    </section>

</main>

@endsection