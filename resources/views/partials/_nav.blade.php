<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <strong><small><h4>{{ strtoupper(config('app.name', 'Laravel')) }}</h4></small></strong>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('/') }}"><small><strong>{{ strtoupper(__('Home')) }}</strong></small></a>
                </li><span class="divide-line"></span>
                <li class="nav-item">
                    <a class="nav-link" href=""><small><strong>{{ strtoupper(__('Economics')) }}</strong></small></a>
                </li><span class="divide-line"></span>
                <li class="nav-item">
                    <a class="nav-link" href=""><small><strong>{{ strtoupper(__('People')) }}</strong></small></a>
                </li><span class="divide-line"></span>
                <li class="nav-item">
                    <a class="nav-link" href=""><small><strong>{{ strtoupper(__('Biography')) }}</strong></small></a>
                </li><span class="divide-line"></span>
                <li class="nav-item">
                    <a class="nav-link" href=""><small><strong>{{ strtoupper(__('Sports')) }}</strong></small></a>
                </li><span class="divide-line"></span>
                <li class="nav-item">
                    <a class="nav-link" href=""><small><strong>{{ strtoupper(__('Entertainment')) }}</strong></small></a>
                </li><span class="divide-line"></span>
                <li class="nav-item">
                    <a class="nav-link" href=""><small><strong>{{ strtoupper(__('Happening')) }}</strong></small></a>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            {{Html::linkRoute('category.index','Category Dashboard', [], ['class' => 'dropdown-item'])}}
                            {{Html::linkroute('tags.index', 'Blog Tags Dashboard', [], ['class' => 'dropdown-item'])}}
                            {{Html::linkroute('publish.index', 'Publication Dashboard', [], ['class' => 'dropdown-item'])}}
                            <hr>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
