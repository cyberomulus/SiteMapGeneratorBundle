# How to create a site map ?

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

3 methods must be implemented:
* `getSiteMapName(): string`: must return the sitemap name (used for the route name and on url). The name must be URL friendly (use snake_case, see [issue #14](https://github.com/cyberomulus/SiteMapGeneratorBundle/issues/14)) 
* `getSiteMapLastModification()`: must return the last modification, null for not use
* `getUrlEntries(): \Iterator`: must return an array of `Cyberomulus\SiteMapGenerator\Entries\URLEntry`

```php
// src/Controller/BlogController.php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider;
use Cyberomulus\SiteMapGenerator\Entries\URLEntry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
    		$urls[] = new SiteMapLEntry(
    					$this->generateUrl("blog_show", 
    								array('slug' => $art->getSlug()),
    								// important use this argument
    								UrlGeneratorInterface::ABSOLUTE_URL), 
    					$art->getLastMod()
    					);
    		// see doc of composer package cyberomulus/sitemap-generator for create a complete SiteMapLEntry and include image for Google extra
    	
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

The controller is now registered as sitemap, the sitemap index is available at the path : /sitemap.xml