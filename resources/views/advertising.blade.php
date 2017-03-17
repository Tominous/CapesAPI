@extends('layouts.app')

@section('head')
<link href="{{ asset('css/pricing.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div id="generic_price_table">
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="price-heading clearfix">
                            <h1>Looking to advertise your website/service?</h1>
                            <h2>We gotcha bro.</h2>
                            <h4>
                                With 5k-10k+ calls a second, we have a unique advertising opportunity available for you.
                                <br/><br/>
                                It's simple, you make (or we can hire someone to make one for you for an extra cost) a
                                cape and we add it to our system.
                                <br/>
                                From there, all you do is wait. When someone calls the API, and if the user they are
                                trying to get a cape for does not have a cape, then an advertising cape is pulled from
                                the system. So the more capes you have, the higher chance of your capes being displayed.
                            </h4>
                            <br/><br/>
                            <small>
                                <i>Neither Halfpetal or CapesAPI do/will make any gurantee on success rate as this kind
                                of advertising is new and has no data to go off of.</i>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-1">
                        <div class="generic_content clearfix">
                            <div class="generic_head_price clearfix">
                                <div class="generic_head_content clearfix">
                                    <div class="head_bg"></div>
                                    <div class="head">
                                        <span>Platinum</span>
                                    </div>
                                </div>
                                <div class="generic_price_tag clearfix">
                                    <span class="price"><span class="sign">$</span> <span class="currency">30</span> <span class="cent">.00</span> <span class="month">/MON</span></span>
                                </div>
                            </div>
                            <div class="generic_feature_list">
                                <ul>
                                    <li>1 cape in the system.</li>
                                    <li>Listed on the advertisers page.</li>
                                    <li>Reach thousands of possible users every single day.</li>
                                    <li>Chance of displaying to 100+ people every second.</li>
                                </ul>
                            </div>
                            <div class="generic_price_btn clearfix">
                                <a href="mailto:hello@halfpetal.com">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-1">
                        <div class="generic_content clearfix">
                            <div class="generic_head_price clearfix">
                                <div class="generic_head_content clearfix">
                                    <div class="head_bg"></div>
                                    <div class="head">
                                        <span>Cape Additon</span>
                                    </div>
                                </div>
                                <div class="generic_price_tag clearfix">
                                    <span class="price"><span class="sign">+$</span> <span class="currency">10</span> <span class="cent">.00</span> <span class="month">/MON</span></span>
                                </div>
                            </div>
                            <div class="generic_feature_list">
                                <ul>
                                    <li>Requires a previous subscription.</li>
                                    <li>Add another cape in the system.</li>
                                    <li>Even higher chance of displaying to 100+ people every second.</li>
                                    <li>Support the development of CapesAPI even more.</li>
                                </ul>
                            </div>
                            <div class="generic_price_btn clearfix">
                                <a href="mailto:hello@halfpetal.com">Contact Us</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
