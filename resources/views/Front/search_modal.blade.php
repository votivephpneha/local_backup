<style type="text/css">
  .modal{
    background-color: rgb(0,0,0) !important; /* Fallback color */
  background-color: rgba(0,0,0,0.4) !important; /* Black w/ opacity */
  }
</style>
<div class="modal fade cardpage_mdl card_modal" id="myModal-{{ $card_id }}" role="dialog" style="opacity: 1;display: block;background: transparent;">
    <div class="modal-dialog modal-lg card--modal">
    
      <!-- Modal content-->
      <div class="modal-content card-mod-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <?php 
                $gall_images_data = DB::table('card_gallery_images')->get()->where('card_id',$card_id);
                $card_sizes = DB::table('card_sizes')->where('card_id',$card_id)->get();
          
              ?>
              <div class="thumb-image">
                <!-- Set up your HTML -->
          <div class="card_carousel owl-carousel">
              @foreach ($gall_images_data as $gallary)    
            <div class="card-thumb-images">
              
              <img src="{{ url('/public/upload/gallery_images') }}/{{ $gallary->gall_images }}">
              
            </div>
            @endforeach
          </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card-sizes">
        <h4>Select Size</h4>
                <form  name="post_sizes_form" method="post" action="{{ url('post_sizes') }}">
                  @csrf
                  <input type="hidden" name="card_id" value="{{ $card_id }}" >
                  <input type="hidden" name="card_size_price" value="" class="card_size_price">
                  @foreach ($card_sizes as $c_size)
                    <div class="card_size_name">
                <div class="card_radio">
                    <input type="hidden" name="card_qty" value="{{ $c_size->card_size_qty }}">
                    <input type="radio" name="c_size" value="{{ $c_size->id  }}" required="" onclick="clickSize(this.value,'{{ $c_size->card_price }}')">&nbsp;{{ $c_size->card_type }}
                </div>
                <div class="card_grid_info">
                <div class="card_name_size">{{ $c_size->card_size }}</div>
                </div>
                <div class="card_price">
                <div class="card_name_price">
                  <?php
                    $card_price = $c_size->card_price;
                    echo "$".number_format((float)$card_price, 2, '.', '');
                  ?>
                </div>
                </div>    
                <div class="inner_card_icon">  
                  <span><i class='bx bx-gift'></i></span>
                </div>
              </div>
                    
                  @endforeach
                  <div class="qty_box">
                  <label for="quantity">Quantity</label>
                  <input type="number" class="form-control" name="qty_box" id="qty_box" required="" min="1">
                </div>
                  <input class="submit_btn" type="submit" name="btn" value="Submit">
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>