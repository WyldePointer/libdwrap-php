# libdwrap-php
A PHP library for querying a remote dwrap server. (So it does *NOT* do any DNS lookup on its own)

### Usage
```
require 'hugor.php';
require "libdwrap.php";

$lookup_array = array(
  "hostname" => "www.google.com",
  "json" => 1,
  "limit" => 3
);

$result = dwrap_do_a_lookup($lookup_array, "http://dwrap.local/api/");

var_dump($result);
```
Result:
```
string(52) "["74.125.232.243","74.125.232.240","74.125.232.244"]"
```

This library is using Hugor(https://github.com/WyldePointer/hugor) for sending HTTP request to the target dwrap server
so you need to `require()` that library *BEFORE* using any `dwrap_*()` functions.
