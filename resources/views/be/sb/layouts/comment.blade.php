						<div class="clear m-b30" id="comment-list">
							<div class="comments-area" id="comments">
								<div class="section-head">
									<h5 class="widget-title style-1">Komentar</h5>
								</div>
								<!-- comment list END -->
								<ol class="comment-list">
									@foreach($page->comments as $comment)
									<li class="comment">
										<div class="comment-body">
											<div class="comment-author vcard"> 
												<img  class="avatar photo" src="{{ asset(config('access.media').'user/user.png') }}" alt=""> 
												<cite class="fn">{{$comment->name}}</cite> 
												<span class="says">says:</span> 
												 <div class="comment-meta"> <a href="javascript:void(0);">{{ $comment->created_at->format('M')}} {{ $comment->created_at->format('j')}}, {{ $comment->created_at->format('Y')}} at {{ $comment->created_at->format('g')}}:{{ $comment->created_at->format('i')}} {{ $comment->created_at->format('a')}}</a> </div>
												<!-- <div class="reply"> <a href="javascript:void(0);" class="comment-reply-link">Reply</a> </div> -->
											</div>
											<div class="comment-content">
												{!! $comment->comment !!}
											</div>
										</div>
										<!-- list END -->
									</li>
									@endforeach
								</ol>
								<!-- comment list END -->
							</div>
						</div>
						<!-- Form -->
						<div class="comments-area" id="respond">
							<div class="comment-respond" id="respond">
								<div class="section-head">
									<h5 class="widget-title style-1">Kirim Komentar</h5>
								</div>
								<h3 class="comment-reply-title" id="reply-title">
									<small> <a style="display:none;" href="javascript:void(0);" id="cancel-comment-reply-link" rel="nofollow">Cancel reply</a> </small>
								</h3>
								<form action="{{route('comment',$page->slug)}}" class="comment-form" id="commentform" method="POST">
									@csrf
									<p class="comment-form-author">
										<label for="author">Nama <span class="required">*</span></label>
										<input name="name" type="text" value="{{ old('name') }}" placeholder="Name" id="author" class="form-control form-control-user @error('name') is-invalid @enderror" required>
										@error('name')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
	                                    @enderror
									</p>
									<p class="comment-form-email">
										<label for="email">Email <span class="required">*</span></label>
										<input name="email" value="{{ old('email') }}" type="email" value="" placeholder="Email" id="email" class="form-control form-control-user @error('email') is-invalid @enderror" required>
										@error('email')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
	                                    @enderror
									</p>
									<p class="comment-form-comment">
										<label for="comment">Komentar</label>
										<textarea name="comment" rows="8" placeholder="Add a Comment" id="comment" class="form-control form-control-user @error('comment') is-invalid @enderror" required>{{ old('comment') }}</textarea>
										@error('comment')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
	                                    @enderror
									</p>
									<p>
										Berapakah Hasil Penjumalah {{ $one }}+{{ $two }}<input type="number" name="result" class="form-control form-control-user @error('result') is-invalid @enderror"  required/>
										@error('result')
                                        <span class="invalid-feedback" status="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
	                                    @enderror
									</p>
									<p class="form-submit">
										<input type="submit" value="Kirim Komentar" class="site-button" id="submit">
									</p>
								</form>
							</div>
						</div>
						<!-- blog END -->