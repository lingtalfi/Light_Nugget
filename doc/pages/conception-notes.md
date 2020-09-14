Light_Nugget, conception notes
============
2020-08-21 -> 2020-09-14




Summary
-------

- [The suggestion path](#the-suggestion-path)
- [Security recommendation](#security-recommendation)
- [A baked in security system for nugget users](#a-baked-in-security-system-for-nugget-users)



A service to fetch nuggets.



We provide a method to access your [nuggets](https://github.com/lingtalfi/Light/blob/master/personal/mydoc/pages/nomenclature.md#nugget):


- getNugget (string nuggetId, string relPath): array 


This method is based on naming conventions, and the nugget is stored in a [babyYaml](https://github.com/lingtalfi/BabyYaml) file.



- **nuggetId**: $plugin:$suggestionPath


With:

- $plugin: the plugin name (for instance Light_PluginABC)
    For security reasons, the double dot char (..) is not allowed.
    
- $suggestionPath: the suggestion path to the babyYaml file, relative to the **nuggetBaseDir** directory (see more details below).
    For security reasons, the double dot char (..) is not allowed.


- nuggetBaseDir: $app_dir/config/data/$plugin/$relPath/$suggestionPath.byml
- $app_dir: the path to the light application


So the concrete babyYaml file location is stored here:

- $nuggetBaseDir/$suggestionPath.byml


Usually, this method is used by a [provider service](https://github.com/lingtalfi/Light/blob/master/personal/mydoc/pages/nomenclature.md#provider-service-subscriber-service),
and so the subscriber provides the **nuggetId** (often via ajax), and the relPath is provided by the provider, and by convention it starts with the provider plugin name.


So for instance if we have an imaginary **Light_SuperList** provider plugin, let's imagine that plugin **Light_ABC** uses the **Light_SuperList**.

So it sends an ajax request, passing a nuggetId of: **Light_ABC:nugget_01**.

The request is then processed by the provider: **Light_SuperList**, which calls our **getNugget** method with a relPath of: **Light_SuperList/all** (for instance).

Therefore, in this case the complete path to the nugget file is: 

- $app_dir/config/data/Light_ABC/Light_SuperList/all/nugget_01.byml



The suggestion path
-------
2020-08-21


A suggestion path is basically a path that follows the [generated/custom pattern](https://github.com/lingtalfi/TheBar/blob/master/discussions/generated-custom-config-pattern.md).

So for instance, in the previous example the suggestion path was **nugget_01**.

If the suggestion path was: **nugget_01.generated** for instance, then the concrete nugget file would be searched in the following locations (in order):


- $app_dir/config/data/Light_ABC/Light_SuperList/all/nugget_01.custom.byml
- $app_dir/config/data/Light_ABC/Light_SuperList/all/nugget_01.generated.byml


  
Security recommendation
----------
2020-08-24


Plugin authors, remember that the **nuggetId** is often passed via ajax, and therefore anybody can change it.
Since there is a direct correlation between the suggested path and the actual file in the filesystem, we recommend
that you always call the **getNugget** method with a relPath argument that is not only your plugin's name, but also includes an extra subdirectory.

For instance, if your plugin name is **Light_ABC**, use **Light_ABC/items** (for instance) as your relPath instead of just **Light_ABC**.

That's because if your plugin ever uses other types of configuration files, you don't want the malicious user to access them just by using a malicious nuggetId.

In other words, use the **relPath** argument to define the chroot dir of your nuggets.

  


A baked in security system for nugget users
---------------
2020-09-14


As our service is becoming more popular, we provide a handy system for plugin authors to check whether a user is granted the action described in the nugget.


We basically use the [basic security nugget system](https://github.com/lingtalfi/TheBar/blob/master/discussions/basic-security-nugget.md), but we've also added some extra properties.

To use our security system, add the security directive to your nugget.


It takes the following properties:

- any: (same as the **basic security nugget system**)
- all: (same as the **basic security nugget system**)
- handler: string, the class name of a handler. It must implement our **LightNuggetSecurityHandlerInterface** interface.
    If it's **container** aware (i.e. if it implements [LightServiceContainerAwareInterface](https://github.com/lingtalfi/Light/blob/master/doc/api/Ling/Light/ServiceContainer/LightServiceContainerAwareInterface.md)), it will be passed the container.
    
    
If **any** or **all** are defined, they will be used as described in the **basic security nugget system**. In addition to that, 
if the handler is defined, it will be used to make an extra check.


Then, all you need to do is call the **checkSecurity** method of our service, which throws an exception if the user isn't granted the right to execute the action,
based on the security nugget configuration.    











