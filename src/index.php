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

// LOAD
require dirname(__DIR__) . "/vendor/autoload.php";

// ERRORS
// set_exception_handler("ErrorHandler::handleException");

// HEADERS
header('Content-Type: application/json; charset=utf-8');

// ROUTE
$router = new Router();
$router->route();
