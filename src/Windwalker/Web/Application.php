<?php
/**
 * Part of formosa project. 
 *
 * @copyright  Copyright (C) 2011 - 2014 SMS Taiwan, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

namespace Windwalker\Web;

use Admin\AdminPackage;
use Front\FrontPackage;
use Windwalker\Core\Application\WebApplication;
use Windwalker\Core\Error\SimpleErrorHandler;
use Windwalker\Core\Package\PackageHelper;
use Windwalker\Core\Provider\AuthenticateProvider;
use Windwalker\Core\Provider\CacheProvider;
use Windwalker\Core\Provider\DatabaseProvider;
use Windwalker\Core\Provider\EventProvider;
use Windwalker\Core\Provider\LanguageProvider;
use Windwalker\Core\Provider\RouterProvider;
use Windwalker\Core\Provider\SessionProvider;
use Windwalker\Core\Provider\WhoopsProvider;
use Windwalker\DataMapper\DataMapper;
use Windwalker\DI\ServiceProviderInterface;
use Windwalker\Ioc;
use Windwalker\Registry\Registry;
use Windwalker\Uri\Uri;
use Windwalker\Windwalker;
use User\UserPackage;

/**
 * Class Application
 *
 * @since 1.0
 */
class Application extends WebApplication
{
	/**
	 * initialise
	 *
	 * @return  void
	 */
	protected function initialise()
	{
		Windwalker::prepareSystemPath($this->config);

		parent::initialise();

		if (!$this->config->get('system.debug'))
		{
			SimpleErrorHandler::registerErrorHandler();
		}

		// Start session
		Ioc::getSession();
	}

	/**
	 * loadProviders
	 *
	 * @return  ServiceProviderInterface[]
	 */
	public static function loadProviders()
	{
		return array(
			/*
			 * Default Providers:
			 * -----------------------------------------
			 * This is some default service providers, we don't recommend to remove them,
			 * But you can replace with yours, Make sure all the needed container key has
			 * registered in your own providers.
			 */
			'debug'    => new WhoopsProvider,
			'event'    => new EventProvider,
			'database' => new DatabaseProvider,
			'router'   => new RouterProvider,
			'lang'     => new LanguageProvider,
			'cache'    => new CacheProvider,
			'session'  => new SessionProvider,
			'auth'     => new AuthenticateProvider,

			/*
			 * Custom Providers:
			 * -----------------------------------------
			 * You can add your own providers here. If you installed a 3rd party packages from composer,
			 * but this package need some init logic, create a service provider to do this and register it here.
			 */

			// Custom Providers here...
		);
	}

	/**
	 * getPackages
	 *
	 * @return  array
	 */
	public function loadPackages()
	{
		/*
		 * Get Global Packages
		 * -----------------------------------------
		 * If you want a package can be use in every applications (for example: Web and Console),
		 * set it in Windwalker\Windwalker object.
		 */
		$packages = Windwalker::loadPackages();

		/*
		 * Get Packages for This Application
		 * -----------------------------------------
		 * If you want a package only use in this application or want to override a global package,
		 * set it here. Example: $packages[] = new Flower\FlowerPackage;
		 */

		// Your packages here...
		$packages['user'] = new UserPackage;

		return $packages;
	}

	/**
	 * Prepare execute hook.
	 *
	 * @return  void
	 */
	protected function prepareExecute()
	{
	}

	/**
	 * Pose execute hook.
	 *
	 * @return  mixed
	 */
	protected function postExecute()
	{
	}

	/**
	 * loadConfiguration
	 *
	 * @param Registry $config
	 *
	 * @throws  \RuntimeException
	 * @return  void
	 */
	protected function loadConfiguration(Registry $config)
	{
		Windwalker::loadConfiguration($config);
	}

	/**
	 * loadRoutingConfiguration
	 *
	 * @return  mixed
	 */
	protected function loadRoutingConfiguration()
	{
		return Windwalker::loadRouting();
	}
}
 