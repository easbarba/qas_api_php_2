<?php

declare(strict_types=1);

namespace Easbarba\QasApi;

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

class ConfigsController
{
    public function index(): string
    {
        http_response_code(200);
        return json_encode(["message" => "GET", "action" => "index"]);
    }

    public function show(string $id): string
    {
        http_response_code(200);
        return json_encode(["message" => "GET", "action" => "show", "id" => $id]);
    }

    public function store(array $request): string
    {
        http_response_code(201);
        return json_encode(["message" => "POST", "action" => "store", "request" => $request]);
    }

    public function update(string $id, array $request): string
    {
        http_response_code(200);
        return json_encode(["message" => "PUT", "action" => "update", "id" => $id, "request" => $request]);
    }

    public function overwrite(string $id, array $request): string
    {
        http_response_code(200);
        return json_encode(["message" => "PUT", "action" => "update", "id" => $id, "request" => $request]);
    }

    public function destroy(string $id): string
    {
        http_response_code(204);
        return json_encode(["message" => "DELETE", "action" => "destroy", "id" => $id]);
    }
}
