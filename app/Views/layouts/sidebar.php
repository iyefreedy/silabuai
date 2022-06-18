<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $active == 'home' ? 'active' : '' ?>">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <?php

    use App\Models\Room;

    if (in_groups('admin')) : ?>
        <li class="nav-item <?= $active == 'room-list' ? 'active' : '' ?>">
            <a class="nav-link" href="/admin/room-list">
                <i class="fas fa-fw fa-door-closed"></i>
                <span>Data Ruangan</span>
            </a>
        </li>
    <?php endif; ?>

    <?php if (in_groups('admin')) : ?>
        <li class="nav-item <?= $active == 'tool-list' ? 'active' : '' ?>">
            <a class="nav-link" href="/admin/tool-list">
                <i class="fas fa-fw fa-tools"></i>
                <span>Data Alat</span>
            </a>
        </li>
    <?php endif; ?>

    <?php if (in_groups('admin')) : ?>
        <li class="nav-item <?= $active == 'user-list' ? 'active' : '' ?>">
            <a class="nav-link" href="/admin/user-list">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Pemakai</span>
            </a>
        </li>
    <?php endif; ?>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Jadwal Pemakaian</span>
        </a>

        <?php
        $rooms = new Room();
        $rooms = $rooms->findAll();
        ?>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Jadwal Pemakaian</h6>
                <?php foreach ($rooms as $room) : ?>
                    <a class="collapse-item" href="/room/<?= $room['room_slug'] ?>"><?= $room['room_name'] ?></a>
                <?php endforeach ?>
            </div>
        </div>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->