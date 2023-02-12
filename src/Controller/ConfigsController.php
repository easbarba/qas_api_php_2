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

/**
 * @OA\Info(title="My First API", version="0.1")
 */
class ConfigsController implements ControllerInterface
{

    /**
     * @OA\Get(
     *     @OA\Response(
     *         response="200",
     *         description="Display all configurations"
     *     )
     * )
     */
    public function index(): string
    {
        return Responses::json(200, ["message" => "GET", "action" => "index"]);
    }

    /**
     * @OA\Get(
     *     @OA\Response(
     *         response="200",
     *         description="Display single configuration"
     *     )
     * )
     */
    public function show(string $id): string
    {
        $name = htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8') ?? 'World';
        return Responses::json(statusCode: 200, content: ["message" => "GET", "action" => "show", "id" => $id, "name" => $name]);
    }


    /**
     * @OA\Post(
     *     @OA\Response(
     *         response="201",
     *         description="Add new configuration"
     *     )
     * )
     */
    public function store(array $request): string
    {
        return Responses::json(201, ["message" => "POST", "action" => "store", "request" => $request]);
    }

    public function search(string $term): string
    {
        return Responses::json(200, ["message" => "GET", "action" => "show", "term" => $term]);
    }

    public function update(string $id, array $request): string
    {
        return Responses::json(200, ["message" => "PUT", "action" => "update", "id" => $id, "request" => $request]);
    }

    public function overwrite(string $id, array $request): string
    {
        return Responses::json(200, ["message" => "PUT", "action" => "update", "id" => $id, "request" => $request]);
    }

    /**
     * @OA\Delete(
     *     @OA\Response(
     *         response="204",
     *         description="The data"
     *     )
     * )
     */
    public function destroy(string $id): string
    {
        return Responses::json(204, ["message" => "DELETE", "action" => "destroy", "id" => $id]);
    }
}
