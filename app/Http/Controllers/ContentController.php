<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::where('status', 1)->latest()->paginate(10);
        return view('content', compact('contents'));
    }

    public function content_details($id)
{
    $content = Content::findOrFail($id);

    return view('detail-content', [
        'contentsTitle' => $content->title,
        'contentsDate' => $content->created_at->format('d/m/Y'),
        'contentsintroText' => $content->introtext,
        'contentsImage' => asset('uploads/contents/' . $content->image),
        'contentsfullText' => $content->fulltext,
    ]);
}


}
