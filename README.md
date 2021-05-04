# What is this?

It's a bit like [symfony/thanks](https://github.com/symfony/thanks), but it tries to tackle a bigger problem! **The climate crisis.** 

Open Source can have positive impact on it. With Treeware every donation is a motivation to work on Open Source code. 

The [Treeware idea](https://treeware.earth/about) is great, but it's not very visible. This package tries to solve it.


Install
---

Add this package as dependency to your package:

```sh
$ composer require treeware/plant
```

Add an `extra` attribute to your package composer.json that contains at least an empty `treeware` object:

A empty treeware extra object 
```json
{
    "extra": {
        "treeware": {}
    }
}
```

To change the default output, add your own `teaser` and `priceGroup`:
```json
{
    "extra": {
        "treeware": {
            "teaser": [
              "Your message to the consumers of your package to convince them.",
              "Multiple lines are possible, but not more than 3 lines and 200 characters."
            ],
            "priceGroups": {
              "useful": 100,
              "important": 250,
              "critical": 500
            } 
        }
    }
}
```



## Example

---

When others require or update your package using composer, a tiny reminder pops up.

```sh

$ composer require this/fancy-package

Using version dev-master for this/fancy-package
./composer.json has been updated
Running composer update this/fancy-package
Loading composer repositories with package information
Updating dependencies
Generating autoload files


🌳 Treeware licence of this/fancy-package - A cool package
🌳 -------------------------------------------------------------------
🌳 The author of this open-source software cares about the climate crisis.
🌳 Using the software in a commercial project requires a donation:
🌳 ⤑ 100 trees ≈ $17 (useful)
🌳 ⤑ 250 trees ≈ $42 (important)
🌳 ⤑ 500 trees ≈ $84 (critical)
🌳 Donate using this link: https://plant.treeware.earth/this/fancy-package

```


