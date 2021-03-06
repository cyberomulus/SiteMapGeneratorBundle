<?php
/*
 * This file is part of the CyberomulusSiteMapGeneratorBundle package.
 *
 * (c) Brack Romain <http://www.cyberomulus.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cyberomulus\SiteMapGeneratorBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider;

/**
 * @author	Brack Romain <http://www.cyberomulus.me>
 */
class CyberomulusSiteMapGeneratorExtension extends Extension
	{
	/**
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function load(array $configs, ContainerBuilder $container)
		{
		// load configuration
		$configuration = new Configuration();
		$config = $this->processConfiguration($configuration, $configs);
			
		// Adds the tag on all services implementing the interface Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider
		$container->registerForAutoconfiguration(SiteMapProvider::class)->addTag('cyberomulus_sitemapgenerator.sitemap_provider');
		
		// Adds internals services in container
		$loader = new XmlFileLoader($container,	new FileLocator(__DIR__.'/../Resources/config'));
		$loader->load('services.xml');
		
		// Adds parameters from config
		$container->setParameter("cyberomulus_site_map_generator.defaults_values.url.last_modification_now", 
			isset($config["defaults_values"]["url"]["last_modification_now"]) ? $config["defaults_values"]["url"]["last_modification_now"] : false );
		$container->setParameter("cyberomulus_site_map_generator.defaults_values.url.change_frequence",
			isset($config["defaults_values"]["url"]["change_frequence"])  ? $config["defaults_values"]["url"]["change_frequence"] : null );
		$container->setParameter("cyberomulus_site_map_generator.defaults_values.url.priority",
			isset($config["defaults_values"]["url"]["priority"]) ? $config["defaults_values"]["url"]["priority"] : null );
		$container->setParameter("cyberomulus_site_map_generator.defaults_values.image.title",
			isset($config["defaults_values"]["image"]["title"]) ? $config["defaults_values"]["image"]["title"] : null );
		$container->setParameter("cyberomulus_site_map_generator.defaults_values.image.caption",
			isset($config["defaults_values"]["image"]["caption"]) ? $config["defaults_values"]["image"]["caption"] : null );
		$container->setParameter("cyberomulus_site_map_generator.defaults_values.image.license",
			isset($config["defaults_values"]["image"]["license"]) ? $config["defaults_values"]["image"]["license"] : null );
		}
	}

