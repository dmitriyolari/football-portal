<?php

namespace App\Http\Controllers\Clients;

use App\DTO\Domain\CommentDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Comment\AnswerCommentRequest;
use App\Http\Requests\User\Comment\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\UserCommentAnswerNotification;
use App\Services\Comment\CommentAnswerService;
use App\Services\Comment\CommentCreateService;
use App\Services\Comment\CommentDeleteService;
use App\Services\Comment\CommentRestoreService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class CommentController extends Controller
{
    /**
     * @throws UnknownProperties
     */
    public function store(StoreCommentRequest $request, CommentCreateService $service, Post $post): RedirectResponse
    {
        $comment = array_merge($request->validated(), ['post_id' => $post->id()]);
        $comment = array_merge($comment, ['user_id' => Auth::user()->id()]);
        $service->create(new CommentDTO($comment));

        return redirect()->back();
    }

    /**
     * @throws Exception
     */
    public function delete(Comment $comment, CommentDeleteService $service): RedirectResponse
    {
        $service->delete($comment);
        session()->flash('success', 'Комментарий удален');

        return redirect()->back();
    }

    /**
     * @param Comment $comment
     * @param CommentRestoreService $service
     *
     * @return RedirectResponse
     */
    public function restore(Comment $comment, CommentRestoreService $service): RedirectResponse
    {
        $service->restore($comment);
        session()->flash('success', 'Комментарий восстановлен');

        return redirect()->back();
    }

    /**
     * @throws UnknownProperties
     */
    public function answer(Post $post, Comment $comment, AnswerCommentRequest $request, CommentAnswerService $service): RedirectResponse
    {
        $response = array_merge($request->validated(), ['post_id' => $post->id()]);
        $response = array_merge($response, ['user_id' => Auth::user()->id()]);
        $response = array_merge($response, ['parent_id' => $comment->id()]);

        $answerComment = $service->create(new CommentDTO($response));

        if (!($comment->user_id == $answerComment->user_id)) {
            $user_was_answered = User::find($comment->user_id);
            $user_answered = User::find($answerComment->user_id);
            Notification::send($user_was_answered, new UserCommentAnswerNotification($user_answered->name, $post));
        }

        session()->flash('success', 'Ответ к комментарию добавлен');

        return redirect()->back();
    }

}
