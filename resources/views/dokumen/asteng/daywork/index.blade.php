@extends('componen.template-admin')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dokumen</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Darma Henwa</a></li>
                <li class="breadcrumb-item active">Asteng</li>
                <li class="breadcrumb-item active">Daywork</li>

            </ol>
        </nav>

        <div class="icon">
            <a href="/dokumen/asteng/daywork/tambah" type="button" class="btn btn-success"><i
                    class="ri-add-fill"></i>Tambah</a>
        </div>
        <!-- Table with stripped rows -->
        <table class="table datatable">
            <thead>
                <tr>
                <th>
                        <small>No</small>
                    </th>
                    <th>
                        <small>Item</small>
                    </th>
                    <th>
                        <small>Base Rate Exc. Fuel (Rp/hrs)</small>
                    </th>
                    <th>
                        <small>Actual Rate Exc. Fuel (Rp/Hrs)</small>
                    </th>
                    <th>
                        <small>FBR (liter/hrs)</small>
                    </th>
                    <th>
                        <small>Currency Adjustment</small>
                    </th>
                    <th>
                        <small>Premium Rate</small>
                    </th>
                    <th>
                        <small>General Escalation</small>
                    </th>
                    <th>
                        <small>Contract Reference</small>
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
                @foreach($dokumendaywork as $item)
                    <tr>

                        <td>{{ $No++ }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td>
                            <a href="{{ url('dokumen/asteng/daywork/detail/'.$item->id) }}"
                                type="button" class="btn btn-primary"><i class="bx bx-info-circle"></i>Detail</a>
                            <form
                                action="{{ url('/dokumen/asteng/daywork/delete/'.$item->id) }}"
                                method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit"><i
                                        class="bx bx-x-circle"></i>Hapus</button>
                            </form>
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
