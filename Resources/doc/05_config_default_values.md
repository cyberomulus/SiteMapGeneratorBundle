# Configure default values

## The principle

The bundle is used to define defaults for parameters.

For example: If you want all your URLs to have the change_frequence attribute automatically set to the daily value, you can do this by specifying it with a configuration file and set it to null in your object.  
The default value will be set only if the object contains null.

```yaml
# config/packages/cyberomulus_site_map_generator.yaml

cyberomulus_site_map_generator:
    defaults_values:
        url:
            change_frequence: "daily"
```

```php
// src/Controller/BlogController.php

class BlogController extends AbstractController implements SiteMapProvider
{
	public function getUrlEntries(): iterable
	{
		return array(new URLEntry("http://..."));
	}
}
```

Return :

```xml
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc>http://...</loc>
		<changefreq>daily</changefreq>
	</url>
</urlset>
```

## The complete configuration

Configuration example :

```yaml
# config/packages/cyberomulus_site_map_generator.yaml

cyberomulus_site_map_generator:
    defaults_values:
        # Set the defaults values on url entries (false by default)
        url:
            # true for set a datetime at now if is null
            last_modification_now:         true
            # Set this frequence if is null (never | yearly | monthly | weekly | daily | hourly | always)
            change_frequence:     "weekly" # One of "never"; "yearly"; "monthly"; "weekly"; "daily"; "hourly"; "always"
            # Set this priority if is null (a float between 0.0 and 1.0)
            priority:             0.1
        # Set the defaults values on image entries
        image:
            # Set this title if is null
            title:                "A defaut title"
            # Set this caption if is null
            caption:              "A defaut caption"
            # Set this license if is null
            license:              "A defaut license"
```