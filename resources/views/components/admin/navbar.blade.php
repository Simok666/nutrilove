<div id="sidebar" class='active'>
    <div class="sidebar-wrapper active">
        <div class="sidebar-menu">
            <ul class="menu">
                <li class='sidebar-title'>Main Menu</li>
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
