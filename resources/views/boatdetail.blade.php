@php
$prefecture = \App\Models\Prefecture::where('url_param', $prefectureParam)->first();

$city = \App\Models\City::where('url_param', $cityParam)->first();

if (strlen($param) != 4 || substr($param, 0, 1) != 'b') {
header("Location: localhost:8000");
exit();
}

$boatId = substr($param, 1);
$boat = \App\Models\Boat::where('id', $boatId)->first();
$is_num_boatId = preg_match('/^[0-9]+$/', $boatId);


if ($prefecture && $city && $is_num_boatId && $boat ) {
$prefecture_name = $prefecture['prefecture_name'];
$city_name = $city['city_name'];
$boat_name = $boat['boat_name'];
} else {
header("Location: localhost:8000");
exit();
}

$lender = \App\Models\Lender::where('id', $boat['lender_id'])->first();

$port = \App\Models\Port::where('id', $lender['port_id'])->first();
$activitedCityParam = \App\Models\City:: where('id', $port['city_id'])->first();

$activitedCityParam = \App\Models\City:: where('id', $port['city_id'])->first();
if ($activitedCityParam['url_param'] != $cityParam) {
header("Location: localhost:8000");
exit();
}

$user = \App\Models\User::where('id', $lender['user_id'])->first();
$user_name = $user['name'];

$title = $boat_name.'('.$prefecture_name.$city_name.')の遊漁船/釣り船|遊漁船サーチ';
$description
=$boat_name.'は、'.$prefecture_name.$city_name.'の遊漁船/釣り船業者です。'.$prefecture_name.$city_name.'で遊漁船/釣り船をご依頼の場合は、'.$user_name.'がおすすめです。';
$keyword = $boat_name.',遊漁船,釣り船,遊漁船サーチ';
$h1 = $boat_name.'('.$prefecture_name.$city_name.')|遊漁船サーチ';
@endphp

<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ $title }}</title>
	<meta name="description" itemprop="description" content="{{ $description }}">
	<meta name="keywords" content="{{ $keyword }}">

	<link rel="stylesheet" href="{{ mix('css/app.css') }}">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
	{{-- Bootstrap CSS --}}
	<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
</head>

<body>
	<h1 style="display: none;">{{ $h1 }}</h1>
	<div id="app">
		<boatdetail-component />
	</div>
</body>
<script src="{{ mix('js/app.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- Bootstrap --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js">
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>
{{-- /Bootstrap --}}
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3"></script>
<link href="https://cdn.jsdelivr.net/npm/vue-loading-overlay@3/dist/vue-loading.css" rel="stylesheet">

</html>