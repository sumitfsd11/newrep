<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="cupcake">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <title>Survey</title>
        
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')
        @livewireStyles
    </head>
    <body class="antialiased">
        <div class="relative bg-base-100 flex flex-col items-top min-h-screen sm:items-center sm:pt-0">
            @include('layouts.nav')
            <div  class="container flex flex-col grow bg-base-100">
                {{ $slot }}
            </div>
        </div>
        @livewireScripts

        <script>
if (!localStorage.getItem('contents') && !localStorage.getItem('oldContents')) {

  localStorage.setItem('contents',JSON.stringify([]) );
  localStorage.setItem('oldContents',JSON.stringify([]));
}

                var URL = window.location.href;
var parts = URL.split("/");
var lastPart = parts.pop();
if(lastPart=='edit'){
   

    window.addEventListener("beforeunload", function(event) {
        alert( window.location.href);
        var oldcontent=localStorage.getItem("oldContents");
    var newcontent=localStorage.getItem("contents");
    if(oldcontent != newcontent)
var discard=confirm("Want to discard changes !")
if(discard){
    localStorage.setItem('contents',JSON.stringify([]) );
}

    });
            }
         


        </script>
    </body>
</html>
