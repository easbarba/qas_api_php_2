<?php

declare(strict_types=1);

namespace Easbarba\QasApi\Core;

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

class Configs
{
    public function __construct(public string $configHome)
    {
        $this->configHome = $configHome;
    }

    /**
     * @param $filepath string
     *
     * @return array<int,Project>
     */
    public function parseSingle(string $filepath): array
    {
        $result = [];
        $files = file_get_contents($filepath);
        $projects = json_decode($files);

        foreach ($projects as $project) {
            $proj = new Project(name: $project->name, branch: $project->branch, url: $project->url);
            array_push($result, $proj);
        }

        return $result;
    }

    /**
     * @return string[]
     */
    public function filenames(): array|false
    {
        $result = [];

        if (!file_exists($this->configHome)) {
            return false;
        }

        $files = scandir($this->configHome, SCANDIR_SORT_DESCENDING);
        $checker = fn ($elm) => $elm !== ".." && $elm !== "." && $elm != 'README.md' && file_exists($this->configHome . "/" . $elm) && !(filesize($this->configHome . "/" . $elm) == 0);
        $filesFiltered = array_filter($files, $checker);

        foreach ($filesFiltered as $file) {
            $result[basename($file, '.json')] = $file;
        }

        return $result;
    }

    public function query(string $id): Config
    {
        $parent = $this->configHome . DIRECTORY_SEPARATOR;
        $allConfigs = $this->filenames();
        $result = [];

        return $result = new Config(lang: $id, projects: $this->parseSingle($parent . $allConfigs[$id]));
    }

    /**
     * @return array<int,array<string,string>>
     */
    public function allParsed(): array
    {
        $allConfigs = $this->filenames();
        $result = [];
        $parent = $this->configHome . DIRECTORY_SEPARATOR;

        foreach ($allConfigs as $key => $value) {
            $current =  $parent . $value;
            array_push($result, [new Config(lang: $key, projects: $this->parseSingle($current))]) ;
        }

        return $result;
    }
}
