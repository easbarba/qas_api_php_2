<?php

declare(strict_types=1);

namespace Tests\Core;

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

use Easbarba\QasApi\Core\Configs;

beforeEach(function () {
    $examplesFolder = realpath(dirname(__DIR__, 3).'/docs/examples');
    $this->configs = new Configs($examplesFolder);
    $this->anyConfig = $examplesFolder.DIRECTORY_SEPARATOR.'misc.json';
});

it('reads config', function () {
    $found = $this->configs->parseSingle($this->anyConfig)[0]->name;

    $this->assertEquals('awesomewm', $found);
});

it('finds configs pathnames', function () {
    $expected = ['misc' => 'misc.json', 'etc' => 'etc.json'];
    $found = $this->configs->filenames();

    $this->assertEquals($expected, $found);
});

it('no config found', function () {
    $this->configs = new Configs('anydir/that/do/not/exist');
    $all = $this->configs->filenames();

    $this->assertFalse($all);
});

it('single config', function () {
    $parsed = $this->configs->query('misc')->projects[1];

    $this->assertEquals('nuxt', $parsed->name);
});

it('random config', function () {
    $parsed = $this->configs->parseSingle($this->anyConfig)[2];

    $this->assertEquals('swift_format', $parsed->name);
});

it('gets all configs', function () {
    $expected = 'awesomewm';
    $found = $this->configs->allParsed()[0][0]->projects;

    $this->assertEquals($expected, $found[0]->name);
});
