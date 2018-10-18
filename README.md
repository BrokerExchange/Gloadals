# Gloadals
Load simple variables into the PHP global scope using an "ini" file.

This is meant to be quick for installation and usage.  

Currently, the only variable types available for loading are: single-depth arrays (associative and numeric) and scalar. 

Obviously, care should be taken when loading any variables into the global scope, if and when possible -- don't use 
globals!  Please take care to not overwrite other global variables. You have been forewarned, and you will assume use of
this code at your own risk.

# License

This project is licensed under the terms of the MIT license. See the included "License.txt" for more information.

# Usage

For the purpose of this demonstration, the ini file shall be called: '.gload.ini', but you can use a different file 
name, if you would like. 

## 1 - install package via composer and require autoload

```
composer require brokerexchange/gloadals 
```

## 2 - require composer autoload

```  
require_once(<PATH_TO_VENDOR_DIRECTORY> . '/vendor/autoload.php' );
```

## 3 - option (a) - Setup ini file ('.gload.ini')

```
;simple (one level deep maximum)
associative_array1[associative_index1] = "test_value1"  
associative_array1[associative_index2] = test_value2  
numeric_array1[] = "test_value3"  
scalar = test_value4

;multidimensional (up to two levels deep maximum)
[multidimensional]
levelone[leveltwo] = "testing"
levelone[another_leveltwo] = "testing testing"
levelone[yet_another_leveltwo] = "testing"  
```

## 3 - option (b) - Setup php file ('.gload.php')

```
<?php

/* Can load associative arrays many-levels deep */
$associative_array = [
    'a_name1' => 'a_value1',
    'a_name2'=> 'a_value2',
    'a_name3' => 'a_value3',
    'a_name4' => [
        'leveltwo' => [
            'levelthree' => 'a_value4'
        ]
    ]
];

$numeric_array['n_name'] = ['value1','value2','value3'];

$scalar = [
    's_name1' => 's_value1',
    's_name2' => 's_value2',
    's_name3' => 's_value3'
];
```

 
## 4 - use and load the Gloadals class

```
use BrokerExchange\Gloadals

.
.
.
 
//(a) ini
Gloadals::load( <PATH_TO_INI_FILE> . '/.gload.ini' );

//(b) php
Gloadals::load( <PATH_TO_FILE> . '/.gload.php', 'php');
```

## 5 - use the GLOBALS variables

```print_r($GLOBALS);```


(a) When loading via ini format:
```...
    .
    .
    .
    [associative_array1] => Array
        (
            [associative_index1] => test_value1
            [associative_index2] => test_value2
        )

    [numeric_array1] => Array
        (
            [0] => test_value3
        )

    [scalar] => test_value4
            
    [multidimensional] => Array
        (
            [levelone] => Array
                (
                    [leveltwo] => testing
                    [another_leveltwo] => testing testing
                    [yet_another_leveltwo] => testing
                )

        )        
)
```

(b) When loading via php format:
```
    [a_name1] => a_value1
    [a_name2] => a_value2
    [a_name3] => a_value3
    [a_name4] => Array
        (
            [leveltwo] => Array
                (
                    [levelthree] => a_value4
                )

        )

    [n_name] => Array
        (
            [0] => Array
                (
                    [0] => n_value1
                    [1] => n_value2
                    [2] => n_value3
                )

        )

    [s_name1] => s_value1
    [s_name2] => s_value2
    [s_name3] => s_value3
```