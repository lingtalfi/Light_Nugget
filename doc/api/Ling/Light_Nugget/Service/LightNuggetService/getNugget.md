[Back to the Ling/Light_Nugget api](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget.md)<br>
[Back to the Ling\Light_Nugget\Service\LightNuggetService class](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService.md)


LightNuggetService::getNugget
================



LightNuggetService::getNugget — Returns the nugget identified by the given nuggetId and relPath.




Description
================


public [LightNuggetService::getNugget](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/getNugget.md)(string $nuggetId, string $relPath, ?array $options = []) : array




Returns the nugget identified by the given nuggetId and relPath.
See the [Light_Nugget conception notes](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/pages/conception-notes.md) for more details.


Available options are:

- varsKey: string=null, The key used to hold the variables (see the conception notes for more info).
     If false, the variable replacement system will not be used.
     If null, the varsKey will default to "_vars".




Parameters
================


- nuggetId

    

- relPath

    

- options

    


Return values
================

Returns array.


Exceptions thrown
================

- [Exception](http://php.net/manual/en/class.exception.php).&nbsp;







Source Code
===========
See the source code for method [LightNuggetService::getNugget](https://github.com/lingtalfi/Light_Nugget/blob/master/Service/LightNuggetService.php#L98-L128)


See Also
================

The [LightNuggetService](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService.md) class.

Previous method: [getNuggetByPath](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/getNuggetByPath.md)<br>Next method: [getNuggetDirective](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/getNuggetDirective.md)<br>

