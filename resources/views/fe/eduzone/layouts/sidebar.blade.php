                    <!-- Side bar start -->
                    <div class="col-xl-3 col-lg-4 col-md-12">
                        <aside class="side-bar sticky-top">
                            <div class="widget">
                                <h5 class="widget-title style-1">Pencarian</h5>
                                <div class="search-bx style-1">
                                    <form action="{{ route('search') }}" role="search" method="get">
                                        <div class="input-group">
                                            <input name="q" value="{{ ($q) ? $q : '' }}" class="form-control form-control-user @error('code') is-invalid @enderror" placeholder="Ketikkan pencarian" type="text">
                                            @error('q')
                                                <span class="invalid-feedback" status="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <span class="input-group-btn">
												<button type="submit" class="fa fa-search site-button sharp radius-no"></button>
                                            </span> 
										</div>
                                    </form>
                                </div>
                            </div>
                            <div class="widget recent-posts-entry">
                                <h5 class="widget-title style-1">Terbaru</h5>
                                <div class="widget-post-bx">
									@foreach($news as $new)
										<div class="widget-post clearfix">
											<div class="dlab-post-media"> 
                                                <a href="{{ route('detail',$new->slug) }}"><img src="{{ asset(config('web.media').'post/'.$new->image) }}" width="200" height="143" alt=""></a>
											</div>
											<div class="dlab-post-info">
												<div class="dlab-post-meta">
													<ul>
														<li class="post-date"> <i class="la la-clock"></i> <strong>{{ $new->created_at->format('j') }} {{ $new->created_at->format('F') }}</strong> <span> {{ $new->created_at->format('Y') }}</span> </li>
													</ul>
												</div>
												<div class="dlab-post-header">
													<h6 class="post-title"><a href="{{ route('detail',$new->slug) }}">{{ $new->title }}</a></h6>
												</div>
											</div>
										</div>
									@endforeach
                                </div>
                            </div>
							<div class="widget widget_gallery gallery-grid-4">
                                <h5 class="widget-title style-1">Galeri</h5>
                                <ul id="lightgallery" class="lightgallery">
									@foreach($galleries as $gallery)
										<li>
											<div class="dlab-post-thum dlab-img-effect">
												<span data-exthumbimage="{{ asset(config('web.media').'album/gallery/'.$gallery->picture) }}" data-src="images/gallery/pic1.jpg" class="check-km" title="Image 1 Title will come here">		
													<img src="{{ asset(config('web.media').'album/gallery/'.$gallery->picture) }}" alt=""> 
												</span>
											</div>
										</li>
									@endforeach
                                </ul>
                            </div>
                            <div class="widget widget_archive">
                                <h5 class="widget-title style-1">Kategory</h5>
                                <ul>
									@foreach($categories as $category)
	                                    <li><a href="{{ route('category',$category->slug) }}">{{ $category->name }}</a></li>
									@endforeach
                                </ul>
                            </div>
							<div class="widget widget_tag_cloud radius">
                                <h5 class="widget-title style-1">Tags</h5>
                                <div class="tagcloud">
									@foreach($tags as $tag)
										<a href="{{ route('tag',$tag->slug) }}">{{ $tag->name }}</a> 
									@endforeach
								</div>
                            </div>
                        </aside>
                    </div>
                    <!-- Side bar END -->