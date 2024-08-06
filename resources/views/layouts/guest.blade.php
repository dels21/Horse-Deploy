<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/root/root.css')}}">
        <link rel="stylesheet" href="{{asset('css/authentication/login.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <style>
        .scrollable-container {
            max-height: 100vh;
            overflow-y: scroll;
            min-height: 100vh;
            scrollbar-color: transparent;
        }
        /* Hide scrollbar for Webkit-based browsers (Chrome, Safari) */
        .scrollable-container::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for IE, Edge, and Firefox */
        .scrollable-container {
            -ms-overflow-style: none;  /* Internet Explorer 10+ */
            scrollbar-width: none;  /* Firefox */
        }
        </style>
        <!-- Scripts -->
    </head>
    <body class=" text-gray-900 antialiased" style="overflow: hidden">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100" >
            <div>
                <a href="/">
                    {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                </a>
            </div>

            <section class="gradient-form" style="background-color: #eee;">
                <div class="card rounded-3 text-black container-fluid ">
                  <div class="row g-0 h-100">
                    <img src="https://media.istockphoto.com/id/1312706504/photo/modern-hospital-building.jpg?s=612x612&w=0&k=20&c=DT6YDRZMH5G5dL-Qv6VwPpVDpIDxJqkAY4Gg0ojGi58=" class="col-lg-6 " style="object-fit: cover;padding: 0;">

                    <div class="col-lg-6 ">
                      <div class="card-body p-md-5 mx-md-4 scrollable-container"  style="scrollbar-width: none;">

                        <div class="text-center">
                          <img src="{{ asset('images/logohorse.png') }}"
                            style="width: 80px;" alt="logo">
                          <h4 class="mt-1 mb-5 pb-1">HORSE</h4>
                        </div>

                        <div>
                            {{$slot}}
                        </div>

                      </div>
                    </div>

                  </div>
                </div>
            </section>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        <script>
          var inputField = document.getElementById('tanggalLahir');

          inputField.addEventListener('change', function() {
              var selectedDate = inputField.value;
              // console.log(selectedDate);
          });
      </script>

      </body>
</html>
