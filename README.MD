Range form widget for October CMS!
======
![alt text](https://github.com/reg2005/oc-range/blob/master/image/scrn.jpg)

How to use:
======

##### 1. Just add into your plugin or project composer.json:

```javascript
{
    "require": {
        "reg2005/oc-range": "1.0.*"
    }
}
```
##### 2. Go to your october project directory use terminal, and run command:

> composer update

##### 3. Add to your Plugin.php this:
```php
    public function registerFormWidgets()
    {
        return [
            'reg2005\Widgets\Range\Widget' => [
                'label' => 'range',
                'code'  => 'range'
            ]
        ];
    }
```
ADD to your fields.yaml something like:
```yaml
money:
    customLabel: Price
    type: range
    default: 300
    minMax:
      min:
          - 50
      10%:
          - 500
          - 1000
      20%:
          - 1500
          - 2000
      50%:
          - 4000
          - 6000
      60%:
          - 6000
          - 10000
      max:
          - 10000
    span: full
```
OR:
```yaml
money:
    customLabel: Price
    type: range
    default: 300
    minMax:
    min: 50
    max: 1000
    span: full
```
