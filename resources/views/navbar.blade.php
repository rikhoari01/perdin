<nav class="navbar">
    <div class="navbar-container">
        <div class="calendar">
            <i class="fa fa-calendar"></i>
            <span class="date">13 Agustus 2023</span>
        </div>
        <div class="user">
            <span class="username">{{ Auth::user()->name }}</span>
            <div class="user-img">
                <i class="fa fa-user"></i>
            </div>
        </div>
    </div>
</nav>