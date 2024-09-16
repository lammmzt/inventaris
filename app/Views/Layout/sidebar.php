<div class="left-side-bar">
    <div class="brand-logo">
        <a href="<?= base_url('Admin/Dashboard') ?>">
            <img src="<?= base_url('Assets/'); ?>LOGO SMANSA.png" alt="" class="dark-logo" />
            <img src="<?= base_url('Assets/'); ?>LOGO SMANSA.png" alt="" class="light-logo" />
            <style>
            .dark-logo {
                width: 50px;
                height: 50px;
            }

            .light-logo {
                width: 50px;
                height: 50px;
            }
            </style>
            PPDB
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li>
                    <a href="<?= base_url('Admin/Dashboard') ?>"
                        class="dropdown-toggle no-arrow <?= $active == 'Dashboard'  ? 'active' : '' ?>">
                        <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                    </a>
                </li>
                <?php
                // if (session()->get('role') == 'Admin'):
                ?>
                <li
                    class="dropdown <?= $active == 'Barang' || $active == 'detail_barang' || $active == 'Ruangan' ? 'show' : '' ?>">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-gear"></span><span class="mtext">Master Data</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('Admin/Barang') ?>"
                                class="<?= $active == 'Barang' || $active == 'detail_barang' ? 'active' : '' ?>">Master
                                Barang</a></li>
                        <li><a href="<?= base_url('Admin/Ruangan') ?>"
                                class="<?= $active == 'Ruangan'  ? 'active' : '' ?>">Ruangan</a></li>
                        <li><a href="<?= base_url('Admin/Satuan') ?>"
                                class="<?= $active == 'Satuan'  ? 'active' : '' ?>">Satuan</a></li>
                    </ul>
                </li>
                <li
                    class="dropdown <?= $active == 'ATK' || $active == 'Transaksi' || $active == 'ATK' ? 'show' : '' ?>">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-archive"></span><span class="mtext">ATK</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('Admin/ATK') ?>" class="<?= $active == 'ATK'  ? 'active' : '' ?>">Data
                                ATK
                            </a></li>
                        <li><a href="<?= base_url('Admin/ATK/Transaksi') ?>"
                                class="<?= $active == 'Transaksi'  ? 'active' : '' ?>">
                                Transakasi
                            </a></li>
                    </ul>
                </li>

                <li
                    class="dropdown <?= $active == 'Inventaris' || $active == 'Pengecekan' || $active == 'Inventaris' ? 'show' : '' ?>">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-box-seam">
                        </span><span class="mtext">Inventaris</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('Admin/Inventaris') ?>"
                                class="<?= $active == 'Inventaris'  ? 'active' : '' ?>">Data
                                Inventaris
                            </a></li>
                        <li><a href="<?= base_url('Admin/Inventaris/Pelaporan') ?>"
                                class="<?= $active == 'Pelaporan'  ? 'active' : '' ?>">
                                Pelaporan
                            </a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= base_url('Admin/User') ?>"
                        class="dropdown-toggle no-arrow <?= $active == 'Users'  ? 'active' : '' ?>">
                        <span class="micon bi bi-people"></span>
                        <span class="mtext">Users
                            <img src="vendors/images/coming-soon.png" alt="" width="25" /></span>
                    </a>
                </li>


                <?php
                //  endif; 
                ?>
                <li
                    class="dropdown <?= $active == 'laporan_transaksi' || $active == 'laporan_data_pengadaan' ? 'show' : '' ?>">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file-earmark-text">

                        </span><span class="mtext">Laporan</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('Admin/Laporan/transaksi') ?>"
                                class="<?= $active == 'laporan-transaksi '  ? 'active' : '' ?>">Laporan transaksi</a>
                        </li>
                        <li><a href="<?= base_url('Admin/laporan_pengadaan') ?>"
                                class="<?= $active == 'laporan_pengadaan'  ? 'active' : '' ?>">Laporan pengadaan</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <div class="dropdown-divider"></div>
                </li>

            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>