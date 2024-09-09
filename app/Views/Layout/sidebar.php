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
                <li class="dropdown <?= $active == 'Barang' || $active == 'Ruangan' ? 'show' : '' ?>">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-gear"></span><span class="mtext">Master Data</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('Admin/Barang') ?>"
                                class="<?= $active == 'Barang'  ? 'active' : '' ?>">Master Barang</a></li>
                        <li><a href="<?= base_url('Admin/Ruangan') ?>"
                                class="<?= $active == 'Ruangan'  ? 'active' : '' ?>">Ruangan</a></li>
                        <li><a href="<?= base_url('Admin/Satuan') ?>"
                                class="<?= $active == 'Satuan'  ? 'active' : '' ?>">Satuan</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('Admin/User') ?>"
                        class="dropdown-toggle no-arrow <?= $active == 'Users'  ? 'active' : '' ?>">
                        <span class="micon bi bi-person"></span>
                        <span class="mtext">Users
                            <img src="vendors/images/coming-soon.png" alt="" width="25" /></span>
                    </a>
                </li>

                <li class="dropdown <?= $active == 'waGateway' || $active == 'sendWa' ? 'show' : '' ?>">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-whatsapp"></span><span class="mtext">WA Gateway</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('Admin/waGateway') ?>"
                                class="<?= $active == 'waGateway'  ? 'active' : '' ?>">Setting</a></li>
                    </ul>
                </li>
                <li class="dropdown <?= $active == 'chatBot' || $active == 'chatBot' ? 'show' : '' ?>">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-chat-dots">
                        </span><span class="mtext">Chat Bot</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('Admin/chatBot') ?>"
                                class="<?= $active == 'chatBot'  ? 'active' : '' ?>">Lis Pertanyaan</a></li>
                    </ul>
                </li>

                <?php
                //  endif; 
                ?>

                <li class="dropdown <?= $active == 'Antrian' || $active == 'Scan' ? 'show' : '' ?>">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-card-checklist"></span><span class="mtext">Antrean</span>
                    </a>
                    <ul class="submenu">
                        <?php
                        if (session()->get('role') == 'Administrator'):
                        ?>
                        <li>
                            <a href="<?= base_url('Admin/Antrian') ?>"
                                class="<?= $active == 'Antrian'  ? 'active' : '' ?>">Daftar Antrean</a>
                        </li>
                        <?php endif; ?>

                        <li>
                            <a href="<?= base_url('Admin/Antrian/scan') ?>"
                                class="<?= $active == 'Scan'  ? 'active' : '' ?>">Scan QR Code</a>
                        </li>
                        <?php
                        if (session()->get('role') == 'Verifikator' || session()->get('role') == 'Administrator'):
                        ?>
                        <li>
                            <a href="<?= base_url('Admin/Antrian/List') ?>"
                                class="<?= $active == 'List'  ? 'active' : '' ?>">List Antrean</a>
                        </li>

                        <?php endif; ?>
                    </ul>
                </li>


                <li
                    class="dropdown <?= $active == 'laporan_antrean' || $active == 'laporan_data_siswa' ? 'show' : '' ?>">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-file-earmark-text">

                        </span><span class="mtext">Laporan</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="<?= base_url('Admin/Laporan/Antrean') ?>"
                                class="<?= $active == 'laporan-antrean '  ? 'active' : '' ?>">Laporan Antrean</a></li>
                        <li><a href="<?= base_url('Admin/laporan_siswa') ?>"
                                class="<?= $active == 'laporan_siswa'  ? 'active' : '' ?>">Laporan Siswa</a></li>
                    </ul>
                </li>

                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a href="https://ppdb.sman1pekalongan.sch.id" target="_blank" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-layout-text-window-reverse"></span>
                        <span class="mtext">Landing Page
                            <img src="vendors/images/coming-soon.png" alt="" width="25" /></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>