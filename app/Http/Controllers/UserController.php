<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Models\User;
use App\Traits\JsonResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use JsonResponses;

    public function index(Request $request)
    {
        $query = User::query();

        $perPage = $request->input('perPage', 10);
        $page = $request->input('page', 1);
        $offset = ($page - 1) * $perPage;

        $sortBy = $request->input('sortBy', 'id');
        $sortOrder = $request->input('sortOrder', 'asc');

        $search = $request->input('search', '');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('id', 'like', "%$search%");
            });
        }

        $total = $query->count();
        $data = $query->offset($offset)->limit($perPage)->orderBy($sortBy, $sortOrder)->get();

        return $this->successResponse("", ['data' => $data, 'total' => $total]);
    }

    public function me()
    {
        return $this->successResponse("", ["user" => Auth::user()]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->only(["name", "email", "password"]);
        $create = User::create($data);
        if (!$create) return $this->errorResponse("Unexpected problem occurred");

        return $this->successResponse("User added successfully", ["user" =>  $create]);
    }
}
