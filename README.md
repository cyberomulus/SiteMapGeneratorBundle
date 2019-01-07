# SiteMapGeneratorBundle
Generate a sitemap for your Symfony website

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

```php
<?php
// src/Controller/BlogController.php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider;

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
}
```