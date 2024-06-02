<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main View</title>

    {{-- CSS --}}
    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">
    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- JQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    {{-- dataTable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    {{-- datatble button --}}


    {{-- Bootstrap Icon --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @yield('css')
    <style>
        div.content {
            position: absolute;
            width: 100vw;
            min-height: 100vh;
            z-index: 10;
        }
        div.bg-mid {
            position: fixed;
            width: 100vw;
            min-height: 100vh;
            z-index: 8;
            background-color: #a09f9f;
            filter: blur(5px);
            opacity: 0.8;

        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        body {
            /* display: flex;
            justify-content: center;
            align-items: center; */
            min-height: 100vh;
            background: #000;
            overflow: auto;
        }

        section.auto-bg {
            position: fixed;
            width: 100vw;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            flex-wrap: wrap;
            overflow: hidden;

        }

        section.auto-bg::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: linear-gradient(#000, rgb(0, 62, 125), #000);
            /* animation: animate 5s linear infinite; */
            animation: colorChanges 5s linear infinite alternate-reverse;
        }
        section.auto-bg span {
            position: relative;
            display: block;
            width: calc(6.25vw - 2px);
            height: calc(6.25vw - 2px);
            background: #ffffff;
            z-index: 2;
            transition: 1.5s;
            /*delay nya*/
        }

        section.auto-bg span:hover {
            background: rgba(148, 187, 206, 0);
            transition: 0s;
        }

        section.auto-bg span.hover {
            background: rgb(0, 170, 255, 0);
            transition: 0s;
        }
        /*button on click*/
        @media (max-width: 900px) {
            section span {
                width: calc(10vw - 2px);
                height: calc(10vw - 2px);
            }
        }

        @media (max-width: 600px) {
            section span {
                width: calc(20vw - 2px);
                height: calc(20vw - 2px);
            }
        }
    </style>



</head>

<body style="overflow-x: hidden;">

    <script>
        $(document).ready(function() {
            for (let index = 0; index < 350; index++) {
                $(".auto-bg").append(`<span></span>`);
            }
            setInterval(function() {
                let spans = $(".auto-bg span");
                let randomSpan = spans.eq(Math.floor(Math.random() * spans.length));
                randomSpan.addClass('hover').delay(1).queue(function(next) {
                    $(this).removeClass('hover');
                    next();
                });
            }, 20);
        })
    </script>
    <section class="auto-bg">

    </section>
    <div class="bg-mid">
    </div>
    <div class="content">
            @yield('components')

            {{-- main content --}}
            <div class="container py-5">
                <div class="col-lg-6 mx-auto">
                    @yield('content')
                </div>
            </div>
            {{-- extras for model, etc --}}
            @yield('extras')
    </div>
    @yield('modal')

    {{-- other components for sidebar, etc --}}

    {{-- JS --}}
    @yield('js')
</body>

</html>
