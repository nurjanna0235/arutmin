@extends('componen.template-user')

@section('conten')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profil</h1>
        <nav>
            <ol class="breadcrumb">

                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active">Profil</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">



                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>


                        </ul>

                        <!-- Profile Edit Form -->
                        <form id="profileForm" action="/user/profile/update" method="POST" enctype="multipart/form-data">
                            @csrf
                           
                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="username" type="text" class="form-control" id="username" value="{{$pengguna->username}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="nik" class="col-md-4 col-lg-3 col-form-label">NIK</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="nik" type="text" class="form-control" id="nik" value="{{$pengguna->nik}}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                <div class="col-md-8 col-lg-9">
                                    <input name="email" type="email" class="form-control" id="Email" value="{{$pengguna->email}}">
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>





                </div>

            </div><!-- End Bordered Tabs -->

        </div>
        </div>

        </div>
        </div>
    </section>

</main>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profilePreview');
            output.src = reader.result; // Ganti src dengan gambar baru
            saveButton.classList.remove('d-none'); // Tampilkan tombol simpan
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>



@endsection