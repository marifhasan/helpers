Installation
============

Official installation method is via composer and its packagist package [marifhasan/helpers](https://packagist.org/packages/marifhasan/helpers).

```
$ composer require marifhasan/helpers
```

Add below lines to composer.json
```
"autoload": {
	"files": [
		"vendor/marifhasan/helpers/src/math.php"
	]
},
```

Usage
=====

Available math short functions for your application use:

```
to_qty
to_amount
to_ordinal
to_number
to_closing
to_words
```
