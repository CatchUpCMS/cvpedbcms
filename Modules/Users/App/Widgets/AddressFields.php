<?php namespace cms\App\Widgets\Address;

use cms\Infrastructure\Abstractions\Widgets\WidgetsAbstract;

/**
 * Class AddressFields
 * @package cms\App\Widgets\Address
 */
class AddressFields extends WidgetsAbstract
{

	/**
	 * @var string Widget title
	 */
	protected $title = 'Address fields';

	/**
	 * @var string Widget description
	 */
	protected $description = 'Display address input fields';

	/**
	 * @var string View namespace
	 */
	protected $view_prefix = null;

	/**
	 * @var string
	 */
	protected $module = null;

	/**
	 * @param string $prefix
	 * @param array  $attributes
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|mixed
	 */
	public function register($prefix = 'primary', $attributes = [])
	{
		return $this->output(
			'app.widgets.addressfields',
			[
				'prefix'       => $prefix,
				'address'      => $attributes['address'],
				'show_country' => array_key_exists('show_country', $attributes)
					? $attributes['show_country']
					: false,
				'show_state'   => array_key_exists('show_state', $attributes)
					? $attributes['show_state']
					: false
			]
		);
	}

}
