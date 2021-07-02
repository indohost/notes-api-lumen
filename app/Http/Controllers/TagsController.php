<?php

namespace App\Http\Controllers;

use App\Models\Tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tags::all();

        return response()->json([
            'code'      => 200,
            'status'    => 'success',
            'data'      => $tags,
        ], 200);
    }

    public function store(Request $request)
    {
        $tag_title  = $request->tag_title;
        $nt_id      = $request->nt_id;

        if (empty($tag_title) or empty($nt_id)) {
            return response()->json([
                'code'      => 400,
                'status'    => 'error',
                'message'   => 'You must fill all fields',
            ], 400);
        }

        try {
            $tags               = new Tags();
            $tags->tag_title    = $tag_title;
            $tags->nt_id        = $nt_id;

            if ($tags->save()) {
                return response()->json([
                    'code'      => 200,
                    'status'    => 'success',
                    'message'   => 'Tag created successfully'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        $tag_title  = $request->tag_title;

        try {
            $tags           = Tags::findOrFail($id);
            $tags->tag_title    = $tag_title;

            if ($tags->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Tag updated successfully'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $tags           = Tags::findOrFail($id);

            if ($tags->delete()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Tag deleted successfully'
                ], 200);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
