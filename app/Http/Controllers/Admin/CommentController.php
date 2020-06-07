<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Models\PlaceComment;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends BaseAdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param PlaceComment $placeComment
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(PlaceComment $placeComment)
    {
        $comments = $placeComment->with('place')
                                 ->with('user')
                                 ->orderBy('created_at', 'DESC')
                                 ->paginate($this->list_item_count);

        $this->_assign('comments', $comments);

        return view('admin.comments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() { /* */ }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) { /* */ }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) { /* */ }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PlaceComment $comment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(PlaceComment $comment)
    {
        $comment = $comment->with('user')
                           ->with('place')
                           ->find($comment->id);

        $this->_assign('comment', $comment->toArray());

        return view('admin.comments.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CommentRequest $request
     * @param PlaceComment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CommentRequest $request, PlaceComment $comment)
    {
        $comment->fill($request->all());
        $comment->save();

        return redirect()->to(route('admin.comments.list'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PlaceComment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(PlaceComment $comment)
    {
        $comment::destroy($comment->id);
        return redirect()->back();
    }
}
