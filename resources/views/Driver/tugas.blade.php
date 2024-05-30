<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Driver | Tugas</title>
</head>

<body>
    @include('driver.components.sidebar')
    <section>
        <div class="belum_diambil">
            @foreach ($list_tugas as $lt)
            <div>
                <img class="avatar-image" src="asset('avatar/avatar1.jpg)" alt="Avatar" style="border-radius: 50%;">
                <div class="description-tugas">
                    <p>
                        Nama penerima : {{ $lt->nama_penerima }}
                        Alamat : {{ $lt->alamat }}
                    </p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</body>

</html>