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
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

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
		// Adds the tag on all services implementing the interface Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider
		$container->registerForAutoconfiguration(SiteMapProvider::class)->addTag('cyberomulus_sitemapgenerator.sitemap_provider');
		
		// Adds internals routes and services in container
		$loader = new XmlFileLoader($container,	new FileLocator(__DIR__.'/../Resources/config'));
		$loader->load('services.xml');
		}
	}

