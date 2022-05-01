@php
    $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
@endphp
<aside class="main-sidebar sidebar-dark-primary bg-black elevation-4">
    <a target="_blank" href="{{ url('/') }}" class="brand-link navbar-dark bg-black">
        <img src="{{ $global_site->favicon->file_url ?? config('core.image.default.favicon') }}" alt="Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: 1; background: #fff">
        <span class="brand-text font-weight-light">{{ $global_site->title }}</span>
    </a>
    <div class="sidebar">
        <div class="user-panel custom-user-image mt-3 pb-3 mb-3 d-flex">
            <div class="image elevation-2" style="background-image: url({{ $user->avatar->file_url ?? ($user->additionalInfo->gender == 1 ?
                 config('core.image.default.avatar_male') :
                 config('core.image.default.avatar_female')) }})">
            </div>
            <div class="info">
                <a href="{{ url('/backend/profile/additional-info') }}" class="d-block">
                    {{ $user->additionalInfo->first_name ?? '' }} {{ $user->additionalInfo->last_name ?? '' }}
                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-child-indent nav-flat flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if (auth()->check())
                    @php
                        $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
                    @endphp
                    @foreach(config('core.admin_menu') as $nav)
                        @if ($user->can($nav['permission']))
                            @if(empty($nav['children']))
                                <li class="nav-item">
                                    @if($nav['id'] == 'sign_out')
                                        <a href="{{ $nav['url'] }}" class="nav-link" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                            <i class="nav-icon fas {{ $nav['icon'] }}"></i>
                                            <p>
                                                {{ $nav['name'] }}
                                            </p>
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    @else
                                        <a href="{{ $nav['url'] }}" class="nav-link" >
                                            <i class="nav-icon fas {{ $nav['icon'] }}"></i>
                                            <p>
                                                {{ $nav['name'] }}
                                            </p>
                                        </a>
                                    @endif
                                </li>
                            @else
                                <li class="nav-item has-treeview">
                                    <a href="javascript:void(0)" class="nav-link">
                                        <i class="nav-icon fas {{ $nav['icon'] }}"></i>
                                        <p>
                                            {{ $nav['name'] }}
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @foreach($nav['children'] as $subNav)
                                            @if(empty($subNav['children']))
                                                <li class="nav-item">
                                                    <a href="{{ $subNav['url'] }}" class="nav-link">
                                                        <i class="fas {{ $subNav['icon'] }} nav-icon"></i>
                                                        <p>{{ $subNav['name'] }}</p>
                                                    </a>
                                                </li>
                                            @else
                                                <li class="nav-item has-treeview">
                                                    <a href="javascript:void(0)" class="nav-link">
                                                        <i class="nav-icon fas {{ $subNav['icon'] }}"></i>
                                                        <p>
                                                            {{ $subNav['name'] }}
                                                            <i class="right fas fa-angle-left"></i>
                                                        </p>
                                                    </a>
                                                    <ul class="nav nav-treeview">
                                                        @foreach($subNav['children'] as $superSubNav)
                                                            <li class="nav-item" style="margin-left: 10px">
                                                                <a href="{{ $superSubNav['url'] }}" class="nav-link">
                                                                    <i class="fas {{ $superSubNav['icon'] }} nav-icon"></i>
                                                                    <p>{{ $superSubNav['name'] }}</p>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach
                @endif
            </ul>
        </nav>
    </div>
</aside>
