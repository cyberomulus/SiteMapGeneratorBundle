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
	 * Service (defined in the constructor)
	 * 
	 * @var SiteMapProvidersCollection
	 */
	private $providersCollection;
	
	/**
	 * @param	SiteMapProvidersCollection	$providersCollection	Service
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function __construct(SiteMapProvidersCollection $providersCollection)
		{
		$this->providersCollection = $providersCollection;
		}
		
	/**
	 * Route for display the sitemap index
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function displayIndex()
		{
		$index = new SiteMapIndex();
		
		foreach ($this->providersCollection->getProviders() as $provider)
			{
			$url = $this->generateUrl('cyberomulus_site_map_generator_site_map',
									array('name' => $provider->getSiteMapName()));
				
			$index->addSiteMapEntry(new SiteMapEntry($url, $provider->getSiteMapLastModification()));
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