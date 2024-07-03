@extends('layouts.app')
@extends('layouts.navbar')
@section('title', 'Home')

@section('content')
<body>
<div class="main">
    <div style="position: relative;">
        <img style="height: 100%; width: 100%;" src="{{asset('assets/images/background.jpg')}}" alt="background image">
        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; color: white; font-size: 24px;">
            <h1>Welcome to our platform!</h1>
            <p>We provide a space for designers to showcase their works and vendors to publish their products.</p>
        </div>
    </div>
</div>
</body>

@endsection
