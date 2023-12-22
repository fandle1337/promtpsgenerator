<?php

namespace App\Repository\Storage;

use App\Dto\DtoPortal;
use App\Model\ModelPortal;

class RepositoryPortal
{
    public function addOrUpdate(DtoPortal $dtoPortal)
    {
        return ModelPortal::updateOrCreate(
            ['domain' => $dtoPortal->domain],
            [
                'license'        => $dtoPortal->license,
                'lang'           => $dtoPortal->lang,
                'member_id'      => $dtoPortal->memberId,
                'access_token'   => $dtoPortal->accessToken,
                'refresh_token'  => $dtoPortal->refreshToken,
                'date_install'   => $dtoPortal->dateInstall,
                'date_uninstall' => $dtoPortal->dateUninstall,
            ]
        );
    }

    public function getByMemberId(string $memberId): DtoPortal|bool
    {
        $result = ModelPortal::where('member_id', $memberId)->first();

        if (!$result) {
            return false;
        }

        return new DtoPortal(
            $result->id,
            $result->domain,
            $result->lang,
            $result->license,
            $result->member_id,
            $result->access_token,
            $result->refresh_token,
            $result->date_install,
            $result->date_uninstall,
        );
    }

    public function getByDomain(string $domain): DtoPortal|bool
    {
        $result = ModelPortal::where('domain', $domain)->first();

        if (!$result) {
            return false;
        }
        return new DtoPortal(
            $result->id,
            $result->domain,
            $result->lang,
            $result->license,
            $result->member_id,
            $result->access_token,
            $result->refresh_token,
            $result->date_install,
            $result->date_uninstall,
        );
    }

    public function uninstallByDomain(string $domain): bool
    {
        return ModelPortal::where('domain', $domain)
            ->update(['date_uninstall' => date("Y-m-d H:i:s")]);
    }
}