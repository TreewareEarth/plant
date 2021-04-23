# WIP

⚡️ This package is not ready to use. 


# What is this?

It's a bit like https://github.com/symfony/thanks, but it tries to solve a bigger problem! **The climate crisis.** 

Open Source can have positve impact on it. With treeware every donation it a motivation to work on Open Source code. 

The treeware idea is great, but it's not very visible. This package tries to solve it.


Install
---

Install this as any other (dev) Composer package:
```sh
$ composer require --dev treeware/plant
```

Add to your package composer.json
```json
{
    "extra": {
        "treeware": {
            "teaser": [
              "Your message to the users of your package to convince them.",
              "Multiple lines are possible, but make sure to keep it briefly."
            ],
            "prices": {
              "useful": "$15",
              "important": "$50",
              "critical": "$150"
            } 
        }
    }
}
```

Example

---

When others install or update your package using composer, a tiny reminder pops up.

```sh

$ composer require xxx/untitled2

Using version dev-master for xxx/untitled2
./composer.json has been updated
Running composer update xxx/untitled2
Loading composer repositories with package information
Updating dependencies
Generating autoload files


🌳 Treeware licence of xxx/untitled2 - A cool package
🌳 -------------------------------------------------------------------
🌳 The author of this open-source software cares about the climate crisis.
🌳 Using the software in a commercial project requires a donation:
🌳 ⤑ $5 (useful)
🌳 ⤑ $25 (important)
🌳 ⤑ $75 (critical)
🌳 Donate using this link: https://plant.treeware.earth/xxx/untitled2


```


