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
                            <h1>Are you an alternate account provider?</h1>
                            <h3>We're opening up a custom service to guarantee every account you have has a cape on it.</h3>
                            <h3>It's as simple as contacting us, and we'll set you up.</h3>
                            <br/><br/>
                            <i>
                                To have this service, you must have at least 1k accounts in your possession and you must
                                be running a legitimate service such as MCLeaks and own an email with the domain (or have
                                some other way of verifying your identity), if you are a reseller (such as Fiverr
                                reselling) you will not get a response back.
                            </i>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="generic_content clearfix">
                            <div class="generic_head_price clearfix">
                                <div class="generic_head_content clearfix">
                                    <div class="head_bg"></div>
                                    <div class="head">
                                        <span>Starter</span>
                                    </div>
                                </div>
                                <div class="generic_price_tag clearfix">
                                    <span class="price"><span class="sign">$</span> <span class="currency">15</span> <span class="cent">.00</span> <span class="month">/MON</span></span>
                                </div>
                            </div>
                            <div class="generic_feature_list">
                                <ul>
                                    <li>1,000 Accounts</li>
                                    <li>No API Limits</li>
                                    <li>No Usage Limits</li>
                                </ul>
                            </div>
                            <div class="generic_price_btn clearfix">
                                <a href="mailto:hello@halfpetal.com">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="generic_content clearfix">
                            <div class="generic_head_price clearfix">
                                <div class="generic_head_content clearfix">
                                    <div class="head_bg"></div>
                                    <div class="head">
                                        <span>Gold</span>
                                    </div>
                                </div>
                                <div class="generic_price_tag clearfix">
                                    <span class="price"><span class="sign">$</span> <span class="currency">30</span> <span class="cent">.00</span> <span class="month">/MON</span></span>
                                </div>
                            </div>
                            <div class="generic_feature_list">
                                <ul>
                                    <li>3,000 Accounts</li>
                                    <li>No API Limits</li>
                                    <li>No Usage Limits</li>
                                </ul>
                            </div>
                            <div class="generic_price_btn clearfix">
                                <a href="mailto:hello@halfpetal.com">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="generic_content clearfix">
                            <div class="generic_head_price clearfix">
                                <div class="generic_head_content clearfix">
                                    <div class="head_bg"></div>
                                    <div class="head">
                                        <span>Diamond</span>
                                    </div>
                                </div>
                                <div class="generic_price_tag clearfix">
                                    <span class="price"><span class="sign">$</span> <span class="currency">50</span> <span class="cent">.00</span> <span class="month">/MON</span></span>
                                </div>
                            </div>
                            <div class="generic_feature_list">
                                <ul>
                                    <li>5,000 Accounts</li>
                                    <li>No API Limits</li>
                                    <li>No Usage Limits</li>
                                </ul>
                            </div>
                            <div class="generic_price_btn clearfix">
                                <a href="mailto:hello@halfpetal.com">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="generic_content clearfix">
                            <div class="generic_head_price clearfix">
                                <div class="generic_head_content clearfix">
                                    <div class="head_bg"></div>
                                    <div class="head">
                                        <span>Custom</span>
                                    </div>
                                </div>
                                <div class="generic_price_tag clearfix">
                                    <span class="price"><span class="currency"></span><span class="cent">Negotiable</span></span>
                                </div>
                            </div>
                            <div class="generic_feature_list">
                                <ul>
                                    <li>6,000+ Accounts</li>
                                    <li>No API Limits</li>
                                    <li>No Usage Limits</li>
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
