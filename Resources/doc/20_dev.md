# Documention for developers

## Routes list

* `cyberomulus_site_map_generator_index`:
    * Controller: `cyberomulus_site_map_generator.site_map.controller::displayIndex`
    * Path: `/sitemap.xml`
*  `cyberomulus_site_map_generator_site_map`
    * Controller: `cyberomulus_site_map_generator.site_map.controller::displaySiteMap`
    * Path: `/sitemap_{name}.xml`

## Services list

* `Cyberomulus\SiteMapGeneratorBundle\SiteMapProvidersCollection`
* `Cyberomulus\SiteMapGeneratorBundle\Command\ProvidersCommand`
* `cyberomulus_site_map_generator.site_map.controller`
    * Class: `Cyberomulus\SiteMapGeneratorBundle\Controller\SiteMapController`

## Parameters list

```yaml
cyberomulus_site_map_generator:
	defaults_values:
		url:
			last_modification_now
			change_frequence
			priority
		image: 
			title
			caption
			license		
```

## Git branches

The project use git flow.


- liste service, route, paraetre, ...

- branche git