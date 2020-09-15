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

- vars: bool=true, whether to use the variables replacement system. See more details in the [Light_Nugget conception notes](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/pages/conception-notes.md)




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
See the source code for method [LightNuggetService::getNugget](https://github.com/lingtalfi/Light_Nugget/blob/master/Service/LightNuggetService.php#L71-L107)


See Also
================

The [LightNuggetService](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService.md) class.

Previous method: [setContainer](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/setContainer.md)<br>Next method: [checkSecurity](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/checkSecurity.md)<br>

