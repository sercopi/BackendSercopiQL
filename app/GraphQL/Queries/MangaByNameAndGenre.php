<?php

namespace App\GraphQL\Queries;

class MangaByNameAndGenre
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return \App\Models\Manga::where("name", "like", $args['name'])->where("genre", "like", $args["genre"])->orderBy("name", "asc")->get();
    }
}
