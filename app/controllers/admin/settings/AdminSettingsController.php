<?php

use Carbon\Carbon;
use Gorilla\Settings;

class AdminSettingsController extends AdminBaseController {

	public function index()
	{
		$timezones = array('UTC' => array('UTC' => 'UTC')) + $this->timezones();

		$settings = array();
		foreach (Settings::all() as $item)
		{
			$settings[$item->name] = $item->value;
		}

		if ($_POST)
		{
			foreach (Input::except('_token') as $name => $value)
			{
				$setting = Settings::find($name) ?: new Settings;
				$setting->name  = $name;
				$setting->value = $value;
				$setting->save();
			}

			Session::flash('notify_confirm', Lang::get('gorilla.messages.confirm'));
			return Redirect::route('admin_settings');
		}

		return View::make('admin.settings.index')->with('settings', $settings)->with('timezones', $timezones);
	}

	/**
	 * Get Timezones list
	 */
	protected function timezones()
	{
		$regions = array(
			'Africa'     => DateTimeZone::AFRICA,
			'America'    => DateTimeZone::AMERICA,
			'Antarctica' => DateTimeZone::ANTARCTICA,
			'Asia'       => DateTimeZone::ASIA,
			'Atlantic'   => DateTimeZone::ATLANTIC,
			'Australia'  => DateTimeZone::AUSTRALIA,
			'Europe'     => DateTimeZone::EUROPE,
			'Indian'     => DateTimeZone::INDIAN,
			'Pacific'    => DateTimeZone::PACIFIC
		);

		$timezones = array();
		foreach ($regions as $name => $mask)
		{
			$zones = DateTimeZone::listIdentifiers($mask);
			foreach($zones as $timezone)
			{
				$time = Carbon::now($timezone);
				$timezones[$name][$timezone] = str_replace('_', ' ', substr($timezone, strlen($name) + 1)) . ' - ' . $time->format('H:i') . ' ( '. $time->format('g:i a'). ' )';
			}
		}

		return $timezones;
	}

}