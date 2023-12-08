<?php

namespace App\Repository\Rest;

class RepositoryUser extends RepositoryRestAbstract
{
    public function getByListId(array $userListId): array
    {
        return $this->client->call("user.get", [
            "ID" => $userListId
        ], 100);
    }

    public function isAdmin(): bool
    {
        $r = $this->client->call("user.admin");
        return $r['result'] ?? false;
    }
}