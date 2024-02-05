<?php

namespace Tdwesten\StatamicBuilder\Contracts;

trait QueryScopes
{
    protected $queryScopes;

    public function queryScopes(array $queryScopes)
    {
        $this->queryScopes = $queryScopes;

        return $this;
    }
}
