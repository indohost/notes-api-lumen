<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;

class NotesController extends Controller
{
    public function index()
    {
        try {
            $notes = Notes::all();

            return response()->json([
                'code'      => 200,
                'status'    => 'success',
                'data'      => $notes,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => $e->getMessage(),
            ], 400);
        }
    }

    public function store(Request $request)
    {
        $nt_title   = $request->nt_title;
        $nt_body    = $request->nt_body;
        $user_id    = $request->user_id;

        if (empty($nt_title) or empty($nt_body) or empty($user_id)) {
            return response()->json([
                'code'      => 400,
                'status'    => 'error',
                'message'   => 'You must fill all fields',
            ], 400);
        }

        try {
            $note           = new Notes();
            $note->nt_title = $nt_title;
            $note->nt_body  = $nt_body;
            $note->user_id  = $user_id;

            if ($note->save()) {
                return response()->json([
                    'code'      => 200,
                    'status'    => 'success',
                    'message'   => 'Note created successfully'
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
        $nt_title   = $request->nt_title;
        $nt_body    = $request->nt_body;

        try {
            $note           = Notes::findOrFail($id);
            $note->nt_title = $nt_title;
            $note->nt_body  = $nt_body;

            if ($note->save()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Note updated successfully'
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
            $note           = Notes::findOrFail($id);

            if ($note->delete()) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Note deleted successfully'
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
