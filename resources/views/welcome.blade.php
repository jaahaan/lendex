<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="shortcut icon" href="{{ $setting['favIcon'] }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- CSRF Token -->
       <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Sytem - Login</title>
        <style>
          :root {
              --primaryColor:{{$setting['theme_colour']}};
              --backgroudColor:{{$setting['background_color']}};
              --fontColor:{{$setting['font_color']}};
              --fontHoverColor:{{$setting['font_hover_color']}};
              /*--------- buttons---------- */
              --primaryButton:#474747;
              --primaryButtonText:#fff;
              --primaryButtonHover:#000401;

              --editButton:#6B6B6B;
              --editButtonText:#fff;
              --editButtonHover:#262525;

              --removeButton:#D6453B;
              --removeButtonText:#fff;
              --removeButtonHover:#D91916;

              --confirmButton:#000401;
              --confirmButtonHover:#000401;

              --editOutlineButton:#6B6B6B;
              --editOutlineButtonHover:#6B6B6B;

              --removeOutlineButton:#D6453B;
              --removeOutlineButtonHover:#D91916;
               /*--------- buttons---------- */
          }
       </style>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
        <link rel="stylesheet" href="//unpkg.com/view-design/dist/styles/iview.css">
        {{-- <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet"> --}}
       <link href={{ asset('css/all.css' )}} rel="stylesheet">
       <link href={{ asset('css/main.css' )}} rel="stylesheet">
       <link href={{ asset('css/custom.css' )}} rel="stylesheet">
       {{-- <link href="https://stacmakpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"> --}}


        <script>
        (function () {
            window.Laravel = {
                csrfToken: '{{ csrf_token() }}'
            };

            var site_name = `{!!  env('SITE')  !!}`
            window.site_name = site_name



            @if(Auth::check())
              window.authUser={!! $user !!}
             @else
                window.authUser=false
             @endif
             window.companySetting={!! $setting !!}
        })();
      </script>
    </head>
    <body>
       <div id="app">
          <default></default>
       </div>
       <script src="{{asset('js/app.js')}}"></script>
    </body>
</html>
