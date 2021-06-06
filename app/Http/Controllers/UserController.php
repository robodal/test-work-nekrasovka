<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Resources\RubricCollection;

class UserController extends Controller
{

    /**
     * Get user api token
     *
     * @param $request Request
     */
    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::once($credentials) && Auth::user()->is_admin) {
            return response()->json([
                'success' => true,
                'data' => [
                    'token' => Auth::user()->createToken('admin')->plainTextToken,
                ],
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => [
                'Auth failed!',
            ],
        ]);
    }

    /**
     * Subscribe to rubric
     *
     * @param $userId string
     * @param $rubricId int
     */
    public function subscribe(string $userId, int $rubricId)
    {
        $user = User::firstWhere(is_numeric($userId) ? 'id' : 'email', $userId);
        $user->rubrics()->attach($rubricId);
        return response()->json(['success' => true]);
    }

    /**
     * Unsubscribe from rubric
     *
     * @param $userId string
     * @param $rubricId int
     */
    public function unsubscribe(string $userId, int $rubricId)
    {
        $user = User::firstWhere(is_numeric($userId) ? 'id' : 'email', $userId);
        $user->rubrics()->detach($rubricId);
        return response()->json(['success' => true]);
    }

    /**
     * Unsubscribe from all rubrics
     *
     * @param $userId string
     */
    public function forget(string $userId)
    {
        $user = User::firstWhere(is_numeric($userId) ? 'id' : 'email', $userId);
        $user->rubrics()->sync([]);
        return response()->json(['success' => true]);
    }

    /**
     * Get list of user's rubrics
     *
     * @param $request Request
     * @param $userId string
     */
    public function rubricsList(Request $request, string $userId)
    {
        $user = User::firstWhere(is_numeric($userId) ? 'id' : 'email', $userId);
        $offset = $request->query('offset', 0);
        $limit = $request->query('limit', 10);
        $rubrics = $user->rubrics()
                        ->limit($limit)
                        ->offset($offset)
                        ->get();
        return new RubricCollection($rubrics);
    }

}
