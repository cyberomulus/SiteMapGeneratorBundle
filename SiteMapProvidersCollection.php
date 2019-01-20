<?php
/*
 * This file is part of the CyberomulusSiteMapGeneratorBundle package.
 *
 * (c) Brack Romain <http://www.cyberomulus.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cyberomulus\SiteMapGeneratorBundle;

/**
 * This class/service contain all SiteMapProvider
 *
 * @author	Brack Romain <http://www.cyberomulus.me>
 */
class SiteMapProvidersCollection
	{
	/**
	 * @var	array	Array of SiteMapProvider
	 */
	private $providers;
	
	/**
	 * @param	iterable	$providers
	 * 				List of services tagged 'cyberomulus_sitemapgenerator.sitemap_provider'.
	 * 				(Dynamically loaded)
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function __construct(iterable $providers)
		{
		$this->providers = array();
			
		foreach ($providers as $value)
			$this->providers[] = $value;
		}
	
	/**
	 * @return	iterable	List of sitemap providers
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function getProviders(): iterable
		{
		return $this->providers;
		}
	
	/**
	 * @param	string 		$name	The name of provider
	 * @return 	SiteMapProvider		The provider named by the argument, or null if the name don't exist
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function getProviderByName(string $name)
		{
		foreach ($this->providers as $provider)
			{
			if ($provider->getSiteMapName() == $name)
				return $provider;
			}
		
		return null;
		}
	}