<?php

namespace App\GraphQL\Queries;

class MangaByName
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return \App\Models\Manga::where("name", "like", $args['searchParam'] . "%")->get();
    }
}
