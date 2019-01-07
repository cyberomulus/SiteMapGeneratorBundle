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
 * This interface must be implemented by sitemap providers to self-declare
 * 
 * @author	Brack Romain <http://www.cyberomulus.me>
 */
interface SiteMapProvider
	{
	/**
	 * @return	string		The sitemap name (used for the route name and on url)
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function getSiteMapName(): string;
	
	/**
	 * @return	\DateTime	The last modification, null for not use
	 * 
	 * @author	Brack Romain <http://www.cyberomulus.me>
	 */
	public function getSiteMapLastModification();
	}