<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::segment(1) === null ? 'active' : '' }}"><a href="{{ route('home') }}">Home</a></li>
                <li class="{{ Request::segment(1) === 'blog' ? 'active' : '' }}"><a href="{{ route('blog.articles.index') }}">Blog</a></li>
                <li class="{{ Request::segment(1) === 'market' ? 'active' : '' }}"><a href="{{ route('market.index') }}">Markets</a></li>
                <li class="{{ Request::segment(1) === 'gallery' ? 'active' : '' }}"><a href="{{ route('gallery.index') }}">Gallery</a></li>
                <li class="{{ Request::segment(1) === 'contact' ? 'active' : '' }}"><a href="{{ route('contact.index') }}">Contact Me</a></li>
            </ul>
            @if(auth()->check())

                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" 
                            class="dropdown-toggle" 
                            data-toggle="dropdown" 
                            role="button" 
                            aria-haspopup="true" 
                            aria-expanded="false"
                        >
                                <img src="{{ auth()->user()->avatar }}" class="img-circle" height="25px" width="25px">
                                {{ auth()->user()->username }}
                                <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Favorited Articles</a></li>
                            <li><a href="#">Favorited Markets</a></li>
                            <li><a href="{{ route('account.index') }}">Account</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('auth.logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ route('facebook.provider') }}"><i class="fa fa-facebook-official"></i> Facebook</a></li>
                    <li><a href="{{ route('google.provider') }}"><i class="fa fa-google-official"></i> Google</a></li>
                    <li><a href="{{ route('auth.register') }}">Register</a></li>
                    <li><a role="button" data-toggle="modal" data-target="#login">Login</a></li>
                </ul>
                @include('frontend.auth.modals.login')
            @endif
        </div>
    </div>
</nav>