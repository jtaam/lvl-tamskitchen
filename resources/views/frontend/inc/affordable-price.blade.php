<section id="pricing" class="pricing">
    <div id="w">
        <div class="pricing-filter">
            <div class="pricing-filter-wrapper">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="section-header">
                                <h2 class="pricing-title">Affordable Pricing</h2>
                                <ul id="filter-list" class="clearfix">
                                    <li class="filter" data-filter="all">All</li>
                                    @foreach($categories as $category)
                                        <li class="filter" data-filter="#{{$category->slug}}">{{title_case($category->name)}} <span class="badge">{{$category->items->count()}}</span></li>
                                    @endforeach
                                </ul><!-- @end #filter-list -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <ul id="menu-pricing" class="menu-price">
                        @foreach($items as $item)
                            <li class="item" id="{{$item->category->slug}}">

                                <a href="#">
                                  <img
                                  @if (config('app.env')=='production')
                                    src="{{$item->image}}"
                                  @else
                                    src="{{asset('uploads/items/'.$item->image)}}"
                                  @endif
                                   class="img-responsive" alt="{{$item->name}}" >
                                    <div class="menu-desc text-center">
                                            <span>
                                                <h3>{{title_case($item->name)}}</h3>
                                                {{ucfirst($item->description)}}
                                            </span>
                                    </div>
                                </a>

                                <h2 class="white">${{$item->price}}</h2>
                            </li>
                        @endforeach
                    </ul>

                    <!-- <div class="text-center">
                            <a id="loadPricingContent" class="btn btn-middle hidden-sm hidden-xs">Load More <span class="caret"></span></a>
                    </div> -->

                </div>
            </div>
        </div>

    </div>
</section>
