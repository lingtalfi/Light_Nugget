[Back to the Ling/Light_Nugget api](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget.md)



The LightNuggetService class
================
2020-08-21 --> 2020-09-14






Introduction
============

The LightNuggetService class.



Class synopsis
==============


class <span class="pl-k">LightNuggetService</span>  {

- Properties
    - protected [Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) [$container](#property-container) ;

- Methods
    - public [__construct](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/__construct.md)() : void
    - public [setContainer](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/setContainer.md)([Ling\Light\ServiceContainer\LightServiceContainerInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerInterface.md) $container) : void
    - public [getNugget](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/getNugget.md)(string $nuggetId, string $relPath) : array
    - public [checkSecurity](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/checkSecurity.md)(array $nugget, ?array $params = []) : void
    - private [error](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/error.md)(string $msg) : void

}




Properties
=============

- <span id="property-container"><b>container</b></span>

    This property holds the container for this instance.
    
    



Methods
==============

- [LightNuggetService::__construct](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/__construct.md) &ndash; Builds the LightNuggetService instance.
- [LightNuggetService::setContainer](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/setContainer.md) &ndash; Sets the container.
- [LightNuggetService::getNugget](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/getNugget.md) &ndash; Returns the nugget identified by the given nuggetId and relPath.
- [LightNuggetService::checkSecurity](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/checkSecurity.md) &ndash; Check that the user is granted the permission to execute an action, and throws an exception if that's not the case.
- [LightNuggetService::error](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/Service/LightNuggetService/error.md) &ndash; Throws an exception.





Location
=============
Ling\Light_Nugget\Service\LightNuggetService<br>
See the source code of [Ling\Light_Nugget\Service\LightNuggetService](https://github.com/lingtalfi/Light_Nugget/blob/master/Service/LightNuggetService.php)



SeeAlso
==============
Previous class: [LightNuggetSecurityHandlerInterface](https://github.com/lingtalfi/Light_Nugget/blob/master/doc/api/Ling/Light_Nugget/SecurityHandler/LightNuggetSecurityHandlerInterface.md)<br>
