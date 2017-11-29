@extends('layouts.master')
@section('content')
    <!-- ================================== -->

    <!-- ///////////  BANNER  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="banner div-section" id="banner" style="background: url('{{ asset('uploads/cms/banner_img'. strchr($cms->banner_img,'.')) }}') no-repeat center center;">
        <div class="container text-center">
            <img class="img-fluid vertical-align absolute-centered" src="{{ asset('uploads/cms/banner_top_img'. strchr($cms->banner_top_img,'.')) }}" alt="Border Opportunities">
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  WHY THE BORDER?  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="the-border div-section" id="the-border">
        <div class="container light-spacing">
            <h1 class="heading">{!! isset($cms) ? $cms->about_title : '' !!}</h1>
            <p class="text gray">{{ isset($cms) ? $cms->about_text : '' }}</p>
            <div class="row">
                <div class="col">
                    <img class="img-fluid" src="{{ asset('uploads/cms/about_item_1_img'. strchr($cms->about_item_1_img,'.')) }}" alt="">
                    <div class="text-container">
                        <h2 class="smooth-transition">{{ isset($cms) ? $cms->about_item_1_title : '' }}</h2>
                        <p class="smooth-transition">{{ isset($cms) ? $cms->about_item_1_text : '' }}</p>
                    </div>
                </div>
                <div class="col">
                    <img class="img-fluid" src="{{ asset('uploads/cms/about_item_2_img'. strchr($cms->about_item_2_img,'.')) }}" alt="">
                    <div class="text-container">
                        <h2 class="smooth-transition">{{ isset($cms) ? $cms->about_item_2_title : '' }}</h2>
                        <p class="smooth-transition">{{ isset($cms) ? $cms->about_item_2_text : '' }}</p>
                    </div>
                </div>
                <div class="col">
                    <img class="img-fluid" src="{{ asset('uploads/cms/about_item_3_img'. strchr($cms->about_item_3_img,'.')) }}" alt="">
                    <div class="text-container">
                        <h2 class="smooth-transition">{{ isset($cms) ? $cms->about_item_3_title : '' }}</h2>
                        <p class="smooth-transition">{{ isset($cms) ? $cms->about_item_3_text : '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  HEXAGONS  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="hexagons background-cover" id="hexagons">
        <div class="hexagons-container spacing">
            <ul id="hexGrid">
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/1.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/2.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/3.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/4.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/5.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/6.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/7.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/8.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/9.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/10.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/11.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/12.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/1.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
                <li class="hex">
                    <div class="hexIn">
                        <a class="hexLink" href="#">
                            <img src="{{ asset('img/index/hexagons/2.png') }}" alt="" />
                            <h3>Aeroespacial</h3>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  DIRECTORY  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="directory" id="directory">
        <div class="container light-spacing">
            <h1 class="heading">{!! isset($cms) ? $cms->directory_title : '' !!}</h1>
            <div class="row">
                @foreach($directories as $key => $directory)
                    @if($key % 5 == 0)
                        <div class="w-100"></div>
                    @endif
                    <div class="col text-center"><img class="img-fluid" src="{{  asset('/uploads/cms/directories/'.$directory->directory_img) }}" alt=""></div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- ================================== -->

    <!-- ///////////  CONTACT  \\\\\\\\\\\ -->

    <!-- ================================== -->
    <div class="contact" id="contact">
        <div class="container spacing">
            <h1 class="heading white">{!! isset($cms) ? $cms->contact_title : '' !!}</h1>
            <p class="text white">{{ isset($cms) ? $cms->contact_text : '' }}</p>
            <div class="row cols-centered">
                <div class="col-sm-6 white">
                    <p>{{ isset($cms) ? $cms->contact_address : '' }}</p>
                </div>
                <div class="col-sm-6">
                    <form action="" method="POST">
                        <input type="text" name="name" placeholder="Name"><span class="bottom-line smooth-transition"></span>
                        <input type="email" name="email" placeholder="Email"><span class="bottom-line smooth-transition"></span>
                        <textarea name="msg" id="msg" cols="30" rows="7" placeholder="Message"></textarea><span class="bottom-line smooth-transition"></span>
                        <button type="submit" class="smooth-transition">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop