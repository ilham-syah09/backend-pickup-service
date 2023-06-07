<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">PICKUP SERVICE</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">PCS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <!-- dashboard -->
            <li class="<?= ($this->uri->segment(2) == 'home') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/home'); ?>"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>

            <li class="menu-header">Master data</li>

            <li class="<?= ($this->uri->segment(2) == 'user') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/user'); ?>"><i class="fas fa-user"></i> <span>List User</span></a></li>

            <li class="<?= ($this->uri->segment(2) == 'ekspedisi') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/ekspedisi'); ?>"><i class="fas fa-list"></i> <span>List Ekspedisi</span></a></li>

            <li class="menu-header">Setting</li>

            <li class="<?= ($this->uri->segment(2) == 'setting') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/setting'); ?>"><i class="fas fa-cogs"></i> <span>Setting</span></a></li>

            <li class="menu-header">Data Paket</li>

            <li class="<?= ($this->uri->segment(2) == 'paket') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/paket'); ?>"><i class="fa fa-first-order"></i> <span>List Paket</span></a></li>
            <li class="<?= ($this->uri->segment(2) == 'progres') ? 'active' : ''; ?>"><a class="nav-link" href="<?= base_url('admin/progres'); ?>"><i class="fa fa-spinner"></i> <span>Progres Paket</span></a></li>

            <li class="menu-header"></li>

            <li class=""><a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>

        </ul>
    </aside>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Yakin untuk keluar dari halaman ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a class="btn btn-danger" href="<?= base_url('auth/logout'); ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    var url = window.location.href
    var parts = url.split("/")
    var route = parts[parts.length - 1]

    if (route) {
        var link = $('a[href*="/' + route + '"]');
        link.closest('ul').closest('li').addClass('active');
        link.parent('li').addClass('active');
    }
</script>