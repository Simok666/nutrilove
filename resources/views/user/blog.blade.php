<x-user.layout title="Artikel">
    <x-slot name="styles">
        <style>
            .descritption_content {
                overflow: hidden;
                text-overflow: ellipsis;
                display: -webkit-box;
                -webkit-line-clamp: 2;

                line-clamp: 2;
                -webkit-box-orient: vertical;
            }
        </style>
    </x-slot>

    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                @isset($search)
                    <div class="col-lg-6 pt-5 pt-lg-0">
                        <h3 data-aos="fade-up">Search results for "{{ $search ?? "" }}"
                        </h3>
                    </div>
                @endisset
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        @foreach ($artikel as $item)
                            <article class="blog_item">
                                <div class="blog_item_img">
                                    <a href="{{ Url('articles/show/' . $item->kode) }}">
                                        <img class="card-img rounded-0" style="max-height: 250px; object-fit: cover"
                                            src="{{ empty($item->file) ? Url('no-image.png') : Url($item->file) }}"
                                            alt="">
                                        <div class="blog_item_date">
                                            <h3>{{ date('d', strtotime($item->created_at)) }}</h3>
                                            <p>{{ date('M', strtotime($item->created_at)) }}</p>
                                        </div>
                                    </a>
                                </div>

                                <div class="blog_details">
                                    {{-- <a class="d-inline-block" href="single-articles.html"> --}}
                                    <a class="d-inline-block" href="{{ Url('articles/show/' . $item->kode) }}">
                                        <h2>{{ $item->title }}</h2>
                                    </a>
                                    <p class="descritption_content"><?= strip_tags($item->desc_content) ?></p>
                                    <ul class="blog-info-link">
                                        <li>By :<a href="{{ Url('articles/author/' . $item->user->id) }}"><i
                                                    class="fa fa-user"></i> {{ $item->user->name }}</a>
                                        <li>Kategori :<a
                                                href="{{ Url('articles/category/' . $item->category->kode) }}"><i
                                                    class="fa fa-user"></i>
                                                {{ $item->category->nama }} </a></li>
                                        <li><a href="#"><i class="fa fa-comments"></i> {{ $item->comment->count() }} Comments</a></li>
                                    </ul>
                                </div>
                            </article>
                        @endforeach
                        {!! $artikel->links('elements.custom-pagenation') !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="{{ Url('/articles/search') }}" method="GET">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" name="search" class="form-control"
                                            placeholder='Search Keyword' onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="submit"><i class="ti-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                    type="submit">Search</button>
                            </form>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
                            <ul class="list cat-list">
                                @foreach ($categori as $item)
                                    <li>
                                        <a href="{{ Url('articles/category/' . $item->kode) }}" class="d-flex">
                                            <p>{{ $item->nama }}</p>
                                            <p>&nbsp;({{ (int) $item->articles()->count() }})</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </aside>

                        <aside class="single_sidebar_widget popular_post_widget">
                            <h3 class="widget_title">Recent Post</h3>
                            @foreach ($artikelterkait as $item)
                                <div class="media post_item">
                                    <a href="{{ Url('articles/show/' . $item->kode) }}">
                                        <img height="80" width="80" style="object-fit: cover"
                                            src="{{ empty($item->file) ? Url('no-image.png') : $item->file }}"
                                            alt="post">
                                    </a>
                                    <div class="media-body">
                                        <a href="{{ Url('articles/show/' . $item->kode) }}">
                                            <h3 class="descritption_content">{{ $item->title }}</h3>
                                        </a>
                                        <p>{{ date('d F Y', strtotime($item->created_at)) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

</x-user.layout>
