@extends('layouts.default')

@section('title', 'Blog - tanteng.me')
@section('description', '小谈博客是一个关注WEB开发的技术博客，这里有PHP的基础知识和技术实践，学习Laravel、ThinkPHP、Yii 2等开发框架，包括MySQ,Redis,memcache等数据库和缓存技术，还有Linux服务器方面的知识，Nginx配置优化，负载均衡等等。')
@section('canonical', 'http://www.tanteng.me/blog')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-1">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <a href="http://blog.tanteng.me/2016/03/aliyun-centos-7-swap/">
                            <img src="http://static.blog.tanteng.me/wp-content/uploads/2016/03/linux.jpg" alt="创建swap分区">
                            <div class="carousel-caption">在阿里云CentOS 7创建swap分区</div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="http://blog.tanteng.me/2016/03/aliyun-centos-7-swap/">
                            <img src="http://static.blog.tanteng.me/wp-content/uploads/2016/03/nginx_load.jpg" alt="Nginx性能调优">
                            <div class="carousel-caption">Nginx性能调优之buffer参数设置</div>
                        </a>
                    </div>
                    <div class="item">
                        <a href="http://blog.tanteng.me/2016/03/redis-maxmemory/">
                            <img src="http://static.blog.tanteng.me/wp-content/uploads/2016/03/redis-logo.jpg" alt="设置Redis">
                            <div class="carousel-caption">设置Redis最大占用内存</div>
                        </a>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        @foreach($newPosts as $post)
        <div class="col-md-4 col-md-offset-1">
            <h3><a href="{{ $post->url }}" target="_blank">{{ $post->post_title }}</a></h3>
            <span>{{ $post->post_date }} | @if($post->main_category) {{ $post->main_category }} @endif</span>
        </div>
        @endforeach
    </div>

    <div class="row text-center margin-top15">
        <a class="btn btn-default" href="http://blog.tanteng.me/page/2" role="button">更多</a>
    </div>
</div>
@stop