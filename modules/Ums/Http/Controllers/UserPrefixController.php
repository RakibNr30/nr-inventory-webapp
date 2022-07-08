<?php

namespace Modules\Ums\Http\Controllers;

use App\Http\Controllers\Controller;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Cms\Entities\CampaignInfluencer;
use Modules\Cms\Entities\Product;
use Modules\Ums\Entities\UserPrefix;

class UserPrefixController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:Common Settings']);
    }

    public function index()
    {
        $userPrefix = UserPrefix::query()->firstOrCreate([
            'id' => 1
        ]);

        return view('ums::user_prefix.index', compact('userPrefix'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'prefix' => 'required|max:255'
        ]);

        $data = $request->except(['_method', '_token']);
        $data['updated_by'] = auth()->user()->id;
        $data['updated_at'] = Carbon::now();

        $userPrefix = UserPrefix::query()->where('id', $id)->update($data);

        if ($userPrefix) {
            notifier()->success('Prefix updated successfully.');
        } else {
            notifier()->error('Prefix cannot be Updated.');
        }

        return redirect()->back();
    }
}
