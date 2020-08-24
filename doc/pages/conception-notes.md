Light_Nugget, conception notes
============
2020-08-21 -> 2020-08-24




A service to fetch nuggets.



We provide a method to access your [nuggets](https://github.com/lingtalfi/Light/blob/master/personal/mydoc/pages/nomenclature.md#nugget):


- getNugget (string nuggetId, string relPath): array 


This method is based on naming conventions, and the nugget is stored in a [babyYaml](https://github.com/lingtalfi/BabyYaml) file.



- **nuggetId**: $plugin:$suggestionPath


With:

- $plugin: the plugin name (for instance Light_PluginABC)
- $suggestionPath: the suggestion path to the babyYaml file, relative to the **nuggetBaseDir** directory (see more details below)


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


  


