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

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * @author	Brack Romain <http://www.cyberomulus.me>
 */
class Configuration implements ConfigurationInterface
	{
	/**
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function getConfigTreeBuilder()
		{
		$treeBuilder = new TreeBuilder('cyberomulus_site_map_generator');
		
		$treeBuilder->getRootNode()
			->children()
				->arrayNode('defaults_values')
					->children()
						->arrayNode('url')
						->info("Set the defaults values on url entries")
							->children()
								->booleanNode('auto_connect')
									->info('true for set a datetime at now if is null (false by default)')
									->defaultFalse()
								->end()
								->enumNode('change_frequence')
									->info('Set this frequence if is null (never | yearly | monthly | weekly | daily | hourly | always)')
									->values(array('never', 'yearly', 'monthly', 'weekly', 'daily', 'hourly', 'always'))
								->end()
								->floatNode('priority')
									->info('Set this priority if is null (a float between 0.0 and 1.0)')
									->min(0.0)
									->max(1.0)
								->end()
							->end()
						->end()
						->arrayNode('image')
							->info("Set the defaults values on image entries")
							->children()
								->scalarNode('title')
									->info('Set this title if is null')
									->cannotBeEmpty()
								->end()
								->scalarNode('caption')
									->info('Set this caption if is null')
									->cannotBeEmpty()
								->end()
								->scalarNode('license')
									->cannotBeEmpty()
									->info('Set this license if is null')
								->end()
							->end()
						->end()
					->end()
				->end()
			->end();
		
		return $treeBuilder;
		}
	}