<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow">
            <div class="container">
                <a class="navbar-brand" href="{{ auth()->user() ? route('dashboard') : route('page.show') }}">
                    {{ config('app.name', 'Serenity') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login.show') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register.show') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ auth()->user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('settings.edit') }}">
                                        {{ __('Settings') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
