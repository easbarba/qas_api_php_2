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

class Router
{
    public function __construct(
        private ConfigsController $controller = new ConfigsController(),
        private string $method = "",
        private string $path = "",
        private array $parts = [],
        private string $version = "",
        private string $resource = "",
        private ?string $id  = ""
    ) {
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $this->parts = explode("/", $this->path);
        $this->version = $this->parts[1];
        $this->resource = $this->parts[2];
        $this->id = $this->parts[3] ?? null;
    }

    public function route(): void
    {
        if (strcmp($this->resource, "configs") !== 0) {
            echo json_encode(["message" => "There is no such a resource, exiting!"]);
            exit;
        }

        $request = [
        "lang"=> "meh",
                     "projects"=> [
                         "name"=> "httprouter",
                         "branch"=> "master",
                         "url"=> urlencode("https://github.com/julienschmidt/meeh")
                     ]
        ];

        switch ($this->method) {
        case "GET":
            if (isset($this->id)) {
                echo $this->controller->show($this->id);
            } else {
                echo $this->controller->index();
            }
            break;
        case "POST":
            echo $this->controller->store($request);
            break;
        case "PUT":
            echo $this->controller->update($this->id, $request);
            break;
        case "PATCH":
            echo $this->controller->overwrite($this->id, $request);
            break;
        case "DELETE":
            echo $this->controller->destroy($this->id);
            break;
        default:
            http_response_code(404);
            break;
        }
    }
}
