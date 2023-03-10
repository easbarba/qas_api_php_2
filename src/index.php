<?php

declare(strict_types=1);

namespace Easbarba\QasApi;

use Easbarba\QasApi\Controller\ConfigsController;
use Easbarba\QasApi\Http\Globals;
use Easbarba\QasApi\Http\Routes;

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

// INITIAL LOADING
require dirname(__DIR__).'/vendor/autoload.php';

// ERRORS
// set_exception_handler("ErrorHandler::handleException");

// HEADERS
header('Content-Type: application/json; charset=utf-8');

// // ROUTES AND HANDLERS
$controller = new ConfigsController();
$globals = new Globals();
$router = new Routes($globals);
$router->dispatch($controller);
