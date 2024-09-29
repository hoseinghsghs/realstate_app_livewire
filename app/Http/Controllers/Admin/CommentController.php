<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Flasher\Toastr\Prime\ToastrFactory;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::with('user')->latest()->paginate(15);
        return view('admin.page.comments.index', compact('comments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment, ToastrFactory $flasher)
    {
        $comment->update(['approved' => !$comment->approved]);
        if ($comment->rating) {
            $property = $comment->property;
            $avg = (int) round(($property->rating + $comment->rating) / 2);
            $property->update(['rating' => $avg]);
        }
        $flasher->addSuccess('وضعیت کامنت مورد نظر با موفقیت تغییر کرد');
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment, ToastrFactory $flasher)
    {
        $comment->delete();
        $flasher->addSuccess('کامنت با موفقیت حذف شد');
        return back();
    }
}
