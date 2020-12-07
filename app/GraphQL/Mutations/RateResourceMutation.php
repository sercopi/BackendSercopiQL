<?php

namespace App\GraphQL\Mutations;

use App\Models\Comment;
use App\Models\Manga;
use App\Models\Novel;
use App\Models\Like;
use App\Models\User;


class RateResourceMutation
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return $this->rating($args["resourceType"], $args["resourceID"], $args["userID"], $args["rating"]);
    }

    public function rating($resourceType, $resourceID, $userID, $ratingNumber)
    {
        //de nuevo hay que desmarcar como requeridos los campos que lo asocian al recurso
        $resource = "";
        switch ($resourceType) {
            case ("novel"):
                $resource = Novel::where("id", $resourceID)->first();
                break;
            case ("manga"):
                $resource = Manga::where("id", $resourceID)->first();
                break;
            default:
                abort(404);
                break;
        }
        if ($rating = User::where("id", $userID)->first()->ratings()->where("ratingable_id", $resource->id)->first()) {
            $rating->update(["rating" => $ratingNumber]);
        } else {
            $rating = User::where("id", $userID)->first()->ratings()->create(["rating" => $ratingNumber]);
            $resource->ratings()->save($rating);
        }
        $resource->updateRating();

        return $resource;
    }
}
