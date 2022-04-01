                                    <li class="active">
										<a href="javascript:;">Home<i class="fa fa-chevron-down"></i></a>
									</li>
									@foreach($mainmenus as $menu)
										<li>
											<a href="{{ ($menu->post) ? $menu->post->slug : $menu->url }}">{{ $menu->name }}
												@if(count($menu->childs)>0)
													<i class="fa fa-chevron-down"></i>
												@endif
											</a>
												@if(count($menu->childs)>0)
													<ul class="sub-menu tab-content">
														@foreach($menu->childs as $menu1)
														<li>
															<a href="{{ ($menu1->post) ? $menu1->postId->slug : $menu1->url }}">{{ $menu1->name }}
																@if(count($menu1->childs)>0)
																	<i class="fa fa-chevron-down"></i>
																@endif
															</a>
																@if(count($menu1->childs)>0)
																	<ul class="sub-menu right">
																		@foreach($menu1->childs as $menu2)
																			<li><a href="{{ ($menu2->post) ? $menu2->postId->slug : $menu2->url }}">{{ $menu2->name }}</a></li>
																		@endforeach
																	</ul>
																@endif														
														</li>
														@endforeach
													</ul>
												@endif
										</li>
									@endforeach