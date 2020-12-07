<?php

namespace App\GraphQL\Mutations;

use App\Models\Comment;
use App\Models\Manga;
use App\Models\Novel;
use App\Models\Like;
use App\Models\User;

class DeleteCommentMutation
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        Comment::where("user_id", $args["userID"])->where("id", $args["commentID"])->first()->delete();
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
