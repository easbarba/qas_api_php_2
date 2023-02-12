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

use PHPUnit\Framework\TestCase;

use Easbarba\QasApi\Core\Configs;

final class ConfigsTest extends TestCase
{
    protected readonly string $anyConfig;
    protected readonly Configs $configs;

    protected function setUp(): void
    {
        $examplesFolder = __DIR__ . "/../../docs/examples";
        $this->configs = new Configs($examplesFolder);
        $this->anyConfig = $examplesFolder . DIRECTORY_SEPARATOR . "misc.json";
    }

    public function testReadConfig(): void
    {
        $found = $this->configs->parseSingle($this->anyConfig)[0]->name;

        $this->assertEquals("awesomewm", $found);
    }

    public function testConfigsFoundPathname(): void
    {
        $expected = ['misc' => "misc.json", 'etc' => 'etc.json'];
        $found = $this->configs->filenames();

        $this->assertSame($expected, $found);
    }

    public function testNoConfigFound(): void
    {
        $configs = new Configs("anydir/that/do/not/exist");
        $all = $configs->filenames();

        $this->assertFalse($all);
    }

    public function testSingleConfig(): void
    {
        $parsed = $this->configs->query("misc")->projects[1];

        $this->assertEquals('nuxt', $parsed->name);
    }


    public function testRandomConfig(): void
    {
        $parsed = $this->configs->parseSingle($this->anyConfig)[2];

        $this->assertEquals('swift_format', $parsed->name);
    }

    public function testAll(): void
    {
        $expected = 'awesomewm';
        $found = $this->configs->allParsed()[0][0]->projects;

        $this->assertEquals($expected, $found[0]->name);
    }
}
