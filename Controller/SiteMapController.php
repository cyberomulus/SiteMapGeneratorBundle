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

/**
 * Regroup all route of bundle
 * 
 * @author	Brack Romain <http://www.cyberomulus.me>
 */
class SiteMapController extends AbstractController
	{
	/**
	 * Route for display the sitemap index
	 */
	public function index()
		{
		return new Response("ok");
		}
	}