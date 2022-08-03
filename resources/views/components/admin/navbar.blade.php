<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
                {{-- <li class="sidebar-item  ">
                    <a href="/admin" class='sidebar-link'>
                        <i data-feather="home" width="20"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>Admin</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="users" width="20"></i>
                        <span>User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="file" width="20"></i>
                        <span>Articles</span>
                    </a>
                </li>
                <li class="sidebar-item has-sub">
                    <a href="#" class='sidebar-link'>
                        <i data-feather="droplet" width="20"></i>
                        <span>Gizi</span>
                    </a>
                    <ul class="submenu active">
                        <li>
                            <a href="/admin/setting/landing-page">Riwayat Gizi Remaja</a>
                        </li>
                        <li>
                            <a href="/admin/setting/landing-page">Riwayat Gizi Anak</a>
                        </li>
                        <li>
                            <a href="/admin/setting/landing-page">Riwayat Gizi Balita</a>
                        </li>
                        <li>
                            <a href="/admin/setting/landing-page">Settings</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item active has-sub">

                    <a href="#" class='sidebar-link'>
                        <i data-feather="settings" width="20"></i>
                        <span>Setting</span>
                    </a>
                    <ul class="submenu active">
                        <li>
                            <a href="/admin/setting/landing-page">Landing Page</a>
                        </li>
                    </ul>
                </li> --}}
                @foreach ($menu ?? '' as $label => $item)
                    <li class="sidebar-item  {{ empty($item['childs']) ? '' : 'has-sub' }}">
                        <a href="{{ $item['url'] }}"
                            class='sidebar-link'>
                            <i data-feather="{{ $item["icon"] }}" width="20"></i>
                            <span>{{ $label }}</span>
                        </a>

                        @if (!empty($item['childs']))
                            <ul class="submenu">
                                @foreach ($item["childs"] as $labelChild => $child)
                                <li>
                                    <a href="{{ $child["url"] }}">{{ $labelChild }}</a>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
