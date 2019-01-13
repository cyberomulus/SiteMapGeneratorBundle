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

## See too

* [Create your first sitemap](Resources/doc/01_create_sitemap.md)
* [Commands list](Resources/doc/10_commands.md)