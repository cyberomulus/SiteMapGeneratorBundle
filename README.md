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
            new Cyberomulus\SiteMapGeneratorBundle\CyberomulusSiteMapGeneratorBundle(),
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
# config/routes/cyberomulus_site_map_generator.yaml

cyberomulus_sitemapgenerator:
    resource: '@CyberomulusSiteMapGeneratorBundle/Resources/config/routes.xml'
```

## See too

* [Create your first sitemap](Resources/doc/01_create_sitemap.md)
* [How to configure default values?](Resources/doc/05_config_default_values.md)
* [Commands list](Resources/doc/10_commands.md)

## Want more ?

#### You just have to ask

You can request a new function in [issue](https://github.com/cyberomulus/SiteMapGeneratorBundle/issues)

#### Contribute

Your pull requests are welcome!!  
The documentation for developers is [here](Resources/doc/20_dev.md)

## Contributors

* Cyberomulus

## License

This library is open-source software licensed under the [MIT license](http://opensource.org/licenses/MIT).