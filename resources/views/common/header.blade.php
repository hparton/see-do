<header>
	<div class="site-wrapper clear">
		<div class="left-align-wrapper">
			<h1 class="site-title aligned">
				<a href="/">[ See+Do ]</a>

				@if (!empty($category))
                    <span class="category-title">{{ $category->title }}</span>
                @endif
			</h1>
			<nav>
				<ul>
					<li><a href="#" class="filter">Filter</a></li>
					<li><a href="{{ route('subscribers.create') }}">Sign Up</a></li>
				</ul>
			</nav>
		</div>
	</div>
</header>
