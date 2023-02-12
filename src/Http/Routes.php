<?php

declare(strict_types=1);

namespace Easbarba\QasApi\Http;

use Easbarba\QasApi\Controller\ControllerInterface;
use Easbarba\QasApi\Models\Config;
use Easbarba\QasApi\Models\Project;

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

class Routes
{
    /**
     * @param array<int,mixed> $parts
     */
    public function __construct(
        private Globals $globals,
        private string $method = "",
        private string $path = "",
        private array $parts = [],
        private string $version = "",
        private string $resource = "",
        private ?string $id  = "",
    ) {
        $this->method = $globals->requestMethod;
        $this->path = parse_url($globals->requestUri, PHP_URL_PATH);
        $this->parts = explode("/", $this->path);
        $this->version = $this->parts[1];
        $this->resource = $this->parts[2];
        $this->id = $this->parts[3] ?? null;
    }

    public function dispatch(ControllerInterface $controller): void
    {
        if (strcmp($this->resource, "configs") !== 0) {
            echo json_encode(["message" => "There is no such a resource, exiting!"]);
            exit;
        }

        $project = new Project(name: "httprouter", url: "https://github.com/julienschmidt/httprouter");
        $request = (array) new Config(lang: "misc", projects: [$project, $project]);

        switch ($this->method) {
        case "GET":
            $this->get($controller);
            break;
        case "POST":
            $this->post($controller, $request);
            break;
        case "PUT":
            $this->put($controller, $request);
            break;
        case "PATCH":
            $this->patch($controller, $request);
            break;
        case "DELETE":
            $this->delete($controller);
            break;
        default:
            $this->RespondMethodNotAllowed();
        }
    }

    // HTTP ACTIONS
    private function get(ControllerInterface $controller): void
    {
        if (isset($this->id)) {
            echo $controller->show($this->id);
        } else {
            echo $controller->index();
        }
    }

    /**
     * @param array<string,string> $request
     */
    private function post(ControllerInterface $controller, array $request): void
    {
        echo $controller->store($request);
    }

    /**
     * @param array<string,string> $request
     */
    private function patch(ControllerInterface $controller, array $request): void
    {
        echo $controller->overwrite($this->id, $request);
    }

    /**
     * @param array<string,string> $request
     */
    private function put(ControllerInterface $controller, array $request): void
    {
        echo $controller->update($this->id, $request);
    }

    private function delete(ControllerInterface $controller): void
    {
        echo $controller->destroy($this->id);
    }

    private function RespondMethodNotAllowed(): void
    {
        http_response_code(405);
        header("Allow: GET, POST, PUT, PATCH, DELETE");
    }
}
