
Install
---

Install this as any other (dev) Composer package:
```sh
$ composer require --dev ostark/plant
```

Add to your package composer.json
```json
{
    "extra": {
        "treeware": {
            "prices": {
              "useful": "$15",
              "important": "$50",
              "critical": "$150"
            } 
        }
    }
}
```

When others install or update your page using composer, a tiny reminder pops up.
