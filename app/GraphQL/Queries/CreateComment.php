<?php

namespace App\GraphQL\Queries;

use App\Models\Manga;
use App\Models\Novel;
use App\Models\Comment;
use App\Models\User;

class CreateComment
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $comment = User::where("id", $args["userID"])->first()->comments()->create(["comment" => $args["comment"]]);
        $this->getResource($args["resourceType"], $args["resourceID"])->comments()->save($comment);
        return $comment;
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
