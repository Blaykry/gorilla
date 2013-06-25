@extends('admin.base')

@section('content')
<div class="page-header">
	<div class="row">
		<div class="large-12 columns">
			<h3>{{ Lang::get('gorilla.settings.title') }}</h3>
		</div>
	</div>
</div>

{{ Form::alert('success', 'notify_confirm') }}

{{ Form::model($settings) }}

	<div class="row">
		<div class="large-3 columns">
			<label class="inline">@lang('gorilla.settings.fields.website_title')</label>
		</div>
		<div class="large-9 columns">
			{{ Form::text('website_title') }}
		</div>
	</div>
	<div class="row">
		<div class="large-3 columns">
			<label class="inline">@lang('gorilla.settings.fields.website_slogan')</label>
		</div>
		<div class="large-9 columns">
			{{ Form::text('website_slogan') }}
		</div>
	</div>
	<div class="row">
		<div class="large-3 columns">
			<label class="inline">@lang('gorilla.settings.fields.timezone')</label>
		</div>
		<div class="large-9 columns">
			{{ Form::select('timezone', $timezones) }}

			<br /><br />

			<div class="panel">
				<h6 class="subheader"><strong>{{ Lang::get('gorilla.settings.utc_time') }} :</strong> {{ Carbon\Carbon::now() }}</h6>
				<h6 class="subheader"><strong>{{ Lang::get('gorilla.settings.local_time') }} :</strong> {{ Carbon\Carbon::now(Gorilla\Settings::give('timezone')) }}</h6>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="large-9 large-offset-3 columns">
			{{ Form::save() }}
		</div>
	</div>

{{ Form::close() }}

@stop