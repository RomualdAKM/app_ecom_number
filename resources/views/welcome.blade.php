<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tailwind Ecommerce</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
            integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
            crossorigin="anonymous" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="stylesheet" href="{{ asset('style.css')}}">

        {{-- @vite('resources/css/app.css') --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.4/css/dataTables.tailwindcss.css">

    </head>
    <body id="app">

        {{-- @vite('resources/js/app.js') --}}

            <script src="{{ mix('js/app.js') }}"></script>

         <!-- copyright end -->

                <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
                <script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
                <script src="https://cdn.datatables.net/2.0.4/js/dataTables.tailwindcss.js"></script>
         <script>
        /*// initialiser datatable
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });*/
        let menuBar = document.querySelector('#menuBar')
        let mobileMenu = document.querySelector('#mobileMenu')
        let closeMenu = document.querySelector('#closeMenu')

        menuBar.addEventListener('click', function(){
            mobileMenu.classList.remove('hidden')
        })

        closeMenu.addEventListener('click', function(){
            mobileMenu.classList.add('hidden')
        })
    </script>
    </body>
</html>
