<a href="#" onclick="searchModel('{{ $search_data->id }}')" >
	<span class="search-img-small">
		<img src="{{ url('/public/upload/cards') }}/{{ $search_data->card_image }}" alt="">
	</span> 
	<div class="search-content-wrapp">
		<div class="search-prd-title">
			<h4>{{ $search_data->card_title }}</h4>
		</div>
		<div class="search-prd-price">
			<span>{{ $search_data->price }}</span>
		</div>
	</div>
</a>
