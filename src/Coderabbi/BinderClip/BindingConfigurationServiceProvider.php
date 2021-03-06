<?php
/**
 * @author Yitzchok Willroth (@coderabbi) <coderabbi@gmail.com>
 * @copyright Yitzchok Willroth (@coderabbi) <coderabbi@gmail.com>
 * @license MIT <http://opensource.org/licenses/MIT>
 *
 * @package  Coderabbi\BinderClip
 */


namespace Coderabbi\BinderClip;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;


/**
 * Class BindingConfigurationServiceProvider
 *
 * @package Coderabbi\BinderClip
 *
 * @abstract
 */
abstract class BindingConfigurationServiceProvider
	extends ServiceProvider
{

	/**
	 * Configuration String
	 */
	const CONFIG_STRING = 'bindings';


	/**
	 * Service Provider Registration
	 *
	 * @access public
	 */
	public function register()
	{
		if ( ! empty(Config::get(self::CONFIG_STRING)))
		{
			$this->registerBindingGroups(Config::get(self::CONFIG_STRING));
		}
	}


	/**
	 * Register Application Binding Groups
	 *
	 * @access private
	 * @param array $groups
	 */
	private function registerBindingGroups(array $groups)
	{
		foreach ($groups as $bindings)
		{
			$this->registerBindings($bindings);
		}
	}


	/**
	 * Register Application Bindings
	 *
	 * @access private
	 * @param array $bindings
	 */
	private function registerBindings(array $bindings)
	{
		foreach ($bindings as $interface => $implementation)
		{
			$this->app->bind($interface, $implementation);
		}
	}

}
