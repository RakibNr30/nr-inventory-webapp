<div class="card card-gray-dark card-outline">
    @if (auth()->check())
        <div class="card-body box-profile">
            @php
                $user = \Modules\Ums\Entities\User::find(auth()->user()->id);
            @endphp
            <div class="text-center">
                <div class="profile-user-img img-fluid img-circle"
                     style="background-image: url({{ $user->avatar->file_url ?? ($user->additionalInfo->gender == 1 ?
                     config('core.image.default.avatar_male') :
                     config('core.image.default.avatar_female')) }})">
                </div>
            </div>
            <h3 class="profile-username text-center">{{ $user->additionalInfo->first_name ?? '' }} {{ $user->additionalInfo->last_name ?? '' }}</h3>
            <p class="text-muted text-center">{{ $user->additionalInfo->designation ?? '' }}</p>
            <ul class="nav nav-pills flex-column">
                @foreach(json_decode(json_encode(config('core.profile_menu'))) as $profile_menu_key => $profile_menu)
                    @if ($user->can($profile_menu->permission))
                        <li class="nav-item {{ $profile_menu_key == ($active ?? '') ? 'bg-light' : '' }}">
                            <a href="{{ $profile_menu->url }}" class="nav-link"
                               style="padding: 10px; font-size: 16px; color: #212543;">
                                {{ $profile_menu->name }}
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif
</div>
