
<div class="bg-white overflow-hidden sm:rounded-lg">
    <div class="p-6 sm:px-10 bg-white border-b border-gray-200">
        <div>
            <x-jet-application-logo class="block h-12 w-auto" />
        </div>

        <div class="mt-6 text-2xl">
            Selamat datang di Aplikasi Banjarmasin!
        </div>

        <div class="mt-6 text-gray-500">
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
        </div>

        <div class="mt-6">
        @auth
            <a href="{{ url('/user/profile') }}" class="btn btn-warning icon-left mr-2"><i class="far fa-user"></i> Profile</a>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary icon-left mr-2" style="width: 100px;">Login</a>
            <a href="{{ route('register') }}" class="btn btn-success icon-left mr-2" style="width: 100px;">Register</a>
        @endauth
        </div>
    </div>
</div>

<div class="py-0 pb-3 px-0 sm:px-0">
    <h2 class="section-title">Kategori</h2>
    <p class="section-lead">This article component is based on card and flexbox.</p>
</div>

<div class="overflow-hidden sm:rounded-lg">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article article-style-b">
            <div class="article-header">
            <div class="article-image" data-background="assets/img/news/img13.jpg" style="background-image: url(&quot;assets/img/news/img13.jpg&quot;);">
            </div>
            </div>
            <div class="article-details">
            <div class="article-title">
                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
            </div>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. </p>
            <div class="article-cta">
                <a href="#">Read More <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </article>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article article-style-b">
            <div class="article-header">
            <div class="article-image" data-background="assets/img/news/img15.jpg" style="background-image: url(&quot;assets/img/news/img15.jpg&quot;);">
            </div>
            </div>
            <div class="article-details">
            <div class="article-title">
                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
            </div>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. </p>
            <div class="article-cta">
                <a href="#">Read More <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </article>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article article-style-b">
            <div class="article-header">
            <div class="article-image" data-background="assets/img/news/img07.jpg" style="background-image: url(&quot;assets/img/news/img07.jpg&quot;);">
            </div>
            </div>
            <div class="article-details">
            <div class="article-title">
                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
            </div>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. </p>
            <div class="article-cta">
                <a href="#">Read More <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </article>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article article-style-b">
            <div class="article-header">
            <div class="article-image" data-background="assets/img/news/img02.jpg" style="background-image: url(&quot;assets/img/news/img02.jpg&quot;);">
            </div>
            </div>
            <div class="article-details">
            <div class="article-title">
                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
            </div>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. </p>
            <div class="article-cta">
                <a href="#">Read More <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </article>
        </div>
    </div>
</div>

<div class="py-0 pb-3 px-0 sm:px-0">
    <h2 class="section-title">Kategori</h2>
    <p class="section-lead">This article component is based on card and flexbox.</p>
</div>

<div class="overflow-hidden sm:rounded-lg">
    <div class="row">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article article-style-b">
            <div class="article-header">
            <div class="article-image" data-background="assets/img/news/img13.jpg" style="background-image: url(&quot;assets/img/news/img13.jpg&quot;);">
            </div>
            </div>
            <div class="article-details">
            <div class="article-title">
                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
            </div>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. </p>
            <div class="article-cta">
                <a href="#">Read More <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </article>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article article-style-b">
            <div class="article-header">
            <div class="article-image" data-background="assets/img/news/img15.jpg" style="background-image: url(&quot;assets/img/news/img15.jpg&quot;);">
            </div>
            </div>
            <div class="article-details">
            <div class="article-title">
                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
            </div>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. </p>
            <div class="article-cta">
                <a href="#">Read More <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </article>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article article-style-b">
            <div class="article-header">
            <div class="article-image" data-background="assets/img/news/img07.jpg" style="background-image: url(&quot;assets/img/news/img07.jpg&quot;);">
            </div>
            </div>
            <div class="article-details">
            <div class="article-title">
                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
            </div>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. </p>
            <div class="article-cta">
                <a href="#">Read More <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </article>
        </div>
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
        <article class="article article-style-b">
            <div class="article-header">
            <div class="article-image" data-background="assets/img/news/img02.jpg" style="background-image: url(&quot;assets/img/news/img02.jpg&quot;);">
            </div>
            </div>
            <div class="article-details">
            <div class="article-title">
                <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
            </div>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
            cillum dolore eu fugiat nulla pariatur. </p>
            <div class="article-cta">
                <a href="#">Read More <i class="fas fa-chevron-right"></i></a>
            </div>
            </div>
        </article>
        </div>
</div>

