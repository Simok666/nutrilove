<x-user.layout title="Index">
    <x-slot name="styles">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <!-- Css for reaction system -->
        <link rel="stylesheet" type="text/css" href="{{ Url('reaction/css/reaction.css') }}" />

        <style>
            .like-details {
                font-size: 14px
            }
        </style>
    </x-slot>
    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 posts-list">
                    <div class="single-post">
                        <div class="feature-img">
                            <img class="img-fluid"
                                src="{{ empty($artikel->file) ? Url('no-image.png') : $artikel->file }}" alt="">
                        </div>
                        <div class="blog_details">
                            <h2>
                                {{ $artikel->title }}
                            </h2>
                            <ul class="blog-info-link mt-3 mb-4">
                                <li><a href="#"><i class="fa fa-user"></i> {{ $artikel->category->nama }}</a></li>
                                <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                            </ul>
                            <p class="excert">
                                <?= $artikel->desc_content ?>
                            </p>
                        </div>
                    </div>
                    <div class="navigation-top">
                        <div class="remove-reaction" style="display: none" data-id="{{ $artikel->id }}"></div>
                        <div class="row">
                            <div class="col-6">
                                <div class="box">
                                    {{-- <input type="checkbox" id="like" class="field-reactions"> --}}
                                    <label style="width: 40px; height: 40px; ; background-size: cover;" for="like"
                                        class="label-reactions">Like</label>
                                    <div class="toolbox"></div>
                                    <label class="overlay" for="like"></label>
                                    <button class="reaction-data reaction-like"><span
                                            class="legend-reaction">Like</span></button>
                                    <button class="reaction-data reaction-love"><span
                                            class="legend-reaction">Love</span></button>
                                    <button class="reaction-data reaction-haha"><span
                                            class="legend-reaction">Haha</span></button>
                                    <button class="reaction-data reaction-wow"><span
                                            class="legend-reaction">Wow</span></button>
                                    <button class="reaction-data reaction-sad"><span
                                            class="legend-reaction">Sad</span></button>
                                    <button class="reaction-data reaction-angry"><span
                                            class="legend-reaction">Angry</span></button>
                                </div>
    
                                <div class="like-stat" style="margin-left: 50px">
                                    <span class="like-emo">
                                        <?= $artikel->emoticon["emoticon"] ?? "" ?>
                                    </span>
                                    <span class="like-details like-details-emo">
                                        <?= $artikel->emoticon["count"] ?? "" ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-6" style="margin-top: 9px">
                                <a href="#comment" class="like-details">
                                    <span class="align-middle like-stat">
                                        <i class="fa fa-comment"></i>
                                    </span>
                                    06 Comments
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="blog-author">
                        <div class="media align-items-center">
                            <img src="{{ empty($artikel->user->photo) ? Url('no-image.png') : Url($artikel->user->photo) }}" alt="">
                            <div class="media-body">
                                <a href="{{ Url('articles/author/' .$artikel->user_id) }}">
                                    <h4>{{ $artikel->user->name }}</h4>
                                </a>
                                <p>{{ $artikel->user->description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="comments-area" id="comment">
                        <h4>05 Comments</h4>
                        <div class="comment-list">
                            <div class="single-comment justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="user_assets/img/comment/comment_1.png" alt="">
                                    </div>
                                    <div class="desc">
                                        <p class="comment">
                                            Multiply sea night grass fourth day sea lesser rule open subdue female fill
                                            which them
                                            Blessed, give fill lesser bearing multiply sea night grass fourth day sea
                                            lesser
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <h5>
                                                    <a href="#">Emilly Blunt</a>
                                                </h5>
                                                <p class="date">December 4, 2017 at 3:12 pm </p>
                                            </div>
                                            <div class="reply-btn">
                                                <a href="#reply" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="comment-form" id="reply">
                        <h4>Leave a Reply</h4>
                        <form class="form-contact comment_form" action="#" id="commentForm">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                            placeholder="Write Comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" type="text"
                                            placeholder="Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email"
                                            placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="website" id="website" type="text"
                                            placeholder="Website">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send
                                    Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="single_sidebar_widget search_widget">
                            <form action="#">
                                <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder='Search Keyword'
                                            onfocus="this.placeholder = ''"
                                            onblur="this.placeholder = 'Search Keyword'">
                                        <div class="input-group-append">
                                            <button class="btns" type="button"><i class="ti-search"></i></button>
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
                                    <a href="single-articles.html">
                                        <img height="80" width="80" style="object-fit: cover"
                                            src="{{ empty($item->file) ? Url('no-image.png') : $item->file }}"
                                            alt="post">
                                    </a>
                                    <div class="media-body">
                                        <a href="single-articles.html">
                                            <h3 class="descritption_content">{{ $item->title }}</h3>
                                        </a>
                                        <p>{{ date("d F Y", strtotime($item->created_at)) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ Blog Area end =================-->
    <x-slot name="script">
        <script type="text/javascript" src="{{ Url('reaction/js/reaction.js') }}"></script>
        <script>
            $(document).ready(function () {
                $(".reaction-data").click(function () {  
                    let data = $(this).find("span").html()
                    let artikel_id = $(".remove-reaction").data("id")
                    reactionArticle(artikel_id, data.toLowerCase())
                })
            });

            const reactionArticle = (article_id, reaction) => {
                ajaxData("/article/reaction", {
                    "article_id": article_id,
                    "reaction"  : reaction
                }, function(resp) {
                    $(".like-emo").html(resp.data.emoticon)
                    $(".like-details-emo").html(resp.data.count)
                    $(".remove-reaction").focus();
                })
            } 
        </script>
    </x-slot>

</x-user.layout>
