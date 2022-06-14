<?php
use App\Models\Translate;
use Carbon\Carbon;

function _TR_($key = '')
{
	$col = env('DEFAULT_LANGUAGE');
	if (!empty($_COOKIE['default_lang'])) {
		$col = $_COOKIE['default_lang'];
	}
	if (Auth::check() && !empty(Auth::user()->lang)) {
		$col = Auth::user()->lang;
	}
	$col = strtolower($col);
	$word = Translate::select($col)->where('lang_key', strtolower(str_replace(' ', '_', $key)))->first();
	if ($word == null) {
		Translate::insert(array('lang_key' => strtolower(str_replace(' ', '_', $key)),
	                            env('DEFAULT_LANGUAGE') => $key,
	                            'created_at' => Carbon::now(),
	                            'updated_at' => Carbon::now()));
		return $key;
	}
	return $word->{$col};
}
function GetCurrentLang()
{
	$lang = env('DEFAULT_LANGUAGE');
	if (!empty($_COOKIE['default_lang'])) {
		$lang = $_COOKIE['default_lang'];
	}
	if (Auth::check() && !empty(Auth::user()->lang)) {
		$lang = Auth::user()->lang;
	}
	return $lang;
}