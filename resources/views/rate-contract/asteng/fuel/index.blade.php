@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dokumen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Fuel</li>
            </ol>
        </nav>

        <div class="icon">
            <a href="/rate-contract/asteng/fuel/tambah" type="button" class="btn btn-success"><i></i>Tambah</a>
        </div>

         <!-- Table with stripped rows -->
         <table class="table datatable">
            <thead>
                <tr>
                <th>
                        <small>No</small>
                    </th>
                    <th>
                        <small>Activity</small>
                    </th>
                    <th>
                        <small>Item</small>
                    </th>
                    <th>
                        <small>Fuel Index</small>
                    </th>
                    <th>
                        <small>Contractual Distance (KM)</small>
                    </th>
                    <th>
                        <small>contract Reference</small>
                    </th>
                    <th>
                        <small>Tanggal</small>
                    </th>
                    <th>
                        <small>Aksi</small>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $No = 1;
                    ?>
                @foreach($dokumenfuel as $item)
                    <tr>
                        <td>{{ $No++ }}</td>
                        <td>{{ $item->activity}}</td>
                        <td>{{ $item->item}}</td>
                        <td>{{ $item->fuel_index}}</td>
                        <td>{{ $item->contractual_distance_km}}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                        <div class="icon">
                        <a href="{{ url('rate-contract/asteng/fuel/edit/' . $item->id) }}"type="button" class="btn btn-warning" style="color: white"><i></i>Edit</a>
                                <a href="{{ url('rate-contract/asteng/fuel/detail/' . $item->id) }}" type="button" class="btn btn-primary"><i></i>Detail</a>
                                <form
                                    action="{{ url('/rate-contract/asteng/fuel/delete/'.$item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit"><i></i>Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                @endforeach
                <!-- End Table with stripped rows -->

    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-5">
                <div class="row">
                </div>
            </div>
        </div>
        </div>
        </div>
        </div><!-- End Card with an image on left -->

        </div><!-- End sidebar recent posts-->

        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

        </div>
    </section>

</main>
<!-- End #main -->
@endsection
