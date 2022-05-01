<nav class="main-header navbar navbar-expand navbar-light navbar-fixed">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a class="nav-link">
                {{ \App\Helpers\AuthManager::getRole()[0] }}
                <i class="fa fa-circle fa-cog text-primary fa-spin" style="font-size: 10px; position: absolute; right: 5px"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
<!--        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">15</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> 4 new messages
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>-->

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user-circle" style="font-size: 25px; margin-top: -3px;"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 200px;">
                <div class="dropdown-header text-left d-inline-block">
                    <div style="margin-top: 5px !important;">
                        @php
                            $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
                        @endphp
                        <div class="profile-user-img img-circle"
                             style="background-image: url({{ $user->avatar->file_url ?? ($user->additionalInfo->gender == 1 ?
                 config('core.image.default.avatar_male') :
                 config('core.image.default.avatar_female')) }})">

                        </div>
                        <span style="float: left; padding: 6px 10px; font-size: 16px; font-weight: bold;">{{ $user->additionalInfo->first_name ?? '' }} {{ $user->additionalInfo->last_name ?? '' }}</span>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <a href="/backend/profile/additional-info" class="dropdown-item">
                    Update Profile Info
                </a>
                <div class="dropdown-divider"></div>
                <a href="/backend/profile/account-info" class="dropdown-item">
                    Update Account Info
                </a>
                <div class="dropdown-divider"></div>
                <a href="/backend/profile/password-change" class="dropdown-item">
                    Password Change
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item dropdown-footer" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    <i class="fas fa-power-off mr-2"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
