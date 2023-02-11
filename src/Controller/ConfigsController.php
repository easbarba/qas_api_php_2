<?php

declare(strict_types=1);

namespace Easbarba\QasApi\Controller;

use Easbarba\QasApi\Utils\Responses;

/*
 * Qas is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Qas is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Qas. If not, see <https://www.gnu.org/licenses/>.
 */

class ConfigsController implements ControllerInterface
{
    public function index(): string
    {
        return Responses::json(200, ["message" => "GET", "action" => "index"]);
    }

    public function show(string $id): string
    {
        return Responses::json(200, ["message" => "GET", "action" => "show", "id" => $id]);
    }

    public function store(array $request): string
    {
        return Responses::json(201, ["message" => "POST", "action" => "store", "request" => $request]);
    }

    public function update(string $id, array $request): string
    {
        return Responses::json(200, ["message" => "PUT", "action" => "update", "id" => $id, "request" => $request]);
    }

    public function overwrite(string $id, array $request): string
    {
        return Responses::json(200, ["message" => "PUT", "action" => "update", "id" => $id, "request" => $request]);
    }

    public function destroy(string $id): string
    {
        return Responses::json(204, ["message" => "DELETE", "action" => "destroy", "id" => $id]);
    }
}
