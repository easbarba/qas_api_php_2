# Qas | API

Qas API built against PHP http library.

## Endpoints

| Method | Pattern       | Code | Action                           |
|--------|---------------|------|----------------------------------|
| GET    | /configs      | 200  | Fetches all configurations.      |
| GET    | /configs/bash | 200  | Fetch a single configuration.    |
| POST   | /configs      | 201  | Creates a new configuration.     |
| PUT    | /configs/ruby | 200  | Replaces a configuration.        |
| PATCH  | /configs/php  | 200  | Partially updates configuration. |
| DELETE | /configs/java | 204  | Deletes a configuration.         |

## Port

Default port is at `:5000/VERSION`

## Configurations

`qas` configuration files are arrays of JSON objects made up of:

- name of the project, 
- branch, optional(defaults to master), 
- URI.

All configuration files must be stored at `$XDG_CONFIGS/qas`:

$XDG_CONFIG/qas/misc.json

```json
[
  {
    "name": "awesomewm",
    "branch": "master",
    "url": "https://github.com/awesomeWM/awesome"
  },
  {
    "name": "nuxt",
    "branch": "main",
    "url": "https://github.com/nuxt/framework"
  },
  {
    "name": "swift_format",
    "branch": "main",
    "url": "https://github.com/apple/swift-format"
  }
]
```

## API Response Output

The final response of the bundled configurations structure is as follow:

- "lang" tag and its name,
- "projects" tag and its array of projects. 

```json
[
  {
    "lang": "misc",
    "projects": [
      {
        "name": "awesomewm",
        "branch": "master",
        "url": "https://github.com/awesomeWM/awesome"
      },
      {
        "name": "nuxt",
        "branch": "main",
        "url": "https://github.com/nuxt/framework"
      },
      {
        "name": "swift_format",
        "branch": "main",
        "url": "https://github.com/apple/swift-format"
      }
    ]
  },
  {
    "lang": "etc",
    "projects": [
      {
        "name": "juancrg90/clean-code-notes",
        "branch": "master",
        "url": "https://github.com/JuanCrg90/Clean-Code-Notes"
      },
      {
        "name": "github-gitignore",
        "branch": "main",
        "url": "https://github.com/github/gitignore"
      },
      {
        "name": "makefiletutorial",
        "branch": "gh-pages",
        "url": "https://github.com/theicfire/makefiletutorial"
      }
    ]
  }
]
```

## GNU Guix

To load all system dependencies, just run `guix shell`

## TODO

- project: branch defaults to master
- core/configs: methods to return a config object instead of array; 

## LICENSE

[GPL-v3](https://www.gnu.org/licenses/gpl-3.0.en.html)
