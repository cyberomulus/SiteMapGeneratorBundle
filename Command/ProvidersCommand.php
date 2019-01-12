<?php
/*
 * This file is part of the CyberomulusSiteMapGeneratorBundle package.
 *
 * (c) Brack Romain <http://www.cyberomulus.me>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cyberomulus\SiteMapGeneratorBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Cyberomulus\SiteMapGeneratorBundle\SiteMapProvidersCollection;
use Symfony\Component\Console\Helper\Table;

/**
 * This command list all site map providers and their configrations
 * 
 * @author	Brack Romain <http://www.cyberomulus.me>
 */
class ProvidersCommand extends Command
	{
	/**
	 * @var		string		Name of command
	 */
	protected static $defaultName = 'cyberomulus:siteMapGenerator:providers';
	
	/**
	 * @var		SiteMapProvidersCollection	service (Dynamically loaded)
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	private $providersCollection;
	
	/**
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function __construct(SiteMapProvidersCollection $providersCollection)
		{
		$this->providersCollection = $providersCollection;
		
		parent::__construct();
		}
	
	/**
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	protected function configure()
		{
		$this->setDescription('ist all site map providers and their configrations.');
		}
	
	/**
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
		{
		if (count($this->providersCollection->getProviders()) == 0)
			{
			$output->writeln(["No declared sitemap provider.","See README.md to create one."]);
			return;
			}
			
		$table = new Table($output);
		$table->setHeaderTitle("List of known sitemap providers:");
		$table->setHeaders(array("Name", "Last modification date", "Class"));
		
		foreach ($this->providersCollection->getProviders() as $provider)
			{
			$table->addRow(array($provider->getSiteMapName(), 
								(is_null($provider->getSiteMapLastModification()) ? "null" : $provider->getSiteMapLastModification()->format('Y-m-d H:i:s')),
								get_class($provider)
								));
			}
		
		$table->render();
		}
	}