<?php

namespace Modules\Dashboard\Http\Controllers\Web\V1;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Modules\Access\Entities\V1\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data = 'Hello';
        return view('dashboard::'.config('app.be_view').'.index', compact('data'));
    }
}
