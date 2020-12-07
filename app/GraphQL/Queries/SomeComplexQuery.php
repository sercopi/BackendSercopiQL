<?php

namespace App\GraphQL\Queries;

class SomeComplexQuery
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // some complex query
        return \App\Models\Manga::where("name", "like", "%" . $args['searchParam'])->get();
    }
}
