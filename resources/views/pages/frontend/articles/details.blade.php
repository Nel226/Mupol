<x-guest-layout>
    <x-preloader/>

    <x-header-guest/>


    <!-- Single News -->
    <section class="news-single section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="single-main">
                                <!-- News Head -->
                                <div class="news-head  ">
                                    <img class="max-h-[400px]" src="{{ asset('storage/'.$article->image_principal) }}" alt="Image">
                                </div>
                                
                                <!-- News Title -->
                                <h1 class="news-title"><a href="news-single.html">{{ $article->titre }}.</a></h1>
                                <span class="rounded-lg bg-primary1 mb-1 px-2 py-0.5 text-white text-sm font-semibold">{{ $article->categorie }}</span>
                                <!-- Meta -->
                                <div class="meta">
                                    <div class="meta-left">
                                        <span class="date"><i class="fa fa-clock-o"></i>{{ \Carbon\Carbon::parse($article->created_at)->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="meta-right">
                                        <span class="views"><i class="fa fa-eye"></i>{{ $article->views }} Vues</span>
                                    </div>
                                </div>
                                <!-- News Text -->
                                <div class="news-text">
                                    <p class=" font-semibold">
                                       {{ $article->resume }}

                                    </p>
                                    {!! $article->contenu !!}
                                
                                </div>
                                <div class="blog-bottom">
                                    <!-- Social Share -->
                                    <p class="font-semibold">Partager sur :</p>
                                    <ul class="social-share">
                                        <li class="facebook">
                                            <a class=" items-center" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}" target="_blank">
                                                <i class="fab  fa-facebook"></i><span>Facebook</span>
                                            </a>
                                        </li>
                                        <li class="whatsapp">
                                            <a class=" items-center" href="https://api.whatsapp.com/send?text={{ urlencode(Request::url()) }}" target="_blank">
                                                <i class="fab fa-whatsapp"></i><span>WhatsApp</span>
                                            </a>
                                        </li>
                                    </ul>
                                
                                    <!-- Next Prev -->
                                    <ul class="prev-next">
                                        @if ($previousArticle)
                                            <li class="prev">
                                                <a href="{{ route('articles-details', $previousArticle->id) }}">
                                                    <i class="fa fa-angle-double-left"></i>
                                                </a>
                                            </li>
                                        @endif
                                    
                                        @if ($nextArticle)
                                            <li class="next">
                                                <a href="{{ route('articles-details', $nextArticle->id) }}">
                                                    <i class="fa fa-angle-double-right"></i>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                    <!--/ End Next Prev -->
                                    
                                </div>
                                
                            </div>
                        </div>
                       
                        
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="main-sidebar">
                        <!-- Single Widget -->
                        <div class="single-widget side-tags">
                            <h3 class="title">Tags</h3>
                            <ul class="tag">
                                <li><a href="#">{{ $article->categorie }}</a></li>
                               
                            </ul>
                        </div>
                        <!--/ End Single Widget -->
                        <!-- Single Widget -->
                        <div class="single-widget recent-post">
                            <h3 class="title">Derniers articles</h3>

                            @foreach ($recentArticles as $recent)
                                <!-- Single Post -->
                                <div class="single-post">
                                    <div class="image">
                                        <img src="{{ asset('storage/'.$recent->image_principal) }}" alt="{{ $recent->titre }}">
                                    </div>
                                    <div class="content">
                                        <h5><a href="{{ route('articles-details', $recent->id) }}">{{ $recent->titre }}</a></h5>
                                        <ul class="comment">
                                            <li><i class="fa fa-calendar" aria-hidden="true"></i> {{ $recent->date }}</li>
                                            <li><i class="fa fa-eye" aria-hidden="true"></i> {{ $recent->views }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End Single Post -->
                            @endforeach

                        </div>
                        <!--/ End Single Widget -->

                       
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/ End Single News -->
    
    

</x-guest-layout>

