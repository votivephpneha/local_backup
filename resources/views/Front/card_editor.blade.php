@extends('Front.layout.video_page_scripting')
@section('title', 'Video Page')

@section('current_page_css')
@endsection

@section('current_page_js')
@endsection

@section('content')


<style type="text/css">

	/* .change_div_content textarea{
		text-align: center;	
	} */
	
	.exit_btn{
		text-align: left;
	}
	.add_cart_btn{
		text-align: right;
	}
	.predefined_text p, .add-text-div{
		text-align: center;
	}
</style>

<div class="card-editor container">
	@if ($message = Session::get('message'))
      <div class="alert alert-success">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      {{ $message }}
    </div>
     @endif
	<div class="card-header row">
		<div class="exit_btn col-md-6">
			<a href="#">Exit</a>
		</div>
		<div class="add_cart_btn col-md-6">
			
			<form method="post" action="{{ url('post_card') }}">
				@csrf
				<input type="hidden" name="card_id" value="{{ $card_id }}" class="cart_id">
				<input type="hidden" name="card_size_id" value="{{ $card_size_id }}" class="cart_id">
				<input type="hidden" name="cart_id" value="{{ $cart_id }}" class="cart1_id">
				<input type="hidden" name="text_size_font1" value="" class="text_size_font1">
				<input type="hidden" name="text_color_font1" value="" class="text_color_font1">
				<input type="hidden" name="text_font1" value="" class="text_font1">
				<input type="hidden" name="text_size_font2" value="" class="text_size_font2">
				<input type="hidden" name="text_color_font2" value="" class="text_color_font2">
				<input type="hidden" name="text_font2" value="" class="text_font2">
				<input type="hidden" name="text_size_font3" value="" class="text_size_font3">
				<input type="hidden" name="text_color_font3" value="" class="text_color_font3">
				<input type="hidden" name="text_font3" value="" class="text_font3">
				<button type="submit" class="editor-add-basket">Add to Basket</button>
			</form>
		</div>
		
		@if ($message = Session::get('error'))
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          {{ $message }}
        </div>
         @endif
         
	</div>
	<div class="card-editor-content">
		<div class="card_editor_carousel">
		  
		  
		  <div class="card-block-one">
		  	<div class="add_text_div row">
		  		<div class="col-md-6 lft_edt">
			  		<div class="text-tools text-tools-one" style="display:none;">
			  			<div class="text-sizes size-tool-box" style="display:none;">
			  				<div class="close-icon-size-one tool-close-icon">
		  						<h4>Text Sizes</h4>
		  						<i class='bx bx-x'></i>
			  				</div>	
			  				<div class="text-size-div row">
			  					
			  					<?php 

			  					for($i=12;$i<=20;$i++){
			  						
			  					?>
			  					<div class="col-md-2">
			  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('1','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
			  					</div>
			  					<?php	
			  						$i++;
			  					}
			  					for($i=25;$i<=65;$i++){
			  						
			  					?>
			  					<div class="col-md-2">
			  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('1','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
			  					</div>
			  					<?php	
			  						$i = $i+4;
			  					}
			  					?>
			  					
			  				</div>
			  				
			  			</div>
			  			<div class="text-sizes color-tool-box" style="display:none;">
			  				<div class="close-icon-colour-one tool-close-icon">
			  					<h4>Text Colour</h4>
		  						<i class='bx bx-x'></i>
		  					</div>	
			  				
			  				<div class="text-color-div row">
			  					@foreach($colors as $color)
			  					    <div class="col-md-12">
				  						<input type="radio" name="text-colour" value="{{ $color->color_value}}" onclick="changeTextSize('1','text-color',this.value)"><div class="clr_name" style="width:50px;height:50px;background-color: {{ $color->color_value }}"></div><span style="width:50px;height:50px;">{{ $color->color_name }}</span>
				  					</div>
			  						
			  					@endforeach
			  					
			  				</div>
			  				
			  			</div>
			  			<div class="text-sizes align-tool-box" style="display: none;">
			  				<div class="close-icon-align-one tool-close-icon">
			  					<h4>Text Alignment</h4>
		  						<i class='bx bx-x'></i>
		  					</div>	
			  				
			  				<div class="horizontal">
			  					<h6>Horizontal</h6>
								<div class="algn_horizontal">
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="left" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4ZM3 9a1 1 0 0 1 1-1h11.539a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h11.539a1 1 0 0 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="center" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="right" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Zm7-14a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H12a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h11.538a1 1 0 0 0 0-2H12Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="justify" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4ZM3 9a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								</div>
			  				</div>
			  				<div class="vertical">							
			  					<h6>Vertical</h6>
								<div class="align-vertical">
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="vertically-top" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M4 3a1 1 0 0 0 0 2h20a1 1 0 1 0 0-2H4Zm0 5a1 1 0 0 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="vertically-middle" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M4 10.5a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Zm0 5a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="vertically-bottom" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M4 18a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Zm0 5a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
			  				</div>
							</div>
			  			</div>
			  			<div class="text-sizes font-tool-box" style="display: none;">
			  				<div class="close-icon-font-one tool-close-icon">
			  					<h4>Font</h4>
		  						<i class='bx bx-x'></i>
		  					</div>	
			  				
			  				<div class="text-font-div row">
			  					@foreach($fonts as $font)
			  					    <div class="col-md-12">
				  						<input type="radio" name="text-colour" value="{{ $font->font_value }}" onclick="changeTextSize('1','text-font',this.value)"><span>{{ $font->font_name }}</span>
				  					</div>
			  						
			  					@endforeach
			  					
			  				</div>
			  			</div>
			  			<div class="text-change-tools">
			  				<div class="change-tools size-click">
			  					<div class="text-number">30</div>
			  					<div class="text-font">Size</div>
			  				</div>
			  				<div class="change-tools font-click">
			  					<div class="text-number">Aa</div>
			  					<div class="text-font">Font</div>
			  				</div>
			  				<div class="change-tools color-click">
			  					<div class="text-number" style="background-color: black;width: 28px; height: 28px;"></div>
			  					<div class="text-font">Color</div>
			  				</div>
			  				<div class="change-tools alignment-click">
			  					<div class="text-number">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28" height="28"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
			  					</div>
			  					<div class="text-font">Align</div>
			  				</div>
			  				<div class="change-tools size">
			  					
			  					<button class="text_btn_one">
			  						<svg viewBox="0 0 40 40" width="40" height="40"><circle cx="20" cy="20" r="19" fill="#F8F8F9" stroke="#087827" stroke-width="2"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M27.707 14.293a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L17 23.586l9.293-9.293a1 1 0 0 1 1.414 0Z" fill="#087827"></path></svg>	
			  						Done
		  					    </button>
			  				</div>
			  			</div>
			  		</div>
		  		
			  		<div class="text-one-div">
				  		<div class="change_div_content add-text-div change_show_div-1" onclick="changeText(1)">
				  			<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="39.89333333333334" height="39.89333333333334" color="#00204D"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4zm20 2H4v20h20V4zm-4 3H8v2.286a1 1 0 0 0 2 0V9h3v10h-.5a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2H15V9h3v.286a1 1 0 1 0 2 0V7z" fill="currentColor"></path></svg>
				  			<span>Add Text</span>
				  		</div>
				  		<div class="change_div_content change_text_div change_hide_div-1" style="display:none;">
				  			<textarea></textarea>
				  		</div>
			  		</div>
		  		</div>
		  		<div class="col-md-6 rgt_edt">
			  		<div class="text-tools text-tools-two" style="display:none;">

			  			<div class="text-sizes size-tool-box" style="display:none;">
			  				<div class="close-icon-size-two tool-close-icon">
			  					<h4>Text Sizes</h4>
		  						<i class='bx bx-x'></i>
		  					</div>	
			  				
			  				<div class="text-size-div row">

			  					<?php 

			  					for($i=12;$i<=20;$i++){
			  						
			  					?>
			  					<div class="col-md-2">
			  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('2','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
			  					</div>
			  					<?php	
			  						$i++;
			  					}
			  					for($i=25;$i<=65;$i++){
			  						
			  					?>
			  					<div class="col-md-2">
			  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('2','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
			  					</div>
			  					<?php	
			  						$i = $i+4;
			  					}
			  					?>
			  					
			  				</div>
			  				
			  			</div>
			  			<div class="text-sizes color-tool-box" style="display:none;">
			  				<div class="close-icon-colour-two tool-close-icon">
			  					<h4>Text Colour</h4>
		  						<i class='bx bx-x'></i>
		  					</div>	
			  				
			  				<div class="text-color-div row">
			  					@foreach($colors as $color)
			  					    <div class="col-md-12">
				  						<input type="radio" name="text-colour" value="{{ $color->color_value }}" onclick="changeTextSize('2','text-color',this.value)"><div class="clr_name" style="width:50px;height:50px;background-color: {{ $color->color_value }}"></div><span style="width:50px;height:50px;">{{ $color->color_name }}</span>
				  					</div>
			  						
			  					@endforeach
			  					
			  				</div>
			  				
			  			</div>
			  			<div class="text-sizes align-tool-box" style="display: none;">
			  				<div class="close-icon-align-two tool-close-icon">
			  					<h4>Text Alignment</h4>
		  						<i class='bx bx-x'></i>
		  					</div>	
			  				
			  				<div class="horizontal">
			  					<h6>Horizontal</h6>
								<div class="algn_horizontal">
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4ZM3 9a1 1 0 0 1 1-1h11.539a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h11.539a1 1 0 0 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Zm7-14a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H12a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h11.538a1 1 0 0 0 0-2H12Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4ZM3 9a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								</div>
			  				</div>
			  				<div class="vertical">
			  					<h6>Vertical</h6>
								<div class="align-vertical">
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="vertically-top" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M4 3a1 1 0 0 0 0 2h20a1 1 0 1 0 0-2H4Zm0 5a1 1 0 0 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="vertically-middle" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M4 10.5a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Zm0 5a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment" value="vertically-bottom" onclick="changeTextSize('1','text-align',this.value)">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M4 18a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Zm0 5a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								</div>
			  				</div>
			  			</div>
			  			<div class="text-sizes font-tool-box" style="display: none;">
			  				<div class="close-icon-font-two tool-close-icon">
			  					<h4>Font</h4>
		  						<i class='bx bx-x'></i>
		  					</div>	
			  				
			  				<div class="text-font-div row">
			  					@foreach($fonts as $font)
			  					    <div class="col-md-12">
				  						<input type="radio" name="text-colour" value="{{ $font->font_value }}" onclick="changeTextSize('2','text-font',this.value)"><span>{{ $font->font_name }}</span>
				  					</div>
			  						
			  					@endforeach
			  					
			  				</div>
			  			</div>
			  			<div class="text-change-tools">
			  				<div class="change-tools size-click">
			  					<div class="text-number">30</div>
			  					<div class="text-font">Size</div>
			  				</div>
			  				<div class="change-tools font-click">
			  					<div class="text-number">Aa</div>
			  					<div class="text-font">Font</div>
			  				</div>
			  				<div class="change-tools color-click">
			  					<div class="text-number" style="background-color: black;width: 28px; height: 28px;"></div>
			  					<div class="text-font">Color</div>
			  				</div>
			  				<div class="change-tools alignment-click">
			  					<div class="text-number">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28" height="28"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
			  					</div>
			  					<div class="text-font">Align</div>
			  				</div>
			  				<div class="change-tools size">
			  					
			  					<button class="text_btn_two">
				  						<svg viewBox="0 0 40 40" width="40" height="40"><circle cx="20" cy="20" r="19" fill="#F8F8F9" stroke="#087827" stroke-width="2"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M27.707 14.293a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L17 23.586l9.293-9.293a1 1 0 0 1 1.414 0Z" fill="#087827"></path></svg>	
				  						Done
			  					    </button>
			  				</div>
			  			</div>
			  		</div>
			  		<div class="text-two-div">
			  			<div class="change_div_content add-text-div change_show_div-2" onclick="changeText(2)">
				  			<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="39.89333333333334" height="39.89333333333334" color="#00204D"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4zm20 2H4v20h20V4zm-4 3H8v2.286a1 1 0 0 0 2 0V9h3v10h-.5a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2H15V9h3v.286a1 1 0 1 0 2 0V7z" fill="currentColor"></path></svg>
				  			<span>Add Text</span>
				  		</div>
				  		<div class="change_div_content change_text_div change_hide_div-2" style="display:none;">
				  			<textarea > </textarea>
				  		</div>
			  		</div>
			  		<div class="predefined_text">
			  			<p>Happy Birthday!<br>I hope you have a great day! 
			  			</p>
			  		</div>
			  		<div class="text-tools text-tools-three" style="display:none;">
			  			<div class="text-sizes size-tool-box" style="display:none;">
			  				<div class="close-icon-size-three tool-close-icon">
				  				<h4>Text Sizes</h4>

			  					<i class='bx bx-x'></i>
		  					</div>	
			  				<div class="text-size-div row">

			  					<?php 

			  					for($i=12;$i<=20;$i++){
			  						
			  					?>
			  					<div class="col-md-2">
			  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('3','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
			  					</div>
			  					<?php	
			  						$i++;
			  					}
			  					for($i=25;$i<=65;$i++){
			  						
			  					?>
			  					<div class="col-md-2">
			  						<input type="radio" name="text-size" value="<?php echo $i; ?>" onclick="changeTextSize('3','text-size','{{ $i }}')"><span><?php echo $i; ?></span>
			  					</div>
			  					<?php	
			  						$i = $i+4;
			  					}
			  					?>
			  					
			  				</div>
			  				
			  			</div>
			  			<div class="text-sizes color-tool-box" style="display:none;">
			  				<div class="close-icon-colour-three tool-close-icon">
				  				<h4>Text Colour</h4>

			  					<i class='bx bx-x'></i>
		  					</div>
			  				
			  				<div class="text-color-div row">
			  					@foreach($colors as $color)
			  					    <div class="col-md-12">
				  						<input type="radio" name="text-colour" value="{{ $color->color_value }}" onclick="changeTextSize('3','text-color',this.value)"><div class="clr_name" style="width:50px;height:50px;background-color: {{ $color->color_value }}"></div><span style="width:50px;height:50px;">{{ $color->color_name }}</span>
				  					</div>
			  						
			  					@endforeach
			  					
			  				</div>
			  				
			  			</div>
			  			<div class="text-sizes align-tool-box" style="display: none;">
			  				<div class="close-icon-align-three tool-close-icon">
				  				<h4>Text Alignment</h4>

			  					<i class='bx bx-x'></i>
		  					</div>
			  				
			  				<div class="horizontal">
			  					<h6>Horizontal</h6>
								<div class="algn_horizontal">
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4ZM3 9a1 1 0 0 1 1-1h11.539a1 1 0 0 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h11.539a1 1 0 0 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Zm7-14a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H12a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h11.538a1 1 0 0 0 0-2H12Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4ZM3 9a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm1 9a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								</div>
			  				</div>
			  				<div class="vertical">
			  					<h6>Vertical</h6>
								<div class="align-vertical">
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M4 3a1 1 0 0 0 0 2h20a1 1 0 1 0 0-2H4Zm0 5a1 1 0 0 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M4 10.5a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Zm0 5a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								<div class="col-md-2">
			  					<input type="radio" name="alignment" class="alignment">
			  					<label for="">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28px" height="28px"><path d="M4 18a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Zm0 5a1 1 0 1 0 0 2h20a1 1 0 1 0 0-2H4Z" fill="currentColor"></path></svg>
			  					</label></div>
								</div>
			  				</div>
			  			</div>
			  			<div class="text-sizes font-tool-box" style="display: none;">
			  				<div class="close-icon-font-three tool-close-icon">
				  				<h4>Font</h4>

			  					<i class='bx bx-x'></i>
		  					</div>
			  				
			  				<div class="text-font-div row">
			  					@foreach($fonts as $font)
			  					    <div class="col-md-12">
				  						<input type="radio" name="text-colour" value="{{ $font->font_value }}" onclick="changeTextSize('3','text-font',this.value)"><span>{{ $font->font_name }}</span>
				  					</div>
			  						
			  					@endforeach
			  					
			  				</div>
			  			</div>
			  			<div class="text-change-tools">
			  				<div class="change-tools size-click">
			  					<div class="text-number">30</div>
			  					<div class="text-font">Size</div>
			  				</div>
			  				<div class="change-tools font-click">
			  					<div class="text-number">Aa</div>
			  					<div class="text-font">Font</div>
			  				</div>
			  				<div class="change-tools color-click">
			  					<div class="text-number" style="background-color: black;width: 28px; height: 28px;"></div>
			  					<div class="text-font">Color</div>
			  				</div>
			  				<div class="change-tools alignment-click">
			  					<div class="text-number">
			  						<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="28" height="28"><path fill-rule="evenodd" clip-rule="evenodd" d="M3 4a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h20a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1ZM7 9a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Zm0 10a1 1 0 0 1 1-1h11.538a1 1 0 0 1 0 2H8a1 1 0 0 1-1-1Z" fill="currentColor"></path></svg>
			  					</div>
			  					<div class="text-font">Align</div>
			  				</div>
			  				<div class="change-tools size">
			  					
			  					<button class="text_btn_three">
			  						<svg viewBox="0 0 40 40" width="40" height="40"><circle cx="20" cy="20" r="19" fill="#F8F8F9" stroke="#087827" stroke-width="2"></circle><path fill-rule="evenodd" clip-rule="evenodd" d="M27.707 14.293a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414L17 23.586l9.293-9.293a1 1 0 0 1 1.414 0Z" fill="#087827"></path></svg>	
			  						Done
		  					    </button>
			  				</div>
			  			</div>
			  		</div>
			  		<div class="text-three-div">
			  			<div class="change_div_content add-text-div change_show_div-3" onclick="changeText(3)">
				  			<svg fill="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" width="39.89333333333334" height="39.89333333333334" color="#00204D"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 2a2 2 0 0 0-2 2v20a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H4zm20 2H4v20h20V4zm-4 3H8v2.286a1 1 0 0 0 2 0V9h3v10h-.5a1 1 0 1 0 0 2h3a1 1 0 1 0 0-2H15V9h3v.286a1 1 0 1 0 2 0V7z" fill="currentColor"></path></svg>
				  			<span>Add Text</span>
				  		</div>
				  		<div class="change_div_content change_text_div change_hide_div-3" style="display:none;">
				  			<textarea></textarea>
				  		</div>
			  		</div>
		  		</div>
		  	</div>
		  </div>
		</div>
		
		
	</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
	
	var oldVal = "";
	$(".change_hide_div-1 textarea").on("change keyup paste", function() {
	    var currentVal = $(this).val();
	    
	    //action to be performed on textarea changed
	    console.log("textarea_val",currentVal);
	    $(".text_font1").val(currentVal);
	});
	$(".change_hide_div-2 textarea").on("change keyup paste", function() {
	    var currentVal = $(this).val();
	    
	    //action to be performed on textarea changed
	    console.log("textarea_val",currentVal);
	    $(".text_font2").val(currentVal);
	});
	$(".change_hide_div-3 textarea").on("change keyup paste", function() {
	    var currentVal = $(this).val();
	    
	    //action to be performed on textarea changed
	    console.log("textarea_val",currentVal);
	    $(".text_font3").val(currentVal);
	});
	
	
	
	function changeText(i){

		if(i == 1){

			var currentVal2 = $(".change_hide_div-2 textarea").val().trim().length;
			//console.log("currentVal2",currentVal2);
			var currentVal3 = $(".change_hide_div-3 textarea").val().trim().length;
			if(currentVal2 > 0){

				$(".change_show_div-2").hide();
				$(".change_hide_div-2").show();
			}else{

				$(".change_show_div-2").show();
				$(".change_hide_div-2").hide();
			}

			if(currentVal3 > 0){
				$(".change_show_div-3").hide();
				$(".change_hide_div-3").show();
			}else{
				
				$(".change_show_div-3").show();
				$(".change_hide_div-3").hide();
			}
			
			$(".change_show_div-1").hide();
			$(".change_hide_div-1").show();
			$(".text-tools").hide();
			$(".text-tools-one").show();
		}

		if(i == 2){
			var currentVal3 = $(".change_hide_div-3 textarea").val().trim().length;
			var currentVal1 = $(".change_hide_div-1 textarea").val().trim().length;
			if(currentVal3 > 0){
				$(".change_show_div-3").hide();
				$(".change_hide_div-3").show();
			}else{
				$(".change_show_div-3").show();
				$(".change_hide_div-3").hide();
			}

			if(currentVal1 > 0){
				$(".change_show_div-1").hide();
				$(".change_hide_div-1").show();
			}else{
				$(".change_show_div-1").show();
				$(".change_hide_div-1").hide();
			}
			//console.log("textarea_val1",currentVal);
			$(".change_show_div-2").hide();
			$(".change_hide_div-2").show();
			$(".text-tools").hide();
			$(".text-tools-two").show();
		}

		if(i == 3){

			var currentVal1 = $(".change_hide_div-1 textarea").val().trim().length;
			var currentVal2 = $(".change_hide_div-2 textarea").val().trim().length;
			if(currentVal1 > 0){
				$(".change_show_div-1").hide();
				$(".change_hide_div-1").show();
			}else{
				$(".change_show_div-1").show();
				$(".change_hide_div-1").hide();
			}

			if(currentVal2 > 0){
				$(".change_show_div-2").hide();
				$(".change_hide_div-2").show();
			}else{
				$(".change_show_div-2").show();
				$(".change_hide_div-2").hide();
			}
			
			$(".change_show_div-3").hide();
			$(".change_hide_div-3").show();
			$(".text-tools").hide();
			$(".text-tools-three").show();
		}
		
	}
	$(".text-tools-one .size-click").click(function(){
		$(".text-sizes").hide();
		$(".text-tools-one .size-tool-box").toggle();
	});
	$(".text-tools-one .color-click").click(function(){
		$(".text-sizes").hide();
		$(".text-tools-one .color-tool-box").toggle();
	});
	$(".text-tools-one .alignment-click").click(function(){
		
		$(".text-sizes").hide();
		$(".text-tools-one .align-tool-box").toggle();
	});
	$(".text-tools-one .font-click").click(function(){
		
		$(".text-sizes").hide();
		$(".text-tools-one .font-tool-box").toggle();
	});

	$(".text-tools-two .size-click").click(function(){
		$(".text-sizes").hide();
		$(".text-tools-two .size-tool-box").toggle();
	});
	$(".text-tools-two .color-click").click(function(){
		$(".text-sizes").hide();
		$(".text-tools-two .color-tool-box").toggle();
	});
	$(".text-tools-two .alignment-click").click(function(){
		
		$(".text-sizes").hide();
		$(".text-tools-two .align-tool-box").toggle();
	});
	$(".text-tools-two .font-click").click(function(){
		
		$(".text-sizes").hide();
		$(".text-tools-two .font-tool-box").toggle();
	});

	$(".text-tools-three .size-click").click(function(){
		$(".text-sizes").hide();
		$(".text-tools-three .size-tool-box").toggle();
	});
	$(".text-tools-three .color-click").click(function(){
		$(".text-sizes").hide();
		$(".text-tools-three .color-tool-box").toggle();
	});
	$(".text-tools-three .alignment-click").click(function(){
		
		$(".text-sizes").hide();
		$(".text-tools-three .align-tool-box").toggle();
	});
	$(".text-tools-three .font-click").click(function(){
		
		$(".text-sizes").hide();
		$(".text-tools-three .font-tool-box").toggle();
	});

	function changeTextSize(text_id,text_type,i){
        
		if(text_id == 1){

	        if(text_type == 'text-size'){
	        	
	        	$(".change_hide_div-1 textarea").css("font-size",i+"px");
	        	$(".text_size_font1").val(i);
	        	
	        } 

	        if(text_type == 'text-color'){
	        	$(".change_hide_div-1 textarea").css("color",i);
	        	$(".text_color_font1").val(i);
	        	
	        }

	        if(text_type == 'text-font'){
	        	$(".change_hide_div-1 textarea").css("font-family",i);
	        	$(".text_color_font1").val(i);
	        	
	        }
	        
	        if(text_type == 'text-align'){
	        	$(".change_hide_div-1 textarea").css("text-align",i);
	        	$(".text_color_font1").val(i);

	        	if(i == "vertically-top"){
	        		$(".change_hide_div-1").css("display","table-cell");
	        		$(".change_hide_div-1").css("width","400px");
	        		$(".change_hide_div-1").css("height","500px");
	        		$(".change_hide_div-1").css("vertical-align","top");
	        	}

	        	if(i == "vertically-middle"){
	        		$(".change_hide_div-1").css("display","table-cell");
	        		$(".change_hide_div-1").css("width","400px");
	        		$(".change_hide_div-1").css("height","500px");
	        		$(".change_hide_div-1").css("vertical-align","middle");
	        	}

	        	if(i == "vertically-bottom"){
	        		$(".change_hide_div-1").css("display","table-cell");
	        		$(".change_hide_div-1").css("width","400px");
	        		$(".change_hide_div-1").css("height","500px");
	        		$(".change_hide_div-1").css("vertical-align","bottom");
	        	}
	        }
    	}

    	if(text_id == 2){
	        if(text_type == 'text-size'){
	        	$(".change_hide_div-2 textarea").css("font-size",i+"px");
	        	$(".text_size_font2").val(i);
	        } 

	        if(text_type == 'text-color'){

	        	$(".change_hide_div-2 textarea").css("color",i);
				$(".text_color_font2").val(i);
	        }

	        if(text_type == 'text-font'){
	        	$(".change_hide_div-2 textarea").css("font-family",i);
	        	$(".text_color_font2").val(i);
	        	
	        }
    	}

    	if(text_id == 3){
	        if(text_type == 'text-size'){
	        	$(".change_hide_div-3 textarea").css("font-size",i+"px");
	        	$(".text_size_font3").val(i);
	        } 

	        if(text_type == 'text-color'){
	        	$(".change_hide_div-3 textarea").css("color",i);
	        	$(".text_color_font3").val(i);
	        }

	        if(text_type == 'text-font'){
	        	$(".change_hide_div-3 textarea").css("font-family",i);
	        	$(".text_color_font3").val(i);
	        	
	        }
    	}
		
	}

	$(".change_hide_div-1 textarea").click(function(){
		$(".text-tools").hide();
		$(".text-tools-one").show();
	});

	$(".change_hide_div-2 textarea").click(function(){
		$(".text-tools").hide();
		$(".text-tools-two").show();
	});

	$(".change_hide_div-3 textarea").click(function(){
		$(".text-tools").hide();
		$(".text-tools-three").show();
	});

	$(".text_btn_one").click(function(){
		var currentVal1 = $(".change_hide_div-1 textarea").val().trim().length;
		if(currentVal1 <= 0){
			$(".change_show_div-1").show();
			$(".change_hide_div-1").hide();
		}
		$(".text-tools-one").hide();
	});

	$(".text_btn_two").click(function(){
		var currentVal2 = $(".change_hide_div-2 textarea").val().trim().length;
		if(currentVal2 <= 0){
			$(".change_show_div-2").show();
			$(".change_hide_div-2").hide();
		}
		$(".text-tools-two").hide();
	});

	$(".text_btn_three").click(function(){
		var currentVal3 = $(".change_hide_div-3 textarea").val().trim().length;
		if(currentVal3 <= 0){
			$(".change_show_div-3").show();
			$(".change_hide_div-3").hide();
		}
		$(".text-tools-three").hide();
	});

	$(".close-icon-size-one .bx").click(function(){
		
		$(".text-tools-one .size-tool-box").hide();
	});
	$(".close-icon-colour-one .bx").click(function(){
		
		$(".text-tools-one .color-tool-box").hide();
	});
	$(".close-icon-align-one .bx").click(function(){
		
		$(".text-tools-one .align-tool-box").hide();
	});
	$(".close-icon-font-one .bx").click(function(){
		
		$(".text-tools-one .font-tool-box").hide();
	});

	$(".close-icon-size-two .bx").click(function(){
		
		$(".text-tools-two .size-tool-box").hide();
	});
	$(".close-icon-colour-two .bx").click(function(){
		
		$(".text-tools-two .color-tool-box").hide();
	});
	$(".close-icon-align-two .bx").click(function(){
		
		$(".text-tools-two .align-tool-box").hide();
	});
	$(".close-icon-font-two .bx").click(function(){
		
		$(".text-tools-two .font-tool-box").hide();
	});

	$(".close-icon-size-three .bx").click(function(){
		
		$(".text-tools-three .size-tool-box").hide();
	});
	$(".close-icon-colour-three .bx").click(function(){
		
		$(".text-tools-three .color-tool-box").hide();
	});
	$(".close-icon-align-three .bx").click(function(){
		
		$(".text-tools-three .align-tool-box").hide();
	});
	$(".close-icon-font-three .bx").click(function(){
		
		$(".text-tools-three .font-tool-box").hide();
	});

	$(document).mouseup(function(e){

    var container_size_one = $(".text-tools-one .size-tool-box");

    // If the target of the click isn't the container
    if(!container_size_one.is(e.target) && container_size_one.has(e.target).length === 0){
        container_size_one.hide();
    }

     var container_color_one = $(".text-tools-one .color-tool-box");

    // If the target of the click isn't the container
    if(!container_color_one.is(e.target) && container_color_one.has(e.target).length === 0){
        container_color_one.hide();
    }

     var container_align_one = $(".text-tools-one .align-tool-box");

    // If the target of the click isn't the container
    if(!container_align_one.is(e.target) && container_align_one.has(e.target).length === 0){
        container_align_one.hide();
    }

     var container_font_one = $(".text-tools-one .font-tool-box");

    // If the target of the click isn't the container
    if(!container_font_one.is(e.target) && container_font_one.has(e.target).length === 0){
        container_font_one.hide();
    }

    var container_size_two = $(".text-tools-two .size-tool-box");

    // If the target of the click isn't the container
    if(!container_size_two.is(e.target) && container_size_two.has(e.target).length === 0){
        container_size_two.hide();
    }

     var container_color_two = $(".text-tools-two .color-tool-box");

    // If the target of the click isn't the container
    if(!container_color_two.is(e.target) && container_color_two.has(e.target).length === 0){
        container_color_two.hide();
    }

     var container_align_two = $(".text-tools-two .align-tool-box");

    // If the target of the click isn't the container
    if(!container_align_two.is(e.target) && container_align_two.has(e.target).length === 0){
        container_align_two.hide();
    }

     var container_font_two = $(".text-tools-two .font-tool-box");

    // If the target of the click isn't the container
    if(!container_font_two.is(e.target) && container_font_two.has(e.target).length === 0){
        container_font_two.hide();
    }

    var container_size_three = $(".text-tools-three .size-tool-box");

    // If the target of the click isn't the container
    if(!container_size_three.is(e.target) && container_size_three.has(e.target).length === 0){
        container_size_three.hide();
    }

     var container_color_three = $(".text-tools-three .color-tool-box");

    // If the target of the click isn't the container
    if(!container_color_three.is(e.target) && container_color_three.has(e.target).length === 0){
        container_color_three.hide();
    }

     var container_align_three = $(".text-tools-three .align-tool-box");

    // If the target of the click isn't the container
    if(!container_align_three.is(e.target) && container_align_three.has(e.target).length === 0){
        container_align_three.hide();
    }

     var container_font_three = $(".text-tools-three .font-tool-box");

    // If the target of the click isn't the container
    if(!container_font_three.is(e.target) && container_font_three.has(e.target).length === 0){
        container_font_three.hide();
    }

    // var container_text_one = $(".text-one-div .change_show_div-1");

    // // If the target of the click isn't the container
    // if(!container_text_one.is(e.target) && container_text_one.has(e.target).length === 0){
    //     container_text_one.show();
    //     $(".text-one-div .change_hide_div-1").hide;
    // }
});

</script>
@endsection