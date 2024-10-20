<div class="wn__sidebar">
    <!-- Start Single Widget -->
    <aside class="widget search_widget">
        <h3 class="widget-title">Search</h3>
        <form method="'get'" action="{{route('frontend.search')}}" >
            @csrf
            <div class="form-input">
                <input type="text" name="keyword" value="{{ old('keyword', request('keyword')) }}" class="form-control" placeholder="Search...">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </aside>
    <!-- End Single Widget -->
    <!-- Start Single Widget -->
    <aside class="widget recent_widget">
        <h3 class="widget-title">Recent Posts</h3>
        <div class="recent-posts">
            <ul>
                @foreach($recent_posts as $recent_post)
                    <li>
                        <div class="post-wrapper d-flex">
                            <div class="thumb">
                                <a href="{{ route('frontend.posts.show', $recent_post->slug) }}">
                                    @if($recent_post->media->count() > 0)
                                        <img src="{{ asset('assets/posts/' . $recent_post->media->first()->file_name) }}" alt="{{ $recent_post->title }}">
                                    @else
                                        <img src="{{ asset('assets/posts/default_small.jpg') }}" alt="blog images">
                                    @endif
                                </a>
                            </div>
                            <div class="content">
                                <h4><a href="{{ route('frontend.posts.show', $recent_post->slug) }}">{{ \Illuminate\Support\Str::limit($recent_post->title, 15, '...')  }}</a></h4>
                                <p> {{ $recent_post->created_at->format("M d, Y") }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>
    <!-- End Single Widget -->
    <!-- Start Single Widget -->
    <aside class="widget category_widget">
        <h3 class="widget-title">Categories</h3>
        <ul>
            @foreach($global_categories as $global_category)
                <li><a href="{{route('frontend.category.posts', $global_category->slug)}}">{{ $global_category->name }}</a></li>
            @endforeach

        </ul>
    </aside>
    <!-- End Single Widget -->
    <!-- Start Single Widget -->
    <aside class="widget category_widget">
        <h3 class="widget-title">Tags</h3>
        <ul>
            @foreach($global_tags as $global_tag)
                <span style="background:#ebebeb none repeat scroll 0 0; color: #333; display: inline-block; font-size: 12px; line-height: 20px; margin: 5px 5px 0 0; padding: 5px 15px; text-transform: capitalize;"><a href="{{route('frontend.tag.posts', $global_tag->slug)}}">{{ $global_tag->name }} ({{ $global_tag->posts_count }})</a></span>
            @endforeach

        </ul>
    </aside>
    <!-- End Single Widget -->
    <!-- Start Single Widget -->
    <aside class="widget archives_widget">
        <h3 class="widget-title">Archives</h3>
        <ul>
            @foreach($global_archives as $key => $val)
                <li><a href="{{ route('frontend.archive.posts', $key . '-' . $val) }}">{{ date("F", mktime(0, 0, 0, $key, 1)) . ' ' . $val }}</a></li>
            @endforeach
        </ul>
    </aside>
    <!-- End Single Widget -->
</div>
