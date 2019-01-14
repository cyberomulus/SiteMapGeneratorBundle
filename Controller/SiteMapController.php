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
use Cyberomulus\SiteMapGenerator\SiteMap;
use Cyberomulus\SiteMapGenerator\Entries\URLEntry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Regroup all route of bundle
 * 
 * @author	Brack Romain <http://www.cyberomulus.me>
 */
class SiteMapController extends AbstractController
	{
	/**
	 * @var	SiteMapProvidersCollection	Service (defined in the constructor)
	 */
	private $providersCollection;
	
	/**
	 * @var iterable	config tree defaults_values
	 */
	private $configDefaultsValues;
	
	/**
	 * @param	SiteMapProvidersCollection	$providersCollection	Service
	 * @param	iterable					$configDefaultsValues	config tree defaults_values
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function __construct(SiteMapProvidersCollection $providersCollection, iterable $configDefaultsValues)
		{
		$this->providersCollection = $providersCollection;
		$this->configDefaultsValues = $configDefaultsValues;
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
									array('name' => $provider->getSiteMapName()),
									UrlGeneratorInterface::ABSOLUTE_URL);
				
			$index->addSiteMapEntry(new SiteMapEntry($url, $provider->getSiteMapLastModification()));
			}
		
		$formatter = new XMLFormatter();
		$response = new Response($formatter->formatSiteMapIndex($index));;
		$response->headers->set('Content-Type', 'xml');
		return $response;
		}
	
	/**
	 * Route for display a sitemap
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function displaySiteMap(string $name)
		{
		$provider = $this->providersCollection->getProviderByName($name);
		
		if (is_null($provider))
			throw $this->createNotFoundException("The sitemap '" . $name . "' don't exist.");
		
		$sitemap = new SiteMap(false);
		
		foreach ($provider->getUrlEntries() as $urlEntry)
			{
			if ($urlEntry instanceof URLEntry)
				{
				if ( (is_null($urlEntry->getLastModification()) == true) && ($this->configDefaultsValues["url"]["auto_connect"] == true) )
					$urlEntry->setLastModification(new \DateTime("now"));
				if ( (is_null($urlEntry->getChangeFrequence()) == true) && (is_null($this->configDefaultsValues["url"]["change_frequence"]) == false) )
					$urlEntry->setChangeFrequence($this->configDefaultsValues["url"]["change_frequence"]);
				if ( (is_null($urlEntry->getPriority()) == true) && (is_null($this->configDefaultsValues["url"]["priority"]) == false) )
					$urlEntry->setPriority($this->configDefaultsValues["url"]["priority"]);
				
				if (count($urlEntry->getGoogleImageEntries()) > 0)
					{
					$sitemap->setActivateGoogleExtra(true);
					
					foreach ($urlEntry->getGoogleImageEntries() as $imageEntry)
						{
						if ( (is_null($imageEntry->getTitle()) == true) && (is_null($this->configDefaultsValues["image"]["title"]) == false) )
							$imageEntry->setTitle($this->configDefaultsValues["image"]["title"]);
						if ( (is_null($imageEntry->getCaption()) == true) && (is_null($this->configDefaultsValues["image"]["caption"]) == false) )
							$imageEntry->setCaption($this->configDefaultsValues["image"]["caption"]);
						if ( (is_null($imageEntry->getLicense()) == true) && (is_null($this->configDefaultsValues["image"]["license"]) == false) )
							$imageEntry->setLicense($this->configDefaultsValues["image"]["license"]);
						}
					}
				
				$sitemap->addUrlEntry($urlEntry);
				}
			}
		
		$formatter = new XMLFormatter();
		$response = new Response($formatter->formatSiteMap($sitemap));
		$response->headers->set('Content-Type', 'xml');
		return $response;
		}
	}