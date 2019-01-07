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
use Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider;

/**
 * @author	Brack Romain <http://www.cyberomulus.me>
 */
class CyberomulusSiteMapGeneratorExtension extends Extension
	{
	public function load(array $configs, ContainerBuilder $container)
		{
		// Adds the tag on all services implementing the interface Cyberomulus\SiteMapGeneratorBundle\SiteMapProvider
		$container->registerForAutoconfiguration(SiteMapProvider::class)->addTag('cyberomulus_sitemapgenerator.sitemap_provider');
		}
	}

