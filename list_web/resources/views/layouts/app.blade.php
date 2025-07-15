<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Task</title>

    <style type="text/tailwindcss">
        .btn{
            @apply rounded-md px-2 py-1 font-medium shadow-sm text-slate-700 text-center ring-1 ring-slate-700/10 hover:bg-slate-50
        }
        
        .link{
            @apply font-medium text-gray-700 underline decoration-pink-500
        }

        .error{
            @apply text-sm text-red-500
        }
        label{
            @apply block uppercase text-slate-700 mb-2
        }

        input, textarea{
            @apply shadow-sm appearance-none border w-full py-2 px-3 text-slate-700 leading-tight focus:outline-none
        }
    </style>

    @yield('style')
</head>

<body class="container mx-auto mt-10 mb-10 max-w-lg">
    <h1 class="text-2xl mb-4">@yield('title')</h1>
    <div>
        @if (session()->has('success'))
            <div> {{session('success')}} </div>
        @endif
        @yield('content')
    </div>
</body>

</html>