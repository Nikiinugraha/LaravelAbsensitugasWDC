<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"> <i class="bi bi-calendar-check text-white me-2"></i><b>Sistem Absensi Online</b></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-3">
                    <span class="nav-link text-white">
                        <i class="bi bi-person-badge"></i> Niki Nugraha
                    </span>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('presence.index') }}">
                            <i class="bi bi-gear"></i> Kelola Absensi
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="bi bi-box-arrow-in-right"></i> Login Admin
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>