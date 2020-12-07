<?php

namespace App\GraphQL\Mutations;

use App\Models\Comment;
use App\Models\Manga;
use App\Models\Novel;
use App\Models\Like;
use App\Models\User;

class DislikeCommentMutation
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $like = Like::where("user_id", $args["userID"])->where("comment_id", $args["commentID"])->first();
        is_null($like) ? Like::create(["user_id" => $args["userID"], "comment_id" => $args["commentID"], "like" => -1]) : $like->update(["like" => $like->like < 0 ? 0 : -1]);
        return $this->getResource($args["resourceType"], $args["resourceID"])->comments()->get();
    }
    function getResource($resourceType, $id)
    {
        switch ($resourceType) {

            case ("manga"):
                $resource = Manga::where("id", $id)->first();
                break;
            case ("novel");
                $resource = Novel::where("id", $id)->first();
                break;
            case ("comment");
                $resource = Comment::where("id", $id)->first();
                break;
            default:
                abort(404);
                break;
        }
        return $resource;
    }
}
