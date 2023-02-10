# Qas | API

Qas API built against PHP http library.

## Endpoints

| Method | Pattern       | Code | Action                           |
|--------|---------------|------|----------------------------------|
| GET    | /configs      | 200  | Fetches all configurations.      |
| GET    | /configs/bash | 200  | Fetch a single configuration.    |
| POST   | /configs      | 201  | Create a new configuration.      |
| PUT    | /configs/ruby | 200  | Overwrite a configuration.       |
| PATCH  | /configs/php  | 200  | Append project to configuration. |
| DELETE | /configs/java | 204  | Deletes a configuration.         |

## Port

Default port is at `:5000/VERSION`

## Configurations

`qas` looks for configuration files at `$XDG_CONFIGS/qas`:

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

The final response of bundled configurations output will look like this:

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

- config: branch defaults to master

## LICENSE

[GPL-v3](https://www.gnu.org/licenses/gpl-3.0.en.html)
