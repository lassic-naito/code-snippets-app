<header class="mb-4">
    <nav class="navbar navbar-expand-sm navbar-light" style="background-color: #87ceeb;"> 
        <a class="navbar-brand" href="/">CodeShare</a>
         
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="nav-bar">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav nav-pills nav-justify-content-end justify-content-around">
                @if (Auth::check())
                    <li class="nav-item">
                        <a href="{{ route('posts.create') }}" class="btn btn-success">
                            <i class="fas fa-edit"></i>:新規投稿
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user"></i> {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item">
                                {!! link_to_route('users.index', 'マイページ') !!}
                            </li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('signup.get') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-user-plus"></i> ユーザ登録
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-sign-in-alt"></i> ログイン
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </nav>
</header>