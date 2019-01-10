<?php
/*
 * This file is part of the CyberomulusSiteMapGeneratorBundle package.
 *
 * (c) Brack Romain <http://www.cyberomulus.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cyberomulus\SiteMapGeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Cyberomulus\SiteMapGeneratorBundle\SiteMapProvidersCollection;
use Cyberomulus\SiteMapGenerator\SiteMapIndex;
use Cyberomulus\SiteMapGenerator\Entries\SiteMapEntry;
use Cyberomulus\SiteMapGenerator\Formatter\XMLFormatter;

/**
 * Regroup all route of bundle
 * 
 * @author	Brack Romain <http://www.cyberomulus.me>
 */
class SiteMapController extends AbstractController
	{
	/**
	 * Route for display the sitemap index
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function displayIndex(SiteMapProvidersCollection $ProvidersCollection)
		{
		$index = new SiteMapIndex();
		
		foreach ($ProvidersCollection->getProviders() as $provider)
			{
			$url = $this->generateUrl('cyberomulus_site_map_generator_site_map',
									array('name' => $provider->cyberomulus_site_map_generator_site_map()));
				
			$index->addSiteMapEntry(new SiteMapEntry($url));
			}
		
		$formatter = new XMLFormatter();
		return new Response($formatter->formatSiteMapIndex($index));
		}
	
	/**
	 * Route for display a sitemap
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function displaySiteMap(string $name)
		{
		// FIXME create method
		return new Response("ok");
		}
	}