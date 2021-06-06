<?php

namespace App\Http\Controllers;

use App\Rubric;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;

class RubricController extends Controller
{
    /**
     * Get users list subscribed to rubric
     *
     * @param $request Request
     * @param $rubricId string
     */
    public function usersList(Request $request, string $rubricId)
    {
        $rubric = Rubric::find($rubricId);
        $offset = $request->query('offset', 0);
        $limit = $request->query('limit', 10);
        $rubrics = $rubric->users()
            ->limit($limit)
            ->offset($offset)
            ->get();
        return new UserCollection($rubrics);
    }

}
