<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FetchPaginateRegistration extends Controller
{
    public static function fetchPaginate(Request $request) {
        
        $keyword    = null;
        $status     = null;
        $created_at = null;
        $form_refid = null;
        if((isset($request['keyword'])) && ($request['keyword'] !== '')) { $keyword = $request['keyword']; };
        if((isset($request['status'])) && ($request['status'] !== 'all')) { $status = $request['status']; };
        if((isset($request['created_at'])) && ($request['created_at'] !== 'all')) { $created_at = $request['created_at']; };
        if((isset($request['form_refid'])) && ($request['form_refid'] !== 'all')) { $form_refid = $request['form_refid']; };

        $source = DB::table("forms_submissions")
        ->when($keyword, function ($query, $keyword) {
            return $query->where("title", "like", "%" . $keyword . "%");
        })
        ->when($form_refid, function ($query, $form_refid) {
            return $query->where("form_refid", $form_refid);
        })
        ->when($status, function ($query, $status) {
            return $query->where("status", $status);
        })
        ->when($created_at, function ($query, $created_at) {
            return $query->whereDate("created_at", $created_at);
        })
        ->whereIn("form_refid", ["FRM-05122025114644-OUY", "FRM-05122025114650-SER"])
        ->paginate(25)
        ->toArray();
        $data   = $source['data'];
        $list   = [];

        foreach($data as $form) {
            $list[]   = [
                "form_refid"                => $form->form_refid,
                "form_submission_refid"     => $form->form_submission_refid,
                "title"                     => $form->title,
                "forms_data"                => json_decode($form->forms_data),
                "creator_refid"             => $form->creator_refid,
                "creator_name"              => $form->creator_name,
                "creator_email"             => $form->creator_email,
                "created_by"                => $form->created_by,
                "created_at"                => $form->created_at,
                "seen"                      => $form->seen,
                "status"                    => $form->status
            ];
        }

        $source['data'] = $list;

        return $source;
    }
}
