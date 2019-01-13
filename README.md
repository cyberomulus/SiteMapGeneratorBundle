# SiteMapGeneratorBundle

Generate a sitemap for your Symfony website (bridge for [cyberomulus/SiteMapGenerator](https://github.com/cyberomulus/SiteMapGenerator)

## Installation

### Applications that use Symfony Flex

Open a command console, enter your project directory and execute:

```console
$ composer require cyberomulus/sitemap-generator-bundle:1.*
```

### Applications that don't use Symfony Flex

#### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require cyberomulus/sitemap-generator-bundle:1.*
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

#### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new cyberomulus\phpToolboxBundle\CyberomulusSiteMapGeneratorBundle,
        );

        // ...
    }

    // ...
}
```

### Import the bundle routes

You must import the bundle routes.  
For this, copy these lines into your routes configuration file:

```yaml
# config/routes.yaml

cyberomulus_sitemapgenerator:
    resource: '@CyberomulusSiteMapGeneratorBundle/Resources/config/routes.xml'
```

## How to create a site map ?

All services and controllers can provide a sitemap.  
For that, it is enough that it implements the interface "Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider".

Sample with a controller :

```php
// src/Controller/BlogController.php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider;

class BlogController extends AbstractController implements SiteMapProvider
{
    
}
```

2 methods must be implemented:
* `getSiteMapName(): string`: must return the sitemap name (used for the route name and on url)
* `getSiteMapLastModification()`: must return the last modification, null for not use
* `getUrlEntries(): \Iterator`: must return an array of `Cyberomulus\SiteMapGenerator\Entries\URLEntry`
```

```php
// src/Controller/BlogController.php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider;
use Cyberomulus\SiteMapGenerator\Entries\URLEntry;

class BlogController extends AbstractController implements SiteMapProvider
{
    public function getSiteMapName(): string
    {
    	return "blog_sitemap";
    }
    
    public function getSiteMapLastModification()
    {
    	return null; // or a datetime object
    }
    
    public function getUrlEntries(): \Iterator
    {
    	$articles = ...; // get articles in doctrine
    	$urls = array();
    	
    	foreach ($articles as $art)
    		$urls[] = new SiteMapLEntry($this->generateUrl("blog_show", array('slug' => $art->getSlug())), 
    										$art->getLastMod());
    		// see doc of composer package cyberomulus/sitemap-generator for create a complete SiteMapLEntry 
    	
    	return $urls;
    }
    
    /**
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function show($slug)
    {
    	// a route
    }
}
```

It is now registered as sitemap, you can check it with the command `php bin/console cyberomulus:siteMapGenerator:providers`:

```console
$ php bin/console cyberomulus:siteMapGenerator:providers

+--------------+--- List of known sitemap providers: -------------------+
| Name         | Last modification date | Class                         |
+--------------+------------------------+-------------------------------+
| blog_sitemap | 2019-01-12 23:48:02    | App\Controller\BlogController |
+--------------+------------------------+-------------------------------+
```

And the sitemap index is available at the path : /sitemap.xml