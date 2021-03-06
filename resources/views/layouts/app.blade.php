<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>CodeShare</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
        <link rel="stylesheet" href="https://unpkg.com/mavon-editor@2.7.4/dist/css/index.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>

    <body>

        @include('commons.navbar')
        
        <div class="container">
            @include('commons.error_messages')
            
            @include('commons.flash_message')

            @yield('content')
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
        
        <script src="https://unpkg.com/mavon-editor@2.7.4/dist/mavon-editor.js"></script>
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
        <script>
            var simplemde = new SimpleMDE({ 
                element: document.getElementById("editor") 
            });
        </script>
        
        <script>
            // モーダルウィンドウ
            $(window).on('load',function(){
                $('#myModal').modal('show');
            });
        </script>
        @yield('script')
    </body>
</html>