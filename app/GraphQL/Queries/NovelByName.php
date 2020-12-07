<?php

namespace App\GraphQL\Queries;

class NovelByName
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return \App\Models\Novel::where("name", "like", "%" . $args['searchParam'] . "%")->get();
    }
}
